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
                    <td>{{ item.transfer_type_id}}</td>
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
            transferConfigurationList:[],
            TransferTypeName:[],
        }
    },
    methods:{
        TransferConfigurationList(uri = 'masters/loadAllTransferConfigMasters/'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.transferConfigurationList = data.data.data;
                this.TransferTypeName= data.data.data.id;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        // TransferTypeName(id){
        //     alert("dsdsds");
        //     axios.get('masters/loadGlobalMasters/'+id)
        //     .then(response => {
        //         let data = response;
        //         this.transferConfigurationList = data.data.data;
        //         this.transferTypeid= data.data.data.id;
        //     })
        //     .catch(function (error){
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        // },

        showedit(data){
            this.$router.push({name:'edit_transfer_config',params: {data:data.id}});
        },
    },
    mounted(){ 
        this.TransferConfigurationList();
        // this.TransferTypeName();
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
