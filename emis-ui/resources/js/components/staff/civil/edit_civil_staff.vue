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
                        <div class="callout callout-success">
                            <div class="form-group row" id="searchemp">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="mb-0.5">Emp Type:<i class="text-danger">*</i> </label><br>
                                    <input type="radio" v-model="personal_form.emp_type" name="etype" value="1"> Regular
                                    <input type="radio" v-model="personal_form.emp_type" name="etype" value="2"> Contract
                                    <input type="radio" v-model="personal_form.emp_type" name="etype" value="3"> Volunteer & Project Based
                                    <!-- <input type="radio" name="etype" @click="showemptypedtab(false)" value="Project Based"> Project Based -->
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5"><span id="empidcid">Emp Id/CID</span><i class="text-danger">*</i> </label>
                                    <input type="text" v-model="personal_form.cideid" @change="remove_error('cideid')" :class="{ 'is-invalid': personal_form.errors.has('cideid') }"  class="form-control" name="cideid" id="cideid">
                                    <has-error :form="personal_form" field="cideid"></has-error>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-4 pt-2">
                                    <button type="button" class="btn btn-sm btn-primary" @click="fetchDetails()"><i class="fa fa-download"></i> Fetch</button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="contrct_type" style="display:none">
                                    <label class="mb-0.5">Contract Category:</label>
                                    <span v-for="(cat, index) in categoryList" :key="index" >
                                        <input type="radio" @change="remove_error('nature_of_participant')" v-model="personal_form.contract_category" :class="{ 'is-invalid' :personal_form.errors.has('nature_of_participant') }" name="nature_of_participant" id="nature_of_participant" :value="cat.id">
                                        <label class="pr-3"> {{cat.name }} </label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Personal Detail</u></label></span>
                            <div class="form-group row">
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Emp Id:<i class="text-danger">*</i></label>
                                    <input type="text" @change="remove_error('emp_id')" v-model="personal_form.emp_id" :class="{ 'is-invalid': personal_form.errors.has('emp_id') }" class="form-control" name="emp_id" id="emp_id">
                                    <has-error :form="personal_form" field="emp_id"></has-error>
                                </div> -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">CID/Work Permit No:<i class="text-danger">*</i> </label>
                                    <input type="text" v-model="personal_form.cid_work_permit" :class="{ 'is-invalid': personal_form.errors.has('cid_work_permit') }" id="cid_work_permit" name="cid_work_permit" class="form-control">
                                    <has-error :form="personal_form" field="cid_work_permit"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Full Name:<i class="text-danger">*</i></label>
                                    <input type="text" @change="remove_error('name')" v-model="personal_form.name" :class="{ 'is-invalid': personal_form.errors.has('name') }" class="form-control" name="name" id="name">
                                    <has-error :form="personal_form" field="name"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Date of Birth:<i class="text-danger">*</i> </label>
                                    <input type="text" :class="{ 'is-invalid': personal_form.errors.has('dob') }" id="dob" name="dob" autocomplete="off" class="form-control popupDatepicker">
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
                                    <label class="mb-0.5">Position Title (Level-Superstructure):<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.position_title" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('position_title') }" class="form-control select2" name="position_title" id="position_title">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in positiontitleList" :key="index" v-bind:value="item.id+'_'+item.subgroup">{{ item.positionTitle }} ({{ item.positionlevel }}-{{item.superstructure}})</option>
                                    </select>
                                    <has-error :form="personal_form" field="position_title"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Position Sub Level:<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.position_sub_level" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('position_sub_level') }" class="form-control select2" name="position_sub_level" id="position_sub_level">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in positionsubList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="position_sub_level"></has-error>
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
                        </div>

                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Permanent Address</u></label></span>
                            <div class="form-group row" id="bhutanese_address">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Dzongkhag:</label>
                                    <select v-model="personal_form.p_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('p_dzongkhag') }" class="form-control select2" name="p_dzongkhag" id="p_dzongkhag">
                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="p_dzongkhag"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Gewog:</label>
                                    <select v-model="personal_form.p_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('p_gewog') }" class="form-control select2" name="p_gewog" id="p_gewog">
                                        <option v-for="(item, index) in p_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="p_gewog"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Village:</label>
                                    <select v-model="personal_form.p_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('p_village_id') }" class="form-control select2" name="p_village_id" id="p_village_id">
                                        <option v-for="(item, index) in p_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="p_village_id"></has-error>
                                </div>
                            </div>
                            <div class="form-group row" id="foreign_address" style="display:none">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Address:</label>
                                    <textarea class="form-control" id="address" v-model="personal_form.address"></textarea>
                                    <has-error :form="personal_form" field="address"></has-error>
                                </div>
                            </div>
                        </div>

                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Contacts</u></label></span>
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
                        </div>

                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Working Address</u></label></span>
                            <div class="form-group row">
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
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Organization Type:<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.organization_type" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('organization_type') }" class="form-control select2" name="organization_type" id="organization_type">
                                        <option value="Org">Organization/School </option>
                                        <option value="Dzongkhag">Dzongkhag</option>
                                        <option value="Ministry">Ministry </option>
                                    </select>
                                    <has-error :form="personal_form" field="organization_type"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="display:none" id="departmentdiv">
                                    <label class="mb-0.5">Department:<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.department" @change="remove_error('working_agency_id')" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('department') }" class="form-control select2" name="department" id="department">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in departmentList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="department"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Working Agency:<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.working_agency_id" @change="remove_error('working_agency_id')" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('working_agency_id') }" class="form-control select2" name="working_agency_id" id="working_agency_id">
                                        <option value=""> --Select--</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="working_agency_id"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success" style="display:none" id="isteaching">
                            <span class="text-blue"><label><u>Subjects</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Compulsory Subject:<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.comp_sub" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('comp_sub') }" class="form-control select2" name="comp_sub" id="comp_sub">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id+'__'+item.is_special_educational_needs">{{ item.name }}</option>
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
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Career Stage:<i class="text-danger">*</i></label><br>
                                    <select @change="remove_error('currier_stage')" v-model="personal_form.currier_stage" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('currier_stage') }" class="form-control select2" name="currier_stage" id="currier_stage">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in cureerstageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="currier_stage"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Is SEN ?:  {{personal_form.issen}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Others</u></label></span>
                            <div class="form-group row">
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Is in SEN Team:</label><br>
                                    <input type="radio" name="sen" value="Yes"> Yes
                                    <input type="radio" name="sen"  value="No"> No
                                </div>  -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Initail Appointment Date:<i class="text-danger">*</i></label>
                                    <input @change="remove_error('initial_appointment_date')" autocomplete="off" class="form-control popupDatepicker" :class="{ 'is-invalid': personal_form.errors.has('initial_appointment_date') }" name="initial_appointment_date" id="initial_appointment_date" type="text">
                                    <has-error :form="personal_form" field="initial_appointment_date"></has-error>
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
                        </div>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('qualification-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="qualification-tab" role="tabpanel" aria-labelledby="basicdetails">
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
                                                        <label class="mb-0.5">Category/Description:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.description" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('description') }" class="form-control select2" id="description">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in qualificationDescription" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="description"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Doner Agency:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.doner_agency" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('doner_agency') }" class="form-control select2" id="doner_agency">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in donerAgencyList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="doner_agency"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Project of Donor Agency:</label>
                                                        <select v-model="qualification_form.project_doner_agency" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('project_doner_agency') }" class="form-control select2" id="project_doner_agency">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in projectdonerAgencyList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="project_doner_agency"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Field/Type:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.field" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('field') }" class="form-control select2" id="field">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in fieldList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="field"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Degree/level:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.degree" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('degree') }" class="form-control select2" id="degree">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in degreeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="degree"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">First Subject:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.firstsub" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('firstsub') }" class="form-control select2" id="firstsub">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in staffqualificationlist" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="firstsub"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Second subject:</label>
                                                        <select v-model="qualification_form.secondsub" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('secondsub') }" class="form-control select2" id="secondsub">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in staffqualificationlist" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="secondsub"></has-error>
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
                                                        <label class="mb-0.5">Country:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.country" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('country') }" class="form-control select2" id="country">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.country_name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="country"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Institute:</label>
                                                        <select v-model="qualification_form.institute" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('institute') }" class="form-control select2" id="institute">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in instituteList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="institute"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Start Date:<i class="text-danger">*</i></label>
                                                        <input :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('startdate') }" type="text" id="startdate" class="form-control popupDatepicker" @change="remove_error('startdate')">
                                                        <has-error :form="qualification_form" field="startdate"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">End Date:<i class="text-danger">*</i></label>
                                                        <input :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('enddate') }" type="text" id="enddate" class="form-control popupDatepicker" @change="remove_error('enddate')">
                                                        <has-error :form="qualification_form" field="enddate"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label class="mb-0.5">Remarks:<i class="text-danger">*</i></label>
                                                        <textarea class="form-control" name="remarks" id="remarks" v-model="qualification_form.remarks"></textarea>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                                <table id="training-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Category/ Desciption</th>
                                            <th>Doner Agency</th>
                                            <th>Project Doner Agency</th>
                                            <th>Field/Typ</th>
                                            <th>Degree/level</th>
                                            <th>First Subject</th>
                                            <th>Second subject</th>
                                            <th>Course Mode/Type</th>
                                            <th>Course Title</th>
                                            <th>Country</th>
                                            <th>Institute</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Remarkse</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in staff_qualification_list" :key="index">
                                            <td>{{ item.categoryname}}</td>
                                            <td>{{ item.doneragencyname}}</td>
                                            <td>{{ item.projectdoneragencyname}}</td>
                                            <td>{{ item.fieldname}}</td>
                                            <td>{{ item.degreename}}</td>
                                            <td>{{ item.sub1name}}</td>
                                            <td>{{ item.sub2name}}</td>
                                            <td>{{ item.coursemodename}}</td>
                                            <td>{{ item.coursetitle}}</td>
                                            <td>{{ item.country.country_name}}</td>
                                            <td>{{ item.institutename}}</td>
                                            <td>{{ item.startdate}}</td>
                                            <td>{{ item.enddate}}</td>
                                            <td>{{ item.remarks}}</td>
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
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Is Nominee?:<i class="text-danger">*</i></label>
                                                        <input type="radio" v-model="nomination_form.isnominee" name="isnominee" value="1"> Yes
                                                        <input type="radio" v-model="nomination_form.isnominee" name="isnominee" value="0"> No
                                                        <has-error :form="nomination_form" field="isnominee"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="nomination_form.isnominee==1">
                                                        <label class="mb-0.5"> Percentage:<i class="text-danger">*</i></label>
                                                        <input v-model="nomination_form.nomi_percentage" :class="{ 'is-invalid': nomination_form.errors.has('nomi_percentage') }" type="text" id="nomi_percentage" class="form-control" @change="remove_error('nomi_percentage')">
                                                        <has-error :form="nomination_form" field="nomi_percentage"></has-error>
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
                                                                <tr id="record1" v-for='(att, index) in nomination_form.fileUpload' :key="index">
                                                                    <td>
                                                                        <input type="text" class="form-control" :class="{ 'is-invalid' :nomination_form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
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
            sex_Array:{},
            donerAgencyList:[],
            projectdonerAgencyList:[],
            fieldList:[],
            degreeList:[],
            marital_statusList:[],
            positiontitleList:[],
            positionsubList:[],
            countryList:[],
            dzongkhagList:[],
            gewog_list:[],
            p_gewog_list:[],
            p_villageList:[],
            villageList:[],
            orgList:[],
            departmentList:[],
            subjectList:[],
            qualificationsubjectList:[],
            subjectArray:{},
            cureerstageList:[],
            qualificationDescription:[],
            staffqualificationlist:[],
            coursemodeList:[],
            repationshipList:[],
            staff_nomination_list:[],
            attachmentDetails:[],
            categoryList:[],
            instituteList:[],
            personal_form: new form({
                isteaching:false,
                organization_type:'',
                personal_id: '',
                contract_category:'',
                cideid:'',
                emp_type: 1,
                emp_id:'',
                cid_work_permit:'',
                name:'',
                p_address:'',
                position_title:'',
                position_sub_level:'',
                sex_id:'',
                dob:'',
                issen:'No',
                marital_status:'',
                country_id:'',
                dzongkhag:'',
                village_id:'',
                gewog:'',
                department:'',
                p_dzongkhag:'',
                p_village_id:'',
                p_gewog:'',
                working_agency_id:'',
                contact_number:'',
                email:'',
                alternative_email:'',
                comp_sub:'',
                elective_sub1:'',
                elective_sub2:'',
                currier_stage:'',
                initial_appointment_date:'',
                emp_file_code:'',
                remarks:'',
                status:'Created',
            }),
            qualification_form: new form({
                personal_id: '',
                doner_agency:'',
                project_doner_agency:'',
                field:'',
                degree:'',
                qualification_id:'',
                description:'',
                qualification:'',
                coursemode:'',
                coursetitle:'',
                firstsub:'',
                secondsub:'',
                country:'',
                institute:'',
                startdate:'',
                enddate:'',
                action_type:'',
                status:'Created',
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
                isnominee:1,
                action_type:'',
                fileUpload: [],
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
                status:'Created',
            }),
            staff_qualification_list:'',
        }
    },
    methods: {
        resetnomidees(){
            this.nomination_form.nomination_id='';
            this.nomination_form.nomi_cid='';
            this.nomination_form.nomi_name='';
            this.nomination_form.nomi_desig='';
            this.nomination_form.nomi_address='';
            this.nomination_form.nomi_contact='';
            this.nomination_form.nomi_email='';
            this.nomination_form.nomi_relation='';
            this.nomination_form.isnominee=1;
            this.nomination_form.action_type='';
            this.nomination_form.fileUpload=[];
            this.nomination_form.attachments=[{ file_name:'',attachment:''}];
            this.nomination_form.ref_docs=[];
            this.nomination_form.status='Created';
        },
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.nomination_form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
         /**
         * method to add more fields
         */
        addMoreattachment: function(){
            this.nomination_form.fileUpload.push({file_name:'', file_upload:''})
        },

        /**
         * method to remove fields
         */
        removeattachment(index){
            if(this.nomination_form.fileUpload.length>1){
                this.nomination_form.fileUpload.pop();
            }
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

        showaddmodal(type){
            if(type=="qualification-modal"){
                $('.popupDatepicker').css('z-index',' 99999 !important; ');
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
            this.attachmentDetails=item.attachment;
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            $('#nomination-modal').modal('show');
        },
        showedit(item){
            $('.popupDatepicker').datepick({
                dateFormat: 'dd/mm/yyyy',
            });
            this.qualification_form.action_type='edit';
            this.qualification_form.qualification_id=item.id;

            $('#description').val(item.category).trigger('change');
            this.qualification_form.description=item.category;

            $('#doner_agency').val(item.doner_id).trigger('change');
            this.qualification_form.project_doner_agency=item.doner_id;
            $('#doner_agency').val(item.project_doner_id).trigger('change');
            this.qualification_form.project_doner_agency=item.project_doner_id;

            $('#field').val(item.field_id).trigger('change');
            this.qualification_form.field=item.field_id;
            $('#degree').val(item.degree_id).trigger('change');
            this.qualification_form.degree=item.degree_id;

            $('#firstsub').val(item.first_subject).trigger('change');
            this.qualification_form.first_subject=item.first_subject;
            $('#secondsub').val(item.second_subject).trigger('change');
            this.qualification_form.second_subject=item.second_subject;

            $('#coursemode').val(item.coursemode).trigger('change');
            this.qualification_form.coursemode=item.coursemode;
            $('#coursetitle').val(item.coursetitle);
            this.qualification_form.coursetitle=item.coursetitle;

            $('#country').val(item.country.id).trigger('change');
            this.qualification_form.country=item.country.id;
            $('#institute').val(item.institute_id).trigger('change');
            this.qualification_form.institute=item.institute_id;

            $('#startdate').val(item.startdate);
            this.qualification_form.startdate=item.startdate;
            $('#enddate').val(item.enddate);
            this.qualification_form.enddate=item.enddate;

            $('#remarks').val(item.remarks);
            this.qualification_form.remarks=item.remarks;
            $('.select2').select2({
                theme: 'bootstrap4'
            });
            $('#qualification-modal').modal('show');

        },
        addMore: function(type){
            if(type=="qualification"){
                this.qualification_form.startdate=this.formatYYYYMMDD($('#startdate').val());
                this.qualification_form.enddate=this.formatYYYYMMDD($('#enddate').val());
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
                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }
                    let formData = new FormData();
                    formData.append('personal_id', this.nomination_form.personal_id);
                    formData.append('ref_docs[]', this.nomination_form.ref_docs);
                    for(let i=0;i<this.nomination_form.ref_docs.length;i++){
                        formData.append('attachments[]', this.nomination_form.ref_docs[i].attach);
                        formData.append('attachmentname[]', this.nomination_form.ref_docs[i].name);
                    }
                    formData.append('nomination_id', this.nomination_form.nomination_id);
                    formData.append('nomi_cid', this.nomination_form.nomi_cid);
                    formData.append('nomi_name', this.nomination_form.nomi_name);
                    formData.append('nomi_desig', this.nomination_form.nomi_desig);
                    formData.append('nomi_address', this.nomination_form.nomi_address);
                    formData.append('nomi_contact', this.nomination_form.nomi_contact);
                    formData.append('nomi_email', this.nomination_form.nomi_email);
                    formData.append('nomi_relation', this.nomination_form.nomi_relation);
                    formData.append('status', this.nomination_form.status);
                    if(this.nomination_form.isnominee==0){
                        formData.append('nomi_percentage', 0);
                    }
                    else{
                        formData.append('nomi_percentage', this.nomination_form.nomi_percentage);
                    }
                    formData.append('isnominee', this.nomination_form.isnominee);
                    formData.append('action_type', this.nomination_form.action_type);
                    formData.append('status', this.nomination_form.status);
                    axios.post('staff/savenominationDetails', formData, config)
                    // this.nomination_form.post('staff/savenominationDetails')
                    .then((response) => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                        this.resetnomidees();
                        this.loadnomination(this.qualification_form.personal_id);
                        $('#nomination-modal').modal('hide');
                    })
                    .catch((error) => {
                        console.log("Error:"+error)
                    });
                }
            }
        },
        loadqualication(staff_id){
            if(staff_id!=null && staff_id!=""){
                let uri = 'staff/loadStaffQualification/'+staff_id;
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
            data.address='Permanent Address '+data.cid;
        },
        fetchDetails(){
            if(this.personal_form.emp_type=="2"){
                $('#contrct_type').show();
            }
            let cid_empid=$('#cideid').val();
            if (cid_empid!= ""){
                axios.get('staff/getEmployeeDetials/'+ this.personal_form.emp_type+'/'+cid_empid)
                .then(response => {
                    this.ciderror = '';
                    let detail = response.data;
                    if (detail!=""){
                        this.personal_form.cid_work_permit=detail.cidNumber;
                        this.personal_form.emp_id=detail.employeeNumber;
                        let fullname=detail.firstName;
                        if(detail.middleName!=""){
                            fullname=fullname+' '+detail.middleName;
                        }
                        if(detail.lastName!=""){
                            fullname=fullname+' '+detail.lastName;
                        }
                        this.personal_form.name= fullname;
                        let dob=detail.dateOfBirth;
                        if(dob.includes('-')){
                            dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                        }
                        if(dob.includes('/')){
                            dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                        }
                        this.personal_form.dob=dob;
                        this.personal_form.email=detail.Email;
                        this.personal_form.initial_appointment_date=detail.dateOfAppointment;

                        this.personal_form.contact_number=detail.MobileNo;
                        axios.get('getpersonbycid/'+ detail.cidNumber)
                        .then(response => {
                            this.ciderror = '';
                            let personal_detail = response.data;
                            this.personal_form.p_dzongkhag=personal_detail.dzongkhagId;
                            let gen='Others';
                            if(personal_detail.gender=='M'){
                                gen='Male';
                            }
                            if(personal_detail.gender=='F'){
                                gen='Female';
                            }
                            this.personal_form.sex_id=this.sex_Array[gen];
                            $('#sex_id').val(this.sex_Array[gen]).trigger('change');

                            $('#p_dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                            $('#p_dzongkhag').prop('disabled',true);
                            $('#dob').prop('disabled',true);
                            $('#sex_id').prop('disabled',true);
                            $('#cid_work_permit').prop('disabled',true);
                            $('#name').prop('disabled',true);
                            this.getPgewoglist(personal_detail.dzongkhagId,personal_detail.gewogId);
                            this.getPvillagelist(personal_detail.gewogId,personal_detail.villageSerialNo);
                        })
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
                        html: "No data found for this eid "+e,
                        icon: 'error'
                    });
                });
            }
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


        loadnomination(staff_id){
            if(staff_id!=null && staff_id!=""){
                let uri = 'staff/loadStaffNomination/'+staff_id;
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
                                console.log("Error:"+error)
                            });
                        }
                    });
                }
            }
            else{
                if(nextclass=="qualification-tab"){
                    this.personal_form.dob=this.formatYYYYMMDD($('#dob').val());
                    this.personal_form.initial_appointment_date=this.formatYYYYMMDD($('#initial_appointment_date').val());
                    if(this.personal_form.position_title.includes('_')){
                        this.personal_form.position_title=this.personal_form.position_title.split('_')[0];
                    }
                    this.personal_form.post('staff/savePersonalDetails')
                    .then((response) =>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                        $('.select2').select2();
                        $('.select2').select2({
                            theme: 'bootstrap4'
                        });
                        if(response.data.data || (response.data.data!=undefined && response.data.data.id!=undefined)){
                            if(response.data.data.id!=undefined && response.data.data.id!=null && response.data.data.id!=""){
                                this.qualification_form.personal_id=response.data.data.id;
                                this.nomination_form.personal_id=response.data.data.id;
                            }
                            this.change_tab(nextclass);
                            this.loadqualificationdescription();
                            this.getfieldListt();
                            this.loadInstitutte();
                            this.loadcoursemode();
                            this.loadqualication(this.personal_form.personal_id);
                        }
                    })
                    .catch((error) => {
                        if(!$('#working_agency_id').attr('class').includes('select2-hidden-accessible')){
                            $('#working_agency_id').addClass('select2-hidden-accessible');
                        }
                        if(!$('#marital_status').attr('class').includes('select2-hidden-accessible')){
                            $('#marital_status').addClass('select2-hidden-accessible');
                        }
                        if(!$('#sex_id').attr('class').includes('select2-hidden-accessible')){
                            $('#sex_id').addClass('select2-hidden-accessible');
                        }
                        if(!$('#position_title').attr('class').includes('select2-hidden-accessible')){
                            $('#position_title').addClass('select2-hidden-accessible');
                        }
                        if(!$('#currier_stage').attr('class').includes('select2-hidden-accessible')){
                            $('#currier_stage').addClass('select2-hidden-accessible');
                        }
                        if(this.personal_form.isteaching){
                            if(!$('#comp_sub').attr('class').includes('select2-hidden-accessible')){
                                $('#comp_sub').addClass('select2-hidden-accessible');
                            }
                            if(!$('#elective_sub1').attr('class').includes('select2-hidden-accessible')){
                                $('#elective_sub1').addClass('select2-hidden-accessible');
                            }
                            if(!$('#elective_sub2').attr('class').includes('select2-hidden-accessible')){
                                $('#elective_sub2').addClass('select2-hidden-accessible');
                            }
                        }
                        console.log("Error:"+error)
                    });
                }
                else if(nextclass=="personal-tab"){
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

        loadAcademicMasters(uri="masters/loadAcademicMasters/all_active_subject"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.subjectList =  data;
                for(let i=0;i<data.length;i++){
                    this.subjectArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        loadactivesex_idList(uri="masters/loadGlobalMasters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sex_idList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.sex_Array[data.data.data[i].name] = data.data.data[i].id;
                }
            })
            .catch(function (error) {
                console.leg(error);
            });
        },

        async loadpositionsubList(){
            this.positionsubList =  await this.loadstaffMasters('active','PositionSubLevel');
        },
        async loadcontractcategory(){
            this.categoryList =  await this.loadstaffMasters('active','ContractCategory');
        },
        async loadpositiontitleList(){
            this.positiontitleList =  await this.loadstaffMasters('all_active_position_title_with_level','PositionTitle');
        },
        async loadrelationshipList(){
            this.repationshipList =  await this.loadstaffMasters('active','Relationship');
        },
        async loadactivemaritalList(){
            this.marital_statusList =  await this.loadstaffMasters('active','MaritalStatus');
        },
        async loadactivecureerstageList(){
            this.cureerstageList =  await this.loadstaffMasters('active','CureerStage');
        },
        async loadactivedoneragencyList(){
            this.donerAgencyList =  await this.loadstaffMasters('active','DonerAgency');
        },
        async getprojectdoneragencylist(id){
            this.projectdonerAgencyList =  await this.loadstaffMasters('byparent__doner_agency_id__'+id,'ProjectDonerAgency');
        },
        async getfieldListt(){
            this.fieldList =  await this.loadstaffMasters('active','QualificationType');
        },
        async getdegreeList(){
            this.degreeList =  await this.loadstaffMasters('active','QualificationLevel');
        },
        async loadqualificationdescription(){
            this.qualificationDescription =  await this.loadstaffMasters('active','QualificationDescription');
        },
        async loadqualification(id){
            this.staffqualificationlist =  await this.loadstaffMasters('byparent__q_level_id__'+id,'Qualification');
        },
        async loadInstitutte(){
            this.instituteList =  await this.loadstaffMasters('active','Institute');
        },
        async loadcoursemode(){
            this.coursemodeList =  await this.loadstaffMasters('active','CourseMode');
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
        getPgewoglist(id,gewog_id){
            let dzoId=$('#p_dzongkhag').val();
            if(id!=""){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            this.gewog_list =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.p_gewog_list = data.data.data;
                if(gewog_id!=""){
                    this.personal_form.p_gewog=gewog_id;
                    $('#p_gewog').val(gewog_id).trigger('change');
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getgewoglist(id,gewogId){
            let dzoId=$('#dzongkhag').val();
            if(id!=""){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            this.gewog_list =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
                this.personal_form.gewog=gewogId;
                $('#gewog').val(gewogId).trigger('change');
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        getDepartmentList(type){
            let uri = 'loadCommons/loadHeaquarterList/all_ministry_departments/'+type.toLowerCase();
            this.gewog_list =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.departmentList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        allOrgList(type){
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+$('#dzongkhag').val();
            if(type=="division"){
                uri = 'loadCommons/loadHeaquarterList/all_division/'+$('#department').val();
            }
            this.orgList = [];
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.orgList = data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getPvillagelist(id,vilageid){
            let villageId=$('#p_gewog').val();
            if(id!=""){
                villageId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+villageId;
             this.villageList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.p_villageList = data.data.data;
                if(vilageid!=""){
                    this.personal_form.p_village_id=vilageid;
                    $('#p_village_id').val(vilageid).trigger('change');
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getvillagelist(id,vil_id){
            let gewogId=$('#gewog').val();
            if(id!=""){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
             this.villageList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
                this.personal_form.village_id=vil_id;
                $('#village_id').val(vil_id).trigger('change');
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
                this.personal_form.position_title=$('#position_title').val().split('_')[0];
                if($('#position_title').val().split('_')[1].toLowerCase().replaceAll(" ", "")=="teachingservices"){
                    this.personal_form.isteaching=true;
                    $('#isteaching').show();
                }
                else{
                    this.personal_form.isteaching=false;
                    $('#isteaching').hide();
                }
            }
            if(id=="position_sub_level"){
                this.personal_form.position_sub_level=$('#position_sub_level').val();
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
            if(id=="p_dzongkhag"){
                this.personal_form.p_dzongkhag=$('#p_dzongkhag').val();
                this.getPgewoglist('','');
            }
            if(id=="p_gewog"){
                this.personal_form.p_gewog=$('#p_gewog').val();
                this.getPvillagelist('','');
            }
             if(id=="p_village_id"){
                this.personal_form.p_village_id=$('#p_village_id').val();
            }
            if(id=="dzongkhag"){
                this.personal_form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist('','');
                this.allOrgList();
            }
            if(id=="organization_type"){
                this.personal_form.organization_type=$('#organization_type').val();
                if($('#organization_type').val()=="Ministry" || $('#organization_type').val()=="Dzongkhag"){
                    this.getDepartmentList($('#organization_type').val());
                    $('#departmentdiv').show();
                }
                else{
                    this.allOrgList('school');
                    $('#departmentdiv').hide();
                }
            }
            if(id=="department"){
                this.personal_form.department=$('#department').val();
                this.allOrgList('division');
            }
            if(id=="gewog"){
                this.personal_form.gewog=$('#gewog').val();
                this.getvillagelist('','');
            }

            if(id=="village_id"){
                this.personal_form.village_id=$('#village_id').val();
            }
            if(id=="working_agency_id"){
                this.personal_form.working_agency_id=$('#working_agency_id').val();
            }
            if(id=="comp_sub"){
                this.personal_form.comp_sub=$('#comp_sub').val().split('__'[0]);
                if($('#comp_sub').val().split('__')[1]==1){
                    this.personal_form.issen='Yes';
                }
                else{
                    this.personal_form.issen='No';
                }
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

            if(id=="doner_agency"){
                this.qualification_form.doner_agency=$('#doner_agency').val();
                this.getprojectdoneragencylist($('#doner_agency').val());
            }
            if(id=="project_doner_agency"){
                this.qualification_form.project_doner_agency=$('#project_doner_agency').val();
            }
            if(id=="field"){
                this.qualification_form.field=$('#field').val();
                this.getdegreeList($('#field').val());
            }
            if(id=="degree"){
                this.qualification_form.degree=$('#degree').val();
                this.loadqualification($('#degree').val());
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
            if(id=="institute"){
                this.qualification_form.institute=$('#institute').val();
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
                    let personal_detail = response.data;
                    if (personal_detail!=""){
                        this.nomination_form.nomi_name = personal_detail.firstName + " " + personal_detail.lastName;
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
        loadData(){
            axios.get('loadCommons/viewStaffDetails/by_id/'+this.$route.params.data.id)
            .then((response) => {
                let data=response.data.data;
                this.personal_form.personal_id=data.id;
                this.qualification_form.personal_id=data.id;
                this.nomination_form.personal_id=data.id;

                this.personal_form.dzongkhag=data.dzo_id;
                $('#dzongkhag').val(data.dzo_id).trigger('change');
                this.getgewoglist(data.dzo_id,data.geowg_id);
                this.getvillagelist(data.geowg_id,data.village_id);

                this.personal_form.emp_type=data.emp_type_id;
                this.personal_form.emp_id=data.emp_id;
                this.personal_form.cid_work_permit=data.cid_work_permit;
                this.personal_form.name=data.name;
                this.personal_form.dob=this.formatDateToddmmyyyy(data.dob);
                $('#dob').val(this.formatDateToddmmyyyy(data.dob));
                // $('#dob').prop('disabled',true);
                this.personal_form.sex_id=data.sex_id;
                $('#sex_id').val(data.sex_id).trigger('change');
                // $('#sex_id').prop('disabled',true);

                this.personal_form.position_title=data.position_title_id+'_'+data.subgroup;
                $('#position_title').val(data.position_title_id+'_'+data.subgroup).trigger('change');
                if($('#position_title').val()!=undefined && $('#position_title').val()!=null && $('#position_title').val().split('_')[1].toLowerCase().replaceAll(" ", "")=="teachingservices"){
                    this.personal_form.isteaching=true;
                    $('#isteaching').show();
                }
                this.personal_form.position_sub_level=data.position_sub_level_id;
                $('#position_sub_level').val(data.position_sub_level_id).trigger('change');

                this.personal_form.marital_status=data.merital_status;
                $('#marital_status').val(data.merital_status).trigger('change');

                this.personal_form.p_dzongkhag=data.p_dzongkhag;
                $('#p_dzongkhag').val(data.p_dzongkhag).trigger('change');

                this.getPgewoglist(data.p_dzongkhag,data.p_gewog);
                this.getPvillagelist(data.p_gewog,data.p_village);


                this.personal_form.country_id=data.country_id;
                this.personal_form.dzongkhag=data.dzo_id;
                $('#dzongkhag').val(data.dzo_id).trigger('change');
                this.getgewoglist(data.dzo_id,data.geowg_id);
                this.getvillagelist(data.geowg_id,data.village_id);
                 this.personal_form.organization_type=data.org_level;
                $('#organization_type').val(data.org_level).trigger('change');

                this.personal_form.working_agency_id=data.working_agency_id;
                this.personal_form.contact_number=data.contact_no;
                this.personal_form.email=data.email;
                this.personal_form.alternative_email=data.alternative_email;
                this.personal_form.comp_sub=data.comp_sub_id;
                $("#comp_sub option[value^='" + data.comp_sub_id + "']").prop("selected", "true").trigger('change');
                this.personal_form.elective_sub1=data.elective_sub_id1;
                $('#elective_sub1').val(data.elective_sub_id1).trigger('change');
                this.personal_form.elective_sub2=data.elective_sub_id2;
                $('#elective_sub2').val(data.elective_sub_id2).trigger('change');
                this.personal_form.currier_stage=data.cureer_stagge_id;
                if(data.is_sen==1){
                    this.personal_form.issen='Yes';
                };
                $('#currier_stage').val(data.cureer_stagge_id).trigger('change');
                this.personal_form.emp_file_code=data.employee_code;
                this.personal_form.remarks=data.remarks;
                this.personal_form.initial_appointment_date=this.formatDateToddmmyyyy(data.initial_appointment_date);
                $('#initial_appointment_date').val(this.formatDateToddmmyyyy(data.initial_appointment_date));
                if(data.emp_type_id==2){
                    $('#contrct_type').show();
                }
            })
            .catch((error) => {
                console.log("Error......"+error);
            });
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

        Fire.$on('changefunction',(id)=>{
            this.changefunction(id);
        });
        this.loadactivemaritalList();
        this.loadactivesex_idList();
        this.loadpositiontitleList();
        this.loadactivecountryList();
        this.loadactivedzongkhagList();
        this.loadcontractcategory();
        this.loadAcademicMasters();
        this.loadactivecureerstageList();
        this.loadrelationshipList();
        this.loadpositionsubList();

        this.loadactivedoneragencyList();
        //Loading details
        this.loadData();
    },
}
</script>
