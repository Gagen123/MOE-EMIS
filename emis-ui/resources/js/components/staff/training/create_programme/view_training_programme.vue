<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
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
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="programme-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Trainig Type:</label>
                                <select disabled v-model="form.training_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('training_type') }" class="form-control select2" name="training_type" id="training_type">
                                    <option value="">--Select--</option>
                                    <option v-for="(item, index) in trainingtypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="training_type"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
                                <label class="mb-0.5">Course Title:</label>
                                <input readonly type="text" class="form-control" @change="remove_err('course_title')" :class="{ 'is-invalid' :form.errors.has('course_title') }" v-model="form.course_title" id="course_title"/>
                                <has-error :form="form" field="course_title"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Organized By (Department/Division):</label>
                                <select disabled v-model="form.organizer" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('organizer') }" class="form-control select2" name="organizer" id="organizer">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in organizerList" :key="index" v-bind:value="item.id"> {{ item.agencyName }}</option>
                                </select>
                                <has-error :form="form" field="organizer"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Related Programme:</label>
                                <select disabled v-model="form.related_programme" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('related_programme') }" class="form-control select2" name="related_programme" id="related_programme">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in relatedProgrammeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="related_programme"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Start Date:</label>
                                <input readonly type="date" class="form-control" @change="remove_err('start_date')" :class="{ 'is-invalid' :form.errors.has('start_date') }" v-model="form.start_date" id="start_date"/>
                                <has-error :form="form" field="start_date"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">End Date:</label>
                                <input readonly type="date" class="form-control" @change="remove_err('end_date')" :class="{ 'is-invalid' :form.errors.has('end_date') }" v-model="form.end_date" id="end_date"/>
                                <has-error :form="form" field="end_date"></has-error>
                            </div>
                        </div>

                        <span id="professional_development_section" style="display:none">
                            <hr/>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Programme Level:</label>
                                    <select disabled v-model="form.programme_level" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('programme_level') }" class="form-control select2" name="programme_level" id="programme_level">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in programmeLevelList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="programme_level"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Programme Type:</label>
                                    <select disabled v-model="form.programme_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('programme_type') }" class="form-control select2" name="programme_type" id="programme_type">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in programmeTypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="programme_type"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Course Type:</label>
                                    <select disabled v-model="form.course_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('course_type') }" class="form-control select2" name="course_type" id="course_type">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in courseTypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="course_type"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Course Provider:</label>
                                    <input readonly type="text" class="form-control" @change="remove_err('course_provider')" :class="{ 'is-invalid' :form.errors.has('course_provider') }" v-model="form.course_provider" id="course_provider"/>
                                    <has-error :form="form" field="course_provider"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Institute/Vanue:</label>
                                    <input readonly type="text" class="form-control" @change="remove_err('vanue')" :class="{ 'is-invalid' :form.errors.has('vanue') }" v-model="form.vanue" id="vanue"/>
                                    <has-error :form="form" field="vanue"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Financial Source:</label>
                                    <select disabled v-model="form.financial_source" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('financial_source') }" class="form-control select2" name="financial_source" id="financial_source">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in financialSourceList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="financial_source"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Total Budget:</label>
                                    <input readonly type="text" class="form-control" @change="remove_err('total_budget')" :class="{ 'is-invalid' :form.errors.has('total_budget') }" v-model="form.total_budget" id="total_budget"/>
                                    <has-error :form="form" field="total_budget"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Total Hours:</label>
                                    <input readonly type="number" class="form-control" @change="remove_err('total_hrs')" :class="{ 'is-invalid' :form.errors.has('total_hrs') }" v-model="form.total_hrs" id="total_hrs"/>
                                    <has-error :form="form" field="total_hrs"></has-error>
                                </div>
                            </div>
                        </span>
                        <span id="qualification_upgradation_section" style="display:none">
                            <hr/>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Category:</label>
                                    <select disabled v-model="form.category" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('category') }" class="form-control select2" name="category" id="category">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in categoryList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="category"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Donor Agency:</label>
                                    <select disabled v-model="form.donor_agency" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('donor_agency') }" class="form-control select2" name="donor_agency" id="donor_agency">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in donor_agencyList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="donor_agency"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Project of Donor Angency:</label>
                                    <select disabled v-model="form.projectofdonor" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('projectofdonor') }" class="form-control select2" name="projectofdonor" id="projectofdonor">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in projectofdonorList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="projectofdonor"></has-error>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Country of Study:</label>
                                    <select disabled v-model="form.study_country" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('study_country') }" class="form-control select2" name="study_country" id="study_country">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in study_countryList" :key="index" v-bind:value="item.id"> {{ item.country_name }}</option>
                                    </select>
                                    <has-error :form="form" field="study_country"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Course Mode/Area/Type:</label>
                                    <select disabled v-model="form.coursemode" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('coursemode') }" class="form-control select2" name="coursemode" id="coursemode">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in coursemodeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="coursemode"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Degree:</label>
                                    <select disabled v-model="form.degree" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('degree') }" class="form-control select2" name="degree" id="degree">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in degreeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="degree"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Subject 1:</label>
                                    <select disabled v-model="form.subject1" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('subject1') }" class="form-control select2" name="subject1" id="subject1">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="subject1"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Subject 2:</label>
                                    <select disabled v-model="form.subject2" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('subject2') }" class="form-control select2" name="subject2" id="subject2">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="subject2"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Thesis Title:</label>
                                    <input readonly type="text" class="form-control" @change="remove_err('thesis_title')" :class="{ 'is-invalid' :form.errors.has('thesis_title') }" v-model="form.thesis_title" id="thesis_title"/>
                                    <has-error :form="form" field="thesis_title"></has-error>
                                </div>
                            </div>
                        </span>
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
                                        <tr v-for='(attach,count) in draft_attachments' :key="count+1" :id="'attachview'+count">
                                            <td>
                                                <input type="text" class="form-control" readonly :value="attach.user_defined_name">
                                            </td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('eligibility-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="eligibility-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Nomination Start Date:</label>
                                <input readonly type="date" class="form-control" @change="remove_err('nomination_start_date')" :class="{ 'is-invalid' :form.errors.has('nomination_start_date') }" v-model="form.nomination_start_date" id="nomination_start_date"/>
                                <has-error :form="form" field="nomination_start_date"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Nomination End Date:</label>
                                <input readonly type="date" class="form-control" @change="remove_err('nomination_end_date')" :class="{ 'is-invalid' :form.errors.has('nomination_end_date') }" v-model="form.nomination_end_date" id="nomination_end_date"/>
                                <has-error :form="form" field="nomination_end_date"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Nature of participation:</label><br/>
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
                                <span v-for="(tar, index) in target_groupList" :key="index" >
                                    <input type="checkbox" v-model="form.target_group" :class="{ 'is-invalid' :form.errors.has('target_group') }" name="target_group" id="target_group" :value="tar.id">
                                    <label class="pr-3"> {{ tar.name  }}</label>
                                </span>
                                 <select v-model="form.target_group" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('target_group') }" class="form-control select2" name="target_group" id="target_group">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in target_groupList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="target_group"></has-error>
                            </div> -->
                            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Eligibility School Leve:l</label>
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
                                        <tr id="addmoreroles">
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
                                <textarea readonly v-model="form.remarks" :class="{ 'is-invalid' :form.errors.has('remarks') }" class="form-control" name="remarks" id="remarks"></textarea>
                                <has-error :form="form" field="remarks"></has-error>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('programme-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            count:1,
            action_param_type:'',
            dis_status:true,
            filecount:1,
            organizerList:[],
            trainingtypeList:[],
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


        loadHrDevelopmentMasters(type){
            let url="masters/loadHrDevelopmentMastersData/"+type;
            axios.get(url)
            .then(response => {
                let data = response.data.data;
                if(type=="active_training_type_list"){
                    this.trainingtypeList=data;
                }
                if(type=="active_related_programme_list"){
                    this.relatedProgrammeList=data;
                }
                if(type=="active_programme_level_list"){
                    this.programmeLevelList=data;
                }
                if(type=="active_programme_type_list"){
                    this.programmeTypeList=data;
                }
                if(type=="active_course_type_list"){
                    this.courseTypeList=data;
                }
                if(type=="active_financial_source_list"){
                    this.financialSourceList=data;
                }
                if(type=="active_category_list"){
                    this.categoryList=data;
                }
                if(type=="active_donor_list"){
                    this.donor_agencyList=data;
                }
                if(type=="active_degree_list"){
                    this.degreeList=data;
                }
                if(type=="active_nature_of_participant_list"){
                    this.nature_of_participantList=data;
                }
                if(type=="active_target_group_list"){
                    this.target_groupList=data;
                }
                //this.loadHrDevelopmentMasters('active_target_group_list');

            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
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
            this.change_tab(nextclass);
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
                this.loadDetails();
            }
        },
        async pullQualificationData(){
            this.loadHrDevelopmentMasters('active_category_list');
            this.loadHrDevelopmentMasters('active_donor_list');
            this.loadstudy_countryList();
            this.loadcoursemode();
            this.loadHrDevelopmentMasters('active_degree_list');
            this.loadsubjectList();
        },
        pullPDPData(){
            this.loadHrDevelopmentMasters('active_programme_level_list');
            this.loadHrDevelopmentMasters('active_programme_type_list');
            this.loadHrDevelopmentMasters('active_course_type_list');
            this.loadHrDevelopmentMasters('active_financial_source_list');
        },
        displayfields(type_id){
            $('#qualification_upgradation_section').hide();
            $('#professional_development_section').hide();
            if($('#'+type_id+' option:selected').text()=='--Select--'){
                this.pullPDPData();
                this.pullQualificationData();
                setTimeout(function(){
                    if($('#'+type_id+' option:selected').text().toLowerCase().includes('qualification upgrad')){
                        $('#qualification_upgradation_section').show();
                    }
                    if($('#'+type_id+' option:selected').text().toLowerCase().includes('professional development')){
                        $('#professional_development_section').show();
                    }
                    this.form.training_type_text=$('#'+type_id+' option:selected').text();
                }, 3000);
            }
            else{
                this.form.training_type_text=$('#'+type_id+' option:selected').text().toLowerCase();
                if($('#'+type_id+' option:selected').text().toLowerCase().includes('qualification upgrad')){
                    this.pullQualificationData();
                    $('#qualification_upgradation_section').show();
                }
                if($('#'+type_id+' option:selected').text().toLowerCase().includes('professional development')){
                    this.pullPDPData();
                    $('#professional_development_section').show();
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
            if(id=="subject1"){
                this.form.subject1=$('#subject1').val();
            }
            if(id=="subject2"){
                this.form.subject2=$('#subject2').val();
            }
        },
        loadDetails(id,type){
            this.action_param_type=type;
            axios.get('staff/hrdevelopment/loadDetails/'+id)
            .then((response) => {
                let data=response.data.data;
                this.form.id=data.id;
                this.form.training_type=data.training_type;
                $('#training_type').val(data.training_type).trigger('change');
                this.displayfields('training_type');
                this.form.course_title=data.course_title;
                this.form.organizer=data.organizer;
                $('#organizer').val(data.organizer).trigger('change');
                this.form.related_programme=data.related_programme;
                $('#related_programme').val(data.related_programme).trigger('change');
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

                this.form.nomination_start_date=data.nomination_start_date;
                this.form.nomination_end_date=data.nomination_end_date;
                this.form.remarks=data.remarks;
                for(let i=0;i<this.nature_of_participantList.length;i++){
                    if(data.nature_of_participant.includes(this.nature_of_participantList[i].id)){
                        $("input[value='" + this.nature_of_participantList[i].id + "']").prop('checked', true);
                        this.form.nature_of_participant.push(this.nature_of_participantList[i].id);
                    }
                }
                for(let i=0;i<this.target_groupList.length;i++){
                    if(data.target_group.includes(this.target_groupList[i].id)){
                        $("input[value='" + this.target_groupList[i].id + "']").prop('checked', true);
                        this.form.target_group.push(this.target_groupList[i].id);
                    }
                }
                for(let i=0;i<this.org_levelList.length;i++){
                    if(data.org_level.includes(this.org_levelList[i].id)){
                        $("input[value='" + this.this.org_levelList[i].id + "']").prop('checked', true);
                        this.form.org_level.push(this.org_levelList[i].id);
                    }
                }
                this.form.role_action_mapp=[];
                for(let i=0;i<data.workflow.length;i++){
                    this.form.role_action_mapp.push({sequence:data.workflow[i].sequence,authority:data.workflow[i].authority_type,role:data.workflow[i].sys_role_id})
                }

                if(type=="view"){
                    $('#training_type').prop('disabled',true);
                    $('#course_title').prop('disabled',true);
                    $('#organizer').prop('disabled',true);
                    $('#related_programme').prop('disabled',true);
                    $('#start_date').prop('disabled',true);
                    $('#end_date').prop('disabled',true);

                    $('#programme_level').prop('disabled',true);
                    $('#programme_type').prop('disabled',true);
                    $('#course_type').prop('disabled',true);
                    $('#course_provider').prop('disabled',true);
                    $('#vanue').prop('disabled',true);
                    $('#total_budget').prop('disabled',true);
                    $('#total_hrs').prop('disabled',true);
                    $('#financial_source').prop('disabled',true);

                    $('#category').prop('disabled',true);
                    $('#donor_agency').prop('disabled',true);
                    $('#projectofdonor').prop('disabled',true);
                    $('#study_country').prop('disabled',true);
                    $('#coursemode').prop('disabled',true);
                    $('#degree').prop('disabled',true);
                    $('#subject1').prop('disabled',true);
                    $('#subject2').prop('disabled',true);
                    $('#thesis_title').prop('disabled',true);
                    $('.addmoredoc').hide();
                    this.dis_status=false;
                    $('#nomination_start_date').prop('disabled',true);
                    $('#nomination_end_date').prop('disabled',true);
                    $('#remarks').prop('disabled',true);
                    $('#addmoreroles').hide();
                    $('#finalsubbtn').hide();
                    // for(let i=0;i<this.nature_of_participantList.length;i++){
                    //     if(data.nature_of_participant.includes(this.nature_of_participantList[i].id)){
                    //         $("input[name=nature_of_participant]").prop("disabled", true);
                    //     }
                    // }
                }
            })
            .catch((error) => {
                console.log("Error......"+error);
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
    },

    mounted() {
        this.count=1,
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        this.loadorganizerList();
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.loadHrDevelopmentMasters('active_training_type_list');
        this.loadHrDevelopmentMasters('active_related_programme_list');

        this.loadHrDevelopmentMasters('active_nature_of_participant_list');
        this.loadHrDevelopmentMasters('active_target_group_list');
        this.loadroleList();
        this.loadDetails(this.$route.params.data,this.$route.params.type);
    },
}
</script>
