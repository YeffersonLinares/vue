
require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('app', require('./components/App.vue').default);
Vue.component('nota', require('./components/Notas.vue').default);

const app = new Vue({
    el: '#app',
});
