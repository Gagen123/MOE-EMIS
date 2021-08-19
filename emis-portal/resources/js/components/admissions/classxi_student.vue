<template>
    <div class="container-fluid">
        <div class="content-header pb-0">
            <div class="content-header pt-1 pb-0">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5><b>Admission For Class XI</b></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="form-group"> 
                    <div class="card-body">
                        <form id="" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
                            <div class="form-group" id="main_form">
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label class="required" >CID No/Reference  : </label>
                                        <label class="text-primary">{{std_admission_details.CidNo}}</label>
                                    </div>
                                    <template v-if="!is_student">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label class="required" >Name of Student :</label>
                                            <label class="text-primary">{{ std_admission_details.FirstName}} {{ std_admission_details.MiddleName=='null' ? '': std_admission_details.MiddleName}} {{ std_admission_details.LastName=='null' ? '': std_admission_details.LastName}}</label>
                                        </div>
                                    </template>
                                    <template v-else>
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
                            </div>
                            <hr>
                            <div class="row-12">
                                <div class="card">
                                    <label class="card-header"><strong>Ranking Information for Each School</strong></label>
                                    <table class="table table-bordered table-striped" id="OrgDetails">
                                        <thead>
                                            <tr>
                                                <th>School Name (<i class="fa fa-fw fa-arrow-down"></i>) / Stream (<i class="fa fa-fw fa-arrow-right"></i>)</th>
                                                <th>Arts</th>
                                                <th>Commerce</th>
                                                <th>Science</th>
                                                <th>Rigzhung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td class="text-primary"></td>
                                            <td class="text-primary"></td>
                                            <td class="text-primary"></td>
                                            <td class="text-primary"></td>
                                            <td class="text-primary"></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row-12">
                                <div class="card">
                                    <label class="card-header"><strong>Application Status</strong></label>
                                    <table class="table table-bordered table-striped" id="OrgDetails">
                                        <thead>
                                            <tr>
                                                <th>School Code</th>
                                                <th>Name of School</th>
                                                <th>School Decision</th>
                                                <th>Student Decision</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <td class="text-primary"></td>
                                            <td class="text-primary"></td>
                                            <td class="text-primary"></td>
                                            <td class="text-primary"></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="form-group">
                <h5>Apply for Admission</h5>
                    <form id="" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
                        <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display:none" id="selectschool">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Dzongkhag/Thromde</th>
                                        <th>School</th>
                                        <th>Class</th>
                                        <th>Stream</th>
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
                                            XI
                                        </td>
                                        <td>
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
                                            <select v-model="student_form.school" :class="{ 'is-invalid': student_form.errors.has('school') }" @change="getstreamList(),removeerror()" class="form-control" name="school" id="school">
                                                <option value="">--- Please Select---</option>
                                                <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                                            </select>
                                            <has-error :form="student_form" field="school"></has-error>
                                        </td>
                                        <td>
                                            <span>{{this.std_class}}</span>
                                        </td>
                                        <td>
                                            <select v-model="student_form.stream" :class="{ 'is-invalid': student_form.errors.has('stream') }"  class="form-control" name="stream" id="stream">
                                                <option value="">--- Please Select---</option>
                                                <option v-for="(item, index) in streamList" :key="index" v-bind:value="item.id">{{item.stream}}</option>
                                            </select>
                                            <has-error :form="student_form" field="stream"></has-error>
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan='5'>
                                            <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                            @click="addMore()"><i class="fa fa-plus"></i> Save & Add</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <hr>
                    <div class="row form-group fa-pull-right" id="finalbtn" style="display:none">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-flat btn-primary" @click="submitDetail()"> <i class="fa fa-save"></i> submit</button>
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
            student_form: new form({
                id:'',
                seats:0,
                admission_type:'',
                student_id:'',
                dzongkhag:'',
                school:'',
                class:'',
                stream:'',
                dateOfapply:'',
                remarks:'',
                std_decission:'',
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
                        this.student_form.dzongkhag=this.parent_school_dzongkhag;
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
                    this.std_class=data.class;
                    this.classList.push(this.std_class);
                    $('#classsection').show();
                });
            }catch(e){
                console.log('error loadactivedzongkhags '+e);
            }
        },

        getParentSchoolList(org_id){
            //this is for test only. Remove the line as org_id will be dynamically assigned
            org_id ='757d19b2-e9d9-448b-a9f1-27a51c065ac5';
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

        getstreamList(){
            let orgId=$('#school').val();
            axios.get('/masters/getStreamByOrgId/' +orgId)
            .then(Response =>{
                let data = Response.data;
                this.streamList = data;
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
                console.leg(error);
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
                type = 'VI';
            } else{
                type=$('input[name="registrationType"]:checked').val();
            }
            
            this.schoolList=[];
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
            if(type=="ECCD"){
                let date1=new Date(this.eccddob);
                // let year1=date1.getFullYear();
                // let month1=date1.getMonth();
                // if(month1===0){ //Have to take into account
                //     month1++;
                //     month2++;
                // }
                //numberOfMonths = (year2 - year1) * 12 + (month2 - month1) - 1;//excluding both month1 and month2
                // numberOfMonths = (year2 - year1) * 12 + (month2 - month1);//include either of the months
                //numberOfMonths = (year2 - year1) * 12 + (month2 - month1)+1;//include both of the months
                // if(this.eccdmonth>numberOfMonths){
                //     isvalid=false;
                // }
                if(date1<dob){
                    isvalid=false;
                }
                messages="You need to attend atleast "+this.eccdmonth+' months old to get register. You will attend that month only at '+this.y;
            }
            else{
                let date1=new Date(this.ppdob);
                // let year1=date1.getFullYear();
                // let month1=date1.getMonth();
                // if(month1===0){ //Have to take into account
                //     month1++;
                //     month2++;
                // }
               // numberOfMonths = (year2 - year1) * 12 + (month2 - month1) - 1;//excluding both month1 and month2
                // numberOfMonths = (year2 - year1) * 12 + (month2 - month1);//include either of the months
                //numberOfMonths = (year2 - year1) * 12 + (month2 - month1)+1;//include both of the months
                if(dob< date1){
                    isvalid=false;
                }
                messages="You need to attend atleast "+this.ppmonth+' months old to get register. You are eligible to register only at the total month of '+this.ppmonth;
            }
            if(isvalid){
                $('#selectschool').show();
                $('#validationmessages').hide();
            }else{
                $('#dzo_Section').hide();
                $('#seatAvailable').hide();
                $('#validation_message').html(messages);
                $('#validationmessages').show();
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
