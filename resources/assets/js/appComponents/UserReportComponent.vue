<template>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Projects in day</div>

                    <div class="card-body">
                        <div class="input-date">
                            <datepicker v-model="input_date" :language="ru" :bootstrap-styling="true" :monday-first="true"></datepicker>
                        </div>
                        <div class="report" v-if="report">
                            <table class="text-center">
                                <tr>
                                    <th>Проект</th>
                                    <th>Задача</th>
                                    <th>Описание</th>
                                    <th>Время, мин.</th>
                                    <th>Время, час.</th>
                                </tr>
                                <template v-for="item in report">
                                    <tr>
                                        <td>{{item.task.project.name_project}}</td>
                                        <td>{{item.task.name_task}}</td>
                                        <td>{{item.step_opis}}</td>
                                        <td>{{(item.fact_time/60).toFixed(1)}}</td>
                                        <td>{{(item.fact_time/3600).toFixed(2)}}</td>
                                    </tr>
                                </template>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>



<script>
    import datepicker from 'vuejs-datepicker';
    import {ru} from 'vuejs-datepicker/dist/locale'

    export default {
        components: {datepicker},
        data: function() {
          return {
              api_token:null,
              input_date:new Date(),
              ru: ru,
              report:undefined,
          }
        },
        mounted() {
            this.api_token = {headers:{'Authorization': `Bearer `+ Window.Laravel.token}};
            this.loadReport();
        },
        methods: {
            loadReport: function () {
                const date=this.input_date.getDate()+'-'+(this.input_date.getMonth()+1)+'-'+this.input_date.getFullYear();
                axios.get('/api/reports/user-report-day/'+date, this.api_token).then((response)=> {
                    this.report = response.data
                });
            },
        },
        watch: {
            input_date : function () {
                 this.loadReport()
            }
        }
    }
</script>

<style scoped>
    .report table{
        width: 100%;
    }

    .input-date {
        padding-bottom: 20px;
    }
</style>
