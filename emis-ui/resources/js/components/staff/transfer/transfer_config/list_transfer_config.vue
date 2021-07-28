<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Transfer Type</th>
                    <th >Submitter</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in transferConfigurationList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{transfertypeList}} {{transfertypeList[item.transfer_type_id]}} {{item.transfer_type_id}}</td>
                    <td>{{ roleList[item.submitter_role_id]}}</td>
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
            transferConfigurationList:[],
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
        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response.data;
                 for(let i=0;i<data.length;i++){
                    this.roleList[data[i].id] = data[i].Name;
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
        mounted(){
            this.LoadTransferType();
            this.loadroleList();

            this.TransferConfigurationList();


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
