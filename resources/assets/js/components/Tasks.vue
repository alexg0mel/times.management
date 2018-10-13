<template>
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
        <tr v-for="entry in filteredData">
            <td v-for="key in columns">
                <template v-if="key==='active'"> <input type="checkbox"  @click="changeActive(entry)" v-model="entry[key]"/> </template>
                <template v-else> {{entry[key]}} </template>
            </td>
        </tr>
        </tbody>
    </table>

</template>

<script>
     export default {
        name: "Tasks",
        props: {
            data: Array,
            columns: Array,
            api_token:null,
            project: null
        },
        data: function () {
            let sortOrders = {};
            this.columns.forEach(function (key) {
                sortOrders[key] = 1
            });
            return {
                sortKey: '',
                sortOrders: sortOrders
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
            changeActive: function (entry) {
                if (!entry.active)
                    this.link(entry.id);
                else
                    this.unlink(entry.id);
            },
            link: function (task_id) {
                axios.post('/api/projects/'+this.project.id+'/tasks/'+task_id+'/link',{}, this.api_token);
            },
            unlink: function (task_id) {
                axios.delete('/api/projects/'+this.project.id+'/tasks/'+task_id+'/link', this.api_token);
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