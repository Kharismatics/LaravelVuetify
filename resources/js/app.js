require('./bootstrap');

window.Vue = require('vue');

import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';
import './plugins/axios'

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify
});