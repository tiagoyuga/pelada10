/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import TDate from './boot-vue-functions'

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('link-destroy-component', require('./components/LinkDestroyComponent').default);

//Vue.component('group-product-component', require('./components/GroupProductComponent').default);
//Vue.component('product-main-component', require('./components/ProductMainComponent').default);
//Vue.component('product-item-component', require('./components/ProductItemComponent').default);

//Vue.component('select2-vue-component', require('./components/Select2VueComponent').default);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    methods: {
        dateFormatBR: TDate.dateBR,
        dateFormatUS: TDate.dateUS,
    }
});

$('#app').tooltip({
    //selector: '[data-toggle="tooltip"]'
    //selector: "[data-tooltip=tooltip]",
});
