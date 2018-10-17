window.Vue = require('vue');

Vue.component('task-in-group-component', require('./appComponents/TaskInGroupComponent.vue'));

const app = new Vue({
    el: '#app',
});


