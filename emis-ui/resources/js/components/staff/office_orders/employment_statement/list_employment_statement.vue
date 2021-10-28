<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="transfer_order_table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Order Number</th>
                            <th>Date of Application</th>
                            <th>Status</th>
                            <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.order_no }}</td>
                            <td>{{ reverseDateTime(item.created_at) }}</td>
                            <td>{{ item.status===1 ? 'Pending For Approval' : item.status ===3?  'Rejected' : 'Approved'}}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadviewpage(item,'view')"> <span class="fa fa-eye"></span> View</a>
                                <a href="#" v-if="item.status===1" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-edit"></span> Edit</a>
                                <a href="#" v-if="item.status===2" class="btn btn-primary btn-sm btn-flat text-white" @click="loadviewpage(item,'print')"> <span class="fa fa-print"></span> Print</a>
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
            selectionList:{},
            data_list:[],
        }
    },
    methods:{
        loadeditpage(itme){
            this.$router.push({name:"edit_employment_statement",query:{data:itme}});
        },
        loadviewpage(itmem,type){
            this.$router.push({name:"view_employment_statement",query:{data:itmem,type:type}});
        },
    },
    mounted(){
        axios.get('/staff/staffOfficeorderController/loadCreatedApplication/TransferOrder__EMPSTAT')
        .then((response) =>{
            let data=response.data.data;
            this.data_list=data;
        })
        .catch((error) =>{
            console.log("Error loadDataList: "+error);
        });
        this.dt = $("#transfer_order_table").DataTable();
    },
    watch:{
        data_list(){
            this.applydatatable('transfer_order_table');
        }
    },
}
</script>
