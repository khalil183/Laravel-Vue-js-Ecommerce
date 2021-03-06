
require('./bootstrap');
window.Vue = require('vue');


Vue.component('router-view-component', require('./components/admin/RouterViewComponent.vue').default);

// router
import router from '../js/router/router'
// Store
import store from '../js/store/store'

// alert
import Swal from 'sweetalert2'
window.Swal=Swal


const app = new Vue({
    el: '#app',
    router,
    store
});

