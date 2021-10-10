require('./bootstrap');


// require vue
window.Vue = require('vue').default;

Vue.component('front-page',require('./components/Front.vue').default);

const app = new Vue({
    el: '#app',
});