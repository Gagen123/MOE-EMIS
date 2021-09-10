<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="errorscreen">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <form class="bootbox-form" id="mainform">
            <div class="row form-group">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-6">
                    <!-- <label for="subsitutingto_id" class="col-sm-3 col-form-label">In Place</label> -->
                    <label class=""> Name of the Teacher:<i class="text-danger">*</i></label>
                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> -->
                      <input type="text" id="subsitutingto_name" readonly class="form-control">
                      <input type="hidden" :class="{ 'is-invalid': form.errors.has('subsitutingto_id') }" v-model="form.subsitutingto_id" name="subsitutingto_id" id="subsitutingto_id" class="form-control">
                      <has-error :form="form" field="subsitutingto_id"></has-error>
                      <span class="text-danger" id="name_err"></span>
                    <!-- </div> -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
                    <br>
                    <button type="button" class="btn btn-success" @click="viewstaffList">
                        <i class="fas fa-edit"></i> Select Teacher
                    </button>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <label class="">Substitute Teacher:<i class="text-danger">*</i></label>
                    <select v-model="form.subsTeacher" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('subsTeacher') }" class="form-control select2" name="subsTeacher" id="subsTeacher">
                        <option v-for="(item, index) in substituteTeacherList" :key="index" v-bind:value="item.id">{{ item.name }} ({{item.cid}})</option>
                    </select>
                    <has-error :form="form" field="subsTeacher"></has-error>
                    <span class="text-danger" id="subsTeacher_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
                    <label class="">Teaching Subject:<i class="text-danger">*</i></label>
                    <select v-model="form.teaching_subject" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('teaching_subject') }" class="form-control select2" name="teaching_subject" id="teaching_subject">
                        <option v-for="(item, index) in teachingSubjList" :key="index" v-bind:value="item.id">{{ item.name }} [{{item.code}}]</option>
                    </select>
                    <has-error :form="form" field="teaching_subject"></has-error>
                    <span class="text-danger" id="teaching_subject_err"></span>
                </div>
                <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
                    <label class=""> Email:<i class="text-danger">*</i></label>
                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="text" id="email" class="form-control" @change="remove_err('email')">
                    <has-error :form="form" field="email"></has-error>
                    <span class="text-danger" id="email_err"></span>
                </div> -->
            </div>
             <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                   <label class="">From Date:<i class="text-danger">*</i></label>
                    <input v-model="form.from_date" :class="{ 'is-invalid': form.errors.has('from_date') }" type="date" id="from_date" class="form-control" @change="remove_err('from_date')">
                    <has-error :form="form" field="from_date"></has-error>
                    <span class="text-danger" id="from_date_err"></span>
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-9">
                    <label class="">To Date:<i class="text-danger">*</i></label>
                    <input v-model="form.to_date" :class="{ 'is-invalid': form.errors.has('to_date') }" type="date" id="to_date" class="form-control" @change="remove_err('to_date')">
                    <has-error :form="form" field="to_date"></has-error>
                    <span class="text-danger" id="to_date_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg- col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_err('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
                    <span class="text-danger" id="remarks_err"></span>
                </div>
                <br>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <label for="isextended" class="">Contract Extension</label>
                    <div class="col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" v-model="form.isextended">
                        <label class="form-check-label" for="isextended">
                          Check, If Yes.
                        </label>
                      </div>
                    </div>
                </div>
            </div>
            <div class="row form-group fa-pull-right" id="actionbtn">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-9">
                    <button type="button" class="btn btn-primary" @click="submitDetails()"> <i class="fa fa-save"></i>Save </button>
                </div>
            </div>
        </form>
         <div class="modal fade" id="viewstaffList" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                     <h4 class="modal-title">List of Teacher </h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                     </button>
                    </div>
                    <div class="modal-body">
                     <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="dzosection">
                                    <label class="mb-0">Dzongkhag: <i class="text-danger">*</i></label>
                                    <select class="form-control select2" id="dzongkhag_id" v-model="dzo_id">
                                        <option value="ALL"> --Select--</option>
                                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="dzongkhag_id_err"></span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Organization: <i class="text-danger">*</i></label>
                                    <select class="form-control select2" id="org_id">
                                        <option value="ALL"> --Select--</option>
                                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <span class="text-danger" id="org_id_err"></span>
                                </div>
                           </div>
                      </div>
                    <!--   <div class="card-body"> -->
                         <table id="dynamic-table" class="table table-bordered table-striped">
                             <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Emp.Id</th>
                                        <th>Name</th>
                                        <th>Position Title</th>
                                        <th>Leave/Seperation Type</th>
                                        <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr v-for="(tableitem, index) in dataList" :key="index">
                                        <td> {{index + 1}}</td>
                                        <td> {{ tableitem.empid}}</td>
                                        <td> {{ tableitem.name}}</td> -->
                                        <td> {{ tableitem.positionTitle}}</td>
                                        <td> {{ tableitem.leavetype}}</td>
                                        <td><button class="btn-outline-danger" type="button" @click="selectteacher( teacher.StaffID,teacher.FullName )">Select</button> </td>      
                                 </tr>
                             </tbody>
                          </table>
                    <!--  </div>-->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return {
            dzongkhagList:[],
            dataList:[],
            teachingSubjList:[],
            substituteTeacherList:[],
            orgList:[],
            dzo_id:'',
            form: new form({
                id:'',
                subsitutingto_id:'',
                subsTeacher:'',
                teaching_subject:'',
                from_date:'',
                to_date:'',
                remarks:'',
                isextended:'',
                action_type:'add',
            }),
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="subsTeacher"){
                this.form.subsTeacher=$('#subsTeacher').val();
            }
            if(id=="teaching_subject"){
                this.form.teaching_subject=$('#teaching_subject').val();
            }
            
            if(id=="dzongkhag_id"){
              // alert($('#dzongkhag').val());
                this.form.dzongkhag=$('#dzongkhag_id').val();
                this.allOrgList($('#dzongkhag_id').val());
            }
        },
        loadstff(uri="staff/substitution/loadStaff/all/SubstitutionModel"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.substituteTeacherList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        LoadTeachingSubject(uri = 'masters/loadAcademicMasters/all_teaching_subject'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.teachingSubjList =  data.data.data;
            })
             .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        showeditmodel(){
          $('#openselectModel').modal({backdrop: 'static', keyboard: false});
          $('#openselectModel').modal('show');
          
        },
        viewstaffList(){
            // let dzongkhag_id=$('#dzongkhag_id').val();
            // let org_id=$('#org_id').val();
            let url="staff/loadLeaveStaffList/";
            // if(organization_type=="Org"){//selct organization
            //     if(org_id!="ALL"){
            //         url+='selectedOrgWiseCivilServent/'+org_id;
            //     }else{
            //         url+='selectedDzoWiseCivilServent/'+dzongkhag_id;
            //     }
            // }
            axios.get(url)
            .then((response) => {
                this.substaffList =  response.data.data;
             })
            .catch((error) => {
                console.log("Error."+error);
            });
            $('#viewstaffList').modal('show');
            
        },
        allOrgList(dzo_id){
            if(dzo_id==""){
                dzo_id=$('#dzongkhag').val();
            }
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
            this.orgList = [];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.orgList = data.data.data;
            })
            
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        // getDetailsbyCID(){
        //     if (this.form.cid.length == 11){
        //         axios.get('staff/substitution/loadStaff/by_cid__'+this.form.cid+'/SubstitutionModel')
        //         .then((response) => {
        //             let data=response.data;
        //             if(data==""){
        //                 axios.get('getpersonbycid/'+ this.form.cid)
        //                 .then(response => {
        //                     this.ciderror = '';
        //                     let personal_detail = response.data;
        //                     if (personal_detail!=""){
        //                         let fullname=personal_detail.firstName;
        //                         if(personal_detail.middleName!=null && personal_detail.middleName!="null" && personal_detail.middleName!=""){
        //                             fullname=fullname+' '+personal_detail.middleName;
        //                         }
        //                         if(personal_detail.lastName!=null && personal_detail.lastName!="null" && personal_detail.lastName!=""){
        //                             fullname=fullname+' '+personal_detail.lastName;
        //                         }
        //                         $('#cid').prop('disabled',true);
        //                         this.form.name = fullname;
        //                         $('#name').prop('disabled',true);
        //                         this.form.dob =personal_detail.dob;
        //                         $('#dob').prop('disabled',true);

        //                         if(personal_detail.gender=="M"){
        //                             personal_detail.gender="male";
        //                         }
        //                         else if(personal_detail.gender=="F"){
        //                             personal_detail.gender="female";
        //                         }
        //                         else{
        //                             personal_detail.gender="others";
        //                         }
        //                         for(let i=0; i<this.sex_idList.length;i++){
        //                             if(this.sex_idList[i].name.toLowerCase()==personal_detail.gender){
        //                                 $('#gender').val(this.sex_idList[i].id).trigger('change');
        //                                 this.form.gender = this.sex_idList[i].id;
        //                             }
        //                         }
        //                         $('#gender').prop('disabled',true);
        //                         this.form.dzongkhag = personal_detail.dzongkhagId;
        //                         $('#dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
        //                         $('#dzongkhag').prop('disabled',true);
        //                         this.form.contact = personal_detail.mobileNumber;
        //                     }else{
        //                         this.ciderror = 'Invalid CID.';
        //                         Swal.fire({
        //                             html: "No data found for matching CID",
        //                             icon: 'info'
        //                         });
        //                     }
        //                 })
        //                 .catch((e) => {
        //                     this.ciderror = 'Invalid CID / service down.';
        //                     Swal.fire({
        //                         html: "No data found for matching CID/service down"+e,
        //                         icon: 'error'
        //                     });
        //                 });
        //             }else{
        //                 Swal.fire({
        //                     html: "this person is already recorded in the system",
        //                     icon: 'error'
        //                 });
        //                 $('#mainform').hide();
        //                 $('#errorscreen').show();
        //                 $('#message').html('this person is already recorded in the system');
        //             }

        //         })

        //     }
        // },
        submitDetails(){
            if(this.validateform()){
                Swal.fire({
                    text: "Are you sure you wish to save this staff details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('staff/substitution/saveSubstitutestaffDetail')
                        .then((response)=> {
                            Swal.fire(
                                'Success!',
                                'Details has been saved successfully.',
                                'success',
                            )
                            this.$router.push('/list_substitute_teacher');
                        })
                        .catch((error) => {
                            console.log("Error shownexttab:"+error)
                        });
                    }
                });
            }
        },
        validateform(){
            let returntype=true;
            if($('#from_date').val()==""){
                $('#from_date_err').html('Please provide from Date');
                returntype=false;
            }
            if($('#to_date').val()==""){
                $('#to_data_err').html('Please provide To Date');
                returntype=false;
            }
            return returntype;
        }
    },
    async mounted(){
        this.loadstff();
        this.LoadTeachingSubject();
        this.dzongkhagList =await this.loadactivedzongkhags();
       // this.orgList= await this.schoolListUnderUserDzongkhag();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=>{
            this.changefunction(id);
        });
        
    },
}
</script>
