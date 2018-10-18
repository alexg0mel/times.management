import activeTaskComponent from './appComponents/ActiveTaskComponent.vue'

const app = new Vue({
    el: '#app',
    template: '<activeTaskComponent/>',
    components: {activeTaskComponent}
});