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
                    <li class="nav-item qualification-tab" @click="shownexttab('qualification-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Qualification </label>
                        </a>
                    </li>
                    <li class="nav-item nomination-tab" @click="shownexttab('nomination-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
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
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mt-4">
                                <button type="button" class="btn btn-sm btn-primary" @click="fetchDetails()"><i class="fa fa-download"></i> Fetch</button>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0.5">Full Name:<i class="text-danger">*</i></label>
                                <input type="text" @change="remove_error('name')" v-model="personal_form.name" :class="{ 'is-invalid': personal_form.errors.has('name') }" class="form-control" name="name" id="name">
                                <has-error :form="personal_form" field="name"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Date of Birth:<i class="text-danger">*</i> </label>
                                <input type="date" v-model="personal_form.dob" :class="{ 'is-invalid': personal_form.errors.has('dob') }" id="dob" name="dob" class="form-control">
                                <has-error :form="personal_form" field="dob"></has-error>
                            </div> 
                             
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Sex:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.sex_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('sex_id') }" class="form-control select2" name="sex_id" id="sex_id">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="sex_id"></has-error>
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
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Contact Number:<i class="text-danger">*</i></label>
                                <input type="number" @change="remove_error('contact_number')" v-model="personal_form.contact_number" :class="{ 'is-invalid': personal_form.errors.has('contact_number') }" class="form-control" name="contact_number" id="contact_number" >
                                <has-error :form="personal_form" field="contact_number"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Email:<i class="text-danger">*</i>
                                    <img src="img/question.png" data-toggle="tooltip" title="System will use this email to send email notifications" class="brand-image img-circle elevation-3" style="width:25px">
                                </label>
                                <input type="text" @change="remove_error('email')" v-model="personal_form.email" :class="{ 'is-invalid': personal_form.errors.has('email') }" class="form-control" name="email" id="email" >
                                <has-error :form="personal_form" field="email"></has-error>
                            </div> 
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Alternative Email:</label>
                                <input type="text" @change="remove_error('alternative_email')" v-model="personal_form.alternative_email" :class="{ 'is-invalid': personal_form.errors.has('alternative_email') }" class="form-control" name="alternative_email" id="alternative_email" >
                                <has-error :form="personal_form" field="alternative_email"></has-error>
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
                                   <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="working_agency_id"></has-error>
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
                                                        <select v-model="qualification_form.description" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('description') }" class="form-control select2" id="description">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in qualificationDescription" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="description"></has-error>
                                                    </div>
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5"> Qualification:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.qualification" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('qualification') }" class="form-control select2" id="qualification">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in staffqualificationlist" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="qualification"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Course Mode/Type:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.coursemode" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('coursemode') }" class="form-control select2" id="coursemode">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in coursemodeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="coursemode"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Course Title:<i class="text-danger">*</i></label>
                                                        <input v-model="qualification_form.coursetitle" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('coursetitle') }" type="text" id="coursetitle" class="form-control" @change="remove_error('coursetitle')">
                                                        <has-error :form="qualification_form" field="coursetitle"></has-error>
                                                    </div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">First Subject:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.firstsub" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('firstsub') }" class="form-control select2" id="firstsub">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="firstsub"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Second subject:</label>
                                                        <select v-model="qualification_form.secondsub" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('secondsub') }" class="form-control select2" id="secondsub">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="secondsub"></has-error>
                                                    </div>
                                                 </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Country:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.country" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('country') }" class="form-control select2" id="country">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.country_name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="country"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Start Date:<i class="text-danger">*</i></label>
                                                        <input v-model="qualification_form.startdate" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('startdate') }" type="date" id="startdate" class="form-control" @change="remove_error('startdate')">
                                                        <has-error :form="qualification_form" field="startdate"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">End Date:<i class="text-danger">*</i></label>
                                                        <input v-model="qualification_form.enddate" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('enddate') }" type="date" id="enddate" class="form-control" @change="remove_error('enddate')">
                                                        <has-error :form="qualification_form" field="enddate"></has-error>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" v-model="qualification_form.action_type">
                                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-flat btn-danger">Cancel</button>
                                        <button  @click="addMore('qualification')" type="button" class="btn btn-flat btn-primary">Add/Update</button>
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
                                    <tbody>
                                        <tr v-for="(item, index) in staff_qualification_list" :key="index">
                                            <td>{{ item.description.name}}</td>
                                            <td>{{ item.qualification.name}}</td>
                                            <td>{{ item.coursemode.name}}</td>
                                            <td>{{ item.coursetitle}}</td>
                                            <td>{{ item.first_subject.name}}</td>
                                            <td v-if="item.second_subject!=null">{{ item.second_subject.name}}</td>
                                            <td v-else></td>
                                            <td>{{ item.country.country_name}}</td>
                                            <td>{{ item.startdate}}</td>
                                            <td>{{ item.enddate}}</td> 
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)">Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('personal-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('nomination-tab')"> <i class="fa fa-arrow-right"></i>Save & Next </button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="nomination-tab" role="tabpanel" aria-labelledby="basicdetails">
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
                                                        <input @keyup.enter="getDetailsbyCID()" @blur="getDetailsbyCID"  v-model="nomination_form.nomi_cid" :class="{ 'is-invalid': nomination_form.errors.has('nomi_cid') }" type="text" id="nomi_cid" class="form-control" @change="remove_error('nomi_cid')">
                                                        <has-error :form="nomination_form" field="nomi_cid"></has-error>
                                                    </div>
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5"> Full Name:<i class="text-danger">*</i></label>
                                                        <input v-model="nomination_form.nomi_name" :class="{ 'is-invalid': nomination_form.errors.has('nomi_name') }" type="text" id="nomi_name" class="form-control" @change="remove_error('nomi_name')">
                                                        <has-error :form="nomination_form" field="nomi_name"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Designation:<i class="text-danger">*</i></label>
                                                        <input v-model="nomination_form.nomi_desig" :class="{ 'is-invalid': qualification_form.errors.has('nomi_desig') }" type="text" id="nomi_desig" class="form-control" @change="remove_error('nomi_desig')">
                                                        <has-error :form="qualification_form" field="nomi_desig"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Address:<i class="text-danger">*</i></label>
                                                        <textarea v-model="nomination_form.nomi_address" :class="{ 'is-invalid': qualification_form.errors.has('nomi_address') }" id="nomi_address" class="form-control" @change="remove_error('nomi_address')"></textarea>
                                                        <has-error :form="qualification_form" field="nomi_address"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Contact Number:<i class="text-danger">*</i></label>
                                                        <input v-model="nomination_form.nomi_contact" :class="{ 'is-invalid': nomination_form.errors.has('nomi_contact') }" type="text" id="nomi_contact" class="form-control" @change="remove_error('nomi_contact')">
                                                        <has-error :form="nomination_form" field="nomi_contact"></has-error>
                                                    </div>
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5"> Email:<i class="text-danger">*</i></label>
                                                        <input v-model="nomination_form.nomi_email" :class="{ 'is-invalid': nomination_form.errors.has('nomi_email') }" type="text" id="nomi_email" class="form-control" @change="remove_error('nomi_email')">
                                                        <has-error :form="nomination_form" field="nomi_email"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Relationship:<i class="text-danger">*</i></label>
                                                        <select v-model="nomination_form.nomi_relation" :class="{ 'is-invalid select2 select2-hidden-accessible': nomination_form.errors.has('nomi_relation') }" class="form-control select2" id="nomi_relation">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in repationshipList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="nomination_form" field="nomi_relation"></has-error>
                                                    </div>
                                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5"> Percentage:<i class="text-danger">*</i></label>
                                                        <input v-model="nomination_form.nomi_percentage" :class="{ 'is-invalid': nomination_form.errors.has('nomi_percentage') }" type="text" id="nomi_percentage" class="form-control" @change="remove_error('nomi_percentage')">
                                                        <has-error :form="nomination_form" field="nomi_percentage"></has-error>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" v-model="nomination_form.action_type">
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
                                            <td>{{ item.nomi_percentage}}</td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="shownominationedit(item)">Edit</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="text-right">
                                                Total: 
                                            </td>
                                            <td colspan="2">
                                                <input readonly type="number" v-model="grand_total" id="percentagetotla" class="form-control">
                                            </td>
                                        </tr>
                                        <!-- <tr v-for='(nom, index) in this.nomination_form.nominies' :key="index">
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
                                                <button type="button" class="btn btn-xs btn-primary btn-sm" id="addMore" 
                                                @click="addMore('nom')"><i class="fa fa-plus"></i> Add More</button>
                                                <button type="button" class="btn btn-xs btn-sm btn-danger" id="addMore" 
                                                @click="remove('nom')"><i class="fa fa-trash"></i> Remove</button>
                                            </td>
                                            <td>
                                                Total: 
                                            </td>
                                            <td>
                                                <input readonly type="number" id="percentagetotla" class="form-control">
                                            </td>
                                        </tr>   -->
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
    data(){
        return{ 
            grand_total:0,
            qualification_tbl_row_count:0,
            sex_idList:[],
            marital_statusList:[],
            positiontitleList:[],
            countryList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            orgList:[],
            subjectList:[],
            cureerstageList:[],
            qualificationDescription:[],
            staffqualificationlist:[],
            coursemodeList:[],
            repationshipList:[],
            staff_nomination_list:[],
            
            personal_form: new form({
                personal_id: '',
                emp_type: 'Regular',
                emp_id:'',
                cid_work_permit:'',
                name:'',
                position_title:'',
                sex_id:'',
                dob:'',
                marital_status:'',
                country_id:'',
                dzongkhag:'',
                village_id:'',
                gewog:'',
                working_agency_id:'',
                contact_number:'',
                email:'',
                alternative_email:'',
                comp_sub:'',
                elective_sub1:'',
                elective_sub2:'',
                currier_stage:'',
                emp_file_code:'',
                remarks:'',
                status:'Pending',
            }),
            qualification_form: new form({
                personal_id: '',
                qualification_id:'',
                description:'',
                qualification:'',
                coursemode:'',
                coursetitle:'',
                firstsub:'',
                secondsub:'',
                country:'',
                startdate:'',
                enddate:'',
                action_type:'',
                status:'Pending',
            }),
            nomination_form: new form({
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
                action_type:'',
                status:'Pending',
            }),  
            staff_qualification_list:'',
        } 
    },
    methods: {
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
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
        shownominationedit(item){
            this.nomination_form.action_type='edit';
            this.nomination_form.nomination_id=item.id;
            $('#nomi_cid').val(item.nomi_cid);
            this.nomination_form.nomi_cid=item.nomi_cid;

            $('#nomi_name').val(item.nomi_name);
            this.nomination_form.nomi_name=item.nomi_name;

            $('#nomi_desig').val(item.nomi_desig);
            this.nomination_form.nomi_desig=item.nomi_desig;

            $('#nomi_address').val(item.nomi_address);
            this.nomination_form.nomi_address=item.nomi_address;

            $('#nomi_contact').val(item.nomi_contact);
            this.nomination_form.nomi_contact=item.nomi_contact;

             $('#nomi_email').val(item.nomi_email);
            this.nomination_form.nomi_email=item.nomi_email;

            $('#nomi_relation').val(item.nomi_relation.id).trigger('change');
            this.nomination_form.nomi_relation=item.relations.id;
            $('#nomi_percentage').val(item.nomi_percentage);
            this.nomination_form.nomi_percentage=item.nomi_percentage;
            
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            $('#nomination-modal').modal('show');
        },
        showedit(item){
            this.qualification_form.action_type='edit';
            this.qualification_form.qualification_id=item.id;
            $('#description').val(item.description.id).trigger('change');
            this.qualification_form.description=item.description.id;

            $('#qualification').val(item.qualification.id).trigger('change');
            this.qualification_form.qualification=item.qualification.id;

            $('#coursemode').val(item.coursemode.id).trigger('change');
            this.qualification_form.coursemode=item.coursemode.id;

            $('#coursetitle').val(item.coursetitle);
            this.qualification_form.coursetitle=item.coursetitle;

            $('#country').val(item.country.id).trigger('change');
            this.qualification_form.country=item.country.id;

            $('#firstsub').val(item.first_subject.id).trigger('change');
            this.qualification_form.first_subject=item.first_subject.id;

            if(item.second_subject!=null){
                $('#secondsub').val(item.second_subject.id).trigger('change');
                this.qualification_form.second_subject=item.second_subject.id;
            }

            $('#startdate').val(item.startdate);
            this.qualification_form.startdate=item.startdate;
            $('#enddate').val(item.enddate); 
            
            this.qualification_form.enddate=item.enddate;
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            $('#qualification-modal').modal('show');
        },
        addMore: function(type){
            if(type=="qualification"){ 
                // this.qualification_form.stfqualifications.push({description:$('#qdescription').val(),qualification:$('#qualification').val(),coursemode:$('#coursemode').val(),
                // coursetitle:$('#coursetitle').val(),firstsub:$('#firstsub').val(),secondsub:$('#sectsub').val(),
                // country:$('#qualificationcountry').val(),startdate:$('#startdate').val(),enddate:$('#enddate').val()})
                this.qualification_form.post('staff/savequalificationDetails')
                .then((response) => {  
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved Successfully'
                    });
                    this.loadqualication(this.qualification_form.personal_id);
                    $('#qualification-modal').modal('hide');
                })
                .catch((error) => {  
                    console.log("Error:"+error)
                });

                // let deletefunction="this.deletequalification('stfqua"+this.qualification_tbl_row_count+"')";
                // let tabledata="<tr id='stfqua"+this.qualification_tbl_row_count+"'>"+
                //     "<td><input type='hidden' id='stfquadesc"+this.qualification_tbl_row_count+"' value='"+$('#qdescription').val()+"'>"+$('#qdescription option:selected').text()+"</td>"+
                //     "<td><input type='hidden' id='stfqualification"+this.qualification_tbl_row_count+"' value='"+$('#qualification').val()+"'>"+$('#qualification option:selected').text()+"</td>"+
                //     "<td><input type='hidden' id='stfcoursemode"+this.qualification_tbl_row_count+"' value='"+$('#coursemode').val()+"'>"+$('#coursemode option:selected').text()+"</td>"+
                //     "<td><input type='hidden' id='stfcoursetitle"+this.qualification_tbl_row_count+"' value='"+$('#coursetitle').val()+"'>"+$('#coursetitle').val()+"</td>"+
                //     "<td><input type='hidden' id='stffirstsub"+this.qualification_tbl_row_count+"' value='"+$('#firstsub').val()+"'>"+$('#firstsub option:selected').text()+"</td>"+
                //     "<td><input type='hidden' id='stfsectsub"+this.qualification_tbl_row_count+"' value='"+$('#sectsub').val()+"'>"+$('#sectsub option:selected').text()+"</td>"+
                //     "<td><input type='hidden' id='stfcountry"+this.qualification_tbl_row_count+"' value='"+$('#qualificationcountry').val()+"'>"+$('#qualificationcountry option:selected').text()+"</td>"+ 
                //     "<td><input type='hidden' id='stfstartdate"+this.qualification_tbl_row_count+"' value='"+$('#startdate').val()+"'>"+$('#startdate').val()+"</td>"+
                //     "<td><input type='hidden' id='stfenddate"+this.qualification_tbl_row_count+"' value='"+$('#enddate').val()+"'>"+$('#enddate').val()+"</td>"+
                //     "<td><button type='button' class='btn btn-sm btn-success btn-flat btn-block pt-0 pb-0'>Edit</button>"+
                //     "<button type='button' @click="+deletefunction+" class='btn btn-sm btn-danger btn-flat btn-block pt-0 pb-0'>Delete</button> </td>"+
                // "</tr>";
                // $('#qualificationlist').append(tabledata);
                // 
                // this.qualification_tbl_row_count++;
            }
            else if(type=="nomination"){
                if(parseInt(this.grand_total)+parseInt(this.nomination_form.nomi_percentage)>100){
                    Swal.fire(
                        'error!',
                        'Your total percentage cannot be more the 100.',
                        'error',
                    )
                }
                else{
                    this.nomination_form.post('staff/savenominationDetails')
                    .then((response) => {  
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                        this.loadnomination(this.qualification_form.personal_id);
                        $('#nomination-modal').modal('hide');
                    })
                    .catch((error) => {  
                        console.log("Error:"+error)
                    });
                }
               
               // this.nomination_form.nominies.push({nomi_cid:'',nomi_name:'',nomi_desig:'',nomi_address:'',nomi_contact:'',nomi_email:'',nomi_relation:'',nomi_percentage:''})
            }
        }, 
        loadqualication(staff_id){
            if(staff_id!=null && staff_id!=""){
                let uri = 'staff/loadQualification/'+staff_id;
                axios.get(uri)
                .then(response =>{
                    let data = response;
                    this.staff_qualification_list = data.data.data;
                })
                .catch(function (error){
                    console.log("Error:"+error)
                });
            }
        },
        remove(type,index){ 
            if(type=="qua"){
                this.qualificationlist.splice(index,1); 
            } 
            else{
                if(this.nomination_form.nominies.length>1){
                    this.nomination_form.nominies.splice(index,1); 
                }
            }            
        },
        getpersonaldetails(data){
            data.name='Full Name'+data.cid;
            data.desig='MR';
            this.personal_form.emp_id=this.personal_form.cid_work_permit;
            data.address='Permanent Address '+data.cid;
        },
        fetchDetails(){
            // this.personal_form.name='Pema Dechen';
            // this.personal_form.position_title='Principal';
            // this.personal_form.contact_number='12312312';
            // this.personal_form.email='pema@gov.bt';
        },
        
        calcualtetotla(data){
            this.totle+=parseInt(data.percentage);
            if(this.grand_total>100){
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
        loadqualificationdescription(){
            let uri = 'masters/loadStaffMasters/all_active_qualification_description_list';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.qualificationDescription = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadqualification(){
            let uri = 'masters/loadStaffMasters/all_active_qualification_List';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.staffqualificationlist = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
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
        
        loadcoursemode(){
            let uri = 'masters/loadStaffMasters/all_active_coursemode_list';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.coursemodeList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                if(this.staff_nomination_list.length<1){
                    Swal.fire(
                        'error!',
                        'Please provide nomination details.',
                        'error',
                    );
                }else{
                    Swal.fire({
                        text: "Are you sure you wish to save this staff details ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.nomination_form.post('staff/updatefinalstaffDetails')
                            .then((response) => {  
                                Swal.fire(
                                    'Success!',
                                    'Details has been saved successfully.',
                                    'success',
                                )
                                this.$router.push('/list_civil_staff');
                            })
                            .catch((error) => {  
                                console.log("Error......"+error)
                            });
                        }
                    });
                }
                
            }
            else{
                if(nextclass=="qualification-tab"){
                    this.personal_form.post('staff/savePersonalDetails')
                    .then((response) => {   
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                        $('.select2').select2();
                        $('.select2').select2({
                            theme: 'bootstrap4'
                        });
                        if(response.data.data.id!=undefined){
                            this.qualification_form.personal_id=response.data.data.id;
                            this.nomination_form.personal_id=response.data.data.id;
                        }
                        this.change_tab(nextclass);
                        this.loadqualificationdescription();
                        this.loadqualification();
                        this.loadcoursemode();
                        this.loadqualication(this.personal_form.personal_id);
                    })
                    .catch((error) => {  
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
                        this.change_tab('personal-tab');
                        console.log("Error......"+error)
                    });
                }
                if(nextclass=="personal-tab"){
                    this.loaddraftpersonalDetails();
                    this.change_tab(nextclass);
                }  
                else{
                    if(nextclass=="nomination-tab" && this.staff_qualification_list.length<1){
                        Swal.fire(
                            'error!',
                            'Please provide qualification details.',
                            'error',
                        );
                        this.change_tab('qualification-tab');
                    }
                    else{
                        this.change_tab(nextclass);
                        this.loadnomination(this.personal_form.personal_id);
                    }
                }
            }
        },
        change_tab(nextclass){
            $('.personname').html(this.personal_form.name);
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
        loaddraftpersonalDetails(){
            axios.get('staff/loaddraftpersonalDetails/Regular')
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
                this.personal_form.personal_id=data.id;
                // this.loadqualication(data.id);
                this.qualification_form.personal_id=data.id;
                this.nomination_form.personal_id=data.id;
                this.personal_form.emp_type=data.emp_type_id;
                this.personal_form.cid_work_permit=data.cid_work_permit;
                this.personal_form.name=data.name;
                this.personal_form.position_title=data.position_title_id;
                this.personal_form.marital_status=data.merital_status;
                this.personal_form.dob=data.dob;
                
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
        
        loadrelationshipList(uri="masters/loadStaffMasters/all_active_relationship_list"){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.repationshipList =  data.data.data;
            })
            .catch(function (error){
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
                for(let i=0; i<this.countryList.length;i++){
                    if(this.countryList[i].nationality.toLowerCase().includes('bhutan')){
                        this.personal_form.country_id=this.countryList[i].id;
                    }
                }
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
        getgewoglist(id){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            this.gewog_list =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        allOrgList(){
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+$('#dzongkhag').val();
            this.orgList = [];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.orgList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
             this.villageList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
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
                
                if($('#country_id option:selected').text().includes('Bhutan')){
                   $('#bhutanese_address').show();
                    $('#foreign_address').hide();
                }
                else{
                     $('#bhutanese_address').hide();
                    $('#foreign_address').show();
                }
                this.personal_form.country_id=$('#'+id).val();
            }
            if(id=="dzongkhag"){
                this.personal_form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist();
                this.allOrgList();
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
            if(id=="qualification"){
                this.qualification_form.qualification=$('#qualification').val();
            }
            if(id=="coursemode"){
                this.qualification_form.coursemode=$('#coursemode').val();
            }
            if(id=="firstsub"){
                this.qualification_form.firstsub=$('#firstsub').val();
            }
            if(id=="secondsub"){
                this.qualification_form.secondsub=$('#secondsub').val();
            }
            
            if(id=="country"){
                this.qualification_form.country=$('#country').val();
            }
            if(id=="description"){
                this.qualification_form.description=$('#description').val();
            }

            if(id=="nomi_relation"){
                this.nomination_form.nomi_relation=$('#nomi_relation').val();
            }
        },
        getDetailsbyCID(){
            if (this.nomination_form.nomi_cid.length == 11){
                axios.get('getpersonbycid/'+ this.nomination_form.nomi_cid)
                .then(response => {
                    this.ciderror = '';
                    if (response.data.citizenDetail[0]) {
                        let response_data = response.data.citizenDetail[0];
                        this.nomination_form.nomi_name = response_data.firstName + " " + response_data.lastName;
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
        this.loadrelationshipList();
        
    },
}
</script>
