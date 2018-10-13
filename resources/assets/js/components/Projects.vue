<template>
    <div class="row">
        <div class="col-md-6">
            <table>
                <thead>
                <tr>
                    <th v-for="key in columns"
                        @click="sortBy(key)"
                        :class="{ active: sortKey === key }">
                        {{ key | capitalize }}
                        <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
                  </span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="entry in filteredData" @click="selectThis(entry)" :class="entry===currProject ? 'active' : ''">
                    <td v-for="key in columns">
                        {{entry[key]}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <tasks :data="tasks" :columns="['name_task', 'active']" :api_token="api_token" :project="currProject"> </tasks>
        </div>
    </div>
</template>

<script>
    import hotkeys from 'hotkeys-js';
    import Tasks from "./Tasks";

     export default {
        name: "Projects",
         components: {Tasks},
         props: {
            data: Array,
            columns: Array,
            api_token:null
        },
        data: function () {
            let sortOrders = {};
            this.columns.forEach(function (key) {
                sortOrders[key] = 1
            });
            return {
                sortKey: '',
                sortOrders: sortOrders,
                currProject: null,
                tasks:[]
            }
        },
        computed: {
            filteredData: function () {
                const sortKey = this.sortKey;
                const order = this.sortOrders[sortKey] || 1;
                let data = this.data;
                if (sortKey) {
                    data = data.slice().sort(function (a, b) {
                        a = a[sortKey];
                        b = b[sortKey];
                        return (a === b ? 0 : a > b ? 1 : -1) * order
                    })
                }
                return data
            }
        },
        filters: {
            capitalize: function (str) {
                return str.charAt(0).toUpperCase() + str.slice(1)
            }
        },
        methods: {
            sortBy: function (key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1
            },
            selectThis: function (data) {
                this.currProject = data;
            },
            moveCursor: function (step) {
                const sizeArr = this.filteredData.length;
                let currPos, i;
                for (i=0; i<sizeArr;i++) {
                    if (this.filteredData[i]===this.currProject) {
                        currPos = i;
                        break
                    }
                }
                currPos += step;
                if (currPos<0) currPos=sizeArr-1;
                if (currPos >= sizeArr) currPos = 0;
                this.currProject = this.filteredData[currPos]
            },
            loadTasks: function () {
                axios.get('/api/projects/'+this.currProject.id+'/tasks', this.api_token).then((response)=> {
                    this.tasks = response.data
                });
            }
        },
        beforeUpdate() {
            if (this.data[0] && !this.currProject) this.currProject = this.data[0];
        },
         mounted() {
             hotkeys('up', (event, handler) => {
                 event.preventDefault();
                 this.moveCursor(-1);
             });
             hotkeys('down', (event, handler) => {
                 event.preventDefault();
                 this.moveCursor(1);
             });

         },
         watch: {
             currProject: function () {
                 this.loadTasks()
             }
         }

    }
</script>

<style scoped>
    body {
        font-family: Helvetica Neue, Arial, sans-serif;
        font-size: 14px;
        color: #444;
    }

    table {
        border: 2px solid #0c64a2;
        border-radius: 3px;
        background-color: #fff;
    }

    th {
        background-color: #0c64a2;
        color: rgba(255,255,255,0.66);
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    td {
        background-color: #f9f9f9;
        cursor: pointer;
    }

    th, td {
        min-width: 120px;
        padding: 10px 20px;
    }

    th.active {
        color: #fff;
    }
    tr.active, tr.active td {
        background-color: #e0e0e0;
    }

    th.active .arrow {
        opacity: 1;
    }

    .arrow {
        display: inline-block;
        vertical-align: middle;
        width: 0;
        height: 0;
        margin-left: 5px;
        opacity: 0.66;
    }

    .arrow.asc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-bottom: 4px solid #fff;
    }

    .arrow.dsc {
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #fff;
    }
</style>