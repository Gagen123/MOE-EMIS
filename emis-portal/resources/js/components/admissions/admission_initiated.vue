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
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >CID No/Reference  : </label>
                        <label class="text-primary">{{std_admission_details.CidNo}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Name of Student :</label>
                        <label class="text-primary">{{ std_admission_details.FirstName}} {{ std_admission_details.MiddleName=='null' ? '': std_admission_details.MiddleName}} {{ std_admission_details.LastName=='null' ? '': std_admission_details.LastName}}</label>
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
                <template v-if="!is_student">
                    <div class="row form-group">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label class="required" >Admission For:<span class="text-danger">*</span></label>
                            <input type="radio" name="registrationType" @click="showsection('ECCD')" value="ECCD" id="new"> ECCD
                            <input type="radio" name="registrationType" @click="showsection('PP')" value="PP" id="existing" class="ml-4"> Class PP
                            <input type="radio" name="registrationType" @click="showsection('Abroad')" value="Abroad" id="existing" class="ml-4"> Any class from Abroad
                        </div>
                    </div>
                </template>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none" id="dzo_Section">
                        <label class="required">Dzongkhag/Thromde <span class="text-danger">*</span><span class="text-danger"></span></label>
                        <select name="dzongkhag" v-model="student_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('dzongkhag') }" class="form-control select2" id="dzongkhag">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none" id="school_Section">
                        <label>School <span class="text-danger">*</span></label>
                        <select v-model="student_form.school" :class="{ 'is-invalid select2 select2-hidden-accessible':student_form.errors.has('school') }" class="form-control select2" name="school" id="school">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="display:none" id="">
                        <label>Seats available </label>
                        <input v-model="student_form.seats" id="seat" type="text" name="seats"
                        class="form-control" :class="{ 'is-invalid': student_form.errors.has('remarks') }"  disabled="true" />
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
            genderArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            OrgDetails:'',
            dzongkhagList:[],
            schoolList:[],
            classList:[],
            streamList:[],
            getSeats:'',
            std_admission_details:'',
            student_form: new form({
                id:'',
                student_id:'',
                student_type:'',
                student_code:'',
                orgId:'',
                dzongkhag:'',
                gewog:'',
                class:'',
                stream:'',
                dateOfapply:'',
                remarks:'',
                std_decission:'',
            })
        }
    },
    methods:{
        submitForm(){
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            this.$Progress.start();
            let formData = new FormData();
            formData.append('student_id', this.student_form.student_id);
            formData.append('student_type', this.student_form.student_type);
            formData.append('OrgOrganizationId',this.$route.query.data.OrgOrganizationId);
            formData.append('dzongkhag', this.student_form.dzongkhag);
            formData.append('school', this.student_form.school);
            formData.append('class', this.student_form.class);
            formData.append('stream', this.student_form.stream);
            formData.append('dateOfapply', this.student_form.dateOfapply);
            formData.append('remarks', this.student_form.remarks);
            formData.append('status', 'pending');
            formData.append('std_decission', 'pending');
            axios.post('/savedetailsEnrolledStd',formData,config)
            .then(()=>{
                Toast.fire({
                    icon: 'success',
                    title: 'Data  saved successfully'
                })
            })
            .catch(()=>{console.log("Error.....")})
        },

        getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
            axios.get(uri)
            .then(Response =>{
                let data = Response.data.data;
                this.dzongkhagList = data;
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
            }).catch(error => console.log(error));

        },
        getstudentPersonalDetails(){
            axios.get('/getStudentDetailsFromPortal/NA')
                .then(response => {
                let data = response.data;
                if(data != ""){
                    this.std_admission_details=data;
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
        getclassList(id){
            let orgId=$('#school').val();
            if(id!=""){
                orgId=id;
            }
            axios.get('/masters/loadClassStreamSection/NA/' +orgId)
            .then(Response =>{
                let data = Response.data;
                this.classList = data;
            })
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
        getseatdetailsbyOrgId(){
            let orgId=$('#school').val();
            axios.get('/masters/getseatdetailsbyOrgId/' +orgId)
            .then(Response =>{
                let data = Response.data.data;
                this.getSeats = data;data
            })
        },
        // getstreamList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
        //     axios.get(uri)
        //     .then(Response =>{
        //         let data = Response.data.data;
        //         this.streamList = data;
        //     })

        // },
        getOrgDetails(id){
            axios.get('loadOrganizationDetailsbyOrgId/' +id)
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
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
            $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#school').attr('class').includes('select2-hidden-accessible')){
            $('#school').addClass('select2-hidden-accessible');
            }
            if(!$('#class').attr('class').includes('select2-hidden-accessible')){
            $('#class').addClass('select2-hidden-accessible');
            }
            if(!$('#stream').attr('class').includes('select2-hidden-accessible')){
            $('#stream').addClass('select2-hidden-accessible');
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
                $('#'+errid).html('');
            }
        },

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag"){
                this.student_form.dzongkhag=$('#dzongkhag').val();
                let type=$('input[name="registrationType"]:checked').val();
                this.getschoolList($('#dzongkhag').val(),type);
            }
            if(id=="school"){
                this.student_form.school=$('#school').val();
                this.getclassList($('#school').val());
            }
            if(id=="class"){
                this.student_form.class=$('#class').val();
                // this.getstreamListByid($('#class').val());

            }
            if(id=="stream"){
                this.student_form.stream=$('#stream').val();
                // this.getstreamList($('#stream').val);

            }
        },
        getschoolList(dzo_id,type){
            this.schoolList=[];
            let uri = 'loadSchoolList/'+dzo_id+'/'+type;
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
        showsection(type){
            $('#dzo_Section').show();
        }
    },
    mounted() {
        $('.select2').select2({
        theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.loadGenderList();
        this.getdzongkhagList();
        this.getclassList();
        this.getseatdetailsbyOrgId();
        axios.get('getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['user_type']!="Parent"){
                this.is_student=true;
            }
        })
        .catch(errors => {
            console.log(errors)
        });
        this.getstudentPersonalDetails();
    },
}
</script>
