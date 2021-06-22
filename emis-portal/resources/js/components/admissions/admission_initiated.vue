<template>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0">Admission Form:</label>
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
            </div>
                <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label class="required" >Dzongkhag : </label>
                    <label class="text-primary">{{dzongkhagArray[std_admission_details.dzongkhag]}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label class="required" >Gewog : </label>
                    <label class="text-primary"><span id="gewogid"></span>{{gewogArray[std_admission_details.CmnGewogId]}}</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label class="required" >Village :</label>
                    <label class="text-primary"><span id="vilageId"></span> {{villageArray[std_admission_details.village_id]}}</label>
                </div>
            </div>
            <hr>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="card-header"><strong>Parent/Guardian Details</strong></label>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>CID</th>
                                <th>Name</th>
                                <th>Relation</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Occupation</th>
                                <th>Residence Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in std_parents" :key="index">
                                <td>{{ item.cid_passport}}</td>
                                <td>{{ item.name}}</td>
                                <td>{{ item.contact_type}}</td>
                                <td>{{ item.cntct_no}}</td>
                                <td>{{ item.email}}</td>
                                <td>{{ item.occupation}}</td>
                                <td>{{ item.residence_address}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label class="required">Dzongkhag/Thromde <span class="text-danger">*</span><span class="text-danger"></span></label>
                    <select name="dzongkhag" v-model="student_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('dzongkhag') }" class="form-control select2" id="dzongkhag"  >
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>School <span class="text-danger">*</span></label>
                    <select v-model="student_form.school" :class="{ 'is-invalid select2 select2-hidden-accessible':student_form.errors.has('school') }" class="form-control select2" name="school" id="school">
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <label>Seats available </label>
                    <input v-model="student_form.seats" id="seat" type="text" name="seats"
                    class="form-control" :class="{ 'is-invalid': student_form.errors.has('remarks') }"  disabled="true" />
                    <has-error :student_form="student_form.seats" field="seat"></has-error>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>
<div class="container-fluid">
    <div class="content-header pb-0">
        <div class="content-header pt-1 pb-0">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                      <h5><b>Admission Form</b></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="row-12">
            <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <input type="radio" name="snationality" v-model="std_admission_details.snationality" value="Bhutanese" id="s-bhutanese" @click="showstdidentity('Student-Bhutanese')" checked> Bhutanese <br>
            <input type="radio" name="snationality" v-model="std_admission_details.snationality" value="Foreign" id="s-foreign" @click="showstdidentity('Student-Non-Bhutanese')"> Non-Bhutanese
            <span class="text-danger" id="snationality_err"></span>
            </div> -->
        </div>
    </div>
    </div>
</div>
</template>
<script>
    export default {
        data(){
            return{
                genderArray:{},
                dzongkhagArray:{},
                gewogArray:{},
                villageArray:{},
                OrgDetails:'',
                getDzoName:'',
                getGewogName:'',
                dzongkhagList:[],
                schoolList:[],
                classList:[],
                streamList:[],
                getSeats:'',
                dzongkhagId:'null',
                gewogId:'null',
                std_admission_details:'',
                std_parents:'',
                student_form: new form({
                  id:'',
                  cid_passport:'',
                  student_id:'',
                  student_type:'',
                  student_code:'',
                  Name:'',
                  orgId:'',
                  DateOfBirth:'',
                  gender:'',
                  address:'',
                  school_code:'',
                  school_name:'',
                  dzongkhag_name:'',
                  gewog:'',
                  dzongkhag:'',
                  school:'',
                  class:'',
                  stream:'',
                  dateOfapply:'',
                  remarks:'',
                  CidNo:'',
                  std_decission:'',

                })
            }
        },
        methods:{
            resetForm: function(event){
                this.student_form.reset();
            },
            showAndHideField:function(type){
            if(type=="classXI"){
            $('#stream').show();
            }

             if(type=="others"){
            $('#stream').hide();
            }
            },
            submitForm(){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                this.$Progress.start();
                  let formData = new FormData();
                  formData.append('student_type', this.student_form.student_type);
                  formData.append('cid_passport', this.student_form.cid_passport);
                  formData.append('DateOfBirth', this.student_form.DateOfBirth);
                  formData.append('Name', this.student_form.Name);
                  formData.append('OrgOrganizationId',this.$route.query.data.OrgOrganizationId);
                  formData.append('gender', this.student_form.gender );
                  formData.append('student_id', this.student_form.student_id);
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
            }).catch(error => console.log(error));

        },
        getstudentPersonalDetails(id){
            axios.get('students/admission/getStudentDetails/admissionCid_'+id)
            .then(response => {
                let data = response.data.data;
                if(data != ""){
                    this.std_admission_details=data;
                    this.student_form.id=data.id;
                    this.student_form.student_id=data.id;
                    this.std_parents=data.parents;
                    this.getGewogList(data.dzongkhag,data.CmnGewogId);
                    this.getvillagelist(data.CmnGewogId,data.village_id);
                    this.getClassId(data.class_id);
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
                // console.log(data);
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
              // console.log(data);
              this.classList = data;
            })
        },
         getseatdetailsbyOrgId(){
            let orgId=$('#school').val();
            if(id!=""){
                orgId=id;
            }
            axios.get('/masters/getseatdetailsbyOrgId/' +orgId)
            .then(Response =>{
                let data = Response.data.data;
                this.getSeats = data;data
            })
        },
         getstreamList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
              axios.get(uri)
                .then(Response =>{
                  let data = Response.data.data;
                  this.streamList = data;
                })

          },
         getOrgDetails(id){
              axios.get('loadOrganizationDetailsbyOrgId/' +id)
                .then(response =>{
                  let data = response.data.data;
                  this.OrgDetails=data;
                //   this.getdzongkhagName(this.OrgDetails.dzongkhagId);
                //   this.getgewogName(this.OrgDetails.gewogId);
              })

          },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
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
        applyselect()
          {
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
                this.getschoolList($('#dzongkhag').val());
            }
            if(id=="school"){
                this.student_form.school=$('#school').val();
                this.getclassList($('#school').val());
            }
            if(id=="class"){
                this.student_form.class=$('#class').val();
                  this.getstreamListByid($('#class').val());

            }
            if(id=="stream"){
                this.student_form.stream=$('#stream').val();
                this.getstreamList($('#stream').val);

            }
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
        },
        created() {
            // let cid=this.$route.query.cid;
            alert(this.$route.query.data);
            this.getstudentPersonalDetails(this.$route.query.data);
            this.getdzongkhagList();
            this.getclassList();
            this.getstreamList();
            this.getseatdetailsbyOrgId();
            // this.getdzongkhagName();
            // this.getgewogName();


  },
}
</script>
