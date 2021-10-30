<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="noaccesssection">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <!-- <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item programme-tab" @click="shownexttab('programme-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Programme Details </label>
                        </a>
                    </li>
                    <li class="nav-item eligibility-tab" @click="shownexttab('eligibility-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Eligibility & Nomination </label>
                        </a>
                    </li>
                </ul>
            </div> -->
            <div class="card-body pt-0 mt-1">
                <!-- <form id="training_form" class="form-horizontal" enctype="multipart/form-data" action="#" method="post"> -->
                    <div class="tab-content">
                        <div class="tab-pane fade active show tab-content-details" id="programme-tab" role="tabpanel" aria-labelledby="basicdetails">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Training Type:<i class="text-danger">*</i></label>
                                    <select v-model="form.training_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('training_type') }" class="form-control select2" name="training_type" id="training_type">
                                        <option value="">--Select--</option>
                                        <option v-for="(item, index) in trainingtypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="training_type"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Course Title:<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" @change="remove_error('course_title')" :class="{ 'is-invalid' :form.errors.has('course_title') }" v-model="form.course_title" id="course_title"/>
                                    <has-error :form="form" field="course_title"></has-error>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Organizer:<i class="text-danger">*</i></label>
                                    <select v-model="form.organizer" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('organizer') }" class="form-control select2" name="organizer" id="organizer">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in organizerList" :key="index" v-bind:value="item.id"> {{ item.agencyName }}</option>
                                    </select>
                                    <has-error :form="form" field="organizer"></has-error>
                                </div> -->
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Programme Organizer:</label>
                                </div>
                            </div>
                            <search />
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Related Programme:</label>
                                    <select v-model="form.related_programme" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('related_programme') }" class="form-control select2" name="related_programme" id="related_programme">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in relatedProgrammeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="related_programme"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Start Date:<i class="text-danger">*</i></label>
                                    <input type="text" autocomplete="off" class="form-control popupDatepicker" @change="remove_error('start_date')" :class="{ 'is-invalid' :form.errors.has('start_date') }" id="start_date"/>
                                    <has-error :form="form" field="start_date"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">End Date:<i class="text-danger">*</i></label>
                                    <input type="text" autocomplete="off" class="form-control popupDatepicker" @change="remove_error('end_date')" :class="{ 'is-invalid' :form.errors.has('end_date') }" id="end_date"/>
                                    <has-error :form="form" field="end_date"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Financial Source:<i class="text-danger">*</i></label>
                                    <select v-model="form.financial_source" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('financial_source') }" class="form-control select2" name="financial_source" id="financial_source">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in financialSourceList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="financial_source"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Total Estimated Budget:</label>
                                    <input type="text" class="form-control" @change="remove_error('total_budget')" :class="{ 'is-invalid' :form.errors.has('total_budget') }" v-model="form.total_budget" id="total_budget"/>
                                    <has-error :form="form" field="total_budget"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Total Expenditure:</label>
                                    <input type="text" class="form-control" @change="remove_error('expenditurel_budget')" :class="{ 'is-invalid' :form.errors.has('expenditurel_budget') }" v-model="form.expenditurel_budget" id="expenditurel_budget"/>
                                    <has-error :form="form" field="expenditurel_budget"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Institute/Venue:<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" @change="remove_error('vanue')" :class="{ 'is-invalid' :form.errors.has('vanue') }" v-model="form.vanue" id="vanue"/>
                                    <has-error :form="form" field="vanue"></has-error>
                                </div>
                            </div>

                            <span id="professional_development_section">
                                <hr/>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Programme Level:<i class="text-danger">*</i></label>
                                        <select v-model="form.programme_level" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('programme_level') }" class="form-control select2" name="programme_level" id="programme_level">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in programmeLevelList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="programme_level"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Programme Type:<i class="text-danger">*</i></label>
                                        <select v-model="form.programme_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('programme_type') }" class="form-control select2" name="programme_type" id="programme_type">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in programmeTypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="programme_type"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Course Type:<i class="text-danger">*</i></label>
                                        <select v-model="form.course_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('course_type') }" class="form-control select2" name="course_type" id="course_type">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in courseTypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="course_type"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Course Provider:<i class="text-danger">*</i></label>
                                        <input type="text" class="form-control" @change="remove_error('course_provider')" :class="{ 'is-invalid' :form.errors.has('course_provider') }" v-model="form.course_provider" id="course_provider"/>
                                        <has-error :form="form" field="course_provider"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Total Hours:<span id="hrsmandatory"></span></label>
                                        <input type="number" class="form-control" @change="remove_error('total_hrs')" :class="{ 'is-invalid' :form.errors.has('total_hrs') }" v-model="form.total_hrs" id="total_hrs"/>
                                        <has-error :form="form" field="total_hrs"></has-error>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="mb-0.5">Nature of participation:<i class="text-danger">*</i></label><br/>
                                        <span v-for="(nature, index) in nature_of_participantList" :key="index" >
                                            <input type="checkbox"  @change="remove_error('nature_of_participant'+index)" v-model="form.nature_of_participant" :class="{ 'is-invalid' :form.errors.has('nature_of_participant') }" name="nature_of_participant" :id="'nature_of_participant'+index" :value="nature.id">
                                            <label class="pr-3"> {{ nature.name  }}</label>
                                            <has-error v-if="index==nature_of_participantList.length-1"  :form="form" field="nature_of_participant"></has-error>
                                        </span>
                                    </div>
                                </div>
                            </span>

                            <!-- for the qualification upgradation -->
                            <span id="qualification_upgradation_section" style="display:none">
                                <hr/>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Category:<i class="text-danger">*</i></label>
                                        <select v-model="form.category" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('category') }" class="form-control select2" name="category" id="category">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in categoryList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="category"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Donor Agency:</label>
                                        <select v-model="form.donor_agency" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('donor_agency') }" class="form-control select2" name="donor_agency" id="donor_agency">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in donor_agencyList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="donor_agency"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Project of Donor Angency:</label>
                                        <select v-model="form.projectofdonor" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('projectofdonor') }" class="form-control select2" name="projectofdonor" id="projectofdonor">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in projectofdonorList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="projectofdonor"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Country of Study:<i class="text-danger">*</i></label>
                                        <select v-model="form.study_country" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('study_country') }" class="form-control select2" name="study_country" id="study_country">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in study_countryList" :key="index" v-bind:value="item.id"> {{ item.country_name }}</option>
                                        </select>
                                        <has-error :form="form" field="study_country"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Course Mode/Area/Type:<i class="text-danger">*</i></label>
                                        <select v-model="form.coursemode" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('coursemode') }" class="form-control select2" name="coursemode" id="coursemode">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in coursemodeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="coursemode"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Degree:<i class="text-danger">*</i></label>
                                        <select v-model="form.degree" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('degree') }" class="form-control select2" name="degree" id="degree">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in degreeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="degree"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Subject 1:<i class="text-danger">*</i></label>
                                        <select v-model="form.subject1" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('subject1') }" class="form-control select2" name="subject1" id="subject1">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="subject1"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Subject 2:</label>
                                        <select v-model="form.subject2" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('subject2') }" class="form-control select2" name="subject2" id="subject2">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="subject2"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Thesis Title:<i class="text-danger">*</i></label>
                                        <input type="text" class="form-control" @change="remove_error('thesis_title')" :class="{ 'is-invalid' :form.errors.has('thesis_title') }" v-model="form.thesis_title" id="thesis_title"/>
                                        <has-error :form="form" field="thesis_title"></has-error>
                                    </div>
                                </div>
                            </span>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0">Upload the Required Documents ({{validfile()}})</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Attachment Name</th>
                                                <th>File(Image,Doc,Excel,Pdf)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='(attach,count) in draft_attachments' :key="count+1">
                                                <td>
                                                    <input type="text" class="form-control" readonly :value="attach.user_defined_name">
                                                </td>
                                                <td>
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="#" @click="deletefile(attach)" class="fa fa-times text-danger"> Delete </a>
                                                </td>
                                            </tr>
                                            <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                                <td>
                                                    <input type="text" class="form-control" @change="remove_error('file_name'+(index+1))" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                    <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control" @change="remove_error('attach'+(index+1))" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                                    <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                    @click="addMoreattachments()"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore"
                                                    @click="removeattachments()"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Remarks:</label>
                                    <textarea v-model="form.remarks" :class="{ 'is-invalid' :form.errors.has('remarks') }" class="form-control" name="remarks" id="remarks"></textarea>
                                    <has-error :form="form" field="remarks"></has-error>
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" @click="shownexttab('eligibility-tab')"> <i class="fa fa-save"></i>Save & Apply </button>
                                    <!-- <button class="btn btn-primary" @click="shownexttab('eligibility-tab')">Save & Next <i class="fa fa-arrow-right"></i></button> -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade tab-content-details" id="eligibility-tab" role="tabpanel" aria-labelledby="basicdetails">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Nomination Start Date:<i class="text-danger">*</i></label>
                                    <input type="date" class="form-control" @change="remove_error('nomination_start_date')" :class="{ 'is-invalid' :form.errors.has('nomination_start_date') }" v-model="form.nomination_start_date" id="nomination_start_date"/>
                                    <has-error :form="form" field="nomination_start_date"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Nomination End Date:<i class="text-danger">*</i></label>
                                    <input type="date" class="form-control" @change="remove_error('nomination_end_date')" :class="{ 'is-invalid' :form.errors.has('nomination_end_date') }" v-model="form.nomination_end_date" id="nomination_end_date"/>
                                    <has-error :form="form" field="nomination_end_date"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Nature of participation:<i class="text-danger">*</i></label><br/>
                                    <span v-for="(nature, index) in nature_of_participantList" :key="index" >
                                        <input type="checkbox" v-model="form.nature_of_participant" :class="{ 'is-invalid' :form.errors.has('nature_of_participant') }" name="nature_of_participant" id="nature_of_participant" :value="nature.id">
                                        <label class="pr-3"> {{ nature.name  }}</label>
                                    </span>
                                    <!-- <select v-model="form.nature_of_participant" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('nature_of_participant') }" class="form-control select2" name="nature_of_participant" id="nature_of_participant">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in nature_of_participantList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select> -->
                                    <has-error :form="form" field="nature_of_participant"></has-error>
                                </div>
                                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Target Group:</label><br/>
                                    commented the dynamic part as it had got conditional
                                    <span v-for="(tar, index) in target_groupList" :key="index" >
                                        <input type="checkbox" v-model="form.target_group" :class="{ 'is-invalid' :form.errors.has('target_group') }" name="target_group" id="target_group" :value="tar.id">
                                        <label class="pr-3"> {{ tar.name  }}</label>
                                    </span>
                                    <has-error :form="form" field="target_group"></has-error>
                                </div> -->
                                <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Eligibility School Leve:l<i class="text-danger">*</i></label>
                                    <span v-for="(level, index) in org_levelList" :key="index" >
                                        <input type="checkbox" v-model="form.org_level" :class="{ 'is-invalid' :form.errors.has('org_level') }" name="org_level" id="org_level" :value="level.id">
                                        <label class="pr-3"> {{ level.name  }}</label>
                                    </span>
                                    <has-error :form="form" field="org_level"></has-error>
                                </div> -->
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <table id="dynamic-table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sequence</th>
                                                <th>Authority Type</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="record1" v-for='(user, index) in form.role_action_mapp' :key="index">
                                                <td>
                                                    <input type="hidden" v-model="user.sequence">
                                                    {{user.sequence}}
                                                </td>
                                                <td>
                                                    <select class="form-control" v-model="user.authority">
                                                        <option value="1">Nomination</option>
                                                        <option value="2">Shortlisting</option>
                                                        <option value="3">Final Selection</option>
                                                    </select>
                                                    <span class="text-danger" :id="'authority_err'+(index+1)"></span>
                                                </td>
                                                <td>
                                                    <select :id="'role'+(index+1)" class="form-control" v-model="user.role">
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                                                    </select>
                                                    <span class="text-danger" :id="'role_err'+(index+1)"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                    @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore"
                                                    @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Remarks:</label>
                                    <textarea v-model="form.remarks" :class="{ 'is-invalid' :form.errors.has('remarks') }" class="form-control" name="remarks" id="remarks"></textarea>
                                    <has-error :form="form" field="remarks"></has-error>
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-success" @click="shownexttab('programme-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                    <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Save & Apply </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</template>
<script>
import search from "../../searchpage.vue";
export default {
    components: {
        search,
    },
    data(){
        return {
            count:1,
            filecount:1,
            trainingtypeList:[],
            organizerList:[],
            relatedProgrammeList:[],
            programmeLevelList:[],
            programmeTypeList :[],
            courseTypeList:[],
            financialSourceList:[],
            categoryList:[],
            donor_agencyList:[],
            projectofdonorList:[],
            study_countryList:[],
            coursemodeList:[],
            degreeList:[],
            subjectList:[],
            nature_of_participantList:[],
            target_groupList:[],
            org_levelList:[],
            roleList:[],
            draft_attachments:[],
            form: new form({
                id: '',
                training_type: '',
                training_type_text:'',
                course_title:'',
                organizer:'',
                related_programme:'',
                start_date:'',
                end_date:'',

                programme_level:'',
                programme_type:'',
                course_type:'',
                course_provider:'',
                vanue:'',
                total_budget:0,
                expenditurel_budget:0,
                total_hrs:'',
                financial_source:'',

                category:'',
                donor_agency:'',
                projectofdonor:'',
                study_country:'',
                coursemode:'',
                degree:'',
                subject1:'',
                subject2:'',
                thesis_title:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                status:'Pending',
                ref_docs:[],

                nomination_start_date:'',
                nomination_end_date:'',
                nature_of_participant:[],
                target_group:[],
                org_level:[],
                role_action_mapp:
                [{
                    sequence:1,authority:'',role:''
                }],
                remarks:'',
            })
        }
    },
    methods: {
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
            // file_path=file_path.replaceAll('/', 'SSS');
            // let uri = 'common/viewFiles/'+file_path;
            // axios.get(uri)
            // .then(response => {
            //     let data = response;
            // })
            // .catch(function (error) {
            //     console.log("Error:"+error);
            // });
        },
        deletefile(file){
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
                            this.loadDetails();
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
        addMore: function(){
            this.count++;
            this.form.role_action_mapp.push({sequence:this.count,authority:'',role:''})
        },
        addMoreattachments: function(){
            this.filecount++;
            this.form.attachments.push({file_name:'',attachment:''})
        },
        remove(index){
            if(this.form.role_action_mapp.length>1){
                this.count--;
                this.form.role_action_mapp.pop();
            }
        },
        removeattachments(index){
            if(this.form.attachments.length>1){
                this.filecount--;
                this.form.attachments.pop();
                this.form.ref_docs.pop();
            }
        },

        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#file_name'+currentcount).val()!=""){
                this.form.ref_docs.push({file_name:$('#file_name'+currentcount).val(),attachment:e.target.files[0]});
                $('#file_name'+currentcount).prop('readonly',true);
            }
            else{
                $('#file_name'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },

        loadprojectofdonorList(uri = 'masters/loadHrDevelopmentDepedentMastersData/projectdonor/'+$('#donor_agency').val()){
            this.projectofdonorList = [];
            axios.get(uri)
            .then(response => {
                let data = response;
                this.projectofdonorList =  data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error);
            });
        },
        loadstudy_countryList(uri = 'masters/loadGlobalMasters/all_active_country'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.study_countryList =  data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error);
            });
        },
        loadcoursemode(uri = 'masters/loadStaffMasters/all_active_coursemode_list'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.coursemodeList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        loadsubjectList(uri = 'masters/loadStaffMasters/all_active_subject_List'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.subjectList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        loadorganizerList(uri = 'organization/getsAgencyList/allSSS'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.organizerList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        loadroleList(uri = 'common/getRoles/active'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.roleList = data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to save and publish ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('/staff/hrdevelopment/saveprogramFinalDetails')
                        .then((response) => {
                            if(response!=null && response!=""){
                                Swal.fire(
                                    'Success!',
                                    'Details has been saved successfully.',
                                    'success',
                                )
                                this.$router.push('/list_programme');
                            }
                        })
                        .catch((error) => {
                            console.log("Error:"+error)
                        });
                    }
                });
            }
            else if(nextclass=="eligibility-tab" && this.validateFileform()){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

                let formData = new FormData();
                formData.append('id', this.form.id);
                formData.append('ref_docs[]', this.form.ref_docs);
                for(let i=0;i<this.form.ref_docs.length;i++){
                    formData.append('attachments[]', this.form.ref_docs[i].attachment);
                    // formData.append('attachmentname[]', this.form.ref_docs[i].attachment.name+', '+this.form.ref_docs[i].file_name);
                    formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
                }
                formData.append('training_type', this.form.training_type);
                formData.append('training_type_text', $('#training_type option:selected').text());
                formData.append('course_title', this.form.course_title);
                formData.append('organizer', $('#org_id').val());
                formData.append('related_programme', this.form.related_programme);
                formData.append('start_date', this.formatYYYYMMDD($('#start_date').val()));
                formData.append('end_date', this.formatYYYYMMDD($('#end_date').val()));

                // if($('#training_type option:selected').text().toLowerCase().includes('qualification upgrad')){
                //     formData.append('category', this.form.category);
                //     formData.append('donor_agency', this.form.donor_agency);
                //     formData.append('projectofdonor', this.form.projectofdonor);
                //     formData.append('study_country', this.form.study_country);
                //     formData.append('coursemode', this.form.coursemode);
                //     formData.append('degree', this.form.degree);
                //     formData.append('subject1', this.form.subject1);
                //     formData.append('subject2', this.form.subject2);
                //     formData.append('thesis_title', this.form.thesis_title);
                // }
                //if($('#training_type option:selected').text().toLowerCase().includes('professional development')){
                    formData.append('programme_level', this.form.programme_level);
                    formData.append('programme_type', this.form.programme_type);
                    formData.append('course_type', this.form.course_type);
                    formData.append('course_provider', this.form.course_provider);
                    formData.append('vanue', this.form.vanue);
                    formData.append('total_budget', this.form.total_budget);
                    formData.append('expenditurel_budget', this.form.expenditurel_budget);
                    formData.append('total_hrs', this.form.total_hrs);
                    formData.append('financial_source', this.form.financial_source);
                //}
                formData.append('status', this.form.status);

                // formData.append('nomination_start_date', this.form.nomination_start_date);
                // formData.append('nomination_end_date', this.form.nomination_end_date);
                formData.append('nature_of_participant', this.form.nature_of_participant);
                // formData.append('target_group', this.form.target_group);
                // formData.append('org_level', this.form.org_level);
                formData.append('remarks', this.form.remarks);

                // this.form.post('/staff/saveprogramDetails', formData, config)
                Swal.fire({
                    text: "Are you sure you wish to save and publish training ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    cancelButtonText:'No',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('/staff/hrdevelopment/saveprogramDetails', formData, config)
                        .then((response) => {
                            // this.form.id=response.data.data.id;//need to check the id
                            // Toast.fire({
                            //     icon: 'success',
                            //     title: 'Data Saved Successfully'
                            // });
                            // $('.select2').select2();
                            // $('.select2').select2({
                            //     theme: 'bootstrap4'
                            // });
                            if(response!=null && response!=""){
                                Swal.fire(
                                    'Success!',
                                    'Details has been saved successfully.',
                                    'success',
                                )
                                this.$router.push('/list_programme');
                            }
                        })
                        .catch((error) => {
                            // this.change_tab('programme-tab');
                            console.log("Errorss:"+error.response.data.error);
                            this.form.errors.errors = error.response.data;
                            this.applyselect2();
                        });
                        // this.change_tab(nextclass);
                    }
                });
            }
        },
        validateFileform(){
            let returnvariable=true;
            if(this.filecount>1){
                for(let i=0;i<this.filecount;i++){
                    if($('#file_name'+(i+1)).val()==""){
                        $('#file_name'+(i+1)+'_err').html('Please mention file name');
                        returnvariable=false;
                    }
                    if($('#attach'+(i+1)).val()==""){
                        $('#attach'+(i+1)+'_err').html('Please mention file');
                        returnvariable=false;
                    }
                    if($('#attach'+(i+1)).val()!=undefined && $('#attach'+(i+1)).val()!="" && !this.isvalidfile($('#attach'+(i+1)).val())){
                        $('#attach'+(i+1)+'_err').html('This file is not accepted. The accepted files are: ' +this.validfile());
                        returnvariable=false;
                    }
                }
            }
            return returnvariable;

        },
        applyselect2(){
            this.applyselect2field('training_type');
            this.applyselect2field('organizer');
            this.applyselect2field('financial_source');
            this.applyselect2field('programme_level');
            this.applyselect2field('programme_type');
            this.applyselect2field('course_type');

            // this.applyselect2field('coursemode');
            // this.applyselect2field('study_country');
            // this.applyselect2field('projectofdonor');
            // this.applyselect2field('donor_agency');
            // this.applyselect2field('category');
        },
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
            if(nextclass=="programme-tab"){
                this.loaddraftDetails();
            }
        },

        displayfields(type_id){
            // $('#qualification_upgradation_section').hide();
            // $('#professional_development_section').hide();
            if($('#'+type_id+' option:selected').text()=='--Select--'){
               $('#hrsmandatory').html('');
                // setTimeout(function(){
                //     if($('#'+type_id+' option:selected').text().toLowerCase().includes('qualification upgrad')){
                //         $('#qualification_upgradation_section').show();
                //     }
                //     if($('#'+type_id+' option:selected').text().toLowerCase().includes('professional development')){
                //         $('#professional_development_section').show();
                //     }
                //     this.form.training_type_text=$('#'+type_id+' option:selected').text();
                // }, 3000);
            }
            else{
                this.form.training_type_text=$('#'+type_id+' option:selected').text();
                // this.form.training_type_text=$('#'+type_id+' option:selected').text().toLowerCase();
                // if($('#'+type_id+' option:selected').text().toLowerCase().includes('qualification upgrad')){
                //     this.pullQualificationData();
                //     $('#qualification_upgradation_section').show();
                // }
                if($('#'+type_id+' option:selected').text().toLowerCase().includes('professional development')){
                    // $('#professional_development_section').show();
                    $('#hrsmandatory').html('<i class="text-danger">*</i>');
                }
                else{
                    $('#hrsmandatory').html('');
                }
            }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="training_type"){
                this.form.training_type=$('#training_type').val();
                this.displayfields(id);
            }
            if(id=="related_programme"){
                this.form.related_programme=$('#related_programme').val();
            }
            if(id=="organizer"){
                this.form.organizer=$('#organizer').val();
            }
            if(id=="programme_level"){
                this.form.programme_level=$('#programme_level').val();
            }
            if(id=="programme_type"){
                this.form.programme_type=$('#programme_type').val();
            }
            if(id=="course_type"){
                this.form.course_type=$('#course_type').val();
            }
            if(id=="financial_source"){
                this.form.financial_source=$('#financial_source').val();
            }
            if(id=="category"){
                this.form.category=$('#category').val();
            }
            if(id=="donor_agency"){
                this.form.donor_agency=$('#donor_agency').val();
                this.loadprojectofdonorList();
            }
            if(id=="projectofdonor"){
                this.form.projectofdonor=$('#projectofdonor').val();
            }
            if(id=="study_country"){
                this.form.study_country=$('#study_country').val();
            }
            if(id=="coursemode"){
                this.form.coursemode=$('#coursemode').val();
            }
            if(id=="degree"){
                this.form.degree=$('#degree').val();
            }
            // if(id=="subject1"){
            //     this.form.subject1=$('#subject1').val();
            // }
            // if(id=="subject2"){
            //     this.form.subject2=$('#subject2').val();
            // }
        },
        loaddraftDetails(){
             axios.get('staff/hrdevelopment/loadDraftDetails')
            .then((response) => {
                let data=response.data.data;
                if(data!=null){
                    this.form.id=data.id;
                    this.form.training_type=data.training_type;
                    // this.displayfields('training_type');
                    this.form.course_title=data.course_title;
                    this.form.organizer=data.organizer;
                    this.form.related_programme=data.related_programme;
                    this.form.start_date=data.start_date;
                    this.form.end_date=data.end_date;

                    this.form.programme_level=data.programme_level;
                    this.form.programme_type=data.programme_type;
                    this.form.course_type=data.course_type;
                    this.form.course_provider=data.course_provider;
                    this.form.vanue=data.vanue;
                    this.form.total_budget=data.total_budget;
                    this.form.total_hrs=data.total_hrs;
                    this.form.financial_source=data.financial_source;

                    this.form.category=data.category;
                    this.form.donor_agency=data.donor_agency;
                    this.form.projectofdonor=data.projectofdonor;
                    this.form.study_country=data.study_country;
                    this.form.coursemode=data.coursemode;
                    this.form.degree=data.degree;
                    this.form.subject1=data.subject1;
                    this.form.subject2=data.subject2;
                    this.form.thesis_title=data.thesis_title;
                    this.draft_attachments=JSON.parse(response.data.documents).data;
                    this.form.attachments=[];
                    this.form.ref_docs=[];
                    // if(doc.data.length>0){
                    //     this.form.attachments=[];
                    //     for(let i=0;i<doc.data.length;i++){
                    //         this.form.attachments.push({file_name:doc.data[i].user_defined_name,attachment:doc.data[i].path})
                    //     }
                    // }

                    // attachments:
                    // [{
                    //     file_name:'',attachment:''
                    // }],
                    // status:'Pending',

                    // nomination_start_date:'',
                    // nomination_end_date:'',
                    // nature_of_participant:'',
                    // target_group:'',
                    // org_level:'',
                }
            })
            .catch((error) => {
                console.log("Error......"+error);
            });
        },  
        async loadmasters(){
            this.trainingtypeList =  await this.loadstaffMasters('active','hr_development_masters___TrainingType');
            this.relatedProgrammeList =  await this.loadstaffMasters('all','hr_development_masters___RelatedProgramme');
            this.nature_of_participantList =  await this.loadstaffMasters('all','hr_development_masters___NatureOfParticipant');
            // this.target_groupList =  await this.loadstaffMasters('all','hr_development_masters___TargetGroup');
            this.financialSourceList =  await this.loadstaffMasters('all','hr_development_masters___FinancialSource');
            // this.categoryList =  await this.loadstaffMasters('all','hr_development_masters___Category');
            // this.donor_agencyList =  await this.loadstaffMasters('all','hr_development_masters___Donor');
            // this.degreeList =  await this.loadstaffMasters('all','hr_development_masters___Degree');
            this.programmeLevelList =  await this.loadstaffMasters('all','hr_development_masters___ProgrammeLevel');
            this.programmeTypeList =  await this.loadstaffMasters('all','hr_development_masters___ProgrammeType');
            this.courseTypeList =  await this.loadstaffMasters('all','hr_development_masters___CourseType');
            this.coursemodeList =  await this.loadstaffMasters('all','CourseMode');
            this.loadorganizerList();
            this.loadstudy_countryList();
            // this.loadcoursemode();
            // this.loadsubjectList();
            // this.loadroleList();
        }
    },

    async mounted() {
        let valid=false;
        this.count=1,
        this.loaddraftDetails();
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
        axios.get('staff/hrdevelopment/checkProgramAccess')
        .then((response) => {
            valid=response.data.data;
            if(valid){
                this.loadmasters();
            }else{
                $('#noaccesssection').show();
                $('#mainform').hide();
                $('#message').html('There is no configuration for you to access this page. Plese contact responsible person to open this page for you. Thank you!');
            }
        })
        .catch((error) => {
            console.log("Error......"+error);
        });
    },
}
</script>
