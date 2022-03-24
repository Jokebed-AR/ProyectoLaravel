Nova.booting((Vue, router, store) => {
    Vue.component('index-question-options', require('./components/IndexField'))
    Vue.component('detail-question-options', require('./components/DetailField'))
    Vue.component('form-question-options', require('./components/FormField'))
})
