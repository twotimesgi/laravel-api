const { default: Axios } = require('axios');
const { defaultsDeep } = require('lodash');


require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router';
import App from './views/App.vue';
import VueLuxon from 'vue-luxon';

import PageHome from './pages/PageHome.vue';
import PageAbout from './pages/PageAbout.vue';
import PageContact from './pages/PageContact.vue';
import PostIndex from './pages/PostIndex.vue';
import PostShow from './pages/PostShow.vue';
import Page404 from './pages/Page404.vue';


Vue.use(VueLuxon);
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: PageHome,
        },
        {
            path: '/about',
            name: 'about',
            component: PageAbout,
        },
        {
            path: '/contact',
            name: 'contact',
            component: PageContact,
        },
        {
            path: '/blog',
            name: 'postIndex',
            component: PostIndex,
        },
        {
            path: '/blog/:slug',
            name: 'postShow',
            component: PostShow,
            props: true,
        },
        {
            path: '*',
            name: 'page404',
            component: Page404,
        },
    ]
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router,
});
