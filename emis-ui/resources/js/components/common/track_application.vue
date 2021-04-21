<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Track Application</h6></li>
        </ol>
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <span>Application/Registration Number:<i class="text-danger">*</i></span>
                        <input type="text" id="appNo" @change="remove_error('appNo_err','appNo')" name="appNo" class="form-control">
                        <span class="text-danger" id="appNo_err"></span>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt-4">
                         <button type="button" @click="getapplicationDetials()" class="btn btn-xs btn-success btn-flat" id="printbtn"><i class="fa fa-eye"></i> View Details</button>
                     </div>
                </div>
                <div class="row form-group" id="status_table" style="display:none">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="tableLearner" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl_No</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Action By</th>
                                    <th>Action Date</th>
                                </tr>
                            </thead>  
                            <tbody>
                                <tr v-for="(item, index) in workflow_detail_list" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.status_name }}</td>
                                    <td>{{ item.remarks }}</td>
                                    <td>{{ item.user_name}} ({{ item.role_name}})</td>
                                    <td>{{ item.action_date }}</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                workflow_detail_list:[],
            };
        },
        methods:{
            validatefield(){
                let returnval=true;
                if($('#appNo').val()==""){
                    $('#appNo_err').html('This field is required');
                    $('#appNo').focus();
                    $('#appNo').addClass('is-invalid');
                    returnval=false;
                }
                return returnval;
            },
            remove_error(errorId,field_id){
                if($('#'+field_id).val()!=""){
                    $('#'+field_id).removeClass('is-invalid');
                    $('#'+errorId).html('');
                }
            },
            getapplicationDetials(){
                if(this.validatefield()){
                    axios.get('common/getApplicationDetials/'+$('#appNo').val())
                    .then(response => {
                        let data = response;
                        this.workflow_detail_list = data.data;
                        $('#status_table').show();
                    });
                }
            },
        },
    }
</script>
