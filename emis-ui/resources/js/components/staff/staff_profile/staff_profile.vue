<template>
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-img">
                        <img class="profile-user-img img-fluid img-circle" src="img/user.png" alt="User profile picture">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="profile-head">
                        <h5>{{personal_form.name}}</h5>
                        <h6>Gender: {{sex_Array[personal_form.sex_id]}}</h6>
                        <h6>Nationality: {{countryList[personal_form.country_id]}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-basic-tab" data-toggle="pill" href="#custom-tabs-four-basic" role="tab" aria-controls="custom-tabs-four-basic" aria-selected="true">Basic Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-personal-tab" data-toggle="pill" href="#custom-tabs-four-personal" role="tab" aria-controls="custom-tabs-four-personal" aria-selected="false">Personal Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-work-tab" data-toggle="pill" href="#custom-tabs-four-work" role="tab" aria-controls="custom-tabs-four-work" aria-selected="false">Work Experience</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-education-tab" data-toggle="pill" href="#custom-tabs-four-education" role="tab" aria-controls="custom-tabs-four-education" aria-selected="false">Education</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-promotion-tab" data-toggle="pill" href="#custom-tabs-four-promotion" role="tab" aria-controls="custom-tabs-four-promotion" aria-selected="false">Promotion Record</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-training-tab" data-toggle="pill" href="#custom-tabs-four-training" role="tab" aria-controls="custom-tabs-four-training" aria-selected="false">Training Record</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-nominations-tab" data-toggle="pill" href="#custom-tabs-four-nominations" role="tab" aria-controls="custom-tabs-four-nominations" aria-selected="false">Nominations</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-basic" role="tabpanel" aria-labelledby="custom-tabs-four-basic-tab">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%">Employee Id:</td>
                                                    <td style="width:35%">{{ personal_form.emp_id }}</td>
                                                    <td style="width:15%"></td>
                                                    <td style="width:35%"></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Working Agency:</td>
                                                    <td style="width:35%">{{ }}</td>
                                                    <td style="width:15%">Dzongkhag:</td>
                                                    <td style="width:35%">{{ }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%">Title:</td>
                                                    <td style="width:35%">{{ positiontitleList[personal_form.position_title] }}</td>
                                                    <td style="width:15%">Position:</td>
                                                    <td style="width:35%">{{ }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Department:</td>
                                                    <td style="width:35%">{{ }}</td>
                                                    <td style="width:15%">Dzongkhag:</td>
                                                    <td style="width:35%">{{ }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Occupational Group:</td>
                                                    <td style="width:35%">{{ }}</td>
                                                    <td style="width:15%">Employee Type:</td>
                                                    <td style="width:35%">{{ personal_form.emp_type==1 ? 'Regular' : personal_form.emp_type==2 ? 'Contract' :'Volunteer'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Date of Joining:</td>
                                                    <td style="width:35%">{{ }}</td>
                                                    <td>{{ }}</td>
                                                    <td>{{ }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-personal" role="tabpanel" aria-labelledby="custom-tabs-four-personal-tab">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%">CID/Work Permit:</td>
                                                    <td style="width:35%">{{ personal_form.cid_work_permit }}</td>
                                                    <td style="width:15%">Date of Birth</td>
                                                    <td style="width:35%">{{ personal_form.dob }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Contact No:</td>
                                                    <td style="width:35%">{{ personal_form.contact_number }}</td>
                                                    <td style="width:15%">Email</td>
                                                    <td style="width:35%">{{ personal_form.email }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Alternative Email:</td>
                                                    <td style="width:35%">{{ personal_form.alternative_email }}</td>
                                                    <td style="width:15%"></td>
                                                    <td style="width:35%">{{  }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Marital Status:</td>
                                                    <td style="width:35%">{{ marital_statusList[personal_form.marital_status] }}</td>
                                                    <td style="width:15%">Nationality:</td>
                                                    <td style="width:35%">{{ countryList[personal_form.country_id] }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%">Present Dzongkhag:</td>
                                                    <td style="width:15%">{{ dzongkhagList[personal_form.dzongkhag] }}</td>
                                                    <td style="width:15%">Present Gewog:</td>
                                                    <td style="width:15%">{{ personal_form.gewog }}</td>
                                                    <td style="width:15%">Present Village:</td>
                                                    <td style="width:15%">{{ personal_form.village_id }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%">Permanant Dzongkhag:</td>
                                                    <td style="width:15%">{{ dzongkhagList[personal_form.p_dzongkhag] }}</td>
                                                    <td style="width:15%">Permanant Gewog:</td>
                                                    <td style="width:15%">{{ personal_form.p_gewog }}</td>
                                                    <td style="width:15%">Permanant Village:</td>
                                                    <td style="width:15%">{{ personal_form.p_village_id }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-work" role="tabpanel" aria-labelledby="custom-tabs-four-work-tab">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="training-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <td>Position Title</td>
                                                <td>Working Agency</td>
                                                <td>Dzongkhag</td>
                                                <td>From Date</td>
                                                <td>To Date</td>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-education" role="tabpanel" aria-labelledby="custom-tabs-four-education-tab">
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
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-promotion" role="tabpanel" aria-labelledby="custom-tabs-four-promotion-tab">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="promotion-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Date of Promotion</th>
                                                    <th>Position Level</th>
                                                    <th>Position Title</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-training" role="tabpanel" aria-labelledby="custom-tabs-four-training-tab">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="training-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Training Type</th>
                                                    <th>Course Title</th>
                                                    <th>Location</th>
                                                    <th>From Date</th>
                                                    <th>To Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-nominations" role="tabpanel" aria-labelledby="custom-tabs-four-nominations-tab">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>
<script>
export default {
    data(){
        return{
            grand_total:0,
            qualification_tbl_row_count:0,
            sex_Array:{},
            marital_statusList:[],
            positiontitleList:[],
            countryList:[],
            dzongkhagList:{},
            villageList1:{},
            gewogArray:{},
            gewogArray1:{},
            villageList:{},
            orgList:[],
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

            personal_form: new form({
                isteaching:false,
                organization_type:'',
                personal_id: '',
                cideid:'',
                emp_type: 1,
                emp_id:'',
                cid_work_permit:'',
                name:'',
                p_address:'',
                position_title:'',
                sex_id:'',
                dob:'',
                marital_status:'',
                country_id:'',
                dzongkhag:'',
                village_id:'',
                gewog:'',
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
            staff_qualification_list:'',
        }
    },
    methods: {
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
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
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.subjectList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        loadactivesubjectList(uri="masters/loadStaffMasters/all_active_subject_List"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.qualificationsubjectList =  data.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        loadactivecureerstageList(uri="masters/loadStaffMasters/all_active_cureer_stage_list"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.cureerstageList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.leg(error);
            });
        },
        loadactivesex_idList(uri="masters/loadGlobalMasters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.sex_Array[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.leg(error);
            });
        },
        loadactivemaritalList(uri="masters/loadStaffMasters/all_active_marital_list"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.marital_statusList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.leg(error);
            });
        },
        loadpositiontitleList(uri="masters/loadStaffMasters/all_active_position_title_with_level"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.positiontitleList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        loadrelationshipList(uri="masters/loadStaffMasters/all_active_relationship_list"){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.repationshipList =  data.data.data;
            })
            .catch(function (error){
                console.leg(error);
            });
        },
        loadactivecountryList(uri="masters/loadGlobalMasters/all_active_country"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.countryList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.countryList[data.data.data[i].id] = data.data.data[i].nationality;
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
                for(let i=0;i<data.data.data.length;i++){
                    this.dzongkhagList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        getPgewoglist(dzoId,gewogid){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                this.personal_form.p_gewog=this.gewogArray[gewogid];
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getPvillagelist(villageId,vill){
            let uri = 'masters/all_active_dropdowns/gewog/'+villageId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.villageList[data.data.data[i].id] = data.data.data[i].name;
                }
                this.personal_form.p_village_id=this.villageList[vill];
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getgewoglist(dzoId,gewog){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.gewogArray1[data.data.data[i].id] = data.data.data[i].name;
                }
                this.personal_form.gewog=this.gewogArray1[gewog];
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getvillagelist(villageId,village){
            let uri = 'masters/all_active_dropdowns/gewog/'+villageId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.villageList1[data.data.data[i].id] = data.data.data[i].name;
                }
                this.personal_form.village_id=this.villageList1[village];
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        allOrgList(){
            let org_type=$('#organization_type').val();
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+$('#dzongkhag').val();
            //Below two should change according to the data from rcsc
            if(org_type=="Dzongkhag"){
                uri = 'loadCommons/loadOrgList/dzongkhagwise/'+$('#dzongkhag').val();
            }
            if(org_type=="Ministry"){
                uri = 'loadCommons/loadOrgList/dzongkhagwise/'+$('#dzongkhag').val();
            }
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



        loadpersonalDetails(){
            axios.get('loadCommons/viewStaffDetails/by_id/'+this.$route.params.data.id)
            .then((response) => {
                let data=response.data.data;

                this.personal_form.personal_id=data.id;
                this.personal_form.emp_type=data.emp_type_id;
                this.personal_form.emp_id=data.emp_id;
                this.personal_form.cid_work_permit=data.cid_work_permit;
                this.personal_form.name=data.name;
                this.personal_form.position_title=data.position_title_id;
                this.personal_form.marital_status=data.merital_status;
                this.personal_form.dob=data.dob;

                this.personal_form.p_dzongkhag=data.p_dzongkhag;
                this.getPgewoglist(data.p_dzongkhag,data.p_gewog);
                this.personal_form.p_gewog=data.p_gewog;
                this.getPvillagelist(data.p_gewog,data.p_village);
                this.personal_form.p_village_id=data.p_village;

                this.personal_form.dzongkhag=data.dzo_id;
                this.getgewoglist(data.dzo_id,data.geowg_id);
                this.personal_form.gewog=data.geowg_id;
                this.getvillagelist(data.geowg_id,data.village_id);
                this.personal_form.village_id=data.village_id;

                this.personal_form.sex_id=data.sex_id;
                this.personal_form.country_id=data.country_id;
                this.personal_form.working_agency_id=data.working_agency_id;
                this.personal_form.contact_number=data.contact_no;
                this.personal_form.email=data.email;
                this.personal_form.alternative_email=data.alternative_email;
                this.personal_form.comp_sub=data.comp_sub_id;
                this.personal_form.elective_sub1=data.elective_sub_id1;
                this.personal_form.elective_sub2=data.elective_sub_id2;
                this.personal_form.currier_stage=data.cureer_stagge_id;
                this.personal_form.emp_file_code=data.employee_code;
                this.personal_form.remarks=data.remarks;
                this.personal_form.initial_appointment_date=data.initial_appointment_date;
                this.loadqualication(data.id);
                this.loadnomination(data.id);
            })
            .catch((error) => {
                console.log("Error......"+error);
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
        this.loadactivemaritalList();
        this.loadactivesex_idList();
        this.loadpositiontitleList();
        this.loadactivecountryList();
        this.loadactivedzongkhagList();

        this.loadAcademicMasters();
        this.loadactivesubjectList();
        this.loadactivecureerstageList();
        this.loadrelationshipList();
        this.loadpersonalDetails();

    },
}
</script>
