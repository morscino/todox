require('./bootstrap');

window.Vue = require('vue');

import vuerouter from 'vue-router';
import App from './App.vue';
import routes from './routes.js';
import swal from 'sweetalert2';

window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;

Vue.use(require('vue-moment'));
Vue.use(vuerouter);
const router = new vuerouter({routes});


new Vue({
	router,
    render: h => h(App)
}).$mount('#app');
