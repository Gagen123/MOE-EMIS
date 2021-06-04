<template>
<div class="container-fluid">
    <div class="content-header pb-0">
        <div class="content-header pt-1 pb-0">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5><b>Admission Request</b></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
         <form id="" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
              <div class="row md-12">
                  <div class="form-group col-md-3">
                      <label class="required">Dzongkhag/Thromde <span class="text-danger">*</span><span class="text-danger"></span></label>
                        <select name="dzongkhag" v-model="student_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('dzongkhag') }" class="form-control select2" id="dzongkhag"  >
                          <option value="">--- Please Select ---</option>
                          <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                        </select>
                  </div>
                  <div class="form-group col-md-3">
                       <label>School <span class="text-danger">*</span></label>
                          <select v-model="student_form.school" :class="{ 'is-invalid select2 select2-hidden-accessible':student_form.errors.has('school') }" class="form-control select2" name="school" id="school">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                          </select>
                  </div>
                  <div class="form-group col-md-3">
                        <label>Class<span class="text-danger">*</span></label>
                          <select v-model="student_form.class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('class') }" class="form-control select2" name="class" id="class">
                              <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in classList  " :key="index" v-bind:value="item.id">{{item.class}}</option>
                          </select>
                  </div>
                    <div class="form-group col-md-3">
                          <label>Request Date:<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" @change="removeerror('dateOfapply')" :class="{ 'is-invalid': student_form.errors.has('dateOfapply') }" id="dateOfapply" v-model="student_form.dateOfapply" placeholder="Date of apply">
                              <has-error :student_form="form" field="date"></has-error>
                    </div>
                 
              </div>
              <div class="row md-12">
                    <div class="form-group col-md-12" >
                        <label>Reason <span class="text-danger">*</span><span class="text-danger"></span></label>
                          <textarea v-model="student_form.reasons" id="reasons" type="text" name="reasons" 
                            class="form-control" :class="{ 'is-invalid': student_form.errors.has('reasons') }"   />
                          <has-error :student_form="form" field="reasons"></has-error>
                   </div>
                   
                  
              </div>
                <hr>                        
                <div class="footer float-right" >
                    <button type="button" v-on:click="resetForm" class="btn btn-danger"><i class="fas fa-redo"></i> Reset</button>
                    <button type="button" v-on:click="submitForm" class="btn btn-success"> <i class="fas fa-save"></i> Request</button>
                </div>
        </form>
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
                getreasons:'',
                dzongkhagId:'null',
                gewogId:'null',
                form:new form({

                }),
                  student_form: new form({
                    id:'',
                    dzongkhag:'',
                    school:'',
                    class:'',
                    stream:'',
                    dateOfapply:'',
                    reasons:'',
                   
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
                formData.append('dzongkhag', this.student_form.dzongkhag);
                formData.append('school', this.student_form.school);
                formData.append('class', this.student_form.class);
                formData.append('stream', this.student_form.stream);
                formData.append('dateOfapply', this.student_form.dateOfapply); 
                formData.append('reasons', this.student_form.reasons); 
                formData.append('status', 'pending'); 
                formData.append('snationality', 'bhutaness');

                axios.post('/RequestadmissionController/savedrequestadmission',formData,config)
                .then(()=>{
                    Toast.fire({
                        icon: 'success',
                        title: 'you have applied successfully'
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


         getreasondetailsbyOrgId(id){
               let orgId=$('#school').val();
                if(id!=""){
                 orgId=id;
            } 
              axios.get('/masters/getreasondetailsbyOrgId/' +orgId)
              .then(Response =>{
                let data = Response.data.data;
                this.getreasons = data;data
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
           $('.select2').select2();
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
            this.getreasondetailsbyOrgId();
            this.getdzongkhagName();
            this.getgewogName();
            this.student_form.cid_passport=this.$route.query.data[0].CidNo;
            this.student_form.Name=this.$route.query.data[0].Name;
            this.student_form.gender=this.$route.query.data[0].CmnSexId;
            this.student_form.DateOfBirth=this.$route.query.data[0].DateOfBirth; 
            this.student_form.address=this.$route.query.data[0].Address;
            this.getOrgDetails(this.$route.query.data[0].OrgOrganizationId);
            
  },
    }
</script>
