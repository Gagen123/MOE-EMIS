<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="warning">
            <h5 class="bg-gradient-danger">Please Note!</h5>
            <div id="message"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Student Details</label>
                        </a>
                    </li>
                    <li class="nav-item details-tab" @click="shownexttab('details-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Add Admission Details</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <br>
                        <div class="form-group" id="main_form">
                            <div class="row form-group">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label class="required" >CID No/Reference  : </label>
                                    <label class="text-primary">{{std_admission_details.student_code ? std_admission_details.student_code : std_admission_details.CidNo}}</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <label class="required" >Name of Student :</label>
                                    <label class="text-primary">{{std_admission_details.Name ? std_admission_details.Name : std_admission_details.FirstName+' '+std_admission_details.MiddleName+' '+std_admission_details.LastName}}</label>
                                </div>
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
                            <div v-if="is_student">
                                <label>Present School Details: </label>
                                <div class="row form-group">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <label class="required" >Class : </label>
                                        <label class="text-primary">{{ this.std_present_class }}</label>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                        <label class="required" >School : </label>
                                        <label class="text-primary"><span id="gewogid"></span>{{ this.std_present_school}}</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label class="required" >Dzongkhag :</label>
                                        <label class="text-primary"><span id="vilageId"></span> {{dzongkhagArray[this.std_present_dzo]}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr><br>
                        <div class="form-group" id="main_form">
                            <h6><u>Parents Details</u></h6><br>
                            <table id="list-student-left" class="table table-bordered table-striped table-head-fixed">
                                <thead>
                                    <tr>
                                        <th >No.</th>
                                        <th >Name</th>
                                        <th >Relation</th>
                                        <th >CID</th>
                                        <th >Occupation</th>
                                        <th >Permanent Address</th>
                                        <th >Working Address</th>
                                        <th >Residence Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, count) in parents_details" :key="count">
                                        <td>{{ count + 1 }} </td>
                                        <td>{{ item.Name }}</td>
                                        <td>{{ item.Relationship }}</td>
                                        <td>{{ item.CidNo }}</td>
                                        <td>{{ item.CmnOccupationId }}</td>
                                        <td>{{  }}</td>
                                        <td>{{ item.WorkAddress }}</td>
                                        <td>{{ item.ResidenceAddress }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('details-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="details-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <br>
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Class:<span class="text-danger">*</span></label>
                                <select v-model="class_form.class" :class="{ 'is-invalid select2 select2-hidden-accessible': class_form.errors.has('class') }"  class="form-control select2" name="class" id="class">
                                    <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                                </select>
                                <has-error :form="class_form" field="class"></has-error>
                            </div>
                        </div>
                        <hr>
                        <table id="sen-student-list-table" class="table table-bordered text-sm table-hover">
                            <tbody>
                                <tr>
                                    <td style="width:15%"><label>Student Type: <span class="text-danger">*</span></label></td>
                                    <td style="width:35%">
                                        <select v-model="class_form.student_type" :class="{ 'is-invalid select2 select2-hidden-accessible': class_form.errors.has('student_type') }" class="form-control select2" name="student_type" id="student_type">
                                            <option value=""> --Select--</option>
                                            <option v-for="(item, index) in studentTypeList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                        </select>
                                        <has-error :form="class_form" field="student_type"></has-error>
                                    </td>
                                    <td style="width:15%"><label>Feeding Modality:<span class="text-danger">*</span></label></td>
                                    <td style="width:35%">
                                        <input  type="checkbox" v-model="class_form.feeding" id="feeding1" value="1" tabindex=""/> One Meal
                                        <input  type="checkbox" v-model="class_form.feeding" id="feeding2" value="2" tabindex=""/> Two Meals
                                        <input  type="checkbox" v-model="class_form.feeding" id="feeding3" value="3" tabindex=""/> Three Meals
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%"><label>Is Needy: <span class="text-danger">*</span></label></td>
                                    <td style="width:35%">
                                        <input  type="radio" v-model="class_form.isNeedy" id="needy" value="1" tabindex=""/> Yes
                                        <input  type="radio" v-model="class_form.isNeedy" id="needy" value="0" tabindex=""/> No
                                    </td>
                                    <td style="width:15%"><label>Scholarship:<span class="text-danger">*</span></label></td>
                                    <td style="width:35%">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for="(item, index) in studentscholarshipList" :key="index">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" :name="'scholarship'+item" :id="'customRadio'+index" v-model="class_form.scholarship" type="radio" :value="item.id">
                                                <label :for="'customRadio'+index" :name="'scholarship'+item" class="font-weight-normal custom-control-label">{{item.Name}}</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%"><label>Diet Type:<span class="text-danger">*</span></label></td>
                                    <td colspan="3" style="width:35%">
                                        <input type="radio" name="feeding_type" :class="{ 'is-invalid': class_form.errors.has('feeding_type') }" v-model="class_form.feeding_type" value="Vegetarian" id="feeding_type"> Vegetarian 
                                        <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('feeding_type') }" name="feeding_type" v-model="class_form.feeding_type" value="Non-Vegetarian" id="feeding_type1"> Non-Vegetarian
                                        <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('feeding_type') }" name="feeding_type" v-model="class_form.feeding_type" value="Eggetarian" id="feeding_type2"> Eggetarian
                                        <has-error :form="class_form" field="feeding_type"></has-error>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="width:65%">
                                        <label> 
                                            Do you think the children/student has a disability? (Eg: difficulty seeing, hearing, walking, 
                                            learning or remembering, focusing, with fine motor skills, self care, being understood, controlling behavior, 
                                            socializing or playing) 
                                        </label>
                                    </td>
                                    <td style="width:35%">
                                         <input type="radio" name="disability" :class="{ 'is-invalid': class_form.errors.has('disability') }" v-model="class_form.disability" value="Yes" id="no_meals1"> Yes 
                                        <input type="radio" class="ml-4" :class="{ 'is-invalid': class_form.errors.has('disability') }" name="disability" v-model="class_form.disability" value="No" id="no_meals2"> No
                                        <has-error :form="class_form" field="disability"></has-error>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Submit </button>
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
            student_id:'',
            student_code:'',
            is_transferred:'0',
            is_student:false,
            std_present_class:'',
            std_present_school:'',
            std_present_dzo:'',
            std_admission_details:'',
            std_class:'',
            parents_details:[],
            genderArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            sex_idList:[],
            countryList:[],
            dzongkhagList:[],
            std_gewog_list:[],
            std_villageList:[],
            motherTongueList:[],
            classList:[],
            streamList:[],
            streamListSelected:[],
            studentTypeList:[],
            studentscholarshipList:[],
            sectionList:[],
            orgid:'',
            class_form: new form({
                student_id:'',
                disability:'',
                special_benifit:[],
                scholarship:[],
                feeding_type:'', isNeedy:0, feeding:[],
                meal_type:'', no_meals:'', student_type:'', section:'', stream:'', class:'',class_stream_id:'',
            }),
        }
    },

    methods:{

        /**
         * method to remove error
         */
        removeerror(fieldid){
			if($('#'+fieldid).val()!=""){
				$('#'+fieldid).removeClass('is-invalid');
				$('#'+errid).html(''); 
			}
		},

        loadAllActiveMasters(type){
            axios.get('masters/loadGlobalMasters/'+type)
            .then(response =>{
                let data = response;
                if(type=="active_mother_tongue"){
                    this.motherTongueList = data.data.data;
                }
                if(type=="all_active_dzongkhag"){
                    this.dzongkhagList = data.data.data;
                }
                if(type=="all_active_gender"){
                    this.sex_idList = data.data.data;
                }
                if(type=="all_country"){
                    this.countryList = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadAllStudentMasters(type){
            axios.get('masters/loadStudentMasters/'+type)
            .then(response =>{
                let data = response;
                if(type=="StudentType_Active"){
                    this.studentTypeList = data.data.data;
                }
                if(type=="ScholarType_Active"){
                    this.studentscholarshipList = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
			axios.get(uri)
			.then(Response =>{
			let data = Response.data.data;
			for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
                $('#dzongkhag').prop('disabled',false);  
            }).catch(error => console.log(error));

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
        loadAdmissionDetails(std_id, std_code){
            var uri='';
            if(std_code == null){
                uri = '/students/admission/getStudentDetails/admission_'+std_id;
            } else{
                this.is_student = true;
                uri = '/students/admission/getStudentDetails/'+std_id;
                this.checkTransferStatus(std_id);
            }
			axios.get(uri)
			.then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.std_admission_details = data;
                    this.parents_details = data.parents;
                    this.class_form.class = data.admission_class.class_id;
                    $('#class').val(data.admission_class.class_id).trigger('change');
                    $('#class').prop('disabled',true);
                    this.getStudentSchoolDetails(data.class.OrgClassStreamId);
                }
			});
		},
        getStudentSchoolDetails(OrgClassStreamId){
            let uri = '/organization/getStudentSchoolDetails/'+ OrgClassStreamId;
            try{
                axios.get(uri).then(response => {
                    let data= response.data.data;
                    //have to check whether the student passed or failed
                    this.std_present_class = data[0].class;
                    this.std_present_school = data[0].name;
                    this.std_present_dzo = data[0].dzongkahgId;
                    // let index = this.class_array.indexOf(this.std_present_class);
                    // index++;
                    // this.std_class=this.class_array[index];
                    // this.classList.forEach(element => {
                    //     //need to check pass or fail
                    //     if(element.class === this.std_class){
                    //         this.class_form.class = element.id;
                    //         $('#class').val(element.id).trigger('change');
                    //         $('#class').prop('disabled',true);
                    //     }
                    // });
                });
            }catch(e){
                console.log('error loadactivedzongkhags '+e);
            }
        },
        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        checkTransferStatus(std_id){
            uri = '/students/admission/getTransferDetails/'+std_id;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.is_transferred = '1';
                } else {
                    $('#warning').show();
                    $('#message').html('Student has not taken Transfer Certificate from previously attended school. <br> Thank you!');
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to show next and previous tab
         */
        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to submit this details for approval ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed){
                        this.class_form.post('/students/admission/saveAdmitStudent',this.class_form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/new_student_admission');
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured. Try again.'
                            });
                            console.log("Error:"+error);
                        })
                    }
                });
            }
            else{
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
            }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="student_type"){
                alert($('#student_type').val());
                this.class_form.student_type=$('#student_type').val();
            }
        },
    },
    mounted() { 
        this.loadAllActiveMasters('all_country');
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('active_mother_tongue');
        this.loadAllStudentMasters('StudentType_Active');
        this.loadAllStudentMasters('ScholarType_Active');
        this.loadAllStudentMasters('SpBenefit_Active');
        this.getdzongkhagList();
        this.loadGenderList();
        this.loadClassList();
      
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.student_id = this.$route.params.data.id;
        this.student_code = this.$route.params.data.std_code;
        this.loadAdmissionDetails(this.$route.params.data.id, this.$route.params.data.std_code);
        
    }
}
</script>