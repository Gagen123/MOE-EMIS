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
                                        <label class="required" >Name of Student :</label>
                                        <label class="text-primary">{{ this.std_name}}</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label class="required" >CID No/Reference  : </label>
                                        <label class="text-primary">{{ this.std_cid}}</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label class="required" >Student Code :</label>
                                        <label class="text-primary">{{ this.std_code}}</label>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label >Date of Birth :</label>
                                        <label class="text-primary">{{this.std_dob}}</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <label class="required" >School :</label>
                                        <label class="text-primary">{{this.student_form.address}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row-12">
                                <div class="card">
                                    <label class="card-header"><strong>Ranking Information for Each School</strong></label>
                                    <table class="table table-bordered table-striped" id="OrgDetails">
                                        <thead>
                                            <tr>
                                                <th>School Name / Stream</th>
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
                <hr>
                    <form id="" class="form-horizontal" enctype="multipart/form-data" action="#" method="POST">
                        <div class="row md-12">
                        <div class="form-group col-md-4">
                            <label>School <span class="text-danger">*</span></label>
                            <select v-model="student_form.school" :class="{ 'is-invalid select2 select2-hidden-accessible':student_form.errors.has('school') }" class="form-control select2" name="school" id="school">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Stream:</label>
                            <select v-model="student_form.stream" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('stream') }" class="form-control select2" name="stream" id="stream">
                                <option value=""> --Select--</option>
                                <option value="Science">Science</option>
                                <option value="Arts">Arts</option>
                                <option value="Commerce">Commerce</option>
                            </select>
                            <has-error :form="student_form" field="stream"></has-error>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>School</th>
                                        <th>Stream</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="record1" v-for='(plan, index) in student_form.action_plan' :key="index">
                                        <td>
                                            <select v-model="student_form.school" :class="{ 'is-invalid select2 select2-hidden-accessible':student_form.errors.has('school') }" class="form-control select2" name="school" id="school">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{item.name}}</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select v-model="student_form.stream" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('stream') }" class="form-control select2" name="stream" id="stream">
                                                <option value=""> --Select--</option>
                                                <option value="Science">Science</option>
                                                <option value="Arts">Arts</option>
                                                <option value="Commerce">Commerce</option>
                                            </select>
                                            <has-error :form="student_form" field="stream"></has-error>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                            @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                            <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                            @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                    <hr>
                    <div class="card-footer text-right">
                        <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                        <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                    </form>
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
                std_name:'',
                std_code:'',
                std_dob:'',
                contact:'',
                OrgOrganizationId:'',
                type:'',
                OrgDetails:'',
                getDzoName:'',
                getGewogName:'',
                dzongkhagList:[],
                schoolList:[],
                classList:[],
                streamList:[],
                action_plan:[],
                getSeats:'',
                dzongkhagId:'null',
                gewogId:'null',
                form:new form({
                }),
                student_form: new form({
                  id:'',
                  student_id:'',
                  school:'',
                  class:'',
                  stream:'',
                  remarks:'',
                  std_decission:'pending',

                })
            }
        },
        methods:{
            resetForm: function(event){
                this.student_form.reset();
            },
            formaction: function(type){
                if(type=="reset"){
                    this.student_form.student= '';
                    this.student_form.remarks='';
                    this.student_form.status= 1;
                }
                if(type=="save"){
                    this.student_form.post('/savedetailsEnrolledStd',this.student_form)
                        .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/classxi_student');
                    })
                    .catch(() => {
                        console.log("Error......")
                    })
                }
            },

            getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
                axios.get(uri)
                .then(Response =>{
                    let data = Response.data.data;
                    this.dzongkhagList = data;
                }).catch(error => console.log(error));

            },
            getStudentDetails(id){
                axios.get('/masters/getStudentDetails/'+id)
                .then(response =>{
                    let data = response.data.data;
                    this.std_name=data['Name'];
                    this.std_code=data['student_code'];
                    this.std_cid=data['CidNo'];
                    this.std_dob=data['DateOfBirth'];
                    this.OrgOrganizationId = data['OrgOrganizationId'];
                    
                    this.getOrganizationDetails(this.OrgOrganizationId);
                })
            },

            getOrganizationDetails(id){
                axios.get('/masters/getFullSchoolDetails/'+id)
                .then(response =>{
                    let data = response.data;
                    this.student_form.dzongkhag = data[0].dzongkhagId;
                    $('#dzongkhag').prop('readonly',true);
                    this.getHssSchoolList(data[0].dzongkhagId);
                })
            },
            getHssSchoolList(dzoId){
                axios.get('/masters/getHssSchoolList/' +dzoId)
                .then(response =>{
                    let data = response.data;
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
            /**
             * method to add more fields
             */
            addMore: function(){
                this.count++;
                this.student_form.action_plan.push({school:'', stream:''})
            },
            /**
             * method to remove fields
             */
            removeStudents(index){
                if(this.student_form.action_plan.length>1){
                    this.count--;
                    this.student_form.action_plan.splice(index,1);
                }
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

        axios.get('getSessionDetail')
            .then(response => {
                let data = response.data.data;
                this.std_id=data['std_id'];
                this.code=data['std_code'];
                this.type=data['user_type'];
                this.email=data['email'];
                this.name=data['full_name'];
                this.contact=data['phone_number'];
                if(data['user_type']!="Parent"){
                    this.is_student=true;
                }
                this.student_form.student_id=data['std_id'];

                this.getStudentDetails(this.std_id);
            })
            .catch(errors => {
                console.log(errors)
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        },


        created() {
            this.getdzongkhagList();
            this.getclassList();
            this.getstreamList();
            // this.getseatdetailsbyOrgId();
            this.getdzongkhagName();
            this.getgewogName();

            // this.student_form.cid_passport=this.$route.query.data.CidNo;
            // this.student_form.Name=this.$route.query.data.first_name + ' ' + this.$route.query.data.last_name;
            // this.student_form.gender=this.$route.query.data.CmnSexId;
            // this.student_form.DateOfBirth=this.$route.query.data.DateOfBirth;
            // this.student_form.address=this.$route.query.data.Address;
            // this.getOrgDetails(this.$route.query.data.OrgOrganizationId);

  },
    }
</script>
