<template>
    <div class="form-control">
        <input :id="name" :name="name" v-model="inputvalue" type="hidden"/>
        <numericInput v-model="days" min="0" max="20" size="100px" align="center"></numericInput> <span class="align-top"><strong>&nbsp;дней&nbsp;</strong></span>
        <numericInput v-model="hours" min="0" max="23" size="100px" align="center"></numericInput> <span class="align-top"><strong>&nbsp;часов&nbsp;</strong></span>
        <numericInput v-model="minutes" min="0" max="59" size="100px" align="center"></numericInput> <span class="align-top"><strong>&nbsp;минут</strong></span>
    </div>

</template>


<script>

    import numericInput from 'vue-numeric-input'

    export default {
        components: {numericInput},
        props: {
            value:0,
            name:''
        },
        data: function() {
          return {
              days:0,
              hours:0,
              minutes:0,
              inputvalue:0
          }
        },

        methods: {
            decode: function () {
                let value= this.value;
                this.days = this.div(value,1440);
                value-=this.days*1440;
                this.hours = this.div(value,60);
                this.minutes = value- this.hours*60;
            },
            encode: function() {
              this.inputvalue =this.days*1440 + this.hours * 60 + this.minutes
            },
            
            div:function (val, by) {
                return (val - val % by) / by
            }
        },
        mounted() {
            this.decode();
            this.inputvalue = this.value
        },
        watch:{
            days: function () {
                this.encode()
            },
            hours: function () {
                this.encode()
            },
            minutes: function () {
                this.encode()
            }
        }

    }
</script>
