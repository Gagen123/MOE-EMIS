<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label class="mb-0">Select Post:</label>
                        <select class="form-control select2" id="post_id" v-model="form.post_id" :class="{ 'is-invalid': form.errors.has('post_id') }">
                            <option value="">--Select--</option>
                            <option v-for="(item, index) in postList" :key="index" v-bind:value="item.id">
                                {{positionList[item.position_title]}}
                            </option>
                        </select>
                    </div>
                </div>
                <template v-if="post_detail!=''">
                    <div class="row form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Position Title:</label>
                            <span class="text-blue text-bold">{{positionList[post_detail.position_title]}}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Application Start Date:</label>
                            <span class="text-blue text-bold">{{post_detail.from_date}}</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Application End Date:</label>
                            <span class="text-blue text-bold">{{post_detail.to_date}}</span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Details:</label>
                            <span class="text-blue text-bold">{{post_detail.details}}</span>
                        </div>
                    </div>
                </template>
                <hr/>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4 pb-4">
                        <label>Applicant:<i class="text-danger">*</i></label>
                        <select v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }}: {{ item.name }}, {{item.position_title}}</option>
                        </select>
                        <has-error :form="form" field="staff_id"></has-error>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Remarks</label>
                        <textarea class="form-control" v-model="form.remarks" id="remarks" name="remarks"></textarea>
                        <span class="text-danger" id="remarks_err"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Upload the Required Documents<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="card">
                    <div class="form-group row">
                        <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                <hr>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary fa-pull-right" @click="submitApplication()"><i class="fa fa-save"></i> Submit </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
     data(){
        return {
            require_count:0,
            count:0,
            selectionList:{},
            positionList:{},
            roleList:{},
            postList:[],
            staffList:[],
            post_detail:'',
            form: new form({
                id:'',
                post_id:'',
                staff_id:'',
                dzo_id:'',
                org_id:'',
                accessLevel:'',
                remarks:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
                applicant:'',
                action_type:'add'
            }),
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
                if(this.count>this.require_count){
                    this.count--;
                    this.form.attachments.pop();
                }
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
        loadPositionTitleList(uri = 'staff/loadStaffMasters/active/PositionTitle'){
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.positionList[data[i].id] = data[i].name;
                }
                this.loadAllPostList();
            })
            .catch(function (error){
                console.log(error);
            });
        },
        getSelectionList(uri = 'questionAnswerController/loadQuestionaries/loadServices_Leadership_Service'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.selectionList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log('err in retrieving services: '+error);
            });
        },
        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.roleList[data[i].Id] = data[i].Name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },

        loadAllPostList(){
            axios.get('/staff/staffLeadershipSerivcesController/loadAllPostList')
            .then((response) =>{
                let data=response.data.data;
                this.postList=data;
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        },
        loadPostDetials(id){
            axios.get('/staff/staffLeadershipSerivcesController/loadPostDetials/'+id)
            .then((response) =>{
                let data=response.data.data;
                this.loadstaff();
                this.post_detail=data;
                this.require_count=data.attachments.length;
                this.count=data.attachments.length;
                if(data.attachments.length>0){
                    this.form.attachments=[];
                    for(let i=0;i<data.attachments.length;i++){
                        $('#file_name'+i).prop('readonly',true);
                        this.form.attachments.push({file_name:data.attachments[i].attachment,attachment:''});
                    }
                }
                this.getstaffDetails();
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="post_id"){
                this.form.post_id=$('#post_id').val();
                this.loadPostDetials($('#post_id').val());
            }
            if(id=="position_title"){
                this.form.position_title=$('#position_title').val();
            }
        },
        getstaffDetails(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                this.form.staff_id=data['staff_id'];
                this.form.dzo_id=data['Dzo_Id'];
                this.form.org_id=data['Agency_Code'];
                this.form.accessLevel=data['acess_level'];
                $('#staff_id').val(data['staff_id']).trigger('change');
                $('#staff_id').prop('disabled',true);
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        submitApplication(){
            Swal.fire({
                text: 'Are you sure you wish to submit this application ? ',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData();
                    formData.append('post_id', this.form.post_id);
                    formData.append('staff_id', this.form.staff_id);
                    formData.append('dzo_id', this.form.dzo_id);
                    formData.append('org_id', this.form.org_id);
                    formData.append('accessLevel', this.form.accessLevel);
                    formData.append('remarks', this.form.remarks);
                    for(let i=0;i<this.form.ref_docs.length;i++){
                        formData.append('attachments[]', this.form.ref_docs[i].attach);
                        formData.append('attachmentname[]', this.form.ref_docs[i].name);
                    }

                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }
                    axios.post('/staff/staffLeadershipSerivcesController/submitApplication', formData, config)
                    .then((response) => {
                        if(response.data!=""){
                            if(response!="" && response!="No Screen"){
                                let res='Your application is submitted and system generated application number is: '+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'application_acknowledgement',params: {data:res }});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Application is submitted successfully'
                                });
                            }
                        }
                    })
                    .catch((error) => {
                        console.log("Error:"+error);
                        this.form.errors.errors = error.response.data.errors;
                    })
                }
            });
        }

    },

    async mounted(){
        this.loadPositionTitleList();
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
        this.getSelectionList();
        this.loadroleList();

    },
}
</script>
