<template>
<div class="container-fluid">
    <div class="content-header pb-0">
        <div class="content-header pt-1 pb-0">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5><b>Admission for Enrolled Student</b></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row-12">
                 <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <input type="radio" name="snationality" v-model="std_admission_details.snationality" value="Bhutanese" id="s-bhutanese" @click="showstdidentity('Student-Bhutanese')" checked> Bhutanese <br>
                    <input type="radio" name="snationality" v-model="std_admission_details.snationality" value="Foreign" id="s-foreign" @click="showstdidentity('Student-Non-Bhutanese')"> Non-Bhutanese
                    <span class="text-danger" id="snationality_err"></span>
                  </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >CID No/Reference  : </label>
                        <label class="text-primary">{{std_admission_details.CidNo}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Student Code : </label>
                        <label class="text-primary">{{ std_admission_details.student_code}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Name of Student :</label>
                        <label class="text-primary">{{ std_admission_details.first_name}} {{ std_admission_details.middle_name}} {{ std_admission_details.last_name}}</label>
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
                    <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Qualification :</label>
                        <label class="text-primary">{{std_admission_details.DateOfBirth}}</label>
                    </div> -->
                </div>
                 <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Dzongkhag : </label>
                        <label class="text-primary">{{std_admission_details.CidNo}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Gewog : </label>
                        <label class="text-primary">{{ std_admission_details.student_code}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Village :</label>
                        <label class="text-primary">{{ std_admission_details.first_name}} </label>
                    </div>
                </div>
            </div>

            <div class="row-12">
                <div class="card">
                    <label class="card-header"><strong>School Information</strong></label>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>School Code</th>
                                <th>Name of School</th>
                                <th>Dzongkhag/ Thromde</th>
                                <th>Gewog / Thromde Demkhong</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="text-primary">0001</td>
                            <td class="text-primary">Gelephu HSS</td>
                            <td class="text-primary">Sarpang</td>
                            <td class="text-primary">{{std_admission_details.gewog_name}}</td>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="content-header pb-0">
                <div class="content-header pt-1 pb-0">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5><b>Select School</b></h5>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row md-12">
                <div class="form-group col-md-4">
                    <label class="required">Dzongkhag/Thromde <span class="text-danger">*</span><span class="text-danger"></span></label>
                    <select name="dzongkhag" v-model="student_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('dzongkhag') }" class="form-control select2" id="dzongkhag"  >
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Class<span class="text-danger">*</span></label>
                    <select v-model="std_admission_details.class_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('class') }" class="form-control select2" name="class" id="class">
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in classList  " :key="index" v-bind:value="item.id">{{item.name}}</option>
                    </select>
                </div>
            </div>
            <div class="row md-12">
                <div class="form-group col-md-4">
                    <label>Apply Date:<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" @change="removeerror('dateOfapply')" :class="{ 'is-invalid': form.errors.has('dateOfapply') }" id="dateOfapply" v-model="student_form.dateOfapply" placeholder="Date of apply">
                    <has-error :form="form" field="date"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Remarks</label>
                    <textarea v-model="student_form.remarks" id="remarks" type="text" name="remarks"  placeholder=" Enter Remarks"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('remarks') }" />
                    <has-error :form="form" field="remarks"></has-error>
                </div>
            </div>
            <hr>
            <div class="footer float-right" >
                <button type="button" v-on:click="resetForm" class="btn btn-danger"><i class="fas fa-redo"></i> Reset</button>
                <button type="button" v-on:click="submitForm" class="btn btn-success"> <i class="fas fa-save"></i> Apply</button>
            </div>
        </div>
    </div>
</div>

</template>

<script>
export default {
    data(){
        return{
            std_admission_details:[],
            instructor_details:[],
            dzongkhagList:[],
            schoolList:[],
            classList:[],
            genderArray:{},
            form: new form({
                id:'',
                contact_no:'',
                alternative_email:'',
                dzongkhag:'',
                school:'',
                class:'',
                stream:'',
                date:'',
                remarks:''
            }),
            student_form: new form({
                id:'',
                student_id:'',
                dzongkhag:'',
                school:'',
                class:'',
                stream:'',
                dateOfapply:'',
                remarks:'',
            })
        }
    },
    methods:{
        getstudentPersonalDetails(id){
            axios.get('students/admission/getStudentDetails/admission_'+id)
            .then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.std_admission_details=data;
                }
            });
        },
        loadgenderList(uri = 'masters/loadGlobalMasters/all_active_gender'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },

        resetForm: function(event){
            this.form.reset();
        },
        submitForm(){
                const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            this.$Progress.start();
            let formData = new FormData();
            formData.append('student_id', std_admission_details.student_id);
            formData.append('dzongkhag', std_admission_details.dzongkhag);
            formData.append('school', std_admission_details.school);
            formData.append('class', std_admission_details.class);
            formData.append('dateOfapply', std_admission_details.dateOfapply);
            formData.append('remarks', std_admission_details.remarks);

                axios.post('/savedetailsEnrolledStd',formData,config)
            .then(()=>{
                Toast.fire({
                    icon: 'success',
                    title: 'Data  updated successfully'
                })
                this.$Progress.finish()
            })
            .catch(()=>{console.log("Error.....")})
        },
        // getStudentdetials(){
        //     axios.get('/getstudentdetails')
        //     .then(response => {
        //         this.student_details  = response.data
        //         std_admission_details.id  =this.student_details.id;
        //         std_admission_details.cid = this.student_details.cid;
        //         std_admission_details.student_code = this.student_details.student_code;
        //         std_admission_details.name = this.student_details.name;
        //         std_admission_details.dob = this.student_details.dob;
        //         std_admission_details.gender = this.student_details.gender;
        //         std_admission_details.school_code = this.student_details.school_code;
        //         std_admission_details.schoolName = this.student_details.schoolName;
        //     }).catch(error => console.log(error));
        // },
        getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
            axios.get(uri)
            .then(Response =>{
            let data = Response.data.data;
            this.dzongkhagList = data;
            }).catch(error => console.log(error));
        },

        // getschoolList(id){
        //     let dzoId=$('#dzongkhag').val();
        //     if(id!=""){
        //         dzoId=id;
        //     }
        //     axios.get('/masters/getOrgList/' +dzoId)
        //     .then(Response =>{
        //         let data = Response.data.data;
        //         this.schoolList = data;
        //     })
        // },
        // getclassList(id){
        //     let orgId=$('#school').val();
        //     if(id!=""){
        //         orgId=id;
        //         console.log(orgId);
        //     }
        //     axios.get('/masters/getClassByOrganizationId/' +orgId)
        //     .then(Response =>{
        //     let data = Response.data.data;
        //     this.classList = data;
        //     })
        // },

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

            async changefunction(id){
        if($('#'+id).val()!=""){
            $('#'+id).removeClass('is-invalid select2');
            $('#'+id+'_err').html('');
            $('#'+id).addClass('select2');
        }

        if(id=="dzongkhag"){
            this.form.dzongkhag=$('#dzongkhag').val();
            this.getschoolList($('#dzongkhag').val());
        }
        if(id=="school"){
            this.form.school=$('#school').val();
            // this.getclassList($('#school').val());
        }
        if(id=="class"){
            this.form.class=$('#class').val();
        }

        }

    },
    mounted() {
        this.loadgenderList();
        // this.getStudentdetials();
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.getstudentPersonalDetails(this.$route.params.data);
        // this.getschoolList();
        // this.getclassList();
    },


}
</script>
