require('./bootstrap');

require('alpinejs');

// require vue
window.Vue = require('vue').default;


Vue.component('front-page',require('./components/Front.vue').default);
Vue.component('favorite',require('./components/Favorite.vue').default);

Vue.component('favorites',require('./components/Favorites.vue').default);
Vue.component('categories',require('./components/Categories.vue').default);

const app = new Vue({
    el: '#app',
});