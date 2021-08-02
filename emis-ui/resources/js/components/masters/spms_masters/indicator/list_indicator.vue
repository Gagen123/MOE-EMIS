<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="indicator-data-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Parameter</th>
                            <th>Indicator</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in indicators" :key="index">
                            <td class="text-right">{{ index + 1 }}</td>
                            <td>{{ item.parameter }} </td>
                            <td>{{ item.name }} </td>
                            <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>

                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                </div>
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
        return{
            indicators:[],
            dt:''
        }
    },
    methods:{
        getIndicators(uri = 'masters/loadSpmMasters/all_indicators'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.indicators =  data.data.data
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_indicator',params: {data:data}})
        },
    },
    mounted(){ 
        this.getIndicators();
        this.dt =  $("#indicator-data-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
                { width: 100, targets: 1},
                { width: 50, targets: 3},
                { width: 50, targets: 4},
            ],
        })
    },
    watch: {
        indicators(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#indicator-data-table").DataTable()
            });
        }
    }
}
</script>
