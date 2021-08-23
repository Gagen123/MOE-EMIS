<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <select class="form-control select2" name="reporting_type" id="reporting_type">
                    <option value=""> --Select--</option>
                    <option value="Transfer"> Transfer </option>
                    <option value="Leadership"> Leadership Selection </option>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <button type="button" @click="loadList()" class="btn btn-primary">Load</button>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="list-table-id" class="table table-sm table-bordered table-striped">
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
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.applicant_name}}</td>
                            <td>{{ item.aplication_number}}</td>
                            <td>{{ item.created_at}}</td>
                            <td><span class="badge badge-success">{{ item.status}}</span></td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadviewpage(item)"> <span class="fa fa-eye"></span> Open</a>
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
            data_list:[],
        }
    },
    methods: {
        loadviewpage(item){
            let page_uri="";
            if(item.aplication_number.includes('STF')){
                page_uri="update_leadership_reporting";
            }else{ //transfer
                page_uri="view_report_transfer";
            }
            this.$router.push({name:page_uri,params:{data:item}});
        },
        loadtransferDetails(){
            axios.get('staff/transfer/reportingTransfer/Approved__Reported')
            .then((response) => {
                let data = response.data
                this.data_list = data;

             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
            });
        },

        loadList(){
            let loadType=$('#reporting_type').val();
            let uri="";
            if(loadType=="Transfer"){
                uri="staff/transfer/reportingTransfer/Approved__Reported";
            }
            if(loadType=="Leadership"){
                uri="/staff/staffLeadershipSerivcesController/loadApprovedApplication";
            }
            axios.get(uri)
            .then((response) => {
                let data = response.data;
                this.data_list = data;
             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
            });
        },
    },
    mounted() {
        // this.loadtransferDetails();
        this.dt =  $("#list-table-id").DataTable()
    },
    watch: {
        data_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#list-table-id").DataTable()
            });
        }
    },

}
</script>


