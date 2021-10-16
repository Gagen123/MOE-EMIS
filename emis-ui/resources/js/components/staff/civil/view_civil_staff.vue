<template>
<div>
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
                        <h5>{{response_data.name}}</h5>
                        <h6>Gender: {{sex_Array[response_data.sex_id]}}</h6>
                        <h6>Nationality: {{countryList[response_data.country_id]}}</h6>
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
                            <ul class="nav nav-tabs border-primary" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item border-right">
                                    <a class="nav-link active" id="custom-tabs-four-basic-tab" data-toggle="pill" href="#custom-tabs-four-basic" role="tab" aria-controls="custom-tabs-four-basic" aria-selected="true">Basic Info</a>
                                </li>
                                <li class="nav-item border-right">
                                    <a class="nav-link" id="custom-tabs-four-personal-tab" data-toggle="pill" href="#custom-tabs-four-personal" role="tab" aria-controls="custom-tabs-four-personal" aria-selected="false">Personal Details</a>
                                </li>
                                <!-- <li class="nav-item border-right">
                                    <a class="nav-link" id="custom-tabs-four-work-tab" data-toggle="pill" href="#custom-tabs-four-work" role="tab" aria-controls="custom-tabs-four-work" aria-selected="false">Work Experience</a>
                                </li> -->
                                <li class="nav-item border-right">
                                    <a class="nav-link" id="custom-tabs-four-education-tab" data-toggle="pill" href="#custom-tabs-four-education" role="tab" aria-controls="custom-tabs-four-education" aria-selected="false">Education</a>
                                </li>
                                <li class="nav-item border-right">
                                    <a class="nav-link" id="custom-tabs-four-promotion-tab" data-toggle="pill" href="#custom-tabs-four-promotion" role="tab" aria-controls="custom-tabs-four-promotion" aria-selected="false">Promotion Record</a>
                                </li>
                                <li class="nav-item border-right">
                                    <a class="nav-link" id="custom-tabs-four-training-tab" data-toggle="pill" href="#custom-tabs-four-training" role="tab" aria-controls="custom-tabs-four-training" aria-selected="false">Training Record</a>
                                </li>
                                <li class="nav-item border-right">
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
                                                    <td style="width:35%" class="text-bold">{{ response_data.emp_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Working Agency:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.working_agency }}</td>
                                                    <td style="width:15%">Dzongkhag:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.dzongkhagName }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%">Position Title:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.position_title_name }}</td>
                                                    <td style="width:15%">Employee Type:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.emp_type_id==1 ? 'Regular' : response_data.emp_type_id==2 ? 'Contract' :'Volunteer'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Date of Joining:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.initial_appointment_date}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="custom-tabs-four-personal" role="tabpanel" aria-labelledby="custom-tabs-four-personal-tab">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%">CID/Work Permit:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.cid_work_permit }}</td>
                                                    <td style="width:15%">Date of Birth</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.dob }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Contact No:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.contact_number }}</td>
                                                    <td style="width:15%">Email</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.email }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Alternative Email:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.alternative_email }}</td>
                                                    <td style="width:15%"></td>
                                                    <td style="width:35%" class="text-bold">{{  }}</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%">Marital Status:</td>
                                                    <td style="width:35%" class="text-bold">{{ response_data.maritalstatus }}</td>
                                                    <td style="width:15%">Nationality:</td>
                                                    <td style="width:35%" class="text-bold">{{ countryList[response_data.country_id] }}</td>
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
                                                    <td style="width:15%" class="text-bold">{{ dzongkhagList[response_data.dzongkhag] }}</td>
                                                    <td style="width:15%">Present Gewog:</td>
                                                    <td style="width:15%" class="text-bold">{{ response_data.gewog }}</td>
                                                    <td style="width:15%">Present Village:</td>
                                                    <td style="width:15%" class="text-bold">{{ response_data.village_id }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table class="table table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:15%">Permanant Dzongkhag:</td>
                                                    <td style="width:15%" class="text-bold">{{ dzongkhagList[response_data.p_dzongkhag] }}</td>
                                                    <td style="width:15%">Permanant Gewog:</td>
                                                    <td style="width:15%" class="text-bold">{{ response_data.p_gewog }}</td>
                                                    <td style="width:15%">Permanant Village:</td>
                                                    <td style="width:15%" class="text-bold">{{ response_data.p_village_id }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="custom-tabs-four-work" role="tabpanel" aria-labelledby="custom-tabs-four-work-tab">
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
                                </div> -->
                                <div class="tab-pane fade" id="custom-tabs-four-education" role="tabpanel" aria-labelledby="custom-tabs-four-education-tab">
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
                                                    <th>Promotion Type</th>
                                                    <th>Superstructure</th>
                                                    <th>Position Title</th>
                                                    <th>Position Level</th>
                                                    <th>Sub Level</th>
                                                    <th>Effective Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in staff_promotion_list" :key="index">
                                                    <td>{{ item.PromotionTypeID}}</td>
                                                    <td>{{ item.superstructure}}</td>
                                                    <td>{{ item.position_title_name}}</td>
                                                    <td>{{ item.positionlevel}}</td>
                                                    <td>{{ item.SubLevel}}</td>
                                                    <td>{{ item.EffectiveDate}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-training" role="tabpanel" aria-labelledby="custom-tabs-four-training-tab">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <table id="training-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Course</th>
                                                    <th>Funding</th>
                                                    <th>Training Status</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in staff_lonttermtraining_list" :key="index">
                                                    <td>{{ item.Course}}</td>
                                                    <td>{{ item.funding}}</td>
                                                    <td>{{ item.training_status}}</td>
                                                    <td>{{ item.StartDate}}</td>
                                                    <td>{{ item.EndDate}}</td>
                                                </tr>
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
            response_data:[],
            grand_total:0,
            qualification_tbl_row_count:0,
            sex_Array:{},
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
            qualificationDescription:[],
            staffqualificationlist:[],
            coursemodeList:[],
            staff_nomination_list:[],
            staff_qualification_list:[],
            attachmentDetails:[],
            staff_promotion_list:[],
            staff_lonttermtraining_list:[],

        }
    },
    methods: {
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

        loadactivesex_idList(uri="masters/loadGlobalMasters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.sex_Array[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
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
                this.response_data.p_gewog=this.gewogArray[gewogid];
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
                this.response_data.p_village_id=this.villageList[vill];
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
                this.response_data.gewog=this.gewogArray1[gewog];
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
                this.response_data.village_id=this.villageList1[village];
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        loadpersonalDetails(){
            axios.get('staff/viewStaffProfile/'+this.$route.params.data.id)
            .then((response) => {
                let data=response.data.data;
                this.response_data=data
                this.response_data.p_dzongkhag=data.p_dzongkhag;
                this.getPgewoglist(data.p_dzongkhag,data.p_gewog);
                this.response_data.p_gewog=data.p_gewog;
                this.getPvillagelist(data.p_gewog,data.p_village);
                this.response_data.p_village_id=data.p_village;

                this.response_data.dzongkhag=data.dzo_id;
                this.getgewoglist(data.dzo_id,data.geowg_id);
                this.response_data.gewog=data.geowg_id;
                this.getvillagelist(data.geowg_id,data.village_id);
                this.response_data.village_id=data.village_id;

                this.response_data.sex_id=data.sex_id;
                this.response_data.country_id=data.country_id;
                this.response_data.working_agency_id=data.working_agency_id;
                this.response_data.contact_number=data.contact_no;
                this.response_data.email=data.email;
                this.response_data.alternative_email=data.alternative_email;
                this.response_data.comp_sub=data.comp_sub_id;
                this.response_data.elective_sub1=data.elective_sub_id1;
                this.response_data.elective_sub2=data.elective_sub_id2;
                this.response_data.currier_stage=data.cureer_stagge_id;
                this.response_data.emp_file_code=data.employee_code;
                this.response_data.remarks=data.remarks;
                this.response_data.initial_appointment_date=data.initial_appointment_date;
                this.loadqualication(data.id);
                this.loadnomination(data.id);
                let uri='/staff/zest/loadPromotion/byStaffId__'+this.$route.params.data.id;
                axios.get(uri)
                .then(response => {
                    this.staff_promotion_list = response.data.data;
                });

                let uri1='/staff/zest/loadLongTermTraining/byStaffId__'+this.$route.params.data.id;
                axios.get(uri1)
                .then(response => {
                    this.staff_lonttermtraining_list = response.data.data;
                });

            })
            .catch((error) => {
                console.log("Error......"+error);
            });
        },

    },

    async mounted() {
        this.loadactivesex_idList();
        this.loadactivecountryList();
        this.loadactivedzongkhagList();
        this.loadAcademicMasters();
        this.loadactivesubjectList();
        this.loadpersonalDetails();
    },
}
</script>
