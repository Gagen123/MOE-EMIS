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
                    <li class="nav-item sen-tab" id="sentab" style="display:none">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('sen-tab')" role="tab">
                            <label class="mb-0.5">Sen Details</label>
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
                                <input type="radio" name="etype" @click="showemptypedtab(true)" value="Regular"> Civil Servent
                                <!-- <input type="radio" name="etype" @click="showemptypedtab(true)" value="Contract"> Contract -->
                                <input type="radio" name="etype" @click="showemptypedtab(false)" value="Volunteer"> Volunteer & Project Based
                                <!-- <input type="radio" name="etype" @click="showemptypedtab(false)" value="Project Based"> Project Based -->
                            </div> 
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5"><span id="empidcid">Emp Id/CID</span><i class="text-danger">*</i> </label>
                                <input type="text" class="form-control h-50" name="emp_id" id="emp_id">
                            </div> 
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mt-4">
                                <button type="button" class="btn btn-sm btn-primary" @click="fetchDetails()"><i class="fa fa-download"></i> Fetch</button>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="cidsection">
                                <label class="mb-0.5">CID/Work Permit No:</label>
                                <input type="text" class="form-control h-50" name="emp_id" id="cid"  readonly>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Full Name:</label>
                                <input type="text" class="form-control h-50" name="emp_id" id="empname"  readonly>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Position Title:</label>
                                <input type="text" class="form-control h-50" name="emp_id" id="position"  readonly>
                            </div> 
                        </div>                        
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Working Agency:</label>
                                <!-- <input type="text" class="form-control h-50" name="emp_id" id="working"  readonly> -->
                                <select  class="form-control h-50 select2bs4" name="sub1" id="sub1">
                                    <option value=""> --Select--</option>
                                    <option value="1"> Mothithang HSS</option>
                                    <option value="Yangchenphug HSS"> Yangchenphug HSS</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Contact Number:</label>
                                <input type="text" class="form-control h-50" name="emp_id" id="contact" >
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Email:</label>
                                <input type="text" class="form-control h-50" name="emp_id" id="email" >
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Compulsory Subject:</label>
                                <select  class="form-control select2bs4" name="sub1" id="sub1">
                                    <option value=""> --Select--</option>
                                    <option value="1"> English</option>
                                    <option value="2"> Dzongkha</option>
                                    <option value="3"> Mathematics</option>
                                    <option value="4"> SEN general</option>
                                    <option value="5"> SEN Dzongkha</option>
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Elective Subject 1:</label>
                                <select  class="form-control h-50 select2bs4" name="sub1" id="sub2">
                                    <option value=""> --Select--</option>
                                    <option value="1"> English</option>
                                    <option value="2"> Dzongkha</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Elective Subject 2:</label>
                                <select  class="form-control h-50 select2bs4" name="sub1" id="sub3">
                                    <option value=""> --Select--</option>
                                    <option value="1"> English</option>
                                    <option value="2"> Dzongkha</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Is in SEN Team:</label><br>
                                <input type="radio" name="sen" value="Yes"> Yes
                                <input type="radio" name="sen"  value="No"> No
                            </div>  -->
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Career Stage:</label><br>
                                <select  class="form-control h-50 select2bs4" name="sub1" id="sub3">
                                    <option value=""> --Select--</option>
                                    <option value="Beginning"> Beginning</option>
                                    <option value="Proficient"> Proficient</option>
                                    <option value="Accomplished"> Accomplished</option>
                                    <option value="Distinguished"> Distinguished</option>
                                </select>
                            </div> 
                             
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Employee File Code:<i class="text-danger">*</i></label>
                                <input class="form-control h-50" name="file_code" id="file_code" type="text">
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
                                <textarea class="form-control h-50" name="remarks" id="remarks"></textarea>
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
                                                        <select class="form-control h-50 select2bs4" id="qdescription">
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
                                                        <select class="form-control h-50 select2bs4" id="qualification">
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
                                                        <select class="form-control h-50 select2bs4" id="coursemode">
                                                            <option value="">--Select--</option>
                                                            <option value="Mix Mode">Mix Mode</option>
                                                            <option value="Full Mode">Full Mode</option>
                                                            <option value="Part Time">Part Time</option>
                                                            <option value="Distance Education">Distance Education</option> 
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Course Title:<i class="text-danger">*</i></label>
                                                        <input type="text" id="coursetitle" class="form-control h-50">
                                                    </div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">First Subject:<i class="text-danger">*</i></label>
                                                        <select class="form-control h-50 select2bs4" id="firstsub">
                                                            <option value="">--Select--</option>
                                                            <option value="Biological Science">Biological Science</option>
                                                            <option value="Buddhist Studies">Buddhist Studies</option>
                                                            <option value="Business Administration">Business Administration</option>
                                                            <option value="Community">Community</option> 
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Second subject:</label>
                                                        <select class="form-control h-50 select2bs4" id="sectsub">
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
                                                        <select class="form-control h-50 select2bs4" id="country">
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
                                                        <input type="date" id="startdate" class="form-control h-50">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">End Date:<i class="text-danger">*</i></label>
                                                        <input type="date" id="enddate" class="form-control h-50">
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
                    <div class="tab-pane fade tab-content-details" id="sen-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <ul class="bg-cyan mb-2">
                            <li class="pl-2 text-white">Providing details for: <span class="personname"></span></li>
                        </ul>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                 <table id="training-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <td>Sl#</td>
                                        <td>Question and Answer</td>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td> 
                                                Does the Teacher have difficulty in seeing, even if wearing glasses?<br>
                                                <input type="radio" name="seing"> No
                                                <input type="radio" name="seing"> Yes - some difficulty
                                                <input type="radio" name="seing"> Yes - a lot of difficulty
                                                <input type="radio" name="seing"> Cannot do at all
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td> 
                                                Does the Teacher have difficulty in hearing, even if using a hearing aid?<br>
                                                <input type="radio" name="hearing"> No
                                                <input type="radio" name="hearing"> Yes - some difficulty
                                                <input type="radio" name="hearing"> Yes - a lot of difficulty
                                                <input type="radio" name="hearing"> Cannot do at all
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td> 
                                                Does the Teacher have difficulty in walking or climbing?<br>
                                                <input type="radio" name="walking"> No
                                                <input type="radio" name="walking"> Yes - some difficulty
                                                <input type="radio" name="walking"> Yes - a lot of difficulty
                                                <input type="radio" name="walking"> Cannot do at all
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td> 
                                                Does the Teacher have difficulty in learning or remembering new things?<br>
                                                <input type="radio" name="remember"> No
                                                <input type="radio" name="remember"> Yes - some difficulty
                                                <input type="radio" name="remember"> Yes - a lot of difficulty
                                                <input type="radio" name="remember"> Cannot do at all
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td> 
                                                Does the Teacher have difficulty focusing on an activity that they enjoy doing?<br>
                                                <input type="radio" name="focus"> No
                                                <input type="radio" name="focus"> Yes - some difficulty
                                                <input type="radio" name="focus"> Yes - a lot of difficulty
                                                <input type="radio" name="focus"> Cannot do at all
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Note: Need to confirm questions and answers related to teacher or staff</td>
                                        </tr>
                                    </tbody>
                                 </table>
                                <ol>
                                    <li>
                                       
                                    </li>
                                    <li>
                                        
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('qualification-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('nomination-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
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
                                                <input type="number" v-model="nom.cid" id="cid" @change="getpersonaldetails(nom)" class="form-control h-50">
                                            </td>
                                            <td>
                                                <input type="text" readonly v-model="nom.name" id="name" class="form-control h-50">
                                            </td>
                                            <td>
                                                <input type="text" readonly v-model="nom.desig" id="desig" class="form-control h-50">
                                            </td>
                                            <td>
                                                <input type="text" readonly v-model="nom.address" id="address" class="form-control h-50">
                                            </td>
                                            <td>
                                                <input type="number" v-model="nom.contact" id="contact" class="form-control h-50">
                                            </td>
                                            <td>
                                                <input type="emial" v-model="nom.email" id="email" class="form-control h-50">
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4">
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
                                                <input type="number" v-model="nom.percentage" id="percentage" @change="calcualtetotla(nom)" class="form-control h-50">
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
                                                <input readonly type="number" id="percentagetotla" class="form-control h-50">
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
            qualificationlist:
            [{
                description:'',qualification:'',coursemode:'',coursetitle:'',firstsub:'',secondsub:'',country:'',startdate:'',enddate:''
            }],
            nominies:
            [{
                cid:'',name:'',desig:'',address:'',contact:'',email:'',relation:'',percentage:''
            }],
        } 
    },
    methods: {
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
            $('#cid').val('12312312312');
            $('#empname').val('Pema Dechen');
            $('#working').val('Yangchenphug HSS');
            $('#position').val('Principal');
            $('#contact').val('12312312');
            $('#email').val('pema@gov.bt');
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
                if(!this.sentab && nextclass=="sen-tab"){
                    nextclass='nomination-tab';
                }
                if(!this.sentab && nextclass=="sen-tab-back"){
                    nextclass='qualification-tab';
                }
                if(this.sentab && nextclass=="sen-tab-back"){
                    nextclass='sen-tab';
                }             
                $('.personname').html($('#empname').val()+', '+$('#position').val());
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
            }
        },
    },
    mounted() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    },
    
}
</script>
