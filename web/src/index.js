import Vue from 'vue';
import store from './store';
import router from './router';
import App from './App.vue';

import 'nprogress/nprogress.css';
import 'bootstrap';
import './scss/main.scss';

import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);

window.$ = window.jQuery = require('jquery');

new Vue({
    store,
    router,
    render: h => h(App),
}).$mount('#app');
