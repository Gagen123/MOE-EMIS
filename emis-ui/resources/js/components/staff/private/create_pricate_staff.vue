<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-details-tabs " @click="shownexttab('','personal-details-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-1">Appointment</label>
                        </a>
                    </li>                  
                    <li class="nav-item qualification-tab">
                        <a class="nav-link " data-toggle="pill" @click="shownexttab('appointment-tab','qualification-tab')" role="tab">
                            <label class="mb-1">Qualification</label>
                        </a>
                    </li>  
                </ul>
            </div>
            <div class="card-body pt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Nationality:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.country_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('country_id') }" class="form-control select2" name="country_id" id="country_id">
                                    <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.nationality }}</option>
                                </select>
                                <has-error :form="personal_form" field="country_id"></has-error>
                            </div> 
                            
                        </div>
                        <div class="form-group row" id="bhutanese_address">
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
                        <div class="form-group row" id="foreign_address" style="display:none">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Address:</label>
                                <textarea @change="remove_error('address')" class="form-control" v-model="personal_form.address" :class="{ 'is-invalid': personal_form.errors.has('address') }" name="address" id="address"></textarea>
                                <has-error :form="personal_form" field="address"></has-error>
                            </div>
                        </div> 
                        <div class="form-group row"> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">CID/Work Permit No:<i class="text-danger">*</i></label>
                                <input type="text" v-model="personal_form.cid_work_permit" @change="remove_error('cid_work_permit')" :class="{ 'is-invalid': personal_form.errors.has('cid_work_permit') }"  class="form-control" name="cid_work_permit" id="cid_work_permit">
                                <has-error :form="personal_form" field="cid_work_permit"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Full Name:<i class="text-danger">*</i></label>
                                <input type="text" @change="remove_error('name')" v-model="personal_form.name" :class="{ 'is-invalid': personal_form.errors.has('name') }" class="form-control" name="name" id="name"  readonly>
                                <has-error :form="personal_form" field="name"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Date of Birth:<i class="text-danger">*</i>
                                    <img src="img/question.png" data-toggle="tooltip" title="Please provide correct date of birth. System will use this data for wishing his/her birth day" class="brand-image img-circle elevation-3" style="width:25px">
                                </label>
                                <input type="date" v-model="personal_form.dob" :class="{ 'is-invalid': personal_form.errors.has('dob') }" id="dob" name="dob" class="form-control">
                                <has-error :form="personal_form" field="dob"></has-error>
                            </div> 
                        </div>
                        <div class="form-group row"> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Sex:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.sex_id" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('sex_id') }" class="form-control select2" name="sex_id" id="sex_id">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="sex_id"></has-error>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Marital Status:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.marital_status" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('marital_status') }" class="form-control select2" name="marital_status" id="marital_status">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in marital_statusList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="marital_status"></has-error>
                            </div> 
                        </div>
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
                        </div>
                       <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Position Title:<i class="text-danger">*</i></label>
                                <select v-model="personal_form.position_title" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('position_title') }" class="form-control select2" name="position_title" id="position_title">
                                    <option value=""> --Select--</option>
                                    <option v-for="(item, index) in positiontitleList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="personal_form" field="position_title"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Working Agency:<i class="text-danger">*</i></label>
                                <!-- <input type="text" class="form-control" name="emp_id" id="working"  readonly> -->
                                <select v-model="personal_form.working_agency_id" @change="remove_error('working_agency_id')" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('working_agency_id') }" class="form-control select2" name="working_agency_id" id="working_agency_id">
                                    <option value=""> --Select--</option>
                                    <option value="1"> Mothithang HSS</option>
                                    <option value="2"> Yangchenphug HSS</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                                <has-error :form="personal_form" field="working_agency_id"></has-error>
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
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Compulsory Subject:<i class="text-danger">*</i></label>
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
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Remarks:</label>
                                <textarea @change="remove_error('remarks')" class="form-control" v-model="personal_form.remarks" :class="{ 'is-invalid': personal_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                                <has-error :form="personal_form" field="remarks"></has-error>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('personal-details-tabs','qualification-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="qualification-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="alert alert-default-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    Details for: Karma Sonam, Teacher
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
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
                                        <tr v-for='(qua, index) in qualificationlist' :key="index">
                                            
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.description" id="description">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Initial Professional Qualification</option>
                                                    <option value="2">Heighest Professional Qualification</option>
                                                    <option value="3">Heighest Acadamic Qualification</option>
                                                    <option value="4">Training</option>
                                                    <option value="4">Others Qualification</option>
                                                </select>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.qualification" id="qualification">
                                                    <option value="">--Select--</option>
                                                    <option value="1">PTC</option>
                                                    <option value="2">ZTC</option>
                                                    <option value="3">B.Ed Primary</option>
                                                    <option value="4">B.Ed Secondary</option>
                                                    <option value="5">PGCE</option>
                                                    <option value="6">PGDE</option>
                                                    <option value="7">B.Ed Secondary</option>  
                                                    <option value="1">B. COM</option>
                                                    <option value="2">M. COM</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.coursemode" id="coursemode">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Mix Mode</option>
                                                    <option value="2">Full Mode</option>
                                                    <option value="3">Part Time</option>
                                                    <option value="4">Distance Education</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" v-model="qua.coursetitle" id="coursetitle" class="form-control h-50">
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.firstsub" id="firstsub">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Biological Science</option>
                                                    <option value="2">Buddhist Studies</option>
                                                    <option value="3">Business Administration</option>
                                                    <option value="4">Community</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.secondsub" id="secondsub">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Biological Science</option>
                                                    <option value="2">Buddhist Studies</option>
                                                    <option value="3">Business Administration</option>
                                                    <option value="4">Community</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.country" id="country">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Bhutan</option>
                                                    <option value="2">AFGHANISTAN</option>
                                                    <option value="3">ANGOLA</option>
                                                    <option value="4">CHINA</option> 
                                                    <option value="5">INDIA</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <input type="date" v-model="qua.startdate" id="startdate" class="form-control h-50">
                                            </td>
                                            <td>
                                                <input type="date" v-model="qua.enddate" id="enddate" class="form-control h-50">
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td colspan="9"> 
                                                <button type="button" class="btn btn-xs btn-primary" id="addMore" 
                                                @click="addMore('qua')"><i class="fa fa-plus"></i> Add More</button>
                                                <button type="button" class="btn btn-xs btn-danger" id="addMore" 
                                                @click="remove('qua')"><i class="fa fa-trash"></i> Remove</button>
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('','personal-details-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button v-if="modalfinalactionedit" class="btn btn-primary" @click="shownexttab('qualification-tab','finalsubmit')">Upate <i class="fa fa-arrow-right"></i></button>
                                <button v-if="!modalfinalactionedit" class="btn btn-primary" @click="shownexttab('qualification-tab','finalsubmit')">Save & Submit <i class="fa fa-arrow-right"></i></button>
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
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            subjectList:[],
            cureerstageList:[],

            personal_form: new form({
                personal_id: '',
                emp_type: 'Private',
                cid_work_permit:'',
                name:'',
                position_title:'',
                sex_id:'',
                dob:'',
                marital_status:'',
                country_id:'c879c252-b4f7-4ab6-964b-1661ae9f0aa5',//insert id of bhutan to preselect
                dzongkhag:'',
                village_id:'',
                gewog:'',
                working_agency_id:'',
                contact_number:'',
                email:'',
                comp_sub:'',
                elective_sub1:'',
                elective_sub2:'',
                currier_stage:'',
                emp_file_code:'',
                remarks:'',
            }),
        }
    },
    methods: {
        loadactivecountryList(uri="masters/load_global_masters/all_active_country"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.countryList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadactivedzongkhagList(uri="masters/load_global_masters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        async getgewoglist(id){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadactivesex_idList(uri="masters/load_global_masters/all_active_gender"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sex_idList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadactivemaritalList(uri="masters/load_staff_masters/all_active_marital_list"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.marital_statusList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        shownexttab(presentclass,nextclass){  
            if(this.validatetabs(presentclass)){
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                //body
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
                if(nextclass=="finalsubmit"){ 
                    Swal.fire({
                        text: "Are you sure you wish to take this action ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Success!',
                                'Staff details is added successfully.',
                                'success',
                            )
                            this.$router.push("/eccd_staff_details");
                        }
                    });
                }
            }
        },
        
    },
     mounted() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        this.loadactivecountryList();
        this.loadactivedzongkhagList();
        this.loadactivesex_idList();
        this.loadactivemaritalList();
    },
    
}
</script>