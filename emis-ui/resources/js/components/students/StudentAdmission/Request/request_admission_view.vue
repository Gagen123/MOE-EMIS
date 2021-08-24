<template>
    <div>
        <div class="card-body">
            <form id="" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
                <div class="form-group" id="main_form">
                    <h6><u>Student Details</u></h6><br>
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >CID No/Reference  : </label>
                            <label class="text-primary">{{std_admission_details.student_code}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Name of Student :</label>
                            <label class="text-primary">{{std_admission_details.name}}</label>
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
                    <label>Present School Details: </label>
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Class : </label>
                            <label class="text-primary">{{ }}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >School : </label>
                            <label class="text-primary"><span id="gewogid"></span>{{std_admission_details.organization_name}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Dzongkhag :</label>
                            <label class="text-primary"><span id="vilageId"></span> {{dzongkhagArray[std_admission_details.organization_dzo]}}</label>
                        </div>
                    </div>
                </div>
                <hr><br>
                <div class="form-group" id="main_form">
                    <h6><u>Admission Request Details</u></h6><br>
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Dzongkhag For Admission Request: </label>
                            <label class="text-primary">{{dzongkhagArray[std_admission_details.dzongkhag]}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Date of Application:</label>
                            <label class="text-primary">{{ std_admission_details.dateOfapply}}</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label class="required" >Reasons :</label>
                            <label class="text-primary">{{ std_admission_details.reasons}}</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="main_form">
                    <h6><u>Supporting Documents</u></h6><br>
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Dzongkhag For Admission Request: </label>
                            <a href="#" @click="openfile(std_admission_details.fileName, std_admission_details.filePath)" class="fa fa-eye"> View</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row md-12">
                    <div class="form-group col-md-12" >
                        <label>Remarks From SPCD: <span class="text-danger">*</span><span class="text-danger"></span></label>
                            <textarea v-model="form.remarks" id="remarks" type="text" name="remarks" class="form-control" :class="{ 'is-invalid': form.errors.has('remarks') }"   />
                        <has-error :form="form" field="remarks"></has-error>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            student_id:'',
            std_admission_details:'',
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
            form: new form({
                id: '', 
                remarks:'',
            })
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

        /**
         * method to reset form
         */
        restForm(){
            this.form.cid_passport= '';
            this.form.first_name = '';
            this.form.middle_name = '';
            this.form.last_name= '';
            this.form.dob= '';
            this.form.sex_id= '';
            this.form.mother_tongue= '';
            this.form.status= '';
            this.form.fulladdress='';
            this.form.country = '';
            this.form.city = '';
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/students/saveStudentAboard',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: ' Detail is added successfully'
                    })
                    this.$router.push('/studentaboard_list');
                })
                .catch(() => {
                    console.log("Error......");
                    this.applyselect();
                })
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
        applyselect(type){
            if(type=="std"){
                if(!$('#sex_id').attr('class').includes('select2-hidden-accessible')){
                    $('#sex_id').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_tongue').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_tongue').addClass('select2-hidden-accessible');
                }
            }
            
        },
        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html(''); 
            }
        },

        loadAdmissionRequest(std_id){
			axios.get('/students/loadAdmissionRequest/'+std_id)
			.then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.std_admission_details = data[0];
                }
			});
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
             
        },
        openfile(fileName, filePath){
            let file_path=filePath+'/'+fileName;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
    },
    mounted() { 
        this.loadAllActiveMasters('all_country');
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('active_mother_tongue');
        this.getdzongkhagList();
      
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.student_id = this.$route.params.data;
        this.loadAdmissionRequest(this.$route.params.data);
        
    }
}
</script>