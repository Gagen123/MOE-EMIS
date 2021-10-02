<template>
    <div class="card-body ">
        <table id="transfer-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Name</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in transferList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
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
        async loadworkingagencyList(){
            this.transferList =  await this.loadstaffMasters('all','TransferReason');
        },
        showedit(data){
              this.$router.push({name:'edit_transfer_reason',params: {data:data}});
        },
        
    },
    mounted(){
        this.loadworkingagencyList();
        this.dt =  $("#transfer-table").DataTable();
    },
    watch: {
        transferList(val) {
            this.applydatatable('#transfer-table');
        }
    },
}
</script>
