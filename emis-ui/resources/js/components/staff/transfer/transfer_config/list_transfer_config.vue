<template>
    <div class="card-body">
        <table id="transfer_config_list" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Transfer Type</th>
                    <th >Submitter</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in dataLists" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{item.name}}</td>
                    <td>{{roleList[item.submitter_role_id]}}</td>
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
            roleList:[],
            dataLists:[],
          
        }
    },
    methods:{
        TransferConfigurationList(uri = 'masters/loadAllTransferConfigMasters/'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dataLists = data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response.data;
                 for(let i=0;i<data.length;i++){
                    this.roleList[data[i].Id] = data[i].Name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },

        showedit(data){
            this.$router.push({name:'edit_transfer_config',params: {data:data.id}});
        },
    },
       async created(){
            this.loadroleList();
            this.TransferConfigurationList();
        },
       watch: {
        dataLists(){
            this.$nextTick(() => {
                this.dt =  $("#transfer_config_list").DataTable()
            });
        }
        },
}
</script>
