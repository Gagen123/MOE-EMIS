<template>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="callout callout-danger" style="display:none" id="screenPermission">
                <h5 class="bg-gradient-danger">Sorry!</h5>
                <div id="message"></div>
            </div>
            <div class="form-group" id="main_form">
                <div class="row form-group">
                    <template v-if="!is_student">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >CID No/Reference  : </label>
                            <label class="text-primary">{{std_admission_details.CidNo}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Name of Student :</label>
                            <label class="text-primary">{{ std_admission_details.FirstName}} {{ std_admission_details.MiddleName=='null' ? '': std_admission_details.MiddleName}} {{ std_admission_details.LastName=='null' ? '': std_admission_details.LastName}}</label>
                        </div>
                    </template>
                    <template v-else>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label class="required" >CID No/Reference  : </label>
                                <label class="text-primary">{{std_admission_details.student_code}}</label>
                            </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Name of Student :</label>
                            <label class="text-primary">{{ std_admission_details.Name}} </label>
                        </div>
                    </template>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Gender :</label>
                        <label class="text-primary">{{ genderArray[std_admission_details.CmnSexId]}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label >Date of Birth :</label>
                        <label class="text-primary">{{std_admission_details.DateOfBirth}}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Dzongkhag : </label>
                        <label class="text-primary">{{dzongkhagArray[std_admission_details.CmnDzoId]}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Gewog : </label>
                        <label class="text-primary"><span id="gewogid"></span>{{gewogArray[std_admission_details.CmnGewogId]}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Village :</label>
                        <label class="text-primary"><span id="vilageId"></span> {{villageArray[std_admission_details.CmnChiwogId]}}</label>
                    </div>
                </div>
                <hr>
                <h6>Present School Details</h6>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label >School : </label>
                        <label class="text-primary">{{ this.std_present_school }}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Class : </label>
                        <label class="text-primary"><span id="present_class"></span>{{this.std_present_class}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="form-group">
            <h5>Apply for Admission</h5>
            <hr>
                <template v-if="!is_student">
                    <div class="row form-group">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label class="required" >Admission For:<span class="text-danger">*</span></label>
                            <input type="radio" name="registrationType" @click="showsection('ECCD')" value="ECCD" id="new"> ECCD
                            <input type="radio" name="registrationType" @click="showsection('PP')" value="PP" id="existing" class="ml-4"> Class PP
                            <input type="radio" name="registrationType" @click="showsection('Abroad')" value="Abroad" id="existing" class="ml-4"> Non-Registered Students (No Student Id)
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="row form-group">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label class="required" >Admission For:<span class="text-danger">*</span></label>
                            <input type="radio" name="registrationType" @change="getParentSchoolDzo()" @click="showsection('ParentSchool')" value="ParentSchool" id="existing" class="ml-4"> Transfer to Parent School
                            <input type="radio" name="registrationType" @change="getdzongkhagList('Student')" @click="showsection('NonParentSchool')" value="NonParentSchool" id="existing" class="ml-4"> Transfer to Non-Parent School <br>
                            <small><i>(*Note: If present school is registered as a feeder school, then Parent School guarantees admission)</i></small>
                        </div>
                    </div>
                </template>
                <div class="row form-group">
                    <div class="callout callout-danger" style="display:none" id="validationmessages">
                        <h5 class="bg-gradient-danger">Sorry!</h5>
                        <div id="validation_message"></div>
                    </div>
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="selectschool">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Dzongkhag/Thromde</th>
                                  <th>School/ECCD Centres</th>
                                  <th>Class/Age group</th>
                                  <!-- <th>Stream</th> -->
                                  <!-- <th>No of Seats</th> -->
                                  <th>School Decision</th>
                                  <th>Student Decision</th>
                                  <th class="pr-4 pl-4">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                                <tr id="record1" v-for='(item, index) in response_data' :key="index">
                                    <td>
                                        {{dzongkhagArray[item.Dzongkhagid]}}
                                    </td>
                                    <td>
                                        {{item.organization.name}}
                                    </td>
                                    <td>
                                        {{item.class_id.includes('Age')?item.class_id:item.class.class}}
                                    </td>
                                    <td>{{item.school_decision}} </td>
                                    <td>{{item.student_decision}} </td>
                                    <td>
                                        <template v-if="item.school_decision=='Accepted' && item.student_decision!='Accepted' && item.student_decision!='Rejected'">
                                            <button type="button" class="btn btn-flat btn-sm btn-primary" id="remove"
                                            @click="remove('Accepted',item.id)"><i class="fa fa-check"></i> Accept</button>
                                            <button type="button" class="btn btn-flat btn-sm bg-success" id="remove"
                                            @click="remove('Rejected',item.id)"><i class="fa fa-times pr-2"></i> Reject</button>
                                        </template>
                                        <template v-if="item.school_decision==''">
                                            <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                            @click="remove('Remove',item.id)"><i class="fa fa-trash"></i> Remove</button>
                                        </template>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="dzongkhag" @change="getschoolList('dzongkhag'),removeerror('dzongkhag')" :class="{ 'is-invalid': student_form.errors.has('dzongkhag') }" v-model="student_form.dzongkhag" class="form-control" id="dzongkhag">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                                        </select>
                                        <has-error :form="student_form" field="dzongkhag"></has-error>
                                    </td>
                                    <td>
                                        <select v-model="student_form.school" :class="{ 'is-invalid': student_form.errors.has('school') }" @change="removeerror('school')" class="form-control" name="school" id="school">
                                            <option value="">--- Please Select---</option>
                                            <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                                        </select>
                                        <has-error :form="student_form" field="school"></has-error>
                                    </td>
                                    <td>
                                        <span>{{this.std_class}}</span>
                                    </td>
                                    <td>
                                        <!-- <span>{{student_form.seats}}</span> -->
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td colspan='5'>
                                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                        @click="addMore()"><i class="fa fa-plus"></i> Save & Add</button>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row form-group fa-pull-right" id="finalbtn" style="display:none">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- <button class="btn btn-flat btn-primary" @click="submitDetail()"> <i class="fa fa-save"></i> submit</button> -->
                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                        @click="addMore()"><i class="fa fa-plus"></i> Save & Add</button>
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
            is_student:false,
            std_id:'',
            std_class:'',
            std_present_class:'',
            std_present_school:'',
            org_id:'',
            parent_school_dzongkhag:'',
            genderArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            OrgDetails:'',
            dzongkhagList:[],
            schoolList:[],
            classList:[],
            streamList:[],
            std_admission_details:'',
            ppdob:'',
            eccddob:'',
            ppmonth:'',
            eccdmonth:'',
            response_data:[],
            //prefedined an array of the classes
            class_array:['Age 1','Age 2','Age 3','Age 4','Age 5','PP', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'],
            student_form: new form({
                id:'',
                seats:0,
                admission_type:'',
                student_id:'',
                dzongkhag:'',
                school:'',
                class:'',
                dateOfapply:'',
                remarks:'',
                std_decission:'',
                actiontype:'portal'
            })
        }
    },
    methods:{
         /**
         * method to add more fields
         */
        addMore: function(){
            Swal.fire({
                text: "Are you sure you wish to save this details ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
            }).then((result) => {
                if(result.isConfirmed){
                    this.student_form.class = this.std_class;
                    this.student_form.post('/admissions/saveorgclassDetails')
                    .then((response) => {
                        this.student_form.dzongkhag='';
                        this.student_form.school='';
                        this.student_form.class='';
                        this.loadadmissions();
                    })
                    .catch((error) => {
                        console.log("Error addMore:"+error);
                    })
                }
            });
        },
        loadadmissions(){
            let std_id=this.student_form.student_id;
            this.student_form.student_seats=[];
            axios.get('/admissions/getorgclassDetails/'+std_id)
            .then(Response =>{
                let data = Response.data;
                this.response_data=data;
                if(data.length>0){
                    $('#finalbtn').show();
                }
            }).catch(error => console.log(error));
        },

        /**
         * method to remove fields
         */
        remove(type,id){
            Swal.fire({
                text: "Are you sure you wish to delete this ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
            }).then((result) => {
                if(result.isConfirmed){
                    axios.get('/admissions/deleteclassDetails/'+id+'__'+type)
                    .then((response) => {
                        let data=response.data;
                        this.student_form.dzongkhag='';
                        this.student_form.school='';
                        this.student_form.class='';
                        this.loadadmissions();
                    })
                    .catch((error) => {
                        console.log("Error remove:"+error);
                    })
                }
            });
        },
        submitDetail(){
            Swal.fire({
                text: "Are you sure you wish to submit this detials for further acceptance ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
            }).then((result) => {
                if(result.isConfirmed){
                    this.student_form.post('/admissions/savefilanorgclassDetails')
                    .then((response) => {
                        let data=response.data;
                        this.$router.push({name:'acknowledgement'});
                    })
                    .catch((error) => {
                        console.log("Error addMore:"+error);
                    })
                }
            });
        },

        getdzongkhagList(type){
            let uri ='masters/loadGlobalMasters/all_active_dzongkhag';
            axios.get(uri)
            .then(Response =>{
                let data = Response.data.data;
                this.dzongkhagList = data;
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
                $('#dzongkhag').prop('disabled',false);
            }).catch(error => console.log(error));
        },

        getParentSchoolDzo(){
            this.student_form.dzongkhag = this.parent_school_dzongkhag;
            $('#dzongkhag').prop('disabled',true);
            this.getParentSchoolList(this.org_id);
        },

        getstudentPersonalDetails(type){
            axios.get('/admissions/getStudentDetailsFromPortal/'+type)
                .then(response => {
                let data = response.data;
                if(data != ""){
                    this.std_admission_details=data;
                    this.org_id = this.std_admission_details.OrgOrganizationId;

                    //Function to load the school list as per feeders
                    if(type == 'Student'){
                        let uri2 ='organizations/loadOrganizationDetailsbyOrgId/'+this.org_id;
                        axios.get(uri2)
                        .then(Response =>{
                            let dzongkhag_data = Response.data.data;
                            this.parent_school_dzongkhag = dzongkhag_data.dzongkhagId;
                            this.std_present_school = dzongkhag_data.name;
                            this.student_form.dzongkhag = this.parent_school_dzongkhag;
                            $('#dzongkhag').prop('disabled',true);
                            this.getStudentClass(data.id);
                            this.getParentSchoolList(this.org_id);
                        }).catch(error => console.log(error));

                        this.student_form.student_id=data.id;
                        this.loadadmissions();
                        let AdmissionType='ParentSchool';
                        this.student_form.admission_type=AdmissionType;
                        $("input[name=registrationType][value=" + AdmissionType + "]").prop('checked', true);
                    } else {
                        this.student_form.student_id=data.id;
                        this.std_class=data.class_id;
                        this.loadadmissions();
                        this.student_form.admission_type=data.AdmissionType;
                        $("input[name=registrationType][value=" + data.AdmissionType + "]").prop('checked', true);
                    }
                    this.showsection(data.AdmissionType)
                    this.getGewogList(data.CmnDzoId,data.CmnGewogId);
                    this.getvillagelist(data.CmnGewogId,data.CmnChiwogId);
                }
                else{
                    $('#main_form').hide();
                    $('#message').html('You are not yet registered in the system. Please register your self first to proceed further from here. <br> Thank you!');
                    $('#screenPermission').show();
                }
            });
        },

        getStudentClass(std_id){
            let uri = '/students/getStudentClassId/'+ std_id;
            try{
                axios.get(uri).then(response => {
                    let data= response.data.data;
                    //have to check whether the student passed or failed
                    this.std_present_class = data.class;
                    let index = this.class_array.indexOf(this.std_present_class);
                    index++;
                    this.std_class=this.class_array[index];
                    this.classList.push(this.std_class);
                    $('#classsection').show();
                });
            }catch(e){
                console.log('error loadactivedzongkhags '+e);
            }
        },

        getParentSchoolList(org_id){
            this.schoolList=[];
            let uri = '/organizations/loadParentSchoolList/'+ org_id;
            try{
                axios.get(uri).then(response => {
                    let data= response.data.data;
                    this.schoolList=data;
                });
            }catch(e){
                console.log('error loadactivedzongkhags '+e);
            }
        },

        getclassList(id){
            this.classList =[];
            let orgId=$('#'+id).val();
            let schoolValue = this.checkSchoolList(orgId);
            if(schoolValue){
                this.student_form.school=orgId;
                axios.get('/masters/loadClassStreamSection/NA/' +orgId)
                .then(Response =>{
                    let data = Response.data;
                    let type=$('input[name="registrationType"]:checked').val();
                    this.student_form.admission_type=type;
                    if(type=="PP"){
                        data.forEach(cls => {
                            if(cls.class=='PP'){
                                this.classList.push(cls);
                            }
                        });
                    }
                    else{
                        this.classList = data;
                    }
                    $('#classsection').show();

                })
            } else {
                Swal.fire({
                    text: "This selection has already been added",
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok!',
                })
                this.student_form.school = '';
            }
        },

        checkSchoolList(orgId){
            for(let i=0;i<this.response_data.length;i++){
                if(this.response_data[i].organization.id == orgId){
                    return false;
                }
            }
            return true;
        },

        getstreamListByid(id){
            let classId=$('#class').val();
            if(id!=""){
                classId=id;
            }
            axios.get('/masters/getStreamByclassId/' +classId)
            .then(Response =>{
                let data = Response.data;
                this.classList = data;
            })
        },

        getOrgDetails(id){
            axios.get('/organizations/loadOrganizationDetailsbyOrgId/' +id)
            .then(response =>{
                let data = response.data.data;
                this.OrgDetails=data;
            })

        },

        getGewogList(dzongkhag,gewog_id){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                $('#gewogid').html(this.gewogArray[gewog_id]);
            });
        },

        getvillagelist(gewogId,vilId){
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                $('#vilageId').html(this.villageArray[vilId]);
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        applyselect(){
            if(!$('#dzongkhag').attr('class').includes('select2')){
            $('#dzongkhag').addClass('select2');
            }
            if(!$('#school').attr('class').includes('select2')){
            $('#school').addClass('select2');
            }
            if(!$('#class').attr('class').includes('select2')){
            $('#class').addClass('select2');
            }
            if(!$('#stream').attr('class').includes('select2')){
            $('#stream').addClass('select2');
            }
        },
        loadGenderList(uri="masters/loadGlobalMasters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sex_idList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        removeerror(fieldid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
            }
        },

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="class"){
                this.student_form.class=$('#class').val();

            }
            if(id=="stream"){
                this.student_form.stream=$('#stream').val();
                // this.getstreamList($('#stream').val);
            }
        },

        getschoolList(dzo_id){
            this.student_form.dzongkhag=$('#'+dzo_id).val();
            var type;
            if(this.is_student){
                type = this.std_class;
                if(this.std_class=="Age 5"){
                    type="PP";
                }else{
                     type="ECCD";
                }
            } else{
                type=$('input[name="registrationType"]:checked').val();
            }

            this.schoolList=[];

            //added if condition by tshewang to get school list, once student type is chaged to student. school list is not appearing as type is empty
            if(type==""){
                type="PP";
            }
            let uri = '/organizations/loadSchoolList/'+ $('#'+dzo_id).val()+'/'+type;
            try{
                axios.get(uri).then(response => {
                    let data= response.data.data;
                    this.schoolList=data;
                    $('#school_Section').show();
                });
            }catch(e){
                console.log('error loadactivedzongkhags '+e);
            }
        },
        getProjection(){
            if($('input[name="registrationType"]:checked').val()=="PP"){
                let clasId=$('#class').val();
                let orgId=$('#school').val();
                let uri = '/organizations/loadProjection/'+clasId+'__'+orgId;
                axios.get(uri).then(response => {
                    let data= response.data;
                    this.student_form.seats=data.ProjectionNo;
                });
            }
            else{
                $('#seatAvailable').hide();
            }
        },
        loadVlidation(){
            let uri='masters/loadValidationcondition';
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.ppdob=data.date;
                this.eccddob=data.date1;
                this.ppmonth=data.no_months;
                this.eccdmonth=data.no_months1;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        showsection(type){
            let dob=new Date(this.std_admission_details.DateOfBirth);
            // let year2=date2.getFullYear();
            // let month2=date2.getMonth();
            // let numberOfMonths;
            let isvalid=true;
            let messages="";
            if(this.is_student){
                $('#selectschool').show();
                $('#validationmessages').hide();
            } else {
                if(type=="ECCD"){
                    const _MS_PER_DAY = 1000 * 60 * 60 * 24;
                    let dob=this.std_admission_details.DateOfBirth;
                    let date1 = new Date(dob);
                    let date2 = new Date(this.eccddob);

                    // Discard the time and time-zone information.
                    const dob_date = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
                    const admission_date = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());

                    let eecdage = Math.floor((admission_date-dob_date) / _MS_PER_DAY);
                    if(eecdage <=1096){
                        messages="You need to attained the minimum required age";
                        $('#dzo_Section').hide();
                        $('#seatAvailable').hide();
                        $('#selectschool').hide();
                        $('#validation_message').html(messages);
                        $('#validationmessages').show();
                    } else {
                        $('#selectschool').show();
                        $('#validationmessages').hide();
                    }
                }
                else{
                    axios.get('masters/loadGlobalMasters/admission')
                    .then(response => {
                        let data = response.data.data;
                        let from_date = new Date(data.from_date);
                        let to_date = new Date(data.to_date);
                        let present_date = new Date();
                        if(to_date >= present_date && from_date <= present_date){
                            $('#selectschool').show();
                            $('#validationmessages').hide();
                        }else{
                            let messages="The Admission Dates are closed. <br> Thank You!";
                            $('#dzo_Section').hide();
                            $('#seatAvailable').hide();
                            $('#selectschool').hide();
                            $('#validation_message').html(messages);
                            $('#validationmessages').show();
                        }
                    })
                    .catch(errors => {
                        console.log(errors)
                    });

                    const _MS_PER_DAY = 1000 * 60 * 60 * 24;
                    let dob=this.std_admission_details.DateOfBirth;
                    let date1 = new Date(dob);
                    let date2 = new Date(this.ppdob);

                    // Discard the time and time-zone information.
                    const dob_date = Date.UTC(date1.getFullYear(), date1.getMonth(), date1.getDate());
                    const admission_date = Date.UTC(date2.getFullYear(), date2.getMonth(), date2.getDate());

                    let ppage = Math.floor((admission_date-dob_date) / _MS_PER_DAY);
                    if(ppage <=1825){
                        messages="You need to attained the minimum required age";
                        $('#dzo_Section').hide();
                        $('#seatAvailable').hide();
                        $('#selectschool').hide();
                        $('#validation_message').html(messages);
                        $('#validationmessages').show();
                    } else {
                        $('#selectschool').show();
                        $('#validationmessages').hide();
                    }
                }
            }
        }
    },
    mounted() {


        axios.get('getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.std_id=data['std_id'];
            let user_type=data['user_type'];
            if(data['user_type']!="Parent"){
                this.is_student=true;
            }
            this.getstudentPersonalDetails(user_type);
            this.getdzongkhagList(user_type);
        })
        .catch(errors => {
            console.log(errors)
        });

        $('.select2').select2({
        theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.loadVlidation();
        this.loadGenderList();
    },
}
</script>
