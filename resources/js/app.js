require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

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

const app = new Vue({ router }).$mount('#app')