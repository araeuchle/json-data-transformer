/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('viewer', require('./screens/Viewer.vue').default);
Vue.component('bottomNavigation', require('./components/BottomNavigation.vue').default);
Vue.component('parseScreen', require('./screens/ParseScreen.vue').default);
Vue.component('dataScreen', require('./screens/DataScreen.vue').default);
Vue.component('exportScreen', require('./screens/ExportScreen.vue').default);
Vue.component('configScreen', require('./screens/ConfigScreen.vue').default);
Vue.component('snapshotScreen', require('./screens/SnapshotScreen.vue').default);



import Sticky from 'vue-sticky-directive';
Vue.use(Sticky);

import Zondicon from 'vue-zondicons';
Vue.component('Zondicon', Zondicon);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store/store';

const app = new Vue({
    store,
    el: '#app',
});
