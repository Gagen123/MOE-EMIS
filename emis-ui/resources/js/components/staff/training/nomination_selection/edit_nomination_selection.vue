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
                        <div class="callout callout-success">
                            <div class="form-group row"> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Trainig Type:</label><br>
                                    <span class="text-blue text-bold">{{ trainingtypeList[form.training_type]}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Course Title:</label><br>
                                    <span class="text-blue text-bold">{{form.course_title}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Organized By (Department/Division):</label><br>
                                    <span class="text-blue text-bold">{{trainingtypeList[form.organizer]}}</span>
                                </div> 
                            </div>
                            <div class="form-group row"> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Related Programme:</label><br>
                                    <span class="text-blue text-bold">{{ relatedProgrammeList[form.related_programme]}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Start Date:</label><br>
                                    <span class="text-blue text-bold">{{form.start_date}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">End Date:</label><br>
                                    <span class="text-blue text-bold">{{form.end_date}}</span>
                                </div> 
                            </div>
                        </div>
                        <span id="professional_development_section" style="display:none">
                            <div class="callout callout-success">
                                <div class="form-group row"> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Programme Level:</label><br>
                                        <span class="text-blue text-bold">{{ programmeLevelList[form.programme_level]}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Programme Type:</label><br>
                                        <span class="text-blue text-bold">{{programmeTypeList[form.programme_type]}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Course Type:</label><br>
                                        <span class="text-blue text-bold">{{courseTypeList[form.course_type]}}</span>
                                    </div> 
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Course Provider:</label><br>
                                        <span class="text-blue text-bold">{{ form.course_provider}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Institute/Vanue:</label><br>
                                        <span class="text-blue text-bold">{{form.vanue}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Financial Source:</label><br>
                                        <span class="text-blue text-bold">{{financialSourceList[form.financial_source]}}</span>
                                    </div> 
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Total Budget:</label><br>
                                        <span class="text-blue text-bold">{{ form.total_budget}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Total Hours:</label><br>
                                        <span class="text-blue text-bold">{{form.total_hrs}}</span>
                                    </div> 
                                </div>
                            </div>
                        </span>
                        <span id="qualification_upgradation_section" style="display:none">
                            <div class="callout callout-success">
                                <div class="form-group row"> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Category:</label><br>
                                        <span class="text-blue text-bold">{{ categoryList[form.category]}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Donor Agency:</label><br>
                                        <span class="text-blue text-bold">{{donor_agencyList[form.donor_agency]}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Project of Donor Angency:</label><br>
                                        <span class="text-blue text-bold">{{projectofdonorList[form.projectofdonor]}}</span>
                                    </div> 
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Country of Study:</label><br>
                                        <span class="text-blue text-bold">{{ study_countryList[form.study_country]}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Course Mode/Area/Type:</label><br>
                                        <span class="text-blue text-bold">{{coursemodeList[form.coursemode]}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Degree:</label><br>
                                        <span class="text-blue text-bold">{{degreeList[form.degree]}}</span>
                                    </div> 
                                </div>
                                <div class="form-group row"> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Subject 1:</label><br>
                                        <span class="text-blue text-bold">{{ subjectList[form.subject1]}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Subject 2:</label><br>
                                        <span class="text-blue text-bold">{{subjectList[form.subject2]}}</span>
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Thesis Title:</label><br>
                                        <span class="text-blue text-bold">{{form.thesis_title}}</span>
                                    </div> 
                                </div>
                            </div>
                        </span>
                        <div class="callout callout-success">
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
                                                    {{attach.user_defined_name}}
                                                </td>
                                                <td>    
                                                    <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                </td> 
                                            </tr>
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                        </div>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('eligibility-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="eligibility-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="form-group row"> 
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="mb-0">Nomination Start Date:</label><br>
                                    <span class="text-blue text-bold">{{ form.nomination_start_date}}</span>
                                </div> 
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="mb-0">Nomination End Date:</label><br>
                                    <span class="text-blue text-bold">{{form.nomination_end_date}}</span>
                                </div> 
                            </div>
                            <div class="form-group row"> 
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="mb-0">Nature of participation:</label><br>
                                    <span v-for="(nature, index) in nature_of_participantList" :key="index" >
                                        <input type="checkbox" v-model="form.nature_of_participant" :class="{ 'is-invalid' :form.errors.has('nature_of_participant') }" name="nature_of_participant" id="nature_of_participant" :value="nature.id"> 
                                        <label class="pr-3"> {{ nature.name  }}</label>
                                    </span>
                                </div> 
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="mb-0">Target Group:</label><br>
                                    <span v-for="(tar, index) in target_groupList" :key="index" >
                                        <input type="checkbox" v-model="form.target_group" :class="{ 'is-invalid' :form.errors.has('target_group') }" name="target_group" id="target_group" :value="tar.id"> 
                                        <label class="pr-3"> {{ tar.name  }}</label>
                                    </span>
                                </div> 
                            </div>
                            <div class="form-group row"> 
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="mb-0">Eligibility School Leve:</label>
                                    <span v-for="(level, index) in org_levelList" :key="index" >
                                        <input type="checkbox" v-model="form.org_level" :class="{ 'is-invalid' :form.errors.has('org_level') }" name="org_level" id="org_level" :value="level.id"> 
                                        <label class="pr-3"> {{ level.name  }}</label>
                                    </span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label class="mb-0">Remarks:</label><br>
                                    <span class="text-blue text-bold">{{form.remarks}}</span>
                                </div>
                            </div>
                        </div>
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
            action_param_type:'',
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
        },
        loadHrDevelopmentMasters(type){
            let url="masters/loadHrDevelopmentMastersData/"+type;
            axios.get(url)
            .then(response => {
                let data = response.data.data;
                if(type=="active_training_type_list"){
                    for(let i=0;i<data.length;i++){
                        this.trainingtypeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_related_programme_list"){
                    for(let i=0;i<data.length;i++){
                        this.relatedProgrammeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_programme_level_list"){
                    for(let i=0;i<data.length;i++){
                        this.programmeLevelList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_programme_type_list"){
                    for(let i=0;i<data.length;i++){
                        this.programmeTypeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_course_type_list"){
                    for(let i=0;i<data.length;i++){
                        this.courseTypeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_financial_source_list"){
                    for(let i=0;i<data.length;i++){
                        this.financialSourceList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_category_list"){
                    for(let i=0;i<data.length;i++){
                        this.categoryList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_donor_list"){
                    for(let i=0;i<data.length;i++){
                        this.donor_agencyList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_degree_list"){
                    for(let i=0;i<data.length;i++){
                        this.degreeList[data[i].id] = data[i].name; 
                    }
                }
                if(type=="active_nature_of_participant_list"){
                    this.nature_of_participantList=data;
                }
                if(type=="active_target_group_list"){
                    this.target_groupList= data; 
                }
                
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
                for(let i=0;i<data.data.data.length;i++){
                    this.projectofdonorList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log("Error:"+error);
            });
        },
        loadstudy_countryList(uri = 'masters/loadGlobalMasters/all_active_country'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.study_countryList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log("Error:"+error);
            });
        },
        loadcoursemode(uri = 'masters/loadStaffMasters/all_active_coursemode_list'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.coursemodeList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        
        loadsubjectList(uri = 'masters/loadStaffMasters/all_active_subject_List'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.subjectList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        
        shownexttab(nextclass){ 
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
      
        loadDetails(id,type){
            this.action_param_type=type;
            axios.get('staff/hrdevelopment/loadDetails/'+id)
            .then((response) => {   
                let data=response.data.data;
                this.form.id=data.id;
                this.form.training_type=data.training_type;
                $('#qualification_upgradation_section').hide();
                $('#professional_development_section').hide();
                if(this.trainingtypeList[data.training_type].toLowerCase().includes('qualification upgrad')){
                    $('#qualification_upgradation_section').show();
                }
                if(this.trainingtypeList[data.training_type].toLowerCase().includes('professional development')){
                    $('#professional_development_section').show(); 
                }
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
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        }
    },
    
    mounted() {
        this.loadHrDevelopmentMasters('active_category_list');
        this.loadHrDevelopmentMasters('active_donor_list');
        this.loadstudy_countryList();
        this.loadcoursemode();
        this.loadHrDevelopmentMasters('active_degree_list');
        this.loadsubjectList();

        this.loadHrDevelopmentMasters('active_programme_level_list');
        this.loadHrDevelopmentMasters('active_programme_type_list');
        this.loadHrDevelopmentMasters('active_course_type_list');
        this.loadHrDevelopmentMasters('active_financial_source_list');
        
        this.loadHrDevelopmentMasters('active_training_type_list');
        this.loadHrDevelopmentMasters('active_related_programme_list');

        this.loadHrDevelopmentMasters('active_nature_of_participant_list');
        this.loadHrDevelopmentMasters('active_target_group_list');
        this.loadDetails(this.$route.params.data,this.$route.params.type);
    },
}
</script>