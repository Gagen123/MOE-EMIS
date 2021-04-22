<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-tab">
                        <a class="nav-link active" data-toggle="pill" @click="shownexttab('personal-tab')" role="tab"> 
                            <label class="mb-0.5">Personal Detais </label>                              
                        </a>
                    </li>
                    <li class="nav-item appointment-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('appointment-tab')" role="tab"> 
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
                                <input type="text" v-model="personal_form.cid_work_permit" @change="remove_error('cid_work_permit')" :class="{ 'is-invalid': personal_form.errors.has('cid_work_permit') }"  class="form-control" name="cid_work_permit" id="cid_work_permit">
                                <has-error :form="personal_form" field="cid_work_permit"></has-error>
                            </div> 
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mt-4 pt-2">
                                <button type="button" class="btn btn-sm btn-primary" @click="fetchDetails()"><i class="fa fa-download"></i> Fetch</button>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Full Name:<i class="text-danger">*</i></label>
                                <input type="text" @change="remove_error('name')" v-model="personal_form.name" :class="{ 'is-invalid': personal_form.errors.has('name') }" class="form-control" name="name" id="name"  readonly>
                                <has-error :form="personal_form" field="name"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Sex:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.sex_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('sex_id') }" class="form-control select2" name="sex_id" id="sex_id">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="sex_id"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Date of Birth:<i class="text-danger">*</i>
                                    <img src="img/question.png" data-toggle="tooltip" title="Please provide correct date of birth. System will use this data for wishing his/her birth day" class="brand-image img-circle elevation-3" style="width:25px">
                                </label>
                                <input type="date" v-model="personal_form.dob" :class="{ 'is-invalid': personal_form.errors.has('dob') }" id="dob" name="dob" class="form-control">
                                <has-error :form="personal_form" field="dob"></has-error>
                            </div> 
                        </div> 
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Marital Status:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.marital_status" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('marital_status') }" class="form-control select2" name="marital_status" id="marital_status">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in marital_statusList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="marital_status"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Nationality:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.country_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('country_id') }" class="form-control select2" name="country_id" id="country_id">
                                    <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.nationality }}</option>
                                </select>
                                <has-error :form="personal_form" field="country_id"></has-error>
                            </div> 
                        </div>
                        <div class="form-group row" id="bhutanese_address">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Dzongkhag:</label>
                                <select v-model="personal_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="dzongkhag"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Gewog:</label>
                                <select v-model="personal_form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="gewog"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Village:</label>
                                <select v-model="personal_form.village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('village_id') }" class="form-control select2" name="village_id" id="village_id">
                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="village_id"></has-error>
                            </div> 
                        </div> 
                        <div class="form-group row" id="foreign_address" style="display:none">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Address:</label>
                                <textarea @change="remove_error('address')" class="form-control" v-model="personal_form.address" :class="{ 'is-invalid': personal_form.errors.has('address') }" name="address" id="address"></textarea>
                                <has-error :form="personal_form" field="address"></has-error>
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
                                <button class="btn btn-primary" @click="shownexttab('appointment-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="appointment-tab" role="tabpanel" aria-labelledby="appointment">
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-cyan mb-2 pb-1 pr-1 pt-1">
                                Providing details for: <span class="personname"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Position Title:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.position_title" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('position_title') }" class="form-control select2" name="position_title" id="position_title">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in positiontitleList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="position_title"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Working Agency:<i class="text-danger">*</i></label>
                                <!-- <input type="text" class="form-control" name="emp_id" id="working"  readonly> -->
                                <select v-model="personal_form.working_agency_id" @change="remove_error('working_agency_id')" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('working_agency_id') }" class="form-control select2" name="working_agency_id" id="working_agency_id">
                                    <option value=""> --Select--</option>
                                    <option value="1"> Mothithang HSS</option>
                                    <option value="2"> Yangchenphug HSS</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                                <has-error :form="personal_form" field="working_agency_id"></has-error>
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
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('personal-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('qualification-tab')"> <i class="fa fa-arrow-right"></i>Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="qualification-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <!-- <ul class="bg-cyan mb-2 pb-1">
                            <li class="pl-2 text-white">
                                
                            </li>
                        </ul> -->
                        
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
                                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-flat btn-danger">Cancel</button>
                                        <button  @click="addMore('qualification')" type="button" class="btn btn-flat btn-primary">Add</button>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-cyan mb-2 pb-1 pr-1 pt-1">
                                Providing details for: <span class="personname"></span>
                                <a class="btn btn-dark btn-flat fa-pull-right pb-0 pl-2 pr-2 pt-0" type="button" @click="showaddmodal('qualification-modal')"><i class="fa fa-plus"></i> Add Qualification</a>
                            </div>
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
                                <button class="btn btn-success" @click="shownexttab('appointment-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('nomination-tab')"> <i class="fa fa-arrow-right"></i>save & Next </button>
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
                                <button class="btn btn-success" @click="shownexttab('qualification-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            sex_idList:[],
            marital_statusList:[],
            positiontitleList:[],
            countryList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
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
                personal_id: '',
                emp_type: 'Regular',
                cid_work_permit:'',
                name:'',
                dob:'',
                marital_status:'',
                sex_id:'',
                country_id:'c879c252-b4f7-4ab6-964b-1661ae9f0aa5',//insert id of bhutan to preselect
                dzongkhag:'',
                gewog:'',
                village_id:'',
                address:'',
                contact_number:'',
                email:'',
                remarks:'',
                 
                working_agency_id:'',
                position_title:'',
                comp_sub:'',
                elective_sub1:'',
                elective_sub2:'',
                currier_stage:'',
                emp_file_code:'',
                
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
                $('#position').prop('readonly',true);
                $('#working').prop('readonly',true);
            }
            else{
                $('#empidcid').html('CID/Work Permit No.');
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
            this.personal_form.name='Pema Dechen';
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
                    text: "Are you sure you wish to save this staff details ?",
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
                if(nextclass=="appointment-tab"){
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
                        response.data.id
                        this.change_tab(nextclass);
                    })
                    .catch((error) => { 
                        if(!$('#marital_status').attr('class').includes('select2-hidden-accessible')){
                            $('#marital_status').addClass('select2-hidden-accessible');
                        }

                        if(!$('#working_agency_id').attr('class').includes('select2-hidden-accessible')){
                            $('#working_agency_id').addClass('select2-hidden-accessible');
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
                if(nextclass=="personal-tab"){
                    this.loaddraftpersonalDetails();
                    this.change_tab(nextclass);
                }  
                else{
                    this.change_tab(nextclass);
                }
            }
        },
        change_tab(nextclass){
            $('.personname').html(this.personal_form.name+', '+$('#position_title').find(":selected").text());
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
        loaddraftpersonalDetails(){
            axios.get('staff/loaddraftpersonalDetails')
            .then((response) => {  
                let data=response.data.data;
                if(data.village_id!=null){
                    this.personal_form.dzongkhag=JSON.parse(response.data.dzongkhag).data.id;
                    this.getgewoglist(JSON.parse(response.data.dzongkhag).data.id);
                    this.personal_form.gewog=JSON.parse(response.data.gewog).data.id;
                    this.getvillagelist(JSON.parse(response.data.gewog).data.id);
                    this.personal_form.village_id=data.village_id;
                }
                else{
                    this.personal_form.address=data.address;
                    $('#bhutanese_address').hide();
                    $('#foreign_address').show();
                }
                this.personal_form.personal_id=data.id
                this.personal_form.emp_type=data.emp_type_id;
                this.personal_form.cid_work_permit=data.cid_work_permit;
                this.personal_form.name=data.name;
                this.personal_form.marital_status=data.marital_status;
                this.personal_form.dob=data.dob;
                this.personal_form.position_title=data.position_title_id;
                
                this.personal_form.sex_id=data.sex_id;
                this.personal_form.country_id=data.country_id;
                this.personal_form.working_agency_id=data.working_agency_id;
                this.personal_form.contact_number=data.contact_no;
                this.personal_form.email=data.email;
                this.personal_form.comp_sub=data.comp_sub_id;
                this.personal_form.elective_sub1=data.elective_sub_id1;
                this.personal_form.elective_sub2=data.elective_sub_id2;
                this.personal_form.currier_stage=data.cureer_stagge_id;
                this.personal_form.emp_file_code=data.employee_code;
                this.personal_form.remarks=data.remarks;
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },
        
        loadactivemaritalList(uri="masters/loadStaffMasters/all_active_marital_list"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.marital_statusList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadactivesubjectList(uri="masters/loadStaffMasters/all_active_subject_List"){
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
        loadactivecureerstageList(uri="masters/loadStaffMasters/all_active_cureer_stage_list"){
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
        loadactivesex_idList(uri="masters/loadGlobalMasters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sex_idList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadpositiontitleList(uri="masters/loadStaffMasters/all_active_position_title"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.positiontitleList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadactivecountryList(uri="masters/loadGlobalMasters/all_active_country"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.countryList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        async getgewoglist(id){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id).addClass('select2 ');
            }
            if(id=="position_title"){
                this.personal_form.position_title=$('#position_title').val();
            }
            if(id=="sex_id"){
                this.personal_form.sex_id=$('#sex_id').val();
            }
            if(id=="marital_status"){ 
                this.personal_form.marital_status=$('#marital_status').val();
            }
            if(id=="country_id"){
                this.personal_form.village='';
                this.personal_form.gewog='';
                this.personal_form.village_id='';
                if($('#'+id).val()!='c879c252-b4f7-4ab6-964b-1661ae9f0aa5'){
                    $('#bhutanese_address').hide();
                    $('#foreign_address').show();
                }
                else{
                    $('#bhutanese_address').show();
                    $('#foreign_address').hide();
                }
                this.personal_form.country_id=$('#'+id).val();
            }
            if(id=="dzongkhag"){
                this.personal_form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist();
            }
            if(id=="gewog"){
                this.personal_form.gewog=$('#gewog').val();
                this.getvillagelist();
            }
            if(id=="village_id"){
                this.personal_form.village_id=$('#village_id').val();
            }
            if(id=="working_agency_id"){
                this.personal_form.working_agency_id=$('#working_agency_id').val();
            }
            if(id=="comp_sub"){
                this.personal_form.comp_sub=$('#comp_sub').val();
            }
            if(id=="elective_sub1"){
                this.personal_form.elective_sub1=$('#elective_sub1').val();
            }
            if(id=="elective_sub2"){
                this.personal_form.elective_sub2=$('#elective_sub2').val();
            }
            if(id=="currier_stage"){
                this.personal_form.currier_stage=$('#currier_stage').val();
            }
        }
        
    },
    
    mounted() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.loadactivemaritalList();
        this.loaddraftpersonalDetails();
        this.loadactivesex_idList();
        this.loadpositiontitleList();
        this.loadactivecountryList();
        this.loadactivedzongkhagList();
        this.loadactivesubjectList();
        this.loadactivecureerstageList();
    },
}
</script>
