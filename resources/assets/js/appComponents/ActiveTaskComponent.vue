<template>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">My tasks</div>

                    <div class="card-body">
                        <projects :data="projects" :columns="['name_project']" :api_token="api_token">
                        </projects>
                    </div>
                </div>
            </div>
        </div>
</template>



<script>

    import Projects from "../components/Projects.vue";
    export default {
        components: {Projects},
        data: function() {
          return {
              api_token:null,
              projects: [],
              tasks:[]
          }
        },
        mounted() {
            this.api_token = {headers:{'Authorization': `Bearer `+ Window.Laravel.token}};
            this.loadProjects();
        },
        methods: {
            loadProjects: function () {
                axios.get('/api/projects', this.api_token).then((response)=> {
                    this.projects = response.data
                });
            }
        }
    }
</script>
