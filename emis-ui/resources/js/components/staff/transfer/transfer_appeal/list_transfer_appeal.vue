<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Transfer Type</th>
                    <th >Date of Apply</th>
                    <th> Status</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in transferAppealDetails" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{item.transfer_type_id}}</td>
                     <td>{{ item.submitter_role_id}}</td>
                    <td>{{ item.submitter_role_id}}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>      
</template>
<script>
export default {
    data(){
        return{
            transferAppealDetails:[],
            transfertypeList:{},
            roleList:{},
        }
    },
    methods:{
        TransferConfigurationList(uri = 'masters/loadAllTransferConfigMasters/'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.transferConfigurationList = data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        LoadTransferType(uri = 'masters/loadGlobalMasters/all_transfer_type_list'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.transfertypeList[data[i].id] =data[i].type;
                }
            })
            .catch(function (error){
                console.log(error);
            });

        },
        LoadTransferAppealDetails(uri = 'staff/transfer/LoadTransferAppealDetails/'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data.data;
                this.transferAppealDetails = data;
                
            })
            .catch(function (error){
                console.log(error);
            });

        },
      
        showedit(data){
            this.$router.push({name:'create_transfer_appeal',params: {data:data.id}});
        },
    },
        mounted(){ 
            this.transferAppealDetails();
            this.LoadTransferType();
            this.LoadTransferAppealDetails();
          

        },
        watch:{
            leaveConfigurationList() {
                this.dt.destroy();
                this.$nextTick(() => {
                    this.dt =  $("#working-agency-table").DataTable()
                });
            }
        },
}
</script>
