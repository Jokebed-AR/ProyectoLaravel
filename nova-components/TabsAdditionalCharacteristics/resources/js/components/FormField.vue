<template>
    <div class="py-8">
        <div class="flex px-8">
            <button
                class="btn-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full text-center"
                @click.prevent="addNewCharacteristic()"
            >
                + Agregar
            </button>
        </div>

        <div class="bg-white rounded-t-lg overflow-hidden  border-gray-400 p-4 ">
            <ul class="flex border-b ml-5 ">
                <li
                    v-for="(tab, index) in tabs"
                    :key="index"
                    class="-mb-px mr-1"
                >
                    <a :class="{
                            'bg-white inline-block py-2 px-4 text-blue-dark border-l border-t border-r rounded-t font-semibold' : (index === activeIndex),
                            'bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold' : (index !== activeIndex)
                        }"
                       href="#"
                       @click.prevent="changeActiveTab(index)"
                    >{{ tab.name }}</a>
                </li>
            </ul>
        </div>

        <div
            v-if="activeCharacteristic"
            class="flex p-8"
        >
            <div class="w-1/4">
                <input
                    id="characteristic-name"
                    class="w-full form-control form-input form-input-bordered"
                    type="text"
                    placeholder="Nombre de la característica"
                    v-model="tabs[activeIndex].name"
                >
            </div>
            <div class="w-1/4">
                <button
                    class="btn btn-default bg-red-dark ml-5 rounded-full text-white"
                    @click.prevent="deleteCharacteristic(activeIndex)"
                >
                    Eliminar
                </button>
            </div>
        </div>
        <div
            v-if="activeCharacteristic && tabs.length > 0"
            class="flex px-8"
        >
            <!-- <trumbowyg
                v-model="tabs[activeIndex].content"
                :config="config"
                class="form-control"
                name="content"
                @tbwchange="tabContentUpdated"
                @tbwfocus="tabContentUpdated"
            ></trumbowyg> -->
            
            <editor v-model="tabs[activeIndex].content"
                    class="form-control w-full"
                    :placeholder="field.name"
                    :init="options"
            ></editor>
        </div>
    </div>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import Trumbowyg from 'vue-trumbowyg'
import 'trumbowyg/dist/ui/trumbowyg.css'
import Editor from '@tinymce/tinymce-vue'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data () {
        return {
            activeIndex: 0,
            tabs: {}
        }
    },
    methods: {

        changeActiveTab(index) {
            this.activeIndex = index
            this.$forceUpdate()
        },

        addNewCharacteristic () {
            this.tabs.push({ name: 'Característica', content: 'Contenido' })
            this.activeIndex = this.tabs.length - 1;
            this.handleChange(this.tabs)
            this.$forceUpdate()
        },

        deleteCharacteristic (index) {
            // delete this.tabs[index]
            this.tabs.splice(index, 1);
            this.activeIndex = 0
            this.handleChange(this.tabs)
            this.$forceUpdate()
        },

        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || JSON.stringify({})
            this.tabs = JSON.parse(this.value)
            let keys = Object.keys(this.tabs) 
            let newTabs = []
            keys.map(key =>  {
                newTabs.push(this.tabs[key])
            })
            this.tabs = newTabs
            // console.log(newTabs);
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || [])
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = JSON.stringify(value)
            // console.log(this.value);
            // this.activeIndex = Object.keys(this.tabs).length - 1
        },

        filePicker: function (callback, value, meta) {
            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            let type = 'image' === meta.filetype ? 'Images' : 'Files';
            let url  = this.options.path_absolute + this.options.lfm_url + '?editor=tinymce5&type=' + type;

            tinymce.activeEditor.windowManager.openUrl({
                url : url,
                title : 'File manager',
                width : x * 0.8,
                height : y * 0.8,
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }
    },
    computed: {
        activeCharacteristic () {
            if (this.tabs.length > 0) {
                return this.tabs[this.activeIndex.toString()]
            }
            return null
        },
        options() {
            let options = this.field.options
            // if (options.use_lfm) {
            //     options['file_picker_callback'] = this.filePicker
            // }
            options['file_picker_callback'] = this.filePicker

            return options
        }
    },
    watch: {
        tabs (val) {
            this.handleChange(val)
        },
        'activeCharacteristic.name' () {
            this.handleChange(this.tabs)
        },
        'activeCharacteristic.content' () {
          this.handleChange(this.tabs)
        }
    },
    components: { Trumbowyg, Editor }
}
</script>

<style>
.tox-tinymce{
    width: 100% !important;
    height: 600px !important;
}
</style>