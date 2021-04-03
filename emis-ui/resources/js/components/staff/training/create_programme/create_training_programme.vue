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
                                <label class="mb-0.5">Trainig Type:<i class="text-danger">*</i></label>
                                <select v-model="form.training_type" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('training_type') }" class="form-control select2" name="training_type" id="training_type">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in trainingtypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="training_type"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Course Title:<i class="text-danger">*</i></label>
                                <input type="text" class="form-control" @change="remove_err('course_title')" :class="{ 'is-invalid' :form.errors.has('course_title') }" v-model="form.course_title" id="course_title"/>
                                <has-error :form="form" field="course_title"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Organized By (Department/Division):<i class="text-danger">*</i></label>
                                <select v-model="form.organizer" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('organizer') }" class="form-control select2" name="organizer" id="organizer">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in trainingtypeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="organizer"></has-error>
                            </div>
                        </div>
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
                                <input type="date" class="form-control" @change="remove_err('start_date')" :class="{ 'is-invalid' :form.errors.has('start_date') }" v-model="form.start_date" id="start_date"/>
                                <has-error :form="form" field="start_date"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">End Date:<i class="text-danger">*</i></label>
                                <input type="date" class="form-control" @change="remove_err('end_date')" :class="{ 'is-invalid' :form.errors.has('end_date') }" v-model="form.end_date" id="end_date"/>
                                <has-error :form="form" field="end_date"></has-error>
                            </div>
                        </div>
                        
                        <span id="professional_development_section" style="display:none">
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
                                    <input type="text" class="form-control" @change="remove_err('course_provider')" :class="{ 'is-invalid' :form.errors.has('course_provider') }" v-model="form.course_provider" id="course_provider"/>
                                    <has-error :form="form" field="course_provider"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Institute/Vanue:<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" @change="remove_err('vanue')" :class="{ 'is-invalid' :form.errors.has('vanue') }" v-model="form.vanue" id="vanue"/>
                                    <has-error :form="form" field="vanue"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Financial Source:<i class="text-danger">*</i></label>
                                    <select v-model="form.financial_source" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('financial_source') }" class="form-control select2" name="financial_source" id="financial_source">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in financialSourceList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="financial_source"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Total Budget:</label>
                                    <input type="text" class="form-control" @change="remove_err('total_budget')" :class="{ 'is-invalid' :form.errors.has('total_budget') }" v-model="form.total_budget" id="total_budget"/>
                                    <has-error :form="form" field="total_budget"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Total Hours:<i class="text-danger">*</i></label>
                                    <input type="number" class="form-control" @change="remove_err('total_hrs')" :class="{ 'is-invalid' :form.errors.has('total_hrs') }" v-model="form.total_hrs" id="total_hrs"/>
                                    <has-error :form="form" field="total_hrs"></has-error>
                                </div>
                            </div>
                        </span>
                        <span id="qualification_upgradation_section">
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
                                    <label class="mb-0.5">Project of Donor Angency</label>
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
                                    <label class="mb-0.5">Course Mode/Area/Type:</label>
                                    <select v-model="form.coursemode" :class="{ 'is-invalid select2 select2-hidden-accessible' :form.errors.has('coursemode') }" class="form-control select2" name="coursemode" id="coursemode">
                                        <option value=""> --Select--</option>
                                        <option v-for="(item, index) in coursemodeList" :key="index" v-bind:value="item.id"> {{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="coursemode"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Degree</label>
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
                                    <label class="mb-0.5">Thesis Title<i class="text-danger">*</i></label>
                                    <input type="text" class="form-control" @change="remove_err('thesis_title')" :class="{ 'is-invalid' :form.errors.has('thesis_title') }" v-model="form.thesis_title" id="thesis_title"/>
                                    <has-error :form="form" field="thesis_title"></has-error>
                                </div>
                            </div>
                        </span>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('eligibility-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="eligibility-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Attachments</label>
                                <table id="participant-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th> 
                                            <th>File</th> 
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <tr id="record1" v-for='(file, index) in form.attachments' :key="index">
                                            <td>
                                                <input type="text" class="form-control" @change="remove_err('attachment_name'+(index+1))" v-model="file.attachment_name" :id="'attachment_name'+(index+1)"/>
                                                <span class="text-danger" :id="'attachment_name'+(index+1)"></span>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" @change="remove_err('attach_file'+(index+1))" :id="'attach_file'+(index+1)"/>
                                                <span class="text-danger" :id="'attach_file'+(index+1)"></span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5"><u>Undertaking</u></label><br />
                                <label>I hereby declare that the information given herein is true to the best of my knowledge and I also certify that:</label>
                            </div>
                        </div>
                        <span v-for="(item, key, index) in  undertakingList" :key="index">
                            <div class="form-group row">
                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                    <input type="checkbox" v-model="form.undertaking" class="icheck-success d-inline" :id="{index}" :class="{ 'is-invalid': form.errors.has('undertaking') }" :value="item.id">
                                </div> 
                                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                    <label class="pr-4"> &nbsp;{{ item.name }}</label><br />
                                </div> 
                            </div> 
                        </span>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('service-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>submit </button>
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
            form: new form({
                id: '',
                training_type: '',
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
                total_budget:'',
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
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadactivetraingitypelist(uri = 'masters/loadHrDevelopmentMastersData/active_training_type_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.trainingtypeList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        loadrelatedProgrammeList(uri = 'masters/loadHrDevelopmentMastersData/active_related_programme_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.relatedProgrammeList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        loadprogrammeLevelList(uri = 'masters/loadHrDevelopmentMastersData/active_programme_level_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programmeLevelList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        loadprogrammeTypeList(uri = 'masters/loadHrDevelopmentMastersData/active_programme_type_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programmeTypeList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        loadcourseTypeList(uri = 'masters/loadHrDevelopmentMastersData/active_course_type_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.courseTypeList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        
        loadfinancialSourceList(uri = 'masters/loadHrDevelopmentMastersData/active_financial_source_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.financialSourceList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        
        loadcategoryList(uri = 'masters/loadHrDevelopmentMastersData/active_category_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.categoryList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error);
            });
        },
        loaddonor_agencyList(uri = 'masters/loadHrDevelopmentMastersData/active_donor_list'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.donor_agencyList =  data.data.data;
            })
            .catch(function (error){
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
        loadstudy_countryList(uri = 'masters/load_global_masters/all_active_country'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.study_countryList =  data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error);
            });
        },
        loadcoursemode(){
            let uri = 'masters/load_staff_masters/all_active_coursemode_list';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.coursemodeList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loaddegreeList(uri = 'masters/loadHrDevelopmentMastersData/active_degree_list'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.degreeList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadsubjectList(uri = 'masters/load_staff_masters/all_active_subject_List'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.subjectList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        
        shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to send this detials for approval ?",
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
                        this.$router.push('/list_transfer');
                    }
                });
            }
            else{
                this.change_tab(nextclass);
            }
        },
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="position_title"){
                this.form.training_type=$('#training_type').val();
            }
            if(id=="related_programme"){
                this.form.related_programme=$('#related_programme').val();
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
        this.loadactivetraingitypelist();
        this.loadrelatedProgrammeList();
        this.loadprogrammeLevelList();
        this.loadprogrammeTypeList();
        this.loadcourseTypeList();
        this.loadfinancialSourceList();

        this.loadcategoryList();
        this.loaddonor_agencyList();
        this.loadstudy_countryList();
        this.loadcoursemode();
        this.loaddegreeList();
        this.loadsubjectList();
    },
}
</script>