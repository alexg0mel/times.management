window.Vue = require('vue');


import exampleComponent from './components/ExampleComponent.vue'

const app = new Vue({
    el: '#app',
    template: '<exampleComponent/>',
    components: { exampleComponent }
});