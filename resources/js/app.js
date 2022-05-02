window.Vue = require('vue').default;
import axios from 'axios'
Vue.component('login', require('./components/Login').default)
Vue.component('product', require('./components/Product').default)
Vue.component('register', require('./components/Register').default)
Vue.component('ProductDetailDialog', require('./components/common/ProductDetailDialog').default)
Vue.component('verify', require('./components/verify').default)
Vue.component('card', require('./components/Card').default)
Vue.component('payment', require('./components/Payment').default)

axios.defaults.headers['Authorization'] = `Bearer ${window.localStorage.getItem('token')}`;



import "tailwindcss/tailwind.css"
import Vue from 'vue'
import App from './views/layouts/app.vue'
const app = new Vue({
    el: '#app',
    components: { App }
});
