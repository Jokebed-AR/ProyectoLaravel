<template>
    <div class="flex space-x-3 mt-3">
        <div class="form-group w-1/3" v-for="(item, index) in selects" :key="index">
            <label class="block uppercase tracking-wide text-gray-100 text-xs font-bold mb-2" for="grid-first-name">
                {{item.attribute_name}}
            </label>
            <select
                class="appearance-none block w-full text-gray-100 border-2 py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                :name="`variant_select${item.attribute_id}`"
                :id="`variant_select${item.attribute_id}`"
                @change="filterSelects(item.attribute_id)">
                <option value="" disabled>{{item.attribute_name}}</option>

                <option v-for="(option, index) in item.options" :key="index" :value="option.id">{{option.name}}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],
        data: () => ({
            dataParsed: null,
            selects: [],
            productSelected: null,
        }),
        mounted() {
            this.dataParsed = JSON.parse(this.data)
            let queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);

            let variant = urlParams.get('variant');

            this.preloadData(variant)
        },
        methods: {
            preloadData(variant = null) {
                let product = null;
                if (variant) {
                    product = this.dataParsed.filter(item => item.id === parseInt(variant))[0];
                } else {
                    let existProduct = this.dataParsed.filter(item => item.default === 1);
                    if (existProduct.length > 0) {
                        product = existProduct[0];
                    }
                }
                if (this.dataParsed[0].options) {
                    this.dataParsed[0].options.map(select => {
                        this.selects.push(select);
                    })
                    let all_options = []
                    this.dataParsed.map(variant => {
                        variant.options.map(option => {
                            all_options.push(
                                {
                                    id_select: option.attribute_id,
                                    id: option.option_id,
                                    name: option.option_name,
                                }
                            )
                        })
                    })
                    all_options = all_options.filter((v,i,a) => a.findIndex(t=>(t.id === v.id))===i)
                    this.selects.map(select => {
                        select.options = []
                        all_options.map(option => {
                            if (option.id_select === select.attribute_id) {
                                select.options.push(option);
                            }
                        })
                    })
                    this.$nextTick().then(() => {
                        let input = document.getElementById(`variant_select1`)
                        if (input) {
                            this.filterSelects(1, product);
                        }
                    });
                }
            },
            filterSelects(type, product = null) {
                let input = document.getElementById(`variant_select${type}`)
                
                let optionSelected = parseInt(input.value)
                
                let filter_products = [];
                let valuesSelects = [];
                this.dataParsed.map(product => {
                    product.options.map(option => {
                      if (option.option_id === optionSelected) {
                          filter_products.push(product)
                      }  
                    })
                })
                
                if (product === null) {
                    this.selects.map(select => {
                            let input = document.getElementById(`variant_select${select.attribute_id}`)
                            if (input) {
                                valuesSelects.push({
                                    attribute_id: select.attribute_id,
                                    attribute_name: select.attribute_name,
                                    optionSelected: parseInt(input.value)
                                })
                            }
                    })
                } else {
                    this.selects.map(select => {
                        let input = document.getElementById(`variant_select${select.attribute_id}`)
                        select.options.map((option, index) => {
                            product.options.map(optionProduct => {
                                if (optionProduct.option_id === option.id) {
                                    input.selectedIndex = index+1
                                    valuesSelects.push({
                                        attribute_id: optionProduct.attribute_id,
                                        attribute_name: optionProduct.attribute_name,
                                        optionSelected: parseInt(optionProduct.option_id)
                                    })
                                }
                            })
                        })
                    })
                }
                // console.log(valuesSelects);
                this.$forceUpdate();
                for (let indexProduct = 0; indexProduct < this.dataParsed.length; indexProduct++) {
                    let quantityOptions = this.dataParsed[indexProduct].options.length;
                    
                    let check = 0;
                    for (let index = 0; index < this.dataParsed[indexProduct].options.length; index++) {
                        if (valuesSelects[index]) {
                            if (this.dataParsed[indexProduct].options[index].option_id === valuesSelects[index].optionSelected) {
                                check++;
                            }
                        }
                    }
                    if (check === quantityOptions) {
                        this.$root.productSelected = this.dataParsed[indexProduct].price_tax;
                        this.$root.productSelectedVariants = this.dataParsed[indexProduct];
                        let url = '?variant=' + this.dataParsed[indexProduct].id
                        window.history.pushState(null, "Title", url);
                        this.$forceUpdate();
                        break;
                    } else {
                        this.$root.productSelected = 'No disponible';
                        this.$root.productSelectedVariants = null
                        this.$forceUpdate();
                    }
                };
            },
        },
    }
</script>
