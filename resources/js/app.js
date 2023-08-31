/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from "vue";
import swal from 'sweetalert2';
import 'bootstrap-vue/dist/bootstrap-vue.css';
require('./bootstrap');
import moment from 'moment';
import VueMoment from 'vue-moment';


window.Vue = require('vue');
Vue.use(VueMoment, {moment});


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent').default);
Vue.component('track-index', require('./components/track/index').default);

Vue.component('track-overview-shipment', require('./components/track/shipmentOverview').default);
Vue.component('track-view-shipment', require('./components/track/shipmentView').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



window.swal = swal


import 'bootstrap/dist/css/bootstrap.css'

let app = new Vue({
    el: '#body-wrapper',
    mounted: function () {
        this.addTransitions()
    },
    data: {
        darkTheme: false,
        extendedView: false,
        removeTransition: true,
    },
    methods: {
        addTransitions: function () {
            setTimeout(function () {
                app.removeTransition = false
            }, 300);
        },
        changeView: function (sidebar, language) {
            axios.post('/interface/sidebar', {
                sidebar: sidebar
            })
                .then(response => {
                    app.extendedView = response['data'];
                    if (language === 'php') {
                        location.reload()
                    }
                })
        },
        toast: function (toaster, append = false, title, message) {
            this.$bvToast.toast(message, {
                title: title,
                toaster: toaster,
                solid: true,
                appendToast: append
            })
        }
    },
});
