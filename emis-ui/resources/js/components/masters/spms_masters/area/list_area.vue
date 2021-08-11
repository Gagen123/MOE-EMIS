<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="area-data-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Domain</th>
                            <th>Area</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in areas" :key="index">
                            <td class="text-right">{{ item.display_sequence_no }}</td>
                            <td>{{ item.domain }} </td>
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
            areas:[],
            dt:''
        }
    },
    methods:{
        getAreas(uri = 'masters/loadSpmMasters/all_areas'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.areas =  data.data.data
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_area',params: {data:data}})
        },
    },
    mounted(){ 
        this.getAreas();
        this.dt =  $("#area-data-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
            ],
        })
    },
    watch: {
        areas(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#area-data-table").DataTable()
            });
        }
    }
}
</script>
