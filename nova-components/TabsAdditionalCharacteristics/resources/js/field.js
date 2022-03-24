
window.$ = window.jQuery = require('jquery')

Nova.booting((Vue, router, store) => {
    Vue.component('index-tabs-additional-characteristics', require('./components/IndexField'))
    Vue.component('detail-tabs-additional-characteristics', require('./components/DetailField'))
    Vue.component('form-tabs-additional-characteristics', require('./components/FormField'))
})
