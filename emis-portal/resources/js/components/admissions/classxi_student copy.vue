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
                <div class="row-12">
                  <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >CID No/Reference  : </label>
                            <label class="text-primary">{{ this.student_form.cid_passport}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Name of Student :</label>
                            <label class="text-primary">{{ this.student_form.Name}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Gender :</label>
                            <label class="text-primary">{{ this.student_form.gender}}</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label >Date of Birth :</label>
                            <label class="text-primary">{{this.student_form.DateOfBirth}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label class="required" >Address :</label>
                            <label class="text-primary">{{this.student_form.address}}</label>
                        </div>
                    </div>
                </div>
                <div class="row-12">
                    <div class="card">
                        <label class="card-header"><strong>School Information</strong></label>
                        <table class="table table-bordered table-striped" id="OrgDetails">
                            <thead>
                                <tr>
                                    <th>School Code</th>
                                    <th>Name of School</th>
                                    <th>Dzongkhag/ Thromde</th>
                                    <th>Gewog / Thromde Demkhong</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td class="text-primary">{{OrgDetails.code}}</td>
                                <td class="text-primary">{{OrgDetails.name}}</td>
                                <td class="text-primary">{{getDzoName.name}}</td>
                                <td class="text-primary">{{getGewogName.name}}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="content-header pb-0">
                      <div class="content-header pt-1 pb-0">
                          <div class="container-fluid">
                              <div class="row mb-2">
                                  <div class="col-sm-6">
                                    <h5><b>School Details</b></h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                </div>
                <div class="row md-12">
                    <div class="form-group col-md-4">
                        <label class="required">Dzongkhag/Thromde <span class="text-danger">*</span><span class="text-danger"></span></label>
                        <select name="dzongkhag" v-model="student_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('dzongkhag') }" class="form-control select2" id="dzongkhag"  >
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>School <span class="text-danger">*</span></label>
                        <select v-model="student_form.school" :class="{ 'is-invalid select2 select2-hidden-accessible':student_form.errors.has('school') }" class="form-control select2" name="school" id="school">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4" id="seat">
                          <label>Seats available </label>
                            <input v-model="student_form.seats" id="seat" type="text" name="seats"
                            class="form-control" :class="{ 'is-invalid': student_form.errors.has('remarks') }"  disabled="true" />
                            <has-error :student_form="student_form.seats" field="seat"></has-error>
                    </div>
                </div>
                <div class="row md-12">
                    <div class="form-group col-md-4">
                            <label>Class<span class="text-danger">*</span></label>
                              <select v-model="student_form.class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('class') }" class="form-control select2" name="class" id="class">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in classList  " :key="index" v-bind:value="item.id">{{item.class}}</option>
                              </select>
                    </div>
                    <div class="form-group col-md-4" id="stream">
                          <label>stream<span class="text-danger">*</span></label>
                              <select v-model="student_form.stream" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('stream') }" class="form-control select2" name="stream" id="stream">
                                  <option value="">--- Please Select ---</option>
                                  <option v-for="(item, index) in streamList" :key="index" v-bind:value="item.id">{{item.stream}}</option>
                              </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Apply Date:<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" @change="removeerror('dateOfapply')" :class="{ 'is-invalid': student_form.errors.has('dateOfapply') }" id="dateOfapply" v-model="student_form.dateOfapply" placeholder="Date of apply">
                        <has-error :student_form="student_form.dateOfapply" field="date"></has-error>
                    </div>
                </div>
                  <hr>
                  <div class="footer float-right" >
                      <button type="button" v-on:click="resetForm" class="btn btn-danger"><i class="fas fa-redo"></i> Reset</button>
                      <button type="button" v-on:click="submitForm" class="btn btn-success"> <i class="fas fa-save"></i> Apply</button>
                  </div>
            </form>
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
                form:new form({
                }),
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
          getschoolList(id){
            let dzoId=$('#dzongkhag').val();
                if(id!=""){
                dzoId=id;
              }

            axios.get('/masters/getOrgList/' +dzoId)
              .then(response =>{
                let data = response.data.data;
                this.schoolList = data;
            })
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
         getseatdetailsbyOrgId(id){
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
              axios.get('loadOrganizationDetailsbyOrgId/NA/' +id)
                .then(response =>{
                  let data = response.data.data;
                  this.OrgDetails=data;
                  this.getdzongkhagName(this.OrgDetails.dzongkhagId);
                  this.getgewogName(this.OrgDetails.gewogId);
              })

          },
        getdzongkhagName(dzo_id){
          axios.get('load_dzongkhag_details_by_id/' +dzo_id)
            .then(response =>{
              let data = response.data.data;
              this.getDzoName=data;

            })

        },
        getgewogName(gewog_id){
            axios.get('load_gewog_details_by_id/' +gewog_id)
            .then(response =>{
              let data = response.data.data;
              this.getGewogName=data;
            })

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
            this.getdzongkhagList();
            this.getclassList();
            this.getstreamList();
            this.getseatdetailsbyOrgId();
            this.getdzongkhagName();
            this.getgewogName();

            this.student_form.cid_passport=this.$route.query.data.CidNo;
            this.student_form.Name=this.$route.query.data.first_name + ' ' + this.$route.query.data.last_name;
            this.student_form.gender=this.$route.query.data.CmnSexId;
            this.student_form.DateOfBirth=this.$route.query.data.DateOfBirth;
            this.student_form.address=this.$route.query.data.Address;
            this.getOrgDetails(this.$route.query.data.OrgOrganizationId);

  },
    }
</script>
