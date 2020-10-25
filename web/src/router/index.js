import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes.js';
import {initProgressBar} from './progress.js';

Vue.use(VueRouter);

const router = new VueRouter({routes});

// initProgressBar(router);

export default router;
