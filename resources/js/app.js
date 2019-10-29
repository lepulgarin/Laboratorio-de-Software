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

Vue.component('formu-component', require('./components/formulario/FormuComponent.vue').default);
Vue.component('ppal-component', require('./components/formulario/PpalComponent.vue').default);
Vue.component('fecha-component', require('./components/formulario/FechaComponent.vue').default);
Vue.component('horario-component', require('./components/formulario/HorComponent.vue').default);
Vue.component('horarios-component', require('./components/formulario/horariosComponent.vue').default);

Vue.component('ppal-sol-component', require('./components/solicitudes/FormPpal.vue').default);
Vue.component('solPen-component', require('./components/solicitudes/FormSolPen.vue').default);
Vue.component('solAten-component', require('./components/solicitudes/FormSolAten.vue').default);
Vue.component('solAsig-component', require('./components/solicitudes/FormSolAsig.vue').default);
Vue.component('sol-component', require('./components/solicitudes/FormSolicitud.vue').default);

Vue.component('formuEdit-component', require('./components/editarSolicitud/FormuComponent.vue').default);
Vue.component('fechaEdit-component', require('./components/editarSolicitud/FechaComponent.vue').default);
Vue.component('horarioEdit-component', require('./components/editarSolicitud/HorComponent.vue').default);
Vue.component('horariosEdit-component', require('./components/editarSolicitud/horariosComponent.vue').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
