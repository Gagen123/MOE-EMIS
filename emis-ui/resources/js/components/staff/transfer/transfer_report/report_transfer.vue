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
                            <th>Status</th>
                            <th class="pl-4 pr-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in transfer_list" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.applicant_name}}</td>
                            <td>{{ item.aplication_number}}</td>
                            <td>{{ item.created_at}}</td>
                            <td><span class="badge badge-success">{{ item.status}}</span></td> 
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadviewpage(item)"> <span class="fa fa-eye"></span> View</a>
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
            transfer_list:[],
        }
    },
    methods: {
        loadviewpage(item){
            this.$router.push({name:"view_report_transfer",params:{data:item}});
        },
        loadtransferDetails(){
            axios.get('staff/transfer/reportingTransfer/Approved__Reported')
            .then((response) => {
                let data = response.data
                this.transfer_list = data;

             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
            });
        },
       
        applyselect2(){
        },
    },
    mounted() {
        this.loadtransferDetails();
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


