window.Vue = require('vue');


Vue.component('active-task-component', require('./appComponents/ActiveTaskComponent.vue'));
// вариант 2

const app = new Vue({
    el: '#app'
});