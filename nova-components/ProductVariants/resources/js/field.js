Nova.booting((Vue, router, store) => {
    Vue.component('index-product-variants', require('./components/IndexField'))
    Vue.component('detail-product-variants', require('./components/DetailField'))
    Vue.component('form-product-variants', require('./components/FormField'))
})
