<template>
    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-cyan mb-2 pb-1 pr-1 pt-1">
            Providing details for: <span class="personname">{{name}} ({{emp_id}})</span>
            <a class="btn btn-dark btn-flat fa-pull-right pb-0 pl-2 pr-2 pt-0" type="button" @click="showaddmodal('nomination-modal')"><i class="fa fa-plus"></i> Add Nomination</a>
        </div>
        <div class="modal fade" id="nomination-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nomination</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body">
                            <form class="bootbox-form">
                                <div class="row form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0.5">CID:<i class="text-danger">*</i></label>
                                        <input @keyup.enter="getDetailsbyCID()" @blur="getDetailsbyCID"  v-model="form.nomi_cid" :class="{ 'is-invalid': form.errors.has('nomi_cid') }" type="text" id="nomi_cid" class="form-control" @change="remove_error('nomi_cid')">
                                        <has-error :form="form" field="nomi_cid"></has-error>
                                    </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0.5"> Full Name:<i class="text-danger">*</i></label>
                                        <input v-model="form.nomi_name" :class="{ 'is-invalid': form.errors.has('nomi_name') }" type="text" id="nomi_name" class="form-control" @change="remove_error('nomi_name')">
                                        <has-error :form="form" field="nomi_name"></has-error>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0.5">Contact Number:<i class="text-danger">*</i></label>
                                        <input v-model="form.nomi_contact" :class="{ 'is-invalid': form.errors.has('nomi_contact') }" type="text" id="nomi_contact" class="form-control" @change="remove_error('nomi_contact')">
                                        <has-error :form="form" field="nomi_contact"></has-error>
                                    </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0.5"> Email:<i class="text-danger">*</i></label>
                                        <input v-model="form.nomi_email" :class="{ 'is-invalid': form.errors.has('nomi_email') }" type="text" id="nomi_email" class="form-control" @change="remove_error('nomi_email')">
                                        <has-error :form="form" field="nomi_email"></has-error>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0.5">Designation:<i class="text-danger">*</i></label>
                                        <input v-model="form.nomi_desig" :class="{ 'is-invalid': form.errors.has('nomi_desig') }" type="text" id="nomi_desig" class="form-control" @change="remove_error('nomi_desig')">
                                        <has-error :form="form" field="nomi_desig"></has-error>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0.5">Address:<i class="text-danger">*</i></label>
                                        <textarea v-model="form.nomi_address" :class="{ 'is-invalid': form.errors.has('nomi_address') }" id="nomi_address" class="form-control" @change="remove_error('nomi_address')"></textarea>
                                        <has-error :form="form" field="nomi_address"></has-error>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0.5">Relationship:<i class="text-danger">*</i></label>
                                        <select v-model="form.nomi_relation" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('nomi_relation') }" class="form-control select2" id="nomi_relation">
                                            <option value="">--Select--</option>
                                            <option v-for="(item, index) in relationshipList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="nomi_relation"></has-error>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0.5">Is Nominee?:<i class="text-danger">*</i></label>
                                        <input type="radio" v-model="form.isnominee" name="isnominee" value="1"> Yes
                                        <input type="radio" v-model="form.isnominee" name="isnominee" value="0"> No
                                        <has-error :form="form" field="isnominee"></has-error>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="form.isnominee==1">
                                        <label class="mb-0.5"> Percentage:<i class="text-danger">*</i></label>
                                        <input v-model="form.nomi_percentage" :class="{ 'is-invalid': form.errors.has('nomi_percentage') }" type="text" id="nomi_percentage" class="form-control" @change="remove_error('nomi_percentage')">
                                        <has-error :form="form" field="nomi_percentage"></has-error>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="mb-0">Upload the Required Documents(if any)</label>
                                        <br>
                                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>File Name</th>
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
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" v-model="form.action_type">
                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-flat btn-danger">Cancel</button>
                        <button  @click="addMore('nomination')" type="button" class="btn btn-flat btn-primary">Add/Update</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>CID</th>
                            <th>Name</th>
                            <th>Designation/Position Title</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Relation</th>
                            <th>Is Nominee</th>
                            <th>% of Benefit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in staff_nomination_list" :key="index">
                            <td>{{ item.nomi_cid}}</td>
                            <td>{{ item.nomi_name}}</td>
                            <td>{{ item.nomi_desig}}</td>
                            <td>{{ item.nomi_address}}</td>
                            <td>{{ item.nomi_contact}}</td>
                            <td>{{ item.nomi_email}}</td>
                            <td>{{ item.relations.name}}</td>
                            <td>{{ item.isnominee==1? 'Yes' : 'No'}}</td>
                            <td>{{ item.nomi_percentage}}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="shownominationedit(item)">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right">
                                Total:
                            </td>
                            <td colspan="3">
                                <input readonly type="number" v-model="grand_total" id="percentagetotla" class="form-control">
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
        return {
            cureerstageArray:{},
            grand_total:0,
            staffList:[],
            relationshipList:[],
            attachmentDetails:[],
            staff_nomination_list:[],
            position_title:'',name:'',emp_id:'',
            staff_id:'',
            form: new form({
                personal_id:'',
                nomination_id:'',
                nomi_cid:'',
                nomi_name:'',
                nomi_desig:'',
                nomi_address:'',
                nomi_contact:'',
                nomi_email:'',
                nomi_relation:'',
                nomi_percentage:'',
                isnominee:1,
                action_type:'',
                fileUpload: [],
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
                status:'Pending',
            }),
        }
    },
    methods: {
        resetnomidees(){
            this.form.nomination_id='';
            this.form.nomi_cid='';
            this.form.nomi_name='';
            this.form.nomi_desig='';
            this.form.nomi_address='';
            this.form.nomi_contact='';
            this.form.nomi_email='';
            this.form.nomi_relation='';
            this.form.isnominee=1;
            this.form.action_type='';
            this.form.fileUpload=[];
            this.form.attachments=[{ file_name:'',attachment:''}];
            this.form.ref_docs=[];
            this.form.status='Pending';
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        showaddmodal(type){
            if(type=="nomination-modal"){
                this.resetnomidees();
                this.form.personal_id=this.staff_id;
                this.form.action_type='add';
                $('#nomi_cid').val('');
                $('#nomi_name').val('');
                $('#nomi_desig').val('');
                $('#nomi_address').val('');
                $('#nomi_contact').val('');
                $('#nomi_email').val('');
                $('#nomi_relation').val('').trigger('change');
                $('#nomi_percentage').val('');
            }
            $('#'+type).modal('show');
        },
        shownominationedit(item){

            this.form.action_type='edit';
            this.form.nomination_id=item.id;
            $('#nomi_cid').val(item.nomi_cid);
            this.form.nomi_cid=item.nomi_cid;

            $('#nomi_name').val(item.nomi_name);
            this.form.nomi_name=item.nomi_name;

            $('#nomi_desig').val(item.nomi_desig);
            this.form.nomi_desig=item.nomi_desig;

            $('#nomi_address').val(item.nomi_address);
            this.form.nomi_address=item.nomi_address;

            $('#nomi_contact').val(item.nomi_contact);
            this.form.nomi_contact=item.nomi_contact;

            $('#nomi_email').val(item.nomi_email);
            this.form.nomi_email=item.nomi_email;

            $('#nomi_relation').val(item.nomi_relation).trigger('change');
            this.form.nomi_relation=item.relations.name;
            $('#nomi_percentage').val(item.nomi_percentage);
            this.form.nomi_percentage=item.nomi_percentage;
            this.attachmentDetails=item.attachment;
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            $('#nomination-modal').modal('show');
        },

        formaction: function(type){
            if(type=="reset"){
                this.form.relationship= '';
                $('#relationship').val('').trigger('change');
                this.form.remarks= '';
            }
            if(type=="save"){
                this.form.post('staff/staffUpdateController/saveStaffRelativeDetails')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updaetd successfully'
                    })
                    this.$router.push('/list_relative_details');
                })
                .catch(() => {
                    console.log("Error:")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="relationship"){
                this.form.relationship=$('#relationship').val();
            }
            if(id=="nomi_relation"){
                this.form.nomi_relation=$('#nomi_relation').val();
            }

        },
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
        // loadstaff(){
        //     let uri ='loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
        //     axios.get(uri)
        //     .then(response =>{
        //         let data = response;
        //         this.staffList = data.data.data;
        //     })
        //     .catch(function (error){
        //         console.log("Error:"+error)
        //     });
        // },
        loadrelationship(uri = 'masters/loadStaffMasters/all_active_relationship_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.relationshipList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        /**
         * method to add more fields
         */
        addMoreattachment: function(){
            this.form.fileUpload.push({file_name:'', file_upload:''})
        },

        /**
         * method to remove fields
         */
        removeattachment(index){
            if(this.form.fileUpload.length>1){
                this.form.fileUpload.pop();
            }
        },
        addMore: function(type){
            if(type=="nomination"){
                if(parseInt(this.grand_total)+parseInt(this.form.nomi_percentage)>100){
                    Swal.fire(
                        'error!',
                        'Your total percentage cannot be more the 100.',
                        'error',
                    )
                }
                else{
                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }
                    let formData = new FormData();
                    formData.append('personal_id', this.form.personal_id);
                    formData.append('ref_docs[]', this.form.ref_docs);
                    for(let i=0;i<this.form.ref_docs.length;i++){
                        formData.append('attachments[]', this.form.ref_docs[i].attach);
                        formData.append('attachmentname[]', this.form.ref_docs[i].name);
                    }
                    formData.append('nomination_id', this.form.nomination_id);
                    formData.append('nomi_cid', this.form.nomi_cid);
                    formData.append('nomi_name', this.form.nomi_name);
                    formData.append('nomi_desig', this.form.nomi_desig);
                    formData.append('nomi_address', this.form.nomi_address);
                    formData.append('nomi_contact', this.form.nomi_contact);
                    formData.append('nomi_email', this.form.nomi_email);
                    formData.append('nomi_relation', this.form.nomi_relation);
                    formData.append('status', this.form.status);
                    if(this.form.isnominee==0){
                        formData.append('nomi_percentage', 0);
                    }
                    else{
                        formData.append('nomi_percentage', this.form.nomi_percentage);
                    }
                    formData.append('isnominee', this.form.isnominee);
                    formData.append('action_type', this.form.action_type);
                    formData.append('status', this.form.status);
                    axios.post('staff/savenominationDetails', formData, config)
                    // this.form.post('staff/savenominationDetails')
                    .then((response) => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                        this.resetnomidees();
                        this.loadnomination(this.form.personal_id);
                        $('#nomination-modal').modal('hide');
                    })
                    .catch((error) => {
                        console.log("Error:"+error)
                    });
                }
            }
        },
        getDetailsbyCID(){
            if (this.form.nomi_cid.length == 11){
                axios.get('getpersonbycid/'+ this.form.nomi_cid)
                .then(response => {
                    this.ciderror = '';
                    let personal_detail = response.data;
                    if (personal_detail!=""){
                        this.form.nomi_name = personal_detail.firstName + " " + personal_detail.lastName;
                    }else{
                        this.ciderror = 'Invalid CID.';
                        Swal.fire({
                            html: "No data found for matching CID",
                            icon: 'info'
                        });
                    }
                })
                .catch((e) => {
                    this.ciderror = 'Invalid CID / service down.';
                    Swal.fire({
                        html: "No data found for matching CID/service down"+e,
                        icon: 'error'
                    });
                });
            }
        },
        loadpositionTitleList(positionid){
            let uri = 'staff/loadStaffMasters/active/PositionTitle';
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.positiontitleList[data.data.data[i].id] = data.data.data[i].name;
                }
                this.position_title=this.positiontitleList[positionid];
            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        },
        loadStaffDetails(id){
            let uri = 'loadCommons/viewStaffDetails/by_id/'+id;
            axios.get(uri)
            .then(response =>{
                this.staffDetails = response.data.data;
                this.form.contact_no = this.staffDetails.contact_no;
                this.form.email = this.staffDetails.email;
                this.emp_id = this.staffDetails.emp_id;
                this.form.alternative_email = this.staffDetails.alternative_email;
                this.loadpositionTitleList(this.staffDetails.position_title_id);

            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        },
        loadnomination(staff_id){
            if(staff_id!=null && staff_id!=""){
                let uri = 'staff/loadNominations/'+staff_id;
                axios.get(uri)
                .then(response =>{
                    let data = response;
                    this.staff_nomination_list = data.data.data;
                    this.grand_total=data.data.total_percentage;
                })
                .catch(function (error){
                    console.log("Error:"+error)
                });
            }
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

        Fire.$on('changefunction',(id)=>{
            this.changefunction(id);
        });
        axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                let roleName="";

                this.name=data['Full_Name'];
                this.staff_id=data['staff_id'];

                this.loadStaffDetails(this.staff_id);
                this.loadnomination(this.staff_id);
            })
            .catch(errors => {
                console.log(errors)
            });

        this.loadrelationship();
    },
}
</script>
