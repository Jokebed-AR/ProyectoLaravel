<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div class="flex items-center border-b border-b-2 border-teal-500 py-2">
                <input class="w-full form-control form-input form-input-bordered rounded border-r"
                       type="text"
                       :placeholder="__('New option')"
                       @keypress.enter.prevent="addNewOption()"
                       v-model="newOption"
                >
                <button
                    class="btn btn-default btn-primary rounded"
                    type="button"
                    @click="addNewOption()"
                >
                    +
                </button>
            </div>

            <div class="flex mt-5"
                 v-for="(key) in Object.keys(options)"
            >

                <input class="w-full form-control form-input form-input-bordered rounded border-r"
                       type="text"
                       :placeholder="__('Option')"
                       v-model="options[key].name"
                >
                <button
                    class="btn btn-default btn-danger rounded"
                    type="button"
                    @click="deleteOption(key)"
                >
                    -
                </button>

            </div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data () {
        return {
            options: {},
            newOption: '',
            lastIndex: 0
        }
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || JSON.stringify({})
            this.options = JSON.parse(this.value)
            this.lastIndex = Object.keys(this.options).length
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },

        addNewOption () {
            this.options[this.lastIndex] = {
              name: this.newOption,
              value: this.newOption.split(' ').join('-').toLowerCase()
            }

            this.lastIndex ++
            this.newOption = ''
            this.handleChange(JSON.stringify(this.options))
        },

        deleteOption (index) {
            delete this.options[index]
            this.handleChange(JSON.stringify(this.options))
            this.$forceUpdate()
        }
    },
}
</script>
