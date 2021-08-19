<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Applicant Name</th>
                            <th>Application Number</th>
                            <th>Date of Apply</th>
                            <th>Remark From HRCD</th>
                            <th>Status</th>
                            <th class="pl-4 pr-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in transfer_list" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ item.application_no}}</td>
                            <td>{{ item.created_at}}</td>
                             <td>{{ item.remarks}}</td>
                            <td><span class="badge badge-success">{{ item.status}}</span></td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View/Edit</a>
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
            totle:0,
            transfer_list:[],
            form: new form({
                status:'',
                staff_name:'',

            })
        }
    },
    methods: {
        showedit(item){
            this.$router.push({name:"edit_transfer_window",params:{data:item}});
		},
        loadTransferAppealDetails(){
            axios.get('staff/transfer/LoadTransferAppealDetails')
            .then((response) => {
                let data = response.data
                this.transfer_list = data;

             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
            });
        },
        loadeditpage(item){
            this.$router.push({name:"edit_transfer_appeal",params:{data:item}});
        },
        applyselect2(){
        },
    },
    mounted() {
        this.loadTransferAppealDetails();
        this.dt =  $("#training-table").DataTable()
    },
    watch: {
        transfer_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#training-table").DataTable()
            });
        }
    },

}
</script>


