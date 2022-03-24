<template>
    <div>
        <default-field :field="field" :errors="errors">
            <template slot="field">
                <div  class="nova-items-field-input-wrapper w-full flex border border-40 p-4">
                    <multiselect
                        class="form-control w-full"
                        v-model="variantsSelect"
                        placeholder="Agregar variantes"
                        selectLabel="Presione enter para agregar"
                        selectedLabel="Seleccionada"
                        deselectLabel="Presione enter para eliminar"
                        group-values="opts"
                        group-label="category"
                        :group-select="true"
                        label="option_name"
                        track-by="option_name"
                        :options="options"
                        :multiple="true"
                        @input="load()"
                    >
                        <template slot="noResult">No se encontraron coincidencias</template>
                    </multiselect>
                    <a @click="generate()" class="btn btn-default btn-primary ml-3 cursor-pointer font-sans">
                        Generar
                    </a>
                </div>

            </template>
        </default-field>
        <div class="w-full flex justify-center pt-5 pb-5" >

        <div class="overflow-hidden overflow-x-auto relative" style="width: 60%;" v-if="this.variants.length > 0">
            <table cellpadding="0" cellspacing="0" data-testid="resource-table" class="table w-full table-undefined">
                <thead>
                    <tr>
                        <th class="text-left">
                            <span>Default</span>
                        </th>
                        <th class="text-left">
                            <span>Variantes</span>
                        </th>
                        <th class="text-left">
                            <span>Precio</span>
                        </th>
                        <th class="text-left">
                            <span>Precio + IVA</span>
                        </th>
                        <th class="text-left" colspan="2">
                            <span>Precio con descuento</span>
                            <div class="help-text lowercase">(0 en caso de que no aplique)</div>
                        </th>
                        <!-- <th class="text-left">
                            <span >
                                &nbsp;
                            </span>
                        </th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr dusk="2-row" v-for="(variant, index) in variants" :key="index">
                        <td class="text-center">
                            <span  class="text-left">
                                <label class="contenedor">
                                <input  type="radio" :id="index" :value="index" name='default' :checked="variants[index].default"  v-model="defaultPicked">
                                <span class="checkmark"></span>
                                </label>
                            </span>
                        </td>
                        <td>
                            <span  class="text-left" v-for="(option, indexOpt) in variant.options" :key="indexOpt">{{option.attribute_name}}: {{option.option_name}} <br></span>
                        </td>
                        <td>
                            <span  class="text-left">
                                <input class="w-full form-control form-input form-input-bordered" type="number" v-model="variants[index].normal_price">
                            </span>
                        </td>
                        <td>
                            <span  class="text-left">
                                <input class="w-full form-control form-input form-input-bordered" type="number"  v-model="variants[index].price_tax">
                            </span>
                        </td>
                        <td>
                            <span  class="text-left">
                                <input class="w-full form-control form-input form-input-bordered" type="number"  v-model="variants[index].discount">
                            </span>
                        </td>
                        <td class="td-fit text-right pr-6 align-middle">
                            <div class="inline-flex items-center">
                                <span class="inline-flex">
                                    <a  class="inline-flex appearance-none cursor-pointer text-70 hover:text-primary mr-3"  @click="deleteVariant(index)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" aria-labelledby="delete" role="presentation" class="fill-current">
                                            <path fill-rule="nonzero" d="M6 4V2a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6H1a1 1 0 1 1 0-2h5zM4 6v12h12V6H4zm8-2V2H8v2h4zM8 8a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1z">
                                            </path>
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import Multiselect from 'vue-multiselect'
export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    components: { Multiselect },

    data () {
      return {
            variantsSelect: [
            ],
            options: [

            ],
            variants: [
            ],

            showTable: false,
            defaultPicked: ''
      }
    },

    mounted(){
        this.createVariants()
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.variants = this.field.variants
            this.variantsSelect = this.field.optionsSelected
            for (let i = 0; i < this.variants.length; i++) {
                if (this.variants[i].default)
                {
                    this.defaultPicked = i;
                    break;
                }
            }
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            for (let i = 0; i < this.variants.length; i++) {
                this.variants[i].default = false
            }
            if( this.variants[this.defaultPicked])
                this.variants[this.defaultPicked].default = true
            
            formData.append('variants', JSON.stringify(this.variants))
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },

        addTag (newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.multi.options.push(tag)
            this.multi.value.push(tag)
        },

        async createVariants(){
            let attributes = this.field.attributes
             for(let i = 0; i < attributes.length; i++){
                await this.options.push({category:attributes[i].name,  opts:[]})
                 for(let j = 0; j < attributes[i].options.length; j++){
                    await this.options[i].opts.push({option_name: attributes[i].options[j].name,
                    attribute_id: attributes[i].id,
                    option_id:attributes[i].options[j].id,
                    attribute_name: attributes[i].name})
                }
            }
        },

        load(){
            this.showTable = false
        },
        generate(){
            let tmpVariants = this.groupBy(this.variantsSelect, 'attribute_id')
            var filteredVariants = tmpVariants.filter(function (variant) {
                return !(Object.keys(variant).length === 0 );
            });
            let variantsGenerated = this.generateVariants(filteredVariants)
            this.variants = this.initializeVariants(variantsGenerated)
            this.showTable = true
        },
        groupBy(data, key)
        {
            return data.reduce(function(item, x) {
                (item[x[key]] = item[x[key]] || []).push(x);
                return item;
            }, []);
        },
        generateVariants(variants)
        {
            let r = [], max = variants.length-1;
            if(max < 0)
                return [];

            function helper(arr, i) {
                for (let j=0, l=variants[i].length; j<l; j++) {
                    let a = arr.slice(0);
                    a.push(variants[i][j]);
                    if (i==max)
                        r.push(a);
                    else
                        helper(a, i+1);
                }
            }
            helper([], 0);
            return r;
        },
        initializeVariants(variants)
        {
            let dataVariants = []
            for (let i=0; i<variants.length; i++) {
                dataVariants.push({
                    'normal_price': 0,
                    'price_tax': 0,
                    'discount': 0,
                    'options': variants[i],
                    'default': false
                })
            }
            return dataVariants;

        },
        deleteVariant(index)
        {
            this.variants.splice(index, 1);
        }

    },
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
