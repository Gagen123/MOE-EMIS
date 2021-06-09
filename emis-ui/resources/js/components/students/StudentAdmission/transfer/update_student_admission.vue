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
                        <label class="text-primary">11305004488</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Student Code : </label>
                        <label class="text-primary">{{ this.student_form.student_code}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Name of Student :</label>
                        <label class="text-primary">Full Name</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Gender :</label>
                        <label class="text-primary">M</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label >Date of Birth :</label>
                        <label class="text-primary">{{this.student_form.dob}}</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label class="required" >Qualification :</label>
                        <label class="text-primary">x</label>
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
                            <td class="text-primary">{{this.student_form.gewog_name}}</td>
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
                    <label>School <span class="text-danger">*</span></label>
                    <select v-model="student_form.school" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('school') }" class="form-control select2" name="school" id="school">
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Class<span class="text-danger">*</span></label>
                    <select v-model="student_form.class" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('class') }" class="form-control select2" name="class" id="class">
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
            axios.get('students/admission/getStudentDetails/'+id)
            .then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.std_admission_details=data;
                }   
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
            formData.append('student_id', this.student_form.student_id);
            formData.append('dzongkhag', this.student_form.dzongkhag);
            formData.append('school', this.student_form.school);
            formData.append('class', this.student_form.class);
            formData.append('dateOfapply', this.student_form.dateOfapply); 
            formData.append('remarks', this.student_form.remarks);

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
        getStudentdetials(){
            axios.get('/getstudentdetails')
            .then(response => {
                this.student_details  = response.data
                this.student_form.id  =this.student_details.id;
                this.student_form.cid = this.student_details.cid;
                this.student_form.student_code = this.student_details.student_code;
                this.student_form.name = this.student_details.name;
                this.student_form.dob = this.student_details.dob;
                this.student_form.gender = this.student_details.gender;
                this.student_form.school_code = this.student_details.school_code;
                this.student_form.schoolName = this.student_details.schoolName;
            }).catch(error => console.log(error));
        },
        getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
            axios.get(uri)
            .then(Response =>{
            let data = Response.data.data;
            this.dzongkhagList = data;
            }).catch(error => console.log(error));
        },

        getschoolList(id){
            let dzoId=$('#dzongkhag').val();
            if(id!=""){
            dzoId=id;
        } 
        axios.get('/masters/getOrgList/' +dzoId)
        .then(Response =>{
            let data = Response.data.data;
            this.schoolList = data;
            })

        },
        getclassList(id){
            let orgId=$('#school').val();
            if(id!=""){
                orgId=id;
                console.log(orgId);
            } 
            axios.get('/masters/getClassByOrganizationId/' +orgId)
            .then(Response =>{
            let data = Response.data.data;
            this.classList = data;
            })
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
            this.getclassList($('#school').val());
        }
        if(id=="class"){
            this.form.class=$('#class').val();
        }
        
        }

    },
    mounted() {
        this.getStudentdetials();
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
        Fire.$emit('changefunction',$(this).attr('id')); 
    });
    
    Fire.$on('changefunction',(id)=> {
        this.changefunction(id);
    });
    },
    created() {
        this.getschoolList();
        this.getclassList();
        this.getstudentPersonalDetails(this.$route.params.data);
    },
}
</script>