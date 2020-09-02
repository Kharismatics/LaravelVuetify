require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Vuetify from 'vuetify';

window.Vue.use(VueRouter);
window.Vue.use(Vuetify);

import ExampleComponent from './components/ExampleComponent.vue';
import TesComponent from './components/TesComponent.vue';

const routes = [
    {
        path: '/',
        component: ExampleComponent
    },
    {
        path: '/tes',
        component: TesComponent
    }
]

const router = new VueRouter({ routes })

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify(),
});