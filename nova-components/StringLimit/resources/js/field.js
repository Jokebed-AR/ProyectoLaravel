Nova.booting((Vue, router, store) => {
    Vue.component('index-StringLimit', require('./components/IndexField'))
    Vue.component('detail-StringLimit', require('./components/DetailField'))
    Vue.component('form-StringLimit', require('./components/FormField'))
})
