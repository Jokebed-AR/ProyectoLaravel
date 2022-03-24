Nova.booting((Vue, router, store) => {
  Vue.component('index-common-questions', require('./components/IndexField'))
  Vue.component('detail-common-questions', require('./components/DetailField'))
  Vue.component('form-common-questions', require('./components/FormField'))
})
