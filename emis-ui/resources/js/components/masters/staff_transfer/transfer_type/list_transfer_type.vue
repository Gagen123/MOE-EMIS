<template>
    <div class="card-body">
        <table id="transfer_type" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Type</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in transferList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
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
            transferList:[], 
            dt:'',
        }
    },
    methods:{
        loadtransferTypeList(uri = 'masters/loadStaffMasters/all_transfer_type_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.transferList =  data.data.data;
            })
            .catch(function (error) {
            });
        },
        showedit(data){
            this.$router.push({name:'edit_transfer_type',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadtransferTypeList();
        this.dt =  $("#transfer_type").DataTable()

    },
    watch: {
        transferList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#transfer_type").DataTable()
            });
        }
    },
}
</script>
