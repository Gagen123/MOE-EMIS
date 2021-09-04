<template>
    <div>
        <br>
        <div>
            <div class="form-group row" id="searchemp">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5"><span id="empidcid">Student Code/Student CID</span><i class="text-danger">*</i> </label>
                    <input type="text" v-model="student_form.student_id" @change="remove_error('student_id')" :class="{ 'is-invalid': student_form.errors.has('student_id') }"  class="form-control" name="student_id" id="student_id">
                    <has-error :form="student_form" field="student_id"></has-error>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mt-4 pt-2">
                    <button type="button" class="btn btn-sm btn-primary" @click="loadAdmissionDetails()"><i class="fa fa-download"></i> Fetch</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group" id="main_form">
            <h6><u>Student Details</u></h6><br>
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
            <label>Present School Details: </label>
            <div class="row form-group">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label class="required" >Class : </label>
                    <label class="text-primary">{{ }}</label>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
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
        <div class="row form-group">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Please Select the Class for Admission:<span class="text-danger">*</span></label>
                <select v-model="student_form.class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('class') }"  class="form-control select2" name="class" id="class">
                    <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                </select>
                <has-error :form="student_form" field="class"></has-error>
            </div>
        </div>
        <div class="row form-group fa-pull-right">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-primary" @click="saveForm('save')">Save </button>
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
            std_admission_details:'',
            parents_details:[],
            genderArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            classList:[],
            sex_idList:[],
            countryList:[],
            dzongkhagList:[],
            std_gewog_list:[],
            std_villageList:[],
            motherTongueList:[],
            student_form: new form({
                id:'',
                admission_type:'',
                student_id:'',
                dzongkhag:'',
                school:'',
                class:'',
                actiontype:'non-portal'
            })
        }
    },

    methods:{

        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
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
        /**
         * to load the class list
         */
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
        loadAdmissionDetails(){
            let std_code='transfer-'+$('#student_id').val();
            let uri = '/students/admission/getStudentDetails/'+std_code;
			axios.get(uri)
			.then(response => {
                let data = response.data.data;
                if(data != "" && data != null){
                    this.std_admission_details = data;
                    this.parents_details = data.parents;
                    this.student_form.student_id = data.id;
                } else {
                    Swal.fire({
                    text: "Student with request CID/Student Code was not found",
                    icon: 'info',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok!',
                    });
                }
			});
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="class"){
                this.student_form.class=$('#class').val();
            }
        },
        saveForm: function(type){
            if(type=="save"){
                this.student_form.post('/students/admission/saveNewTransferStudent',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_registration_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
    },
    mounted() { 
        this.loadAllActiveMasters('all_country');
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('active_mother_tongue');
        this.getdzongkhagList();
        this.loadGenderList();
      
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.loadClassList();
        
    }
}
</script>
