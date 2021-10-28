<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-tab" @click="shownexttab('personal-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-1">Appointment</label>
                        </a>
                    </li>
                    <li class="nav-item qualification-tab" @click="shownexttab('qualification-tab')">
                        <a class="nav-link " data-toggle="pill" role="tab">
                            <label class="mb-1">Qualification</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <!-- <div class="callout callout-success">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Nationality:<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.country_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('country_id') }" class="form-control select2" name="country_id" id="country_id">
                                        <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.nationality }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="country_id"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">CID/Work Permit No:<i class="text-danger">*</i></label>
                                    <input type="text" @keyup.enter="getDetailsbyCID('cid_work_permit')" @blur="getDetailsbyCID('cid_work_permit')" v-model="personal_form.cid_work_permit" @change="remove_error('cid_work_permit')" :class="{ 'is-invalid': personal_form.errors.has('cid_work_permit') }"  class="form-control" name="cid_work_permit" id="cid_work_permit">
                                    <has-error :form="personal_form" field="cid_work_permit"></has-error>
                                </div>
                            </div>
                        </div> -->
                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Personal Detail</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Full Name:<i class="text-danger">*</i></label>
                                    <input type="text" @change="remove_error('name')" v-model="personal_form.name" :class="{ 'is-invalid': personal_form.errors.has('name') }" class="form-control" name="name" id="name">
                                    <has-error :form="personal_form" field="name"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Date of Birth:<i class="text-danger">*</i></label>
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

                            <div class="form-group row" id="bhutanese_address">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Dzongkhag:</label>
                                    <select v-model="personal_form.p_dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('p_dzongkhag') }" class="form-control select2" name="p_dzongkhag" id="p_dzongkhag">
                                        <option v-for="(item, index) in p_dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="dzongkhag"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Gewog:</label>
                                    <select v-model="personal_form.p_gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('p_gewog') }" class="form-control select2" name="p_gewog" id="p_gewog">
                                        <option v-for="(item, index) in p_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="gewog"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Village:</label>
                                    <select v-model="personal_form.p_village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('village_id') }" class="form-control select2" name="p_village_id" id="p_village_id">
                                        <option v-for="(item, index) in p_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="village_id"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Position Title:<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.position_title" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('position_title') }" class="form-control select2" name="position_title" id="position_title">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in positiontitleList" :key="index" v-bind:value="item.id">{{ item.positionTitle }} ({{ item.positionlevel }})</option>
                                    </select>
                                    <has-error :form="personal_form" field="position_title"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Career Stage:<i class="text-danger">*</i></label><br>
                                    <select @change="remove_error('currier_stage')" v-model="personal_form.currier_stage" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('currier_stage') }" class="form-control select2" name="currier_stage" id="currier_stage">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in cureerstageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="currier_stage"></has-error>
                                </div>
                            </div>
                            <div class="form-group row" id="foreign_address" style="display:none">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Address:</label>
                                    <textarea @change="remove_error('address')" class="form-control" v-model="personal_form.address" :class="{ 'is-invalid': personal_form.errors.has('address') }" name="address" id="address"></textarea>
                                    <has-error :form="personal_form" field="address"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Contacts</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-1">Contact No:<i class="text-danger">*</i></label>
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
                                    <label class="mb-0.5">Working Agency:<i class="text-danger">*</i></label>
                                    <select v-model="personal_form.working_agency_id" @change="remove_error('working_agency_id')" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('working_agency_id') }" class="form-control select2" name="working_agency_id" id="working_agency_id">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="working_agency_id"></has-error>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Competent Subject:<i class="text-danger">*</i></label>
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
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Initail Appointment Date:<i class="text-danger">*</i></label>
                                <input @change="remove_error('initial_appointment_date')" autocomplete="off" class="form-control popupDatepicker" :class="{ 'is-invalid': personal_form.errors.has('initial_appointment_date') }" name="initial_appointment_date" id="initial_appointment_date" type="text">
                                <has-error :form="personal_form" field="initial_appointment_date"></has-error>
                            </div>
                        </div>

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
                    <div class="tab-pane fade tab-content-details" id="qualification-tab" role="tabpanel">
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
                                                        <label class="mb-0.5">Category:<i class="text-danger">*</i></label>
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
                                                        <label class="mb-0.5">Type:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.field" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('field') }" class="form-control select2" id="field">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in fieldList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="field"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">level:<i class="text-danger">*</i></label>
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
                                                        <label class="mb-0.5">Course Mode:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.coursemode" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('coursemode') }" class="form-control select2" id="coursemode">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in coursemodeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="coursemode"></has-error>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Course Title:<i class="text-danger">*</i></label>
                                                        <input v-model="qualification_form.coursetitle" :class="{ 'is-invalid': qualification_form.errors.has('coursetitle') }" type="text" id="coursetitle" class="form-control" @change="remove_error('coursetitle')">
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
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label class="mb-0.5">Status:<i class="text-danger">*</i></label>
                                                        <select v-model="qualification_form.qua_status" :class="{ 'is-invalid select2 select2-hidden-accessible': qualification_form.errors.has('qua_status') }" class="form-control select2" id="qua_status">
                                                            <option value="">--Select--</option>
                                                            <option v-for="(item, index) in qua_statusList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                                        </select>
                                                        <has-error :form="qualification_form" field="qua_status"></has-error>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <label class="mb-0.5">Remarks:</label>
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
        return {
            sex_idList:[],
            positiontitleList:[],
            countryList:[],
            p_dzongkhagList:[],
            p_gewog_list:[],
            p_villageList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            orgList:[],
            subjectList:[],
            subjectArray:{},
            cureerstageList:[],
            marital_statusList:[],
            qualificationlist:[],
            qualificationDescription:[],
            staffqualificationlist:[],
            staff_qualification_list:[],
            coursemodeList:[],
            donerAgencyList:[],
            projectdonerAgencyList:[],
            fieldList:[],
            degreeList:[],
            instituteList:[],
            qua_statusList:[],

            personal_form: new form({
                personal_id: '',
                emp_type: 'Private',
                cid_work_permit:'',
                name:'',
                position_title:'',
                sex_id:'',
                dob:'',
                marital_status:'',
                country_id:'',
                p_dzongkhag:'',
                p_village_id:'',
                p_gewog:'',
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
                initial_appointment_date:'',
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
        }
    },
    methods: {
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
                console.log("Error loadactivecountryList:"+error)
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadactivePdzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.p_dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error loadactivePdzongkhagList:"+error)
            });
        },
        async getgewoglist(id,gewogId){
            let dzoId=$('#dzongkhag').val();
            this.gewog_list = [];
            if(id!=""){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
                $('#gewog').val(gewogId).trigger('change');
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async getPgewoglist(id,gewogId){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            this.p_gewog_list = [];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.p_gewog_list = data.data.data;
                $('#p_gewog').val(gewogId).trigger('change');
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        allOrgList(dzo_id,id){
            let uri = 'loadCommons/loadOrgList/private/'+dzo_id;
            this.orgList = [];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.orgList = data.data.data;
                if(id!=""){
                    this.personal_form.working_agency_id=id;
                    $('#working_agency_id').val(id).trigger('change');
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async getvillagelist(id,village_id){
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
                $('#village_id').val(village_id).trigger('change');
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        async getPvillagelist(id,village_id){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            this.p_villageList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.p_villageList = data.data.data;
                $('#p_village_id').val(village_id).trigger('change');
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        addMore: function(type){
            if(type=="qualification"){
                this.qualification_form.startdate=this.formatYYYYMMDD($('#startdate').val());
                this.qualification_form.enddate=this.formatYYYYMMDD($('#enddate').val());
                this.qualification_form.post('staff/savequalificationDetails')
                .then((response) => {
                    if(response!=""){
                        Toast.fire({
                            icon: 'success',
                            title: 'Data saved Successfully'
                        });
                        this.loadqualication(this.qualification_form.personal_id);
                        $('#qualification-modal').modal('hide');
                    }
                })
                .catch((error) => {
                    console.log("Error:"+error)
                });
            }
        },
        loadactivesex_idList(uri="masters/loadGlobalMasters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sex_idList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error loadactivesex_idList:"+error)
            });
        },
        async loadactivecureerstageList(){
            this.cureerstageList =  await this.loadstaffMasters('active','CureerStage');
        },
        async loadcoursemode(){
            this.coursemodeList =  await this.loadstaffMasters('active','CourseMode');
        },
        // async loadInstitutte(){
        //     this.instituteList =  await this.loadstaffMasters('active','Institute');
        // },
        async loadqualification(id){
            this.staffqualificationlist =  await this.loadstaffMasters('byparent__q_level_id__'+id,'Qualification');
        },
        async loadqualificationdescription(){
            this.qualificationDescription =  await this.loadstaffMasters('active','QualificationDescription');
        },
        async loadactivemaritalList(){
            this.marital_statusList =  await this.loadstaffMasters('active','MaritalStatus');
        },
        async loadpositiontitleList(){
            this.positiontitleList =  await this.loadstaffMasters('all_active_position_title_with_level','PositionTitle');
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
        async getQualicationStatusList(){
            this.qua_statusList =  await this.loadstaffMasters('active','QualificationStatus');
        },
        loadactivesubjectList(uri="masters/loadAcademicMasters/all_active_main_subject"){
        // loadactivesubjectList(uri="masters/loadAcademicMasters/all_active_teacher_subject"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.subjectList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.subjectArray[data.data.data[i].id] = data.data.data[i].name;
                }

            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        async loadInstitute(country_id){
            this.instituteList=[];
            this.instituteList =  await this.loadstaffMasters('byparent__country_id__'+country_id,'Institute');
        },

        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                if(this.staff_qualification_list.length<1){
                    Swal.fire(
                        'error!',
                        'Please provide qualification details.',
                        'error',
                    );
                }
                else{
                    Swal.fire({
                        text: "Are you sure you wish to save this staff details ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.qualification_form.post('staff/updatefinalPrivatestaffDetails')
                            .then((response) => {
                                Swal.fire(
                                    'Success!',
                                    'Details has been saved successfully.',
                                    'success',
                                )
                                this.$router.push('/list_private_staff');
                            })
                            .catch((error) => {
                                console.log("Error shownexttab:"+error)
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
                        }

                        this.getfieldListt();
                        this.loadInstitutte();
                        this.loadcoursemode();
                        this.loadactivedoneragencyList();
                        this.getQualicationStatusList();
                        this.loadqualificationdescription();
                        this.loadqualification();
                        this.change_tab(nextclass);
                        this.loadqualication(this.personal_form.personal_id);
                    })
                    .catch((error) => {
                        if(!$('#working_agency_id').attr('class').includes('select2-hidden-accessible')){
                            $('#working_agency_id').addClass('select2-hidden-accessible');
                        }
                        if(!$('#comp_sub').attr('class').includes('select2-hidden-accessible')){
                            $('#comp_sub').addClass('select2-hidden-accessible');
                        }
                        this.change_tab('personal-tab');
                        console.log("Error: "+error)
                    });
                }
                else if(nextclass=="personal-tab"){
                    this.loadpersonalDetails();
                    this.change_tab(nextclass);
                }
                else{
                    this.change_tab(nextclass);
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
        loadpersonalDetails(){
            axios.get('loadCommons/viewStaffDetails/by_id/'+this.$route.params.data.id)
            .then((response) => {
                let data=response.data.data;
                if(data!=null){
                    this.personal_form.p_dzongkhag=data.p_dzongkhag;
                    this.getPgewoglist(data.p_dzongkhag,data.p_gewog);
                    this.personal_form.p_gewog=data.p_gewog;
                    this.getPvillagelist(data.p_gewog,data.p_villag);
                    this.personal_form.p_village_id=data.p_village;
                    this.personal_form.dob=this.formatDateToddmmyyyy(data.dob);
                    $('#dob').val(this.formatDateToddmmyyyy(data.dob));

                    this.personal_form.dzongkhag=data.dzo_id;
                    $('#p_dzongkhag').val(data.dzo_id).trigger('change');
                    this.allOrgList(data.dzo_id,data.working_agency_id);
                    this.getgewoglist(data.dzo_id,data.geowg_id);
                    this.personal_form.gewog=data.geowg_id;
                    this.getvillagelist(data.geowg_id,data.village_id);
                    this.personal_form.village_id=data.village_id;
                    this.personal_form.initial_appointment_date=data.initial_appointment_date;
                    $('#initial_appointment_date').val(this.reverseDate1(data.initial_appointment_date));

                    this.personal_form.personal_id=data.id;
                    this.qualification_form.personal_id=data.id;
                    this.personal_form.emp_type=data.emp_type_id;
                    this.personal_form.cid_work_permit=data.cid_work_permit;
                    this.personal_form.name=data.name;
                    this.personal_form.position_title=data.position_title_id;
                    $('#position_title').val(data.position_title_id).trigger('change');
                    this.personal_form.dob=data.dob;
                    this.personal_form.currier_stage=data.cureer_stagge_id;
                    $('#currier_stage').val(data.currier_stage).trigger('change');

                    this.personal_form.sex_id=data.sex_id;
                    $('#sex_id').val(data.sex_id).trigger('change');
                    this.personal_form.country_id=data.country_id;
                    $('#country_id').val(data.country_id).trigger('change');

                    this.personal_form.contact_number=data.contact_no;
                    this.personal_form.email=data.email;
                    this.personal_form.alternative_email=data.alternative_email;
                    this.personal_form.comp_sub=data.comp_sub_id;
                    $('#comp_sub').val(data.comp_sub_id).trigger('change');
                    this.personal_form.elective_sub1=data.elective_sub_id1;
                    $('#elective_sub1').val(data.elective_sub_id1).trigger('change');
                    this.personal_form.elective_sub2=data.elective_sub_id2;
                    $('#elective_sub2').val(data.elective_sub_id2).trigger('change');
                    this.personal_form.currier_stage=data.cureer_stagge_id;
                    $('#currier_stage').val(data.cureer_stagge_id).trigger('change');
                    this.personal_form.remarks=data.remarks;
                }

            })
            .catch((error) => {
                console.log("Error......"+error);
            });
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
            $('#'+type).modal('show');
        },
        showedit(item){
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

        async changefunction(id){
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
                    $('#name').prop('disabled',false);
                    this.personal_form.name='';
                    $('#cid_work_permit').prop('disabled',false);
                    this.personal_form.cid_work_permit='';
                    $('#dob').prop('disabled',false);
                    this.personal_form.dob='';
                    $('#sex_id').prop('disabled',false);
                    this.personal_form.sex_id='';
                    $('#bhutanese_address').hide();
                    $('#foreign_address').show();
                }
                this.personal_form.country_id=$('#'+id).val();
            }
            if(id=="p_dzongkhag"){
                this.personal_form.p_dzongkhag=$('#p_dzongkhag').val();
                this.getPgewoglist($('#p_dzongkhag').val(),'');
            }
            if(id=="p_gewog"){
                this.personal_form.p_gewog=$('#p_gewog').val();
                this.getPvillagelist($('#p_gewog').val(),'');
            }
            if(id=="p_village_id"){
                this.personal_form.p_village_id=$('#p_village_id').val();
            }
            if(id=="dzongkhag"){
                this.personal_form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist($('#dzongkhag').val(),'');
                this.allOrgList($('#dzongkhag').val(),'');

            }
            if(id=="gewog"){
                this.personal_form.gewog=$('#gewog').val();
                this.getvillagelist($('#gewog').val(),'');
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
                this.loadInstitute($('#country').val());
            }
            if(id=="description"){
                this.qualification_form.description=$('#description').val();
            }
            if(id=="qua_status"){
                this.qualification_form.qua_status=$('#qua_status').val();
            }

        },
        getDetailsbyCID(fieldId){
            axios.get('staff/checkThisCid/'+ $('#'+fieldId).val())
            .then(response => {
                let data=response.data.data;
                if(data!=null && data.name!="" && data.status=="Created"){
                    Swal.fire({
                        html: "This person is already registered. You cannot add the same person for multipe times",
                        icon: 'error'
                    });
                    this.personal_form.name = " ";
                    this.personal_form.dob = " ";
                    $('#dob').val("");
                    personal_detail.gender="";
                    this.personal_form.dzongkhag ="";
                    $('#dzongkhag').val("").trigger('change');
                    this.personal_form.gewog = "";
                    this.personal_form.village_id = "";
                }
                else if(data!=null &&  data.name!="" && data.status=="Pending"){
                    Swal.fire({
                        html: "This person has already initaited the Application process. You may check with other responsible person to complete his/her registration",
                        icon: 'error'
                    });
                    this.personal_form.name = " ";
                    this.personal_form.dob = " ";
                    $('#dob').val("");
                    personal_detail.gender="";
                    this.personal_form.dzongkhag ="";
                    $('#dzongkhag').val("").trigger('change');
                    this.personal_form.gewog = "";
                    this.personal_form.village_id = "";
                }
                else{
                    if($('#country_id option:selected').text().includes('Bhutan')){
                        if ($('#'+fieldId).val().length != 11){
                            Swal.fire({
                                html: "Please ender 11 digit CID",
                                icon: 'error'
                            });
                        }
                        else{
                            axios.get('getpersonbycid/'+ $('#'+fieldId).val())
                            .then(response => {
                                if(response.data!=""){
                                    let personal_detail = response.data;
                                    this.personal_form.name = personal_detail.firstName + " " + personal_detail.lastName;
                                    let dob=personal_detail.dob;
                                    if(dob.includes('-')){
                                        dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                                    }
                                    if(dob.includes('/')){
                                        dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                                    }
                                    this.personal_form.dob = dob;
                                    $('#dob').val(dob);
                                    if(personal_detail.gender=="M"){
                                        personal_detail.gender="male";
                                    }
                                    else if(personal_detail.gender=="F"){
                                        personal_detail.gender="female";
                                    }
                                    else{
                                        personal_detail.gender="others";
                                    }
                                    for(let i=0; i<this.sex_idList.length;i++){
                                        if(this.sex_idList[i].name.toLowerCase()==personal_detail.gender){
                                            $('#sex_id').val(this.sex_idList[i].id).trigger('change');
                                            this.personal_form.sex_id =  this.sex_idList[i].id;
                                        }
                                    }
                                    this.personal_form.p_dzongkhag =personal_detail.dzongkhagId;
                                    $('#dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                                    this.getPgewoglist(personal_detail.dzongkhagId,personal_detail.gewogId);
                                    this.personal_form.p_gewog = personal_detail.gewogId;
                                    this.getPvillagelist(personal_detail.gewogId,personal_detail.villageSerialNo);
                                    $('#village_id').val(personal_detail.villageSerialNo).trigger('change');
                                    this.personal_form.p_village_id = personal_detail.villageSerialNo;
                                    $('#name').prop('disabled',true);
                                    $('#cid_work_permit').prop('disabled',true);
                                    $('#dob').prop('disabled',true);
                                    $('#sex_id').prop('disabled',true);
                                    $('#dzongkhag').prop('disabled',true);
                                    $('#gewog').prop('disabled',true);
                                    $('#village_id').prop('disabled',true);
                                }else{
                                    Swal.fire({
                                        html: "No data found for this CID",
                                        icon: 'error'
                                    });
                                }
                            })
                            .catch((exception) => {
                                Swal.fire({
                                    html: "No data found for matching CID/service down"+exception,
                                    icon: 'error'
                                });
                            });
                        }
                    }
                }
            })
            .catch((exception) => {
                console.log('exception: '+exception );
            });

        },

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
        this.loadactivecountryList();
        this.loadactivePdzongkhagList();
        this.loadactivedzongkhagList();
        this.loadactivesex_idList();
        this.loadactivemaritalList();
        this.loadpositiontitleList();
        this.loadactivecureerstageList();
        this.loadactivesubjectList();
        this.loadpersonalDetails();

    },

}
</script>
