<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="reason_for_absent_table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in reasonList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name }}</td>
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
            reasonList:[],
            dt:''
        }
    },
    methods:{
        loadReasonsForAbsentList(uri = 'masters/loadAcademicMasters/all_reasons_for_absent'){
            axios.get(uri)
            .then(response => {
                this.reasonList =  response.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_reason_for_absent',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadReasonsForAbsentList();
        this.dt =  $("#reason_for_absent_table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
            ],
        })
    },
    watch: {
        reasonList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#reason_for_absent_table").DataTable()
            });
        }
    }
}
</script>
