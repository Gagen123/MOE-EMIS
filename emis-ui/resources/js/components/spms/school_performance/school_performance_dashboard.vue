<template>
       <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                <table id="evaluation-dashbord-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Domain Category</th>
                            <th>Status</th>
                            <th>No. of Schools</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in summaries" :key="index" @click.prevent="showedit(item)">
                            <td class="text-right">{{ index + 1}}</td>
                            <td>{{ item.sub_category}}</td>
                            <td>{{ item.status_name}}</td>
                            <td class="text-right pr-4"> 
                                <router-link :to="{name:'list_school_performance',params: {data:item}}">
                                     {{item.no_of_schools}}
                                </router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return {
            summaries:[],
            dt:'',
        }
    },
    methods:{
        getDEODashboardData(){
            axios.get('spms/getDeoDashboardData')
                .then(response => {
                    this.summaries = response.data
                })
        },
        showedit(data){
            this.$router.push({name:'list_school_performance',params: {data:data}})
        },
       
    },
    computed:{
        calculateTotal(){
            let totalSchhol = 0
            this.summaries.forEach(item => {
                return totalSchhol +=item.no_of_schools
            })
            return totalSchhol
        }
    },
    mounted(){
        this.getDEODashboardData()
        this.dt = $("#evaluation-dashbord-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
                { width: 120, targets: 3},
            ],
        })
        
    },
    watch: {
        summaries(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#evaluation-dashbord-table").DataTable()
            });
        }
    }
}
</script>