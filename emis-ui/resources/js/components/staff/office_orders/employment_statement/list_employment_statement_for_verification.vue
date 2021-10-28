<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
                <table id="transfer_order_table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Order Number</th>
                            <th>Applicant Name</th>
                            <th>EID</th>
                            <th>Position Title</th>
                            <th>Position Level</th>
                            <th>Working Address</th>
                            <th>Date of Application</th>
                            <th>Status</th>
                            <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.order_no }}</td>
                            <td>{{ item.staff_name }}</td>
                            <td>{{ item.emp_id }}</td>
                            <td>{{ item.position_title_name }}</td>
                            <td>{{ item.positionlevel }}</td>
                            <td>{{ item.working_agency }}</td>
                            <td>{{ reverseDateTime(item.created_at) }}</td>
                            <td>{{ item.status===1 ? 'Pending For Approval' : item.status ===3?  'Rejected' : 'Approved'}}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-edit"></span> Open</a>
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
    methods: {
        loadeditpage(itme){
            this.$router.push({name:"verify_employment_statement",query:{data:itme}});
        },
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });

        axios.get('/staff/staffOfficeorderController/loadCreatedApplicationForVerification/TransferOrder__EMPSTAT')
        .then((response) =>{
            let data=response.data.data;
            this.data_list=data;
        })
        .catch((error) =>{
            console.log("Error loadDataList: "+error);
        });
        this.dt =  $("#transfer_order_table").DataTable();
    },
    watch: {
        data_list() {
            this.applydatatable('transfer_order_table');
        }
    },
}
</script>
