window.Vue = require('vue');


import activeTaskComponent from './appComponents/ActiveTaskComponent.vue'
// Вариант 1

const app = new Vue({
    el: '#app',
    template: '<activeTaskComponent/>',
    components: {activeTaskComponent}
});