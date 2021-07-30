<template>
    <div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-cyan mb-2 pb-1 pr-1 pt-1">
            Providing details for: <span class="personname"></span>
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
                                        <label class="mb-0.5">Relationship:<i class="text-danger">*</i></label>
                                        <select v-model="form.nomi_relation" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('nomi_relation') }" class="form-control select2" id="nomi_relation">
                                            <option value="">--Select--</option>
                                            <option v-for="(item, index) in repationshipList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
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
                            <th>Percentage of benifit (%)</th>
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
            staffList:[],
            relationshipList:[],
            form: new form({
                personal_id: '',
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
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        showaddmodal(type){
            if(type=="qualification-modal"){
                this.qualification_form.action_type='add';
                $('#description').val('').trigger('change');
                $('#qualification').val('').trigger('change');
                $('#coursemode').val('').trigger('change');
                $('#coursetitle').val('').trigger('change');
                $('#qualificationcountry').val('').trigger('change');
                $('#firstsub').val('');
                $('#startdate').val('');
                $('#enddate').val('');
            }
            if(type=="nomination-modal"){
                this.resetnomidees();
                this.nomination_form.action_type='add';
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

        },
        loadstaff(){
            let uri ='loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.staffList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
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

        this.loadrelationship();
        this.loadstaff();
    },
}
</script>
