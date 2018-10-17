<template>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <template v-show="projects.length>0">
                            <label for="group-projects">Проект:</label>
                            <select  @change="projectChange()" id="group-projects" class="form-control" v-model="project">
                                <option value="0" v-if="project==0">Выберите проект...</option>
                                <option v-for="project in projects" :value="project.id">{{ project.name_project }}</option>
                            </select>
                        </template>

                    </div>

                    <div class="card-body" v-show="project!=0">
                        <div class="row">
                            <div class="col-md-6">
                                <dl>
                                    <dt>Свободные задачи:</dt>
                                    <draggable v-model="free_tasks" class="dragArea" :options="{group:'tasks'}" >
                                        <dd v-for="item in free_tasks" :data-id="item.id">{{item.name_task}}</dd>
                                    </draggable>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt>Группа задач:</dt>
                                    <draggable v-model="group_tasks" class="dragArea" :options="{group:'tasks'}" @add="drag" @remove="drag">
                                        <dd v-for="item in group_tasks" :data-id="item.id">{{item.name_task}}</dd>
                                    </draggable>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>


<script>

    import draggable from 'vuedraggable'

    export default {
        components: {draggable},
        props: {
            token:null,
            group:null
        },
        data: function() {
          return {
              projects:   [],
              free_tasks: [],
              group_tasks:[],
              project:0
          }
        },
        mounted() {
            this.loadProjects();
        },
        methods: {
            loadProjects: function () {
                axios.get('/api/groups/projects', this.api_token).then((response)=> {
                    this.projects = response.data
                });
            },
            loadFreeTasks: function () {
                axios.get('/api/groups/free-tasks/'+this.project,this.api_token).then((response)=> {
                    this.free_tasks = response.data
                });
            },
            loadLinkedTasks: function () {
                axios.get('/api/groups/group-tasks/'+this.project+'/'+this.group, this.api_token).then((response)=> {
                    this.group_tasks = response.data
                });
            },
            projectChange: function () {
                this.loadFreeTasks();
                this.loadLinkedTasks()
            },
            drag: function (e) {
                if (e.type=='add') this.linkTask(e.clone.dataset.id)
                if (e.type=='remove') this.unlinkTask(e.clone.dataset.id)
            },
            linkTask: function (task) {
                axios.post('/api/groups/link-tasks/'+this.group+'/'+task,{},this.api_token)
            },
            unlinkTask: function (task) {
                axios.delete('/api/groups/link-tasks/'+this.group+'/'+task,this.api_token)
            }

        },
        computed:{
            api_token:function () {
                return {headers:{'Authorization': `Bearer `+ this.token}}
            }
        }
    }
</script>

<style scoped>
    .dragArea{
        min-height: 50px;
        background-color: #bce5f2;
    }

</style>