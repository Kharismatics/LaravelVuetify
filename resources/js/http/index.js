import Vue from 'vue';

// axios
import VueAxios from 'vue-axios'
import axios from 'axios'

// // Vue Resource
// import VueResource from 'vue-resource';


// axios
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`;

// // Vue Resource
// Vue.use(VueResource);
// Vue.http.options.root = process.env.MIX_APP_URL+'/api';

export default {
    // root: process.env.VUE_APP_API_URL
};