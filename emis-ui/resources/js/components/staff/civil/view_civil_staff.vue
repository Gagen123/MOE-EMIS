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
                                    <label class="mb-0.5">Emp Type: </label>
                                    <span class="text-blue text-bold">
                                        {{personal_form.emp_type==1 ? 'Regualr' : personal_form.emp_type==2 ? 'Contract' :'Volunteer' }}
                                    </span>

                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <span class=""><label><u>Personal Detail</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Emp Id:</label>
                                    <span class="text-blue text-bold">{{personal_form.emp_id}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">CID/Work Permit No:</label>
                                    <span class="text-blue text-bold">{{personal_form.cid_work_permit}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Full Name:</label>
                                    <span class="text-blue text-bold">{{personal_form.name}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Date of Birth: </label>
                                    <span class="text-blue text-bold">{{personal_form.dob}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Sex:</label>
                                    <span class="text-blue text-bold">{{sex_Array[personal_form.sex_id]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Position Title (Level):</label>
                                    <span class="text-blue text-bold">{{positiontitleList[personal_form.position_title]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Marital Status:</label>
                                    <span class="text-blue text-bold">{{marital_statusList[personal_form.marital_status]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Nationality:</label>
                                    <span class="text-blue text-bold">{{countryList[personal_form.country_id]}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <span class=""><label><u>Contacts</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Contact Number:</label>
                                    <span class="text-blue text-bold">{{personal_form.contact_number}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5"></label>
                                    <span class="text-blue text-bold">{{personal_form.email}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Alternative Email:</label>
                                    <span class="text-blue text-bold">{{personal_form.alternative_email}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <span class=""><label><u>Permanent Address</u></label></span>
                            <div class="form-group row" id="bhutanese_address">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzongkhagList[personal_form.p_dzongkhag]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Gewog:</label>
                                    <span class="text-blue text-bold">{{personal_form.p_gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Village:</label>
                                    <span class="text-blue text-bold">{{personal_form.p_village_id}}</span>
                                </div>
                            </div>
                            <div class="form-group row" id="foreign_address" style="display:none">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Address:</label>
                                    <span class="text-blue text-bold">{{personal_form.address}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Working Address</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzongkhagList[personal_form.dzongkhag]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Gewog:</label>
                                    <span class="text-blue text-bold">{{personal_form.gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Village:</label>
                                    <span class="text-blue text-bold">{{personal_form.village_id}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Organization Type:</label>
                                    <select v-model="personal_form.organization_type" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('organization_type') }" class="form-control select2" name="organization_type" id="organization_type">
                                        <option value="Org">Organization/School </option>
                                        <option value="Dzongkhag">Dzongkhag</option>
                                        <option value="Ministry">Ministry </option>
                                    </select>
                                    <has-error :form="personal_form" field="organization_type"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Working Agency:</label>
                                    <select v-model="personal_form.working_agency_id" @change="remove_error('working_agency_id')" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('working_agency_id') }" class="form-control select2" name="working_agency_id" id="working_agency_id">
                                        <option value=""> --Select--</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="personal_form" field="working_agency_id"></has-error>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success" v-if="personal_form.isteaching">
                            <span class="text-blue"><label><u>Subjects</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Compulsory Subject:</label>
                                    <span class="text-blue text-bold">{{subjectList[personal_form.comp_sub]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Elective Subject 1:</label>
                                    <span class="text-blue text-bold">{{subjectList[personal_form.elective_sub1]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Elective Subject 2:</label>
                                    <span class="text-blue text-bold">{{subjectList[personal_form.elective_sub2]}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <span class="text-blue"><label><u>Others</u></label></span>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Initail Appointment Date:</label>
                                    <span class="text-blue text-bold">{{personal_form.initial_appointment_date}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Career Stage:</label>
                                    <span class="text-blue text-bold">{{cureerstageList[personal_form.currier_stage]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0.5">Employee File Code:</label>
                                    <span class="text-blue text-bold">{{personal_form.emp_file_code}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0.5">Remarks:</label>
                                    <span class="text-blue text-bold">{{personal_form.remarks}}</span>
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
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-cyan mb-2 pb-1 pr-1 pt-1">
                                Details for: <span class="personname"></span>
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
                            Details for: <span class="personname"></span>
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
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('qualification-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
                this.qualification_form.personal_id=data.id;
                this.nomination_form.personal_id=data.id;
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
                this.loadqualication(this.personal_form.personal_id);
                this.loadnomination(this.personal_form.personal_id);
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
