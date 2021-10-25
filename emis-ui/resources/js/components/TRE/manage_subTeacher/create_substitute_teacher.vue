<template>
    <div>
        <form>
            <div class="form-group row">
                <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0">Organization Type s: <i class="text-danger">*</i></label>
                    <select class="form-control select2" name="organization_type_id" id="organization_type_id">
                        <option value=""> --Select--</option>
                        <option value="Org">Organization/School </option>
                        <option value="Dzongkhag">Dzongkhag</option>
                        <option value="Ministry">Ministry </option>
                    </select>
                    <span class="text-danger" id="organization_type_id_err"></span>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="dzosection">
                    <label class="mb-0">Dzongkhag: <i class="text-danger">*</i></label>
                    <select class="form-control select2" id="dzongkhag_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <span class="text-danger" id="dzongkhag_id_err"></span>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display:none" id="departmentdiv">
                    <label class="mb-0">Department: <i class="text-danger">*</i></label>
                    <select class="form-control select2" name="department_id" id="department_id">
                        <option value="ALL"> --Select--</option>
                        <option v-for="(item, index) in departmentList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <span class="text-danger" id="department_id_err"></span>
                </div> -->
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0">Organization: <i class="text-danger">*</i></label>
                    <select class="form-control select2" id="org_id">
                        <option value="ALL"> --Select--</option>
                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <span class="text-danger" id="org_id_err"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
                    <label class="mb-0.5">Staff:<i class="text-danger">*</i></label><br>
                    <select v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.emp_id }}: {{ item.name }} ({{ item.position_title.name }})</option>
                    </select>
                    <has-error :form="form" field="staff_id"></has-error>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
                    <label class="">Substitute Teacher:<i class="text-danger">*</i></label>
                    <select v-model="form.subsTeacher" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('subsTeacher') }" class="form-control select2" name="subsTeacher" id="subsTeacher">
                        <option v-for="(item, index) in substituteTeacherList" :key="index" v-bind:value="item.id">{{ item.name }} ({{item.cid}})</option>
                    </select>
                    <has-error :form="form" field="subsTeacher"></has-error>
                    <span class="text-danger" id="subsTeacher_err"></span>
                </div>
            </div>
            <div class="form-group row">    
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-9">
                    <label class="">Teaching Subject:<i class="text-danger">*</i></label>
                    <select v-model="form.teaching_subject" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('teaching_subject') }" class="form-control select2" name="teaching_subject" id="teaching_subject">
                        <option v-for="(item, index) in teachingSubjList" :key="index" v-bind:value="item.id">{{ item.name }} [{{item.code}}]</option>
                    </select>
                    <has-error :form="form" field="teaching_subject"></has-error>
                    <span class="text-danger" id="teaching_subject_err"></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-1">From Date:<i class="text-danger">*</i></label>
                    <input type="date" @change="remove_error('start_date')" v-model="form.start_date" :class="{ 'is-invalid': form.errors.has('start_date') }" class="form-control" name="start_date" id="start_date">
                    <has-error :form="form" field="start_date"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-1">To Date:<i class="text-danger">*</i></label>
                    <input type="date" @change="remove_error('end_date')" v-model="form.end_date" :class="{ 'is-invalid': form.errors.has('end_date') }" class="form-control" name="end_date" id="end_date">
                    <has-error :form="form" field="end_date"></has-error>
                </div>
            </div>
           
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-9">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
                </div>
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
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            dzongkhagList:[],
            dzo_id:'',
         //   departmentList:[],
            orgList:[],
            staffList:[],
            teachingSubjList:[],
            substituteTeacherList:[],
            form: new form({
                staff_id:'',
                subsTeacher: '',
                teaching_subject: '',
                start_date:'',
                end_date:'',
                remarks:'',
                isextended:'',
                model:'SubstitutedTeacher',
                action_type:'add'
            }),
        }
    },
    methods: {
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.staff_id= '';
                this.form.subsTeacher= '',
                this.form.teaching_subject= '',
                this.form.start_date= '';
                this.form.end_date= '';
                this.form.remarks= '';
                this.form.isextended = '';
                $('#staff_id').val('').trigger('change');
            }
            // if(type=="save"){   
            //     this.form.post('staff/substitution/saveStaffSubstituted')
            //         .then(() => {
            //         Toast.fire({
            //             icon: 'success',
            //             title: 'Details added successfully'
            //         })
            //         this.$router.push('/list_substitute_teacher');
            //     })
            //     .catch(() => {
            //         console.log("Error:")
            //     })
            // }
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.form.post('staff/substitution/saveStaffSubstituted',this.form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/list_substitute_teacher');
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured. Try again.'
                            });
                            console.log("Error:"+error);
                        })
                    }
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            // if(id=="dzongkhag_id"){
            //     if($('#organization_type_id').val()==""){
            //         $('#organization_type_id_err').html('Please select Organization type');
            //     }else{
            //         this.departmentList=[];
            //         this.orgList=[];
            //         $('#organization_type_id_err').html('');
            //         // alert($('#organization_type_id').val());
            //         if($('#organization_type_id').val()=="Org"){
            //             $('#departmentdiv').hide();
            //             this.orgList=await this.schoolList($('#dzongkhag_id').val());
            //         } else if($('#organization_type_id').val()=="Ministry"){
            //             $('#departmentdiv').show();
            //             this.departmentList=await this.getDepartmentListbydzo($('#organization_type_id').val(),$('#dzongkhag_id').val());
            //         } else{
            //             this.departmentList=[];
            //             $('#departmentdiv').show();
            //             this.departmentList=await this.getDepartmentListbydzo($('#organization_type_id').val(),$('#dzongkhag_id').val());
            //         }
            //     }
            // }
            if(id=="dzongkhag_id"){
                this.orgList = [];
                this.orgList=await this.schoolList($('#dzongkhag_id').val());
            }
            // if(id=="department_id"){
            //     if($('#department_id').val()!=""){
            //         this.orgList=await this.getdivisionList($('#department_id').val());
            //     }
            // }
            if(id=="org_id"){
                this.staffList = [];
                this.staffList=await this.staffOrgwise($('#org_id').val());
            }
            if(id=="staff_id"){
                this.form.staff_id =$('#staff_id').val();
            }
            if(id="subsTeacher"){
                this.form.subsTeacher =$('#subsTeacher').val();
            }
            if(id="teaching_subject"){
                this.form.teaching_subject =$('#teaching_subject').val();
            }
            

        },
        loadstaff(){
            let uri ='loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.staffList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
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
        LoadTeachingSubject(uri = 'masters/loadAcademicMasters/all_active_teacher_subject'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.teachingSubjList =  data.data.data;
            })
             .catch(function (error) {
                console.log("Error......"+error)
            });
        },
    },
    async mounted(){
        this.dzongkhagList= await this.loadactivedzongkhags();
        this.loadstff();
        this.LoadTeachingSubject();
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

        
        // this.loadstaff();
    },
}
</script>
