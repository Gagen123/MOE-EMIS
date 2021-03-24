<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-tab" @click="shownexttab('personal-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Appointment </label>                              
                        </a>
                    </li>
                    <li class="nav-item qualification-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('qualification-tab')" role="tab">
                            <label class="mb-0.5">Qualification </label>
                        </a>
                    </li>
                    <li class="nav-item nomination-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('nomination-tab')" role="tab">
                            <label class="mb-0.5">Nominees & Family Members</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row" id="searchemp">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Emp Type:<i class="text-danger">*</i> </label><br>
                                <input type="radio" v-model="personal_form.emp_type" name="etype" @click="showemptypedtab(true)" value="Regular"> Civil Servent
                                <!-- <input type="radio" name="etype" @click="showemptypedtab(true)" value="Contract"> Contract -->
                                <input type="radio" v-model="personal_form.emp_type" name="etype" @click="showemptypedtab(false)" value="Volunteer"> Volunteer & Project Based
                                <!-- <input type="radio" name="etype" @click="showemptypedtab(false)" value="Project Based"> Project Based -->
                            </div> 
               
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5"><span id="empidcid">Emp Id/CID</span><i class="text-danger">*</i> </label>
                                <input type="text" v-model="personal_form.cid_no" @change="remove_error('cid_no')" :class="{ 'is-invalid': personal_form.errors.has('cid_no') }"  class="form-control" name="cid_no" id="cid_no">
                                <has-error :form="personal_form" field="cid_no"></has-error>
                            </div> 
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mt-4">
                                <button type="button" class="btn btn-sm btn-primary" @click="fetchDetails()"><i class="fa fa-download"></i> Fetch</button>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="cidsection">
                                <label class="mb-0.5">CID/Work Permit No:</label>
                                <input type="text" class="form-control" name="emp_id" id="cid"  readonly>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Full Name:<i class="text-danger">*</i></label>
                                <input type="text" @change="remove_error('full_name')" v-model="personal_form.full_name" :class="{ 'is-invalid': personal_form.errors.has('full_name') }" class="form-control" name="emp_id" id="empname"  readonly>
                                <has-error :form="personal_form" field="full_name"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Position Title:<i class="text-danger">*</i></label>
                                <input type="text" @change="remove_error('position_title')" v-model="personal_form.position_title" :class="{ 'is-invalid': personal_form.errors.has('position_title') }" class="form-control" name="position_title" id="position_title"  readonly>
                                <has-error :form="personal_form" field="position_title"></has-error>
                            </div> 
                        </div>                        
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Working Agency:<i class="text-danger">*</i></label>
                                <!-- <input type="text" class="form-control" name="emp_id" id="working"  readonly> -->
                                <select v-model="personal_form.working_agency" @change="remove_error('working_agency')" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('working_agency') }" class="form-control select2" name="working_agency" id="working_agency">
                                    <option value=""> --Select--</option>
                                    <option value="1"> Mothithang HSS</option>
                                    <option value="2"> Yangchenphug HSS</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                                <has-error :form="personal_form" field="working_agency"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Contact Number:<i class="text-danger">*</i></label>
                                <input type="number" @change="remove_error('contact_number')" v-model="personal_form.contact_number" :class="{ 'is-invalid': personal_form.errors.has('contact_number') }" class="form-control" name="contact_number" id="contact_number" >
                                <has-error :form="personal_form" field="contact_number"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Email:<i class="text-danger">*</i></label>
                                <input type="text" @change="remove_error('email')" v-model="personal_form.email" :class="{ 'is-invalid': personal_form.errors.has('email') }" class="form-control" name="email" id="email" >
                                <has-error :form="personal_form" field="email"></has-error>
                            </div> 
                        </div>
               
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Compulsory Subject:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.comp_sub" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('comp_sub') }" class="form-control select2" name="comp_sub" id="comp_sub">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="comp_sub"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Elective Subject 1:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.elective_sub1" :class="{'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('elective_sub1') }" class="form-control select2" name="elective_sub1" id="elective_sub1">
                                   <option value=""> --Select--</option>
                                   <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="elective_sub1"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Elective Subject 2:</label> 
                                <select v-model="personal_form.elective_sub2" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('elective_sub2') }" class="form-control select2" name="elective_sub2" id="elective_sub2">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="elective_sub2"></has-error>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Is in SEN Team:</label><br>
                                <input type="radio" name="sen" value="Yes"> Yes
                                <input type="radio" name="sen"  value="No"> No
                            </div>  -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Career Stage:<i class="text-danger">*</i></label><br>
                                <select @change="remove_error('currier_stage')" v-model="personal_form.currier_stage" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('currier_stage') }" class="form-control select2" name="currier_stage" id="currier_stage">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in cureerstageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="currier_stage"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Employee File Code:<i class="text-danger">*</i></label>
                                <input @change="remove_error('emp_file_code')" class="form-control" v-model="personal_form.emp_file_code" :class="{ 'is-invalid': personal_form.errors.has('emp_file_code') }" name="emp_file_code" id="emp_file_code" type="text">
                                <has-error :form="personal_form" field="emp_file_code"></has-error>
                            </div> 
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Has Received Training on Supporting Children with Disabilities:</label><br>
                                <input type="radio" name="sentraining" value="Yes"> Yes
                                <input type="radio" name="sentraining" value="No"> No
                            </div> 
                        </div> -->
                        
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Remarks:</label>
                                <textarea @change="remove_error('remarks')" class="form-control" v-model="personal_form.remarks" :class="{ 'is-invalid': personal_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                                <has-error :form="personal_form" field="remarks"></has-error>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('qualification-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="qualification-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <ul class="bg-cyan mb-2 pb-1">
                            <li class="pl-2 text-white">
                                Providing details for: <span class="personname"></span>
                                <a class="btn btn-outline-primary btn-flat fa-pull-right pb-0 pl-2 pr-2 pt-0" type="button" @click="showaddmodal('qualification-modal')"><i class="fa fa-plus"></i> Add Qualification</a>
                            </li>
                        </ul>
                        <div class="modal fade" id="qualification-modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Qualification Details</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="bootbox-body">
                                            <form class="bootbox-form">
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Description:<i class="text-danger">*</i></label>
                                                        <select class="form-control select2" id="qdescription">
                                                            <option value="">--Select--</option>
                                                            <option value="Initial Professional Qualification">Initial Professional Qualification</option>
                                                            <option value="Heighest Professional Qualification">Heighest Professional Qualification</option>
                                                            <option value="Heighest Acadamic Qualification">Heighest Acadamic Qualification</option>
                                                            <option value="Training">Training</option>
                                                            <option value="Others Qualification">Others Qualification</option>
                                                        </select>
                                                    </div>
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5"> Qualification:<i class="text-danger">*</i></label>
                                                        <select class="form-control select2" id="qualification">
                                                            <option value="">--Select--</option>
                                                            <option value="PTC">PTC</option>
                                                            <option value="ZTC">ZTC</option>
                                                            <option value="B.Ed Primary">B.Ed Primary</option>
                                                            <option value="B.Ed Secondary">B.Ed Secondary</option>
                                                            <option value="PGCE">PGCE</option>
                                                            <option value="6">PGDE</option>
                                                            <option value="PGDE">B.Ed Secondary</option>  
                                                            <option value="B. COM">B. COM</option>
                                                            <option value="M. COM">M. COM</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Course Mode/Type:<i class="text-danger">*</i></label>
                                                        <select class="form-control select2" id="coursemode">
                                                            <option value="">--Select--</option>
                                                            <option value="Mix Mode">Mix Mode</option>
                                                            <option value="Full Mode">Full Mode</option>
                                                            <option value="Part Time">Part Time</option>
                                                            <option value="Distance Education">Distance Education</option> 
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Course Title:<i class="text-danger">*</i></label>
                                                        <input type="text" id="coursetitle" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">First Subject:<i class="text-danger">*</i></label>
                                                        <select class="form-control select2" id="firstsub">
                                                            <option value="">--Select--</option>
                                                            <option value="Biological Science">Biological Science</option>
                                                            <option value="Buddhist Studies">Buddhist Studies</option>
                                                            <option value="Business Administration">Business Administration</option>
                                                            <option value="Community">Community</option> 
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Second subject:</label>
                                                        <select class="form-control select2" id="sectsub">
                                                            <option value="">--Select--</option>
                                                            <option value="Biological Science">Biological Science</option>
                                                            <option value="Buddhist Studies">Buddhist Studies</option>
                                                            <option value="Business Administration">Business Administration</option>
                                                            <option value="Community">Community</option> 
                                                        </select>
                                                    </div>
                                                 </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Country:<i class="text-danger">*</i></label>
                                                        <select class="form-control select2" id="country">
                                                            <option value="">--Select--</option>
                                                            <option value="Bhutan">Bhutan</option>
                                                            <option value="AFGHANISTAN">AFGHANISTAN</option>
                                                            <option value="ANGOLA">ANGOLA</option>
                                                            <option value="CHINA">CHINA</option> 
                                                            <option value="INDIA">INDIA</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Start Date:<i class="text-danger">*</i></label>
                                                        <input type="date" id="startdate" class="form-control">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">End Date:<i class="text-danger">*</i></label>
                                                        <input type="date" id="enddate" class="form-control">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-flat btn-default">No</button>
                                        <button  @click="addMore('qualification')" type="button" class="btn btn-flat btn-primary">Yes</button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="training-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Desciption</th>
                                            <th>Qualification</th>
                                            <th>Course Mode/Type</th>  
                                            <th>Course Title</th>
                                            <th>First Subject</th> 
                                            <th>Second subject</th>    
                                            <th>Country</th>    
                                            <th>Start Date</th> 
                                            <th>End Date</th>
                                            <th>Action</th>                     
                                        </tr>
                                    </thead>
                                    <tbody id="qualificationlist">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('personal-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('sen-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="nomination-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <ul class="bg-cyan mb-2">
                            <li class="pl-2 text-white">Providing details for: <span class="personname"></span></li>
                        </ul>
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
                                            <th>Percentage of benifit (%)</th>                     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(nom, index) in nominies' :key="index">
                                            <td>
                                                <input type="number" v-model="nom.cid" id="cid" @change="getpersonaldetails(nom)" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" readonly v-model="nom.name" id="name" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" readonly v-model="nom.desig" id="desig" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" readonly v-model="nom.address" id="address" class="form-control">
                                            </td>
                                            <td>
                                                <input type="number" v-model="nom.contact" id="contact" class="form-control">
                                            </td>
                                            <td>
                                                <input type="emial" v-model="nom.email" id="email" class="form-control">
                                            </td>
                                            <td>
                                                <select class="form-control select2">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Spouse</option>
                                                    <option value="1">Father</option>
                                                    <option value="1">Mother</option>
                                                    <option value="1">Son</option>
                                                    <option value="1">Daughter</option>
                                                    <option value="1">Brother</option>
                                                    <option value="1">Sister</option>
                                                    <option value="1">Others</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" v-model="nom.percentage" id="percentage" @change="calcualtetotla(nom)" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6"> 
                                                <button type="button" class="btn btn-xs btn-primary" id="addMore" 
                                                @click="addMore('nom')"><i class="fa fa-plus"></i> Add More</button>
                                                <button type="button" class="btn btn-xs btn-danger" id="addMore" 
                                                @click="remove('nom')"><i class="fa fa-trash"></i> Remove</button>
                                            </td>
                                            <td>
                                                Total: 
                                            </td>
                                            <td>
                                                <input readonly type="number" id="percentagetotla" class="form-control">
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('sen-tab-back')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Save </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
export default {
  components: { 

   },
    data(){
        return{ 
            totle:0,
            sentab:false,
            subjectList:[],
            cureerstageList:[],
            qualificationlist:
            [{
                description:'',qualification:'',coursemode:'',coursetitle:'',firstsub:'',secondsub:'',country:'',startdate:'',enddate:''
            }],
            nominies:
            [{
                cid:'',name:'',desig:'',address:'',contact:'',email:'',relation:'',percentage:''
            }],
            personal_form: new form({
                emp_type: 'Regular',
                cid_no:'',
                full_name:'',
                position_title:'',
                working_agency:'',
                contact_number:'',
                email:'',
                comp_sub:'',
                elective_sub1:'',
                elective_sub2:'',
                currier_stage:'',
                emp_file_code:'',
                remarks:'',
            })
        } 
    },
    methods: {
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        }, 
        showemptypedtab(type){
            if(type){
                $('#empidcid').html('Emp Id/CID');
                $('#cidsection').show();
                $('#position').prop('readonly',true);
                $('#working').prop('readonly',true);
            }
            else{
                $('#empidcid').html('CID/Work Permit No.');
                $('#cidsection').hide();
                $('#position').prop('readonly',false);
                $('#working').prop('readonly',false);
            }
        },
        showsendtab(type){
            if(type){
                $('#sentab').show();
                this.sentab=true;
            }
            else{
                $('#sentab').hide();
                this.sentab=false;
            }
        },
        showaddmodal(type){
            $('#'+type).modal('show');
        },
        addMore: function(type){
            if(type=="qualification"){ 
                let tabledata="<tr>"+
                "<td>"+$('#qdescription').val()+"</td>"+
                "<td>"+$('#qualification').val()+"</td>"+
                "<td>"+$('#coursemode').val()+"</td>"+
                "<td>"+$('#coursetitle').val()+"</td>"+
                "<td>"+$('#firstsub').val()+"</td>"+
                "<td>"+$('#sectsub').val()+"</td>"+
                "<td>"+$('#country').val()+"</td>"+ 
                "<td>"+$('#startdate').val()+"</td>"+
                "<td>"+$('#enddate').val()+"</td>"+
                "<td><button type='button' class='btn btn success><i class='fa fa-edit'></i> Edit</button><button type='button' class='btn btn danger><i class='fa fa-times'></i> Delete</button> </td>"+
                "</tr>";
                $('#qualificationlist').append(tabledata);
                $('#qualification-modal').modal('hide');
            }
            else{
                this.nominies.push({cid:'',name:'',desig:'',address:'',contact:'',email:'',relation:'',percentage:''})
            }
        }, 
        remove(type,index){ 
            if(type=="qua"){
                this.qualificationlist.splice(index,1); 
            } 
            else{
                this.nominies.splice(index,1); 
            }            
        },
        getpersonaldetails(data){
            data.name='Full Name'+data.cid;
            data.desig='MR';
            data.address='Permanent Address '+data.cid;
        },
        fetchDetails(){
            this.personal_form.cid_no='12312312312';
            $('#cid').val('12312312312');
            this.personal_form.full_name='Pema Dechen';
            this.personal_form.position_title='Principal';
            this.personal_form.contact_number='12312312';
            this.personal_form.email='pema@gov.bt';
        },
        calcualtetotla(data){
            this.totle+=parseInt(data.percentage);
            if(this.totle>100){
                this.totle-=parseInt(data.percentage);
                Swal.fire(
                    'error!',
                    'Your total percentage cannot be more the 100.',
                    'error',
                )
                data.percentage=0;
            }
            $('#percentagetotla').val(this.totle);
        },
        shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to safe this staff details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Success!',
                            'Details has been saved successfully.',
                            'success',
                        )
                        this.$router.push('/regular_contract_staff');
                    }
                });
            }
            else{
                if(nextclass=="qualification-tab"){
                    this.personal_form.comp_sub=$('#comp_sub').val();
                    this.personal_form.working_agency=$('#working_agency').val();
                    this.personal_form.elective_sub1=$('#elective_sub1').val();
                    this.personal_form.elective_sub2=$('#elective_sub2').val();
                    this.personal_form.currier_stage=$('#currier_stage').val();
                    this.personal_form.post('staff/savePersonalDetails')
                    .then((response) => {  
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Updated Successfully'
                        });
                        $('.select2').select2();
                        $('.select2').select2({
                            theme: 'bootstrap4'
                        });
                        this.change_tab(nextclass);
                    })
                    .catch((error) => {  
                        if(!$('#working_agency').attr('class').includes('select2-hidden-accessible')){
                            $('#working_agency').addClass('select2-hidden-accessible');
                        }
                        if(!$('#comp_sub').attr('class').includes('select2-hidden-accessible')){
                            $('#comp_sub').addClass('select2-hidden-accessible');
                        }
                        if(!$('#elective_sub1').attr('class').includes('select2-hidden-accessible')){
                            $('#elective_sub1').addClass('select2-hidden-accessible');
                        }
                        if(!$('#elective_sub2').attr('class').includes('select2-hidden-accessible')){
                            $('#elective_sub2').addClass('select2-hidden-accessible');
                        }
                        if(!$('#currier_stage').attr('class').includes('select2-hidden-accessible')){
                            $('#currier_stage').addClass('select2-hidden-accessible');
                        }
                       
                        // $('.select2').select2();
                        // $('.select2').select2({
                        //     theme: 'bootstrap4'
                        // }); 
                        this.change_tab('personal-tab');
                        console.log("Error......"+error)
                    });
                }  
                else{
                    this.change_tab(nextclass);
                }
            }
        },
        change_tab(nextclass){
            $('.personname').html($('#empname').val()+', '+$('#position').val());
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
        loadactivesubjectList(uri="masters/load_staff_masters/all_active_subject_List"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.subjectList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadactivecureerstageList(uri="masters/load_staff_masters/all_active_cureer_stage_list"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.cureerstageList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
    },
    mounted() {
        $('.select2').select2();
        $('.select2').on('select2:select', function (el) {
            if($('#'+$(this).attr('id')).val()!=""){
                $('#'+$(this).attr('id')).removeClass('is-invalid select2');
                $('#'+$(this).attr('id')).addClass('select2 ');
            }
        });
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        this.loadactivesubjectList();
        this.loadactivecureerstageList();
    },
}
</script>
