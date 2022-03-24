<template>
<div>
  <default-field :full-width-content="true" :field="field" :errors="errors" :show-help-text="showHelpText">
    <template slot="field">
      <div class="flex w-full justify-end flex-wrap nova-items-field-input-wrapper border border-40 p-4">
        <div class="flex flex-col w-1/2 px-1">
          <p class="my-2 text-80">Pregunta</p>
          <!-- <input
            id="question"
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :class="errorClasses"
            placeholder="Pregunta"
            v-model="question"
          /> -->
          <textarea 
            id="question" cols="30" rows="10" 
            v-model="question"
            class="w-full form-input form-input-bordered h-16"
            placeholder="Pregunta"></textarea>
        </div>
        <div class="flex flex-col w-full md:w-1/2 px-1">
        <p class="my-2 text-80">Respuesta</p>
          <!-- <input
            id="answer"
            type="text"
            class="w-full form-control form-input form-input-bordered"
            :class="errorClasses"
            placeholder="Respuesta"
            v-model="answer"
          /> -->
          
          <textarea 
            id="answer" cols="30" rows="10" 
            v-model="answer"
            class="w-full form-input form-input-bordered h-16"
            placeholder="Respuesta"></textarea>
        </div>
        <a @click="addFaq()" class="mt-2 btn btn-default btn-primary ml-3 cursor-pointer font-sans">
            Agregar
        </a>
      </div>
    </template>
  </default-field>
  
        <div class="w-full flex justify-center pt-5 pb-5" >

        <div class="overflow-hidden overflow-x-auto relative" style="width: 60%;" v-if="this.faqs.length > 0">
            <table cellpadding="0" cellspacing="0" data-testid="resource-table" class="table w-full table-undefined">
                <thead>
                    <tr>
                        <th class="text-left">
                            <span>Pregunta</span>
                        </th>
                        <th class="text-left">
                            <span>Respuesta</span>
                        </th>
                        <th class="text-left">
                            <span >
                                &nbsp;
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr dusk="2-row" v-for="(faq, index) in faqs" :key="index">
                        <td>
                            <span class="text-left">{{faq.question}}<br></span>
                        </td>
                        <td>
                            <span class="text-left">{{faq.answer}}<br></span>
                        </td>
                        <td class="td-fit text-right pr-6 align-middle">
                            <div class="inline-flex items-center">
                                <span class="inline-flex">
                                    <a  class="inline-flex appearance-none cursor-pointer text-70 hover:text-primary mr-3"  @click="editFaq(index)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" aria-labelledby="edit" role="presentation" class="fill-current"><path d="M4.3 10.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H5a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM6 14h2.59l9-9L15 2.41l-9 9V14zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h6a1 1 0 1 1 0 2H2v14h14v-6z"></path></svg>
                                    </a>
                                </span>
                                <span class="inline-flex">
                                    <a  class="inline-flex appearance-none cursor-pointer text-70 hover:text-primary mr-3"  @click="deleteFaq(index)">
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

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

  data(){
    return{
      question: '',
      answer: '',
      faqs:[],
    }
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
        this.faqs = this.field.value ?  JSON.parse(this.field.value) : []
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, JSON.stringify(this.faqs) || [])
    },

    addFaq(){
      this.faqs.push({ question: this.question, answer: this.answer})
      this.question = ''
      this.answer = ''
    },
    deleteFaq(index){
      this.faqs.splice(index, 1)
    },
    editFaq(index){
      this.question = this.faqs[index].question
      this.answer = this.faqs[index].answer
      this.faqs.splice(index, 1)
    }
  },
}
</script>
