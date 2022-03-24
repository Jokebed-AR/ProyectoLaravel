import VueCurrencyInput from 'vue-currency-input'
const pluginOptions = { /* see config reference */ }

Nova.booting((Vue, router, store) => {
    Vue.use(VueCurrencyInput, pluginOptions)
    Vue.component('index-CurrencyField', require('./components/IndexField'))
    Vue.component('detail-CurrencyField', require('./components/DetailField'))
    Vue.component('form-CurrencyField', require('./components/FormField'))
})
