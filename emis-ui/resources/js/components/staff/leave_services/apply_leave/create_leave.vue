<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Type:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="leave_type_id" v-model="form.leave_type_id" :class="{ 'is-invalid': form.errors.has('leave_type_id') }">
                            <option v-for="(item, index) in leavetypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="leave_type_id"></has-error>
                    </div>
                </div>
                <div class="row form-group" id="form_details" style="display:none">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Application:</label>
                        <span class="text-blue">{{current_date}}</span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>No of days/months you can avail:</label>
                        <span class="text-blue">{{leave_balance}}{{total_leave_apply}}</span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4 pb-4">
                        <label class="mb-0.5">Applicant:<i class="text-danger">*</i></label>
                        <select v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }}: {{ item.name }}, {{item.position_title}}</option>
                        </select>
                        <has-error :form="form" field="staff_id"></has-error>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>From Date:<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" :class="{ 'is-invalid': form.errors.has('from_date') }"  name="from_date" id="from_date" v-model="form.from_date">
                        <has-error :form="form" field="from_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>To Date:<span class="text-danger">*</span></label>
                        <input type="date" @change="calculateNoDays()" :class="{ 'is-invalid': form.errors.has('to_date') }"  class="form-control" name="to_date" id="to_date" v-model="form.to_date">
                        <has-error :form="form" field="to_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. of Days:</label>
                        <input type="number" class="form-control" :class="{ 'is-invalid': form.errors.has('no_days') }"  name="no_days" id="no_days" v-model="form.no_days">
                        <has-error :form="form" field="no_days"></has-error>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                        <label>Details:<span class="text-danger">*</span></label>
                        <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }" v-model="form.reason" id="reason"></textarea>
                        <has-error :form="form" field="reason"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Upload the Required Documents<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="card">
                    <div class="form-group row">
                        <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                        <td>
                                            <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                            <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                        </td>
                                        <td>
                                            <input type="file" name="attachments" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                            <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                            @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                            <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                            @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" style="display:none" id="applyId"><i class="fa fa-save"></i> Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            count:0,
            leavetypeList:[],
            staffList:[],
            roleList:[],
            count:1,
            current_date:'',
            total_leave_apply:'',
            actual_leave_avail:0,
            leave_balance:0,
            form: new form({
                staff_id:'',
                leave_type_id:'',
                year:'',
                date_of_application:'',
                from_date:'',
                to_date:'',
                no_days:'',
                reason:'',
                submitted_to:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
                action_type:'create'
            })
        }
    },
    methods: {
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#file_name'+currentcount).val()!=""){
                this.form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#file_name'+currentcount).prop('readonly',true);
            }
            else{
                $('#file_name'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        addMore: function(){
            this.count++;
            this.form.attachments.push({file_name:'', attachment:''});
        },
        remove(){
            if(this.form.attachments.length>1){
                this.count--;
                this.form.attachments.pop();
            }
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadleaveTypeList(uri = 'masters/loadStaffMasters/all_leave_type_list'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.leavetypeList =  data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        calculateNoDays(){
            if($('#from_date').val()==""){
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry! ',
                    text: 'Please provide From Date first!',
                });
                $('#to_date').val('');
            }

            if($('#from_date').val()!="" && $('#from_date').val() > $('#to_date').val()){
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry! ',
                    text: 'Please mention valid To Date. To Date should be greater then from date!',
                });
                $('#to_date').val('');
            }
            if($('#from_date').val()!="" && $('#to_date').val()!="" && $('#from_date').val() <= $('#to_date').val()){
                let date1 = new Date($('#from_date').val());
                let date2 = new Date($('#to_date').val());
                let Difference_In_Time = date2.getTime() - date1.getTime();
                let Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
                // $('#no_days').val(Difference_In_Days);
                Difference_In_Days++;
                this.form.no_days=Difference_In_Days;
            }
        },
        validated(){
            let returntype=true;
            if(this.total_leave_apply.toLowerCase().includes('day') && this.form.no_days>this.leave_balance){
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry! ',
                    text: 'You can avail maximum of '+this.leave_balance +' Days',
                });
                returntype=false;
            }
            return returntype;
        },
		formaction: function(type){
            if(type=="save" && this.validated()){
                Swal.fire({
                    text: "Are you sure you wish to submit for further approval ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('leave_type_id', this.form.leave_type_id);
                        formData.append('staff_id', this.form.staff_id);
                        formData.append('year', this.form.year);
                        formData.append('date_of_application', this.form.date_of_application);
                        formData.append('from_date', this.form.from_date);
                        formData.append('to_date', this.form.to_date);
                        formData.append('no_days', this.form.no_days);
                        formData.append('reason', this.form.reason);
                        formData.append('submitted_to', this.form.submitted_to);
                        formData.append('action_type', this.form.action_type);
                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attach);
                            formData.append('attachmentname[]', this.form.ref_docs[i].name);
                        }
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }
                        axios.post('/staff/staffServices/submitLeaveApplication', formData, config)
                        // this.form.post('/staff/staffServices/submitLeaveApplication',this.form)
                        .then((response) => {
                            if(response.data!=undefined){
                                let message="Leave Application has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'Leave_acknowledgement',params: {data:message}});
                                Swal.fire(
                                    'Success!',
                                    'Leave Application has been submitted for approval',
                                    'success',
                                )
                            }
                            else{
                                if(response.includes('No role mapping found for this selected use')){
                                    Swal.fire({
                                        title: 'No Role Configuration ! ',
                                        text: "Sorry! "+response.data,
                                        icon: 'error',
                                    });
                                }
                            }
                            //
                        })
                        .catch((err) =>{
                            console.log("Error: "+err);
                            this.applyselect2();

                        })
                    }
                })

            }
		},
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="leave_type_id"){
                this.form.leave_type_id=$('#leave_type_id').val();
                this.getLeave_details();
            }
            if(id=="staff_id"){
                this.form.staff_id=$('#staff_id').val();
                this.getApprovedLeaveCount();
            }
        },
        loadstaff(){
            let uri = 'loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.staffList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getLeave_details(){
            axios.get('staff/staffServices/checkEligibility/'+$('#leave_type_id').val())
            .then(response =>{
                let data = response.data.data;
                console.log(data);
                if(data!=""){
                    //need to handle for multiple role later, for now it will take for first role at the index 0
                    this.total_leave_apply=' ('+data.leave_details.category+')';
                    this.actual_leave_avail=data.leave_details.no_days;
                    this.leave_balance=data.leave_details.no_days;
                    this.form.submitted_to=data.next_role_id.role_id;
                    $('#form_details').show();
                    $('#applyId').show();
                    this.getApprovedLeaveCount();
                }
                else{
                    Swal.fire({
                        title: 'No Leave Configuration ! ',
                        text: "Sorry! System cannot find leave configuration for this role. Please contact system administrator",
                        icon: 'error',
                    });
                    $('#form_details').hide();
                    $('#applyId').hide();
                }
            })
            .catch(function (error){
                console.log(error);
            });

        },
        getApprovedLeaveCount(){
            if(this.total_leave_apply.toLowerCase().includes('day')){
                axios.get('staff/staffServices/getApprovedLeaveCount/'+this.form.staff_id+'/'+$('#leave_type_id').val())
                .then(response =>{
                    let totlaApprovedleave=0;
                    let data = response.data.data;
                    for(let i=0;i<data.length;i++){
                        totlaApprovedleave+=parseInt(data[i].no_days);
                    }
                    let leavebalance=0;
                    leavebalance=this.actual_leave_avail-totlaApprovedleave;
                    this.leave_balance=leavebalance;
                    if(leavebalance<1){
                        Swal.fire({
                            title: 'No Leave Balance ! ',
                            text: "Sorry! You have already availed maximum number of leave for this type",
                            icon: 'error',
                        });
                        $('#applyId').hide();
                    }
                    else{
                        $('#applyId').show();
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            }
            axios.get('staff/staffServices/getOnGoingLeave/'+this.form.staff_id)
            .then(response =>{
                let data = response.data.data;
                if(data!=null && data!=""){
                    Swal.fire({
                        title: 'Already Applied ! ',
                        text: "Sorry! You have submitted leave application with Application number: "+data.application_number+' which is under process.',
                        icon: 'error',
                    });
                    $('#applyId').hide();
                }
                else{
                    $('#applyId').show();
                }
            })
            .catch(function (error){
                console.log(error);
            });

        },
        applyselect2(){
            if(!$('#leave_type_id').attr('class').includes('select2-hidden-accessible')){
                $('#leave_type_id').addClass('select2-hidden-accessible');
            }
        },

    },
    mounted(){
        let currentdate = new Date();
        this.form.year=currentdate.getFullYear();
        let currdate=currentdate.getFullYear()+'-'+currentdate.getMonth() + 1+'-'+currentdate.getDate();
        // if(fromDate<=currdate && todate>=currdate){

        // }
        // else{
        //     errormessfge
        // }
        this.current_date=currentdate.getDate()+'/'+currentdate.toLocaleString('default', { month: 'long' })+'/'+currentdate.getFullYear();
        this.form.date_of_application=currentdate.getFullYear()+'-'+('0' + (currentdate.getMonth() + 1)).slice(-2)+'-'+('0' + currentdate.getDate()).slice(-2);
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=>{
            this.changefunction(id);
        });
        this.loadleaveTypeList();
        this.loadstaff();

        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.form.staff_id=data['staff_id'];
            $('#staff_id').val(data['staff_id']).trigger('change');
        })
        .catch(errors => {
            console.log(errors)
        });
    },
}
</script>
