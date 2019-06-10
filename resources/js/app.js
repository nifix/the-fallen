/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router';


window.Vue = require('vue');
window.Vue.use(VueRouter);

import App from './components/App';
import Home from './components/Home';
import Roster from './components/Roster';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/roster',
            name: 'roster',
            component: Roster
        },
        {
            path: '/forum',
            name: 'forum',
            beforeEnter() { location.href = 'https://www.thefallen-guild.com/forum/index.php' }
        }
    ]
});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('App', require('./components/App.vue').default);
Vue.component('Home', require('./components/Home.vue').default);
Vue.component('Roster', require('./components/Roster.vue').default);

// Blocks
Vue.component('RecruitingBlock', require('./components/partials/RecruitingBlock.vue').default);
Vue.component('RaiderioBlock', require('./components/partials/RaiderioBlock.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    component: { App },
    router
});
