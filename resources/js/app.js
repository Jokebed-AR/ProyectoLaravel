require('./bootstrap');
import VueWaypoint from 'vue-waypoint'
import Toasted from 'vue-toasted';



window.Vue = require('vue');
import Variants from './components/Variants.vue';
import Navbar from './components/Navbar.vue';
import Accordion from './components/Accordion';
import AccordionItem from './components/AccordionItem';



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Components

Vue.use(VueWaypoint)
Vue.use(Toasted)


Vue.component('navbar', Navbar)
Vue.component('variants-component', Variants)
Vue.component('accordion-component', Accordion);
Vue.component('accordion-item-component', AccordionItem);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import { mixins } from './utils'

Vue.directive('scroll', {
    inserted: function (el, binding) {
        let f = function (evt) {
            if (binding.value(evt, el)) {
                window.removeEventListener('scroll', f, {pasive: true})
            }
        }
        window.addEventListener('scroll', f, {pasive: true})
    }
})


const app = new Vue({
    // components: { carousel },
    el: '#app',
    mixins: [mixins],
});
