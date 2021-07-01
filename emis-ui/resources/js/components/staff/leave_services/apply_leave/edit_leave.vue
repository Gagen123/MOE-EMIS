this asdf<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Type:</label>
                        <select disabled class="form-control select2" id="leave_type_id" v-model="form.leave_type_id" :class="{ 'is-invalid': form.errors.has('leave_type_id') }">
                            <option v-for="(item, index) in leavetypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="leave_type_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Application:</label>
                        <input disabled type="date" format="dd/mm/yyyy"  class="form-control" v-model="form.date_of_application">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Current Status:</label>
                        <input disabled type="text" format="dd/mm/yyyy"  class="form-control" v-model="form.status">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4 pb-4">
                        <label class="mb-0.5">Applicant:</label>
                        <select disabled v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }}: {{ item.name }}, {{item.position_title}}</option>
                        </select>
                        <has-error :form="form" field="staff_id"></has-error>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>From Date:</label>
                        <input type="date" class="form-control" :class="{ 'is-invalid': form.errors.has('from_date') }"  name="from_date" id="from_date" v-model="form.from_date">
                        <has-error :form="form" field="from_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>To Date:</label>
                        <input type="date" @change="calculateNoDays()" :class="{ 'is-invalid': form.errors.has('to_date') }"  class="form-control" name="to_date" id="to_date" v-model="form.to_date">
                        <has-error :form="form" field="to_date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. of Days:</label>
                        <input type="number" class="form-control" :class="{ 'is-invalid': form.errors.has('no_days') }"  name="no_days" id="no_days" v-model="form.no_days">
                        <has-error :form="form" field="no_days"></has-error>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                        <label>Details:</label>
                        <textarea class="form-control" :class="{ 'is-invalid': form.errors.has('reason') }" v-model="form.reason" id="reason"></textarea>
                        <has-error :form="form" field="reason"></has-error>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Upload the Required Documents<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="card">
                    <div class="form-group row">
                        <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-8">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Upload File</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for='(attach,count) in applicationdetailsatt' :key="count+1">
                                        <template>
                                            <td>{{attach.user_defined_name}} </td>
                                            <td>  {{attach.original_name}}</td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                <span>
                                                    <a href="#" class="pl-4 fa fa-times text-danger" @click="deletefile(attach)"> Delete </a>
                                                </span>
                                            </td>
                                        </template>
                                    </tr>
                                    <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                        <td>
                                            <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                            <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                        </td>
                                        <td>
                                            <input type="file" name="attachments" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                            <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr v-if="isset">
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
                <div class="card-footer text-right">
                    <button type="button" id="updatebtn" style="display:none" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            leavetypeList:[],
            staffList:[],
            total_leave_apply:'',
            leave_balance:'',
            applicationdetailsatt:'',
            isset:false,
            form: new form({
                staff_id:'',
                leave_type_id:'',
                year:'',
                date_of_application:'',
                from_date:'',
                to_date:'',
                no_days:'',
                reason:'',
                status:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
                action_type:'edit'
            })
        }
    },
    methods: {
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        addMore: function(){
            this.form.attachments.push({file_name:'', file_upload:''})
        },
        remove(index){
            if(this.form.attachments.length>1){
                this.form.attachments.pop();
            }
        },
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        deletefile(file){
            Swal.fire({
                text: "Are you sure you wish to DELETE this selected file ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    let file_path=file.path+'/'+file.original_name;
                    file_path=file_path.replaceAll('/', 'SSS');
                    let uri = 'common/deleteFile/'+file_path+'/'+file.id;
                    axios.get(uri)
                    .then(response => {
                        let data = response;
                        if(data.data){
                            Swal.fire(
                                'Success!',
                                'File has been deleted successfully.',
                                'success',
                            );
                        }
                        else{
                        Swal.fire(
                                'error!',
                                'Not able to delete this file. Please contact system adminstrator.',
                                'error',
                            );
                        }

                    })
                    .catch(function (error) {
                        console.log("Error:"+error);
                    });
                }
            });
        },
        loadleaveTypeList(uri = 'masters/loadStaffMasters/all_leave_type_list'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.leavetypeList =  data.data.data;
            })
            .catch(function (error){
                console.log(error);
            });
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
        getLeave_details(){
            axios.get('staff/staffServices/checkEligibility/'+$('#leave_type_id').val())
            .then(response =>{
                let data = response;
                if(data.data.data!=""){
                    this.total_leave_apply=' ('+data.data.data[0].leave_details.category+')';
                    this.actual_leave_avail=data.data.data[0].leave_details.no_days;
                    this.leave_balance=data.data.data[0].leave_details.no_days;
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
                })
                .catch(function (error){
                    console.log(error);
                });
            }

        },
        formaction: function(type){
            if(type=="save" && this.validated()){
                Swal.fire({
                    text: "Are you sure you wish to updateinformation ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        let formData = new FormData();
                        formData.append('id', this.form.id);
                        formData.append('leave_type_id', this.form.leave_type_id);
                        formData.append('staff_id', this.form.staff_id);
                        formData.append('year', this.form.year);
                        formData.append('date_of_application', this.form.date_of_application);
                        formData.append('from_date', this.form.from_date);
                        formData.append('to_date', this.form.to_date);
                        formData.append('no_days', this.form.no_days);
                        formData.append('reason', this.form.reason);
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
                        // this.form.post('/staff/staffServices/editLeaveApplication',this.form)
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
                                if(response.data.includes('No role mapping found for this selected use')){
                                    Swal.fire({
                                        title: 'No Role Configuration ! ',
                                        text: "Sorry! "+response.data,
                                        icon: 'error',
                                    });
                                }
                            }
                        })
                        .catch((err) =>{
                            console.log("Error: "+err);
                            this.applyselect2();

                        })
                    }
                })

            }
		},
        applyselect2(){
            if(!$('#leave_type_id').attr('class').includes('select2-hidden-accessible')){
                $('#leave_type_id').addClass('select2-hidden-accessible');
            }
        },
    },
    mounted(){
        this.loadleaveTypeList();
        this.loadstaff();
        this.form.id=this.$route.params.data.id;
        this.form.staff_id=this.$route.params.data.staff_id;
        this.form.leave_type_id=this.$route.params.data.leave_type_id;
        this.form.year=this.$route.params.data.year;
        this.form.date_of_application=this.$route.params.data.date_of_application;
        this.form.from_date=this.$route.params.data.from_date;
        this.form.to_date=this.$route.params.data.to_date;
        this.form.no_days=this.$route.params.data.no_days;
        this.form.reason=this.$route.params.data.reason;
        this.form.status=this.$route.params.data.status;
        this.applicationdetailsatt=this.$route.params.data.attachment_details;
        if(this.$route.params.data.status!="Approved" && this.$route.params.data.status!="Rejected"){
            $('#updatebtn').show();
            this.isset=true;
        }
        this.getLeave_details();
        this.getApprovedLeaveCount();
    },
}
</script>
