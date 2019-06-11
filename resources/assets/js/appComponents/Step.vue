<template>
    <div class="form-control">
        <div class="row">
            <div class="col-md-4">
                <template v-if="groups" v-for="group in groups">
                    <p class="pl-0" @click="atgroup(group.group_id)"><strong>{{group.name_group}}</strong></p>
                    <template v-if="this_group(group.group_id)" v-for="project in group.projects">
                        <p @click="atproject(project.project_id)" class="pl-2">{{project.name_project}}</p>
                        <template v-if="this_project(project.project_id)" v-for="task in project.tasks">
                            <p @click="attask(task.task_id)" :class="this_task(task.task_id) ? 'pl-4 active':'pl-4'" >{{task.name_task}}</p>
                        </template>
                    </template>
                </template>

            </div>
            <div class="col-md-8">
                <wysiwyg v-model="step_opis" />
                <div id="checkdiv">
                    <checkbox v-model="active" v-show="show" @change="onChange" class="p-svg p-curve" color="success" off-color="danger" toggle :disabled="!enabled_checkbox" >
                        <svg slot="extra" class="svg svg-icon" viewBox="0 0 24 24">
                            <path d="M12,20A7,7 0 0,1 5,13A7,7 0 0,1 12,6A7,7 0 0,1 19,13A7,7 0 0,1 12,20M19.03,7.39L20.45,5.97C20,5.46 19.55,5 19.04,4.56L17.62,6C16.07,4.74 14.12,4 12,4A9,9 0 0,0 3,13A9,9 0 0,0 12,22C17,22 21,17.97 21,13C21,10.88 20.26,8.93 19.03,7.39M11,14H13V8H11M15,1H9V3H15V1Z"
                                  style="stroke: white;fill:white"></path>
                        </svg>
                        ON
                        <svg slot="off-extra" class="svg svg-icon" viewBox="0 0 24 24">
                            <path d="M12,20A7,7 0 0,1 5,13C5,11.72 5.35,10.5 5.95,9.5L15.5,19.04C14.5,19.65 13.28,20 12,20M3,4L1.75,5.27L4.5,8.03C3.55,9.45 3,11.16 3,13A9,9 0 0,0 12,22C13.84,22 15.55,21.45 17,20.5L19.5,23L20.75,21.73L13.04,14L3,4M11,9.44L13,11.44V8H11M15,1H9V3H15M19.04,4.55L17.62,5.97C16.07,4.74 14.12,4 12,4C10.17,4 8.47,4.55 7.05,5.5L8.5,6.94C9.53,6.35 10.73,6 12,6A7,7 0 0,1 19,13C19,14.27 18.65,15.47 18.06,16.5L19.5,17.94C20.45,16.53 21,14.83 21,13C21,10.88 20.26,8.93 19.03,7.39L20.45,5.97L19.04,4.55Z"
                                  style="stroke: white;fill:white"></path>
                        </svg>
                        <label slot="off-label">OFF</label>
                    </checkbox>
                </div>
            </div>
        </div>


    </div>

</template>


<script>

    import wysiwyg from 'vue-wysiwyg';
    import checkbox from 'pretty-checkbox-vue/check';

    const config={hideModules: {
        "code": true,
        "table": true

        }};
    Vue.use(wysiwyg, config);


    export default {
        components: {checkbox},
        props: {
            token:null
        },

        data: function() {
          return {
            step_opis:'',
            groups:null,
            active:false,
            group:null,
            project:null,
            task:null,
            show:false

          }
        },

        methods: {
            loadTasks:function () {
                axios.get('/api/tasks', this.api_token).then((response)=> {
                    this.groups = response.data
                });
            },
            atgroup:function (id) {
                this.group=id;
                this.task = null
            },
            this_group:function (id) {
                return this.group===id
            },
            atproject:function (id) {
                this.project=id;
                this.task = null
            },
            this_project:function (id) {
                return this.project===id
            },
            attask:function (id) {
                this.task=id
            },
            this_task:function (id) {
                return this.task===id
            },
            loadTime:function () {
                axios.get('/api/get-time',this.api_token).then((response) => {
                    this.show = true
                    if (response.data) {
                        const time = response.data
                        this.step_opis = time.step_opis
                        this.group = time.group_id
                        this.project = time.task.project_id
                        this.task = time.task_id
                        Vue.nextTick(() => {this.active = true})

                    }
                })
            },
            startTime:function () {

                axios.post('/api/start-time/'+this.group+'/'+this.task,{},this.api_token).then((response) => {
                     if (this.step_opis)
                            this.putOpis()
                })
            },
            stopTime:function () {
                axios.put('/api/stop-time',{},this.api_token)
            },
            putOpis:function () {
                axios.put('/api/time',{step_opis:this.step_opis},this.api_token);
            },
            onChange:function () {
                if (this.active)
                    this.startTime()
                else
                    this.stopTime()
            }


        },
        mounted() {
            this.loadTasks()
            this.loadTime()
        },
        computed: {
            api_token: function () {
                return {headers: {'Authorization': `Bearer ` + this.token}}
            },
            enabled_checkbox:function () {
                return (this.task != null)
            }
        },
        watch: {
            step_opis : function () {
                if (this.active) this.putOpis()
            }
        }

    }
</script>

<style scoped>
    @import "~vue-wysiwyg/dist/vueWysiwyg.css";
    @import "~pretty-checkbox/dist/pretty-checkbox.css";


    #app .active{
        background-color: #bce5f2;
    }

    #app p{
        cursor: pointer;
    }

    #checkdiv{
        font-size: 100px;
    }

    .form-control{
        height: initial;
        min-height: calc(1.5em + .75rem + 2px);
    }

</style>