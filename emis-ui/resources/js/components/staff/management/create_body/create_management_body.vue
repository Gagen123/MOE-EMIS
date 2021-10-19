<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item programme-tab" @click="shownexttab('board-details-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Board Details </label>
                        </a>
                    </li>
                    <li class="nav-item eligibility-tab" @click="shownexttab('members-details-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5"> Member Details </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="board-details-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Board Type: <span class="text-danger">*</span></label>
                                <select v-model="form.body_type" :class="{ 'is-invalid' :form.errors.has('body_type') }" class="form-control" name="body_type" id="body_type">
                                    <option value="">--Select--</option>
                                    <option v-for="(item, index) in management_body_list" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="body_type"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Term From Date:<span class="text-danger">*</span></label>
                                <input type="date" v-model="form.from_date" @change="remove_err('from_date')" id="from_date" name="from_date" class="form-control">
                                <has-error :form="form" field="from_date"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Term To Date:<span class="text-danger">*</span></label>
                                <input type="date" v-model="form.to_date" id="to_date" @change="remove_err('to_date')" name="to_date" class="form-control">
                                <span class="text-danger" id="to_date"></span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Upload the Required Documents(if any)</label>
                                <br>
                                <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>File Name/Description</th>
                                            <th>Upload File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(attach, count) in attachmentDetails' :key="count+1" :id="'esxist'+count">
                                            <template>
                                                <td>
                                                    {{attach.user_defined_name}}
                                                </td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    <span>
                                                        <a href="#" class="pl-4 fa fa-times text-danger" @click="deletefile(attach,count)"> Delete </a>
                                                    </span>
                                                </td>
                                            </template>
                                        </tr>
                                        <tr id="record1" v-for='(att, index) in form.fileUpload' :key="index">
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
                                                @click="addMoreattachment()"><i class="fa fa-plus"></i> Add More</button>
                                                <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                                @click="removeattachment()"><i class="fa fa-trash"></i> Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Remarks:</label>
                                <textarea @change="remove_error('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                                <has-error :form="form" field="remarks"></has-error>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn  btn-primary" @click="shownexttab('members-details-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="members-details-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Staff Members</label>
                                <button class="btn btn-sm  btn-success fa-pull-right" type="button" @click="showaddmembers('Staff')"><i class="fa fa-plus"></i> Add Member</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
                                <table id="staff_data_table" class="table table-sm table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Name</th>
                                            <th>Designation/Position Title</th>
                                            <th>Contact Number</th>
                                            <th>email</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in staffcomposition_list" :key="index">
                                            <td>{{ index+1}}</td>
                                            <td>{{ item.name}}</td>
                                            <td>{{ designationArray[item.designation]}}</td>
                                            <td>{{ item.phone}}</td>
                                            <td>{{ item.email}}</td>
                                            <td>{{ item.address}}</td>
                                            <td>{{ item.from_date}}</td>
                                            <td>{{ item.to_date}}</td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm btn-flat text-white" @click="loadeditpage(item)">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Non Staff Members</label>
                                <button class="btn btn-sm  btn-success fa-pull-right" type="button" @click="showaddmembers('Non Staff')"><i class="fa fa-plus"></i> Add Member</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
                                <table id="non-staff_data_table" class="table table-sm table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Designation</th>
                                            <th>Contact Number</th>
                                            <th>Email</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in nonstaffcomposition_list" :key="index">
                                            <td>{{ index+1}}</td>
                                            <td>{{ item.name}}</td>
                                            <td>{{ designationArray[item.designation]}}</td>
                                            <td>{{ item.phone}}</td>
                                            <td>{{ item.email}}</td>
                                            <td>{{ item.address}}</td>
                                            <td>{{ item.from_date}}</td>
                                            <td>{{ item.to_date}}</td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm btn-flat text-white" @click="loadeditpage(item)">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Student Members</label>
                                <button class="btn btn-sm  btn-success fa-pull-right" type="button" @click="showaddmembers('Student')"><i class="fa fa-plus"></i> Add Member</button>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
                                <table id="student_data_table" class="table table-sm table-bordered table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Designation</th>
                                            <th>Contact Number</th>
                                            <th>Email</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in studentcomposition_list" :key="index">
                                            <td>{{ index+1}}</td>
                                            <td>{{ item.name}}</td>
                                            <td>{{ designationArray[item.designation]}}</td>
                                            <td>{{ item.phone}}</td>
                                            <td>{{ item.email}}</td>
                                            <td>{{ item.address}}</td>
                                            <td>{{ item.from_date}}</td>
                                            <td>{{ item.to_date}}</td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-sm btn-flat text-white" @click="loadeditpage(item)">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn  btn-success" @click="shownexttab('board-details-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn  btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i> Save </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade show" id="addboardmembers" aria-modal="true" style="padding-right: 17px;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Member Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Type:<span class="text-danger">*</span> </label>
                                <select v-model="staff.type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('type') }" class="form-control select2" name="type" id="type">
                                    <option value="">--Select--</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Non Staff">Non Staff</option>
                                    <option value="Student">Student</option>
                                </select>
                                <has-error :form="staff" field="type"></has-error>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="non-staff_details" style="display:none">
                                <label>Name:<span class="text-danger">*</span> </label>
                                <input type="text" class="form-control" v-model="staff.nonstaffname" @change="remove_err('nonstaffname')" id="nonstaffname">
                                <has-error :form="staff" field="nonstaffname"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Designation:<span class="text-danger">*</span></label>
                                <select v-model="staff.designation" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('designation') }" class="form-control select2" name="designation" id="designation">
                                    <option value="">--Select--</option>
                                    <option v-for="(item, index) in designationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="staff" field="designation"></has-error>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none" id="nonstaffaddress">
                                <label>Address</label>
                                <textarea v-model="staff.address" name="address" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row" id="nonstaffcontact" style="display:none">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Phone Number</label>
                                <input type="number" v-model="staff.phone" @change="remove_err('phone')" id="contactNo" name="contactNo" class="form-control">
                                <has-error :form="staff" field="phone"></has-error>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Email</label>
                                <input type="email" id="email" v-model="staff.email" name="email" class="form-control">
                                <has-error :form="staff" field="email"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>From Date</label>
                                <input type="date" id="fromdate" v-model="staff.fromdate" name="fromdate" class="form-control">
                                <has-error :form="staff" field="fromdate"></has-error>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>To Date</label>
                                <input type="date" id="todate" v-model="staff.todate" name="todate" class="form-control">
                                <has-error :form="staff" field="todate"></has-error>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-success btn-sm  mb-0.5"  @click="showadprocess()"> <i class="fa fa-check"></i> Add</button>
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
            management_body_list:[],
            staffList:[],
            designationList:[],
            designationArray:{},
            staffcomposition_list:[],
            studentcomposition_list:[],
            nonstaffcomposition_list:[],
            attachmentDetails:[],
            
            form: new form({
                id:'',
                body_type:'',
                from_date:'',
                to_date:'',
                remarks:'',
                fileUpload: [],
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
            staff: new form({
                management_id:'',
                emptye: '',
                staffselect:'',
                nonstaffnae:'',
                designation:'',
                phone:'',
                email:'',
                address:'',
                fromdate:'',
                todate:'',
            }),
        }
    },
    methods: {
        shownexttab(nextclass){
            if(nextclass=="members-details-tab"){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let formData = new FormData();
                formData.append('body_type', this.form.body_type);
                formData.append('from_date', this.form.from_date);
                formData.append('to_date', this.form.to_date);
                formData.append('remarks', this.form.remarks);
                 for(let i=0;i<this.form.ref_docs.length;i++){
                        formData.append('attachments[]', this.form.ref_docs[i].attach);
                        formData.append('attachmentname[]', this.form.ref_docs[i].name);
                    }
                axios.post('staff/managementBody/saveManagementBody',formData,config)
                .then((response) => {
                    if(response.data!=""){
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                        this.staff.management_id=response.data.data.id;
                        this.form.id=response.data.data.id;
                        this.loadcomposition();
                        this.next_tab(nextclass);
                    }
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Not able to save data. Please try again'
                    });
                    console.log("Error:"+error)
                });
            }
            else if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        
                        this.form.post('staff/managementBody/updateManagementBody')
                        .then((response) => {
                            Swal.fire(
                                'Success!',
                                'Details has been saved successfully.',
                                'success',
                            )
                            this.$router.push('/list_management_body');
                        })
                        .catch((error) => {
                            console.log("Error......"+error)
                        });
                    }
                });
            }
            else{
                this.next_tab(nextclass);
            }
        },
        next_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
        showaddmembers(type){
            this.staff.reset();
            $('#type').val(type);
            this.staff.emptye=type;
            $('#non-staff_details').show();
            $('#nonstaffaddress').show();
            $('#nonstaffcontact').show();
            this.staff.fromdate=$('#from_date').val();
            this.staff.todate=$('#to_date').val();
            $('#addboardmembers').modal('show');
        },

        showadprocess(){
            this.staff.management_id=this.form.id;
            this.staff.post('staff/managementBody/saveManagementBodyComposition')
            .then((response) => {
                if(response.data!=""){
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved Successfully'
                    });
                    this.loadcomposition();
                }
            })
            .catch((error) => {
                Swal.fire(
                    'Error!',
                    'Not able to save this details. Please try again.',
                    'error',
                )
                console.log("Error:"+error)
            });
        },
        loadcomposition(){
            let uri = 'staff/managementBody/loadManagementBodyComposition/'+ this.form.id;
            axios.get(uri)
            .then(response => {
                this.staffcomposition_list=[];
                this.studentcomposition_list=[];
                this.nonstaffcomposition_list=[];
                let data = response.data.data.members;
                for(let i=0;i<data.length;i++){
                    if(data[i].emptye=="Staff"){
                        this.staffcomposition_list.push(data[i]);
                    }
                    if(data[i].emptye=="Student"){
                        this.studentcomposition_list.push(data[i]);
                    }
                    if(data[i].emptye=="Non Staff"){
                        this.nonstaffcomposition_list.push(data[i]);
                    }
                }
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        loadeditpage(item){
             axios.get('staff/managementBody/deleteManagementBodyComposition/'+item.id+'/'+this.form.id)
            .then((response) => {
                if(response.data!=""){
                    Toast.fire({
                        icon: 'success',
                        title: 'Data deleted successfully'
                    });
                    this.loadcomposition();
                }
            })
            .catch((error) => {
                Swal.fire(
                    'Error!',
                    'Not able to save this details. Please try again.',
                    'error',
                )
                console.log("Error:"+error)
            });
        },
        reloadtable(){
            $("#staff_data_table").DataTable({
                "responsive": true,
                "autoWidth": true,
            });
            $("#non-staff_data_table").DataTable({
                "responsive": true,
                "autoWidth": true,
            });
        },
        validatedate(){
            let ret=true;
            if($('#boardtype').val()==""){
                $('#boardtype_err').html('Please select board type');
                $('#boardtype').focus();
                $('#boardtype').addClass('is-invalid');
                ret=false;
            }
            if($('#termformdate').val()==""){
                $('#termformdate_err').html('Please mention from date');
                $('#termformdate').focus();
                $('#termformdate').addClass('is-invalid');
                ret=false;
            }
            if($('#termtodate').val()==""){
                $('#termtodate_err').html('Please mention to date');
                $('#termtodate').focus();
                $('#termtodate').addClass('is-invalid');
                ret=false;
            }
            return ret;
        },
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        deletefile(file,count){
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
                            $('#esxist'+count).remove();
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
        addMoreattachment: function(){
            this.form.fileUpload.push({file_name:'', file_upload:''})
        },
        removeattachment(index){
            if(this.form.fileUpload.length>1){
                this.form.fileUpload.pop();
            }
        },
        remove_err(fieldId,errorId){
            if($('#'+fieldId).val()!=""){
                $('#'+errorId).html('');
                $('#'+fieldId).removeClass('is-invalid');
            }
        },
        loadmanagmentBodyList(type){
            let uri = 'masters/loadStaffMasters/'+type;
            axios.get(uri)
            .then(response => {
                let data = response;
                if(type=="all_active_mgmn_body_type"){
                    this.management_body_list =  data.data.data;
                }
                if(type=="all_active_mgmn_desig"){
                    this.designationList =  data.data.data;
                    for(let i=0;i<data.data.data.length;i++){
                        this.designationArray[data.data.data[i].id] = data.data.data[i].name;
                    }
                }
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadStaffList(uri = 'staff/loadStaff/workingagency'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.staffList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
    },
    mounted(){
        this.loadmanagmentBodyList('all_active_mgmn_body_type');
        this.loadmanagmentBodyList('all_active_mgmn_desig');
        this.loadStaffList();
    },

}
</script>


