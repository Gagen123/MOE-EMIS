<template>
    <div>
        <form>
            <search />
            <!-- <div class="form-group row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0">Organization Type : <i class="text-danger">*</i></label>
                    <select class="form-control select2" name="organization_type_id" id="organization_type_id">
                        <option value=""> --Select--</option>
                        <option value="Org">Organization/School </option>
                        <option value="Dzongkhag">Dzongkhag</option>
                        <option value="Ministry">Ministry </option>
                    </select>
                    <span class="text-danger" id="organization_type_id_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="dzosection">
                    <label class="mb-0">Dzongkhag: <i class="text-danger">*</i></label>
                    <select class="form-control select2" id="dzongkhag_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <span class="text-danger" id="dzongkhag_id_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="display:none" id="departmentdiv">
                    <label class="mb-0">Department: <i class="text-danger">*</i></label>
                    <select class="form-control select2" name="department_id" id="department_id">
                        <option value="ALL"> --Select--</option>
                        <option v-for="(item, index) in departmentList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <span class="text-danger" id="department_id_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0">Organization: <i class="text-danger">*</i></label>
                    <select class="form-control select2" id="org_id">
                        <option value="ALL"> --Select--</option>
                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <span class="text-danger" id="org_id_err"></span>
                </div>
            </div>
             -->
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Staff:<i class="text-danger">*</i></label>
                    <select v-model="resp_form.staff" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('staff') }" class="form-control select2" name="staff" id="staff">
                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.emp_id }} : {{ item.name }}, {{item.position_title_name}}, {{item.positionlevel}}</option>
                    </select>
                    <has-error :form="resp_form" field="staff"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Offence Type:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="offence_type_id" v-model="resp_form.offence_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('offence_type_id') }">
                        <option v-for="(item, index) in offenceTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="resp_form" field="offence_type_id"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Case Type:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="case_type" v-model="resp_form.case_type" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('case_type') }">
                        <option v-for="(item, index) in CaseTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="resp_form" field="offence_type_id"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Case Category:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="case_category" v-model="resp_form.case_category" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('case_category') }">
                        <option v-for="(item, index) in CaseCategoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="resp_form" field="case_category"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Description of Offence:</label>
                    <textarea @change="remove_error('offence_description')" class="form-control" v-model="resp_form.offence_description" :class="{ 'is-invalid': resp_form.errors.has('offence_description') }" name="offence_description" id="offence_description"></textarea>
                    <has-error :form="resp_form" field="offence_description"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Offence Date:<span class="text-danger">*</span></label>
                    <input class="form-control popupDatepicker" type="text" autocomplete="off" :class="{ 'is-invalid': resp_form.errors.has('offence_date') }" id="offence_date">
                    <has-error :form="resp_form" field="offence_date"></has-error>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('description_on_action')" class="form-control" v-model="resp_form.description_on_action" :class="{ 'is-invalid': resp_form.errors.has('description_on_action') }" name="description_on_action" id="description_on_action"></textarea>
                    <has-error :form="resp_form" field="description_on_action"></has-error>
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
import search from "../../searchpage.vue";
export default {
    components: {
        search,
    },
    data(){
        return {
            dzongkhagList:[],
            dzo_id:'',
            departmentList:[],
            orgList:[],
            screen_id:'',
            staffList:[],
            offenceTypeList:[],
            CaseTypeList:[],
            CaseCategoryList:[],
            resp_form: new form({
                id:'',
                staff: '',
                offence_date:'',
                offence_type_id:'',
                case_type:'',
                case_category:'',
                offence_description:'',
                description_on_action:'',
                action_type:'add',
            }),
        }
    },
    methods: {
        // loadStaffList(uri='loadCommons/loadStaffList/userdzongkhagwise/NA'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response.data.data;
        //         this.staffList =  data;
        //     })
        //     .catch(function (error){
        //         console.log("Error: "+error)
        //     });
        // },

        loadStaffList(uri='loadCommons/loadStaffList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.staffList =  data;
            })
            .catch(function (error){
                console.log("Error: "+error)
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.resp_form.staff= '';
                this.resp_form.offence_type_id='';
                this.resp_form.case_type='';
                this.resp_form.case_category= '';
                this.resp_form.offence_description= '';
                this.resp_form.description_on_action= '';
            }
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    cancelButtonText:'No',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.resp_form.offence_date=this.formatYYYYMMDD($('#offence_date').val());
                        this.resp_form.post('staff/staffServices/saveStaffDisaplinary')
                            .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Details added successfully'
                            });
                            this.applyselect();
                            this.$router.push({name:'list_staff_disciplinary',query: {data:this.screen_id}});
                        })
                        .catch(() => {
                            console.log("Error:")
                        })
                    }
                })

            }
		},
        applyselect(){
            this.applyselect2field('staff');
            this.applyselect2field('offence_type_id');
            this.applyselect2field('case_type');
            this.applyselect2field('case_category');
        },

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag_id"){
                if($('#organization_type_id').val()==""){
                    $('#organization_type_id_err').html('Please select Organization type');
                }else{
                    this.departmentList=[];
                    this.orgList=[];
                    $('#organization_type_id_err').html('');
                    // alert($('#organization_type_id').val());
                    if($('#organization_type_id').val()=="Org"){
                        $('#departmentdiv').hide();
                        this.orgList=await this.schoolList($('#dzongkhag_id').val());
                    } else if($('#organization_type_id').val()=="Ministry"){
                        $('#departmentdiv').show();
                        this.departmentList=await this.getDepartmentListbydzo($('#organization_type_id').val(),$('#dzongkhag_id').val());
                    } else{
                        this.departmentList=[];
                        $('#departmentdiv').show();
                        this.departmentList=await this.getDepartmentListbydzo($('#organization_type_id').val(),$('#dzongkhag_id').val());
                    }
                }
            }
            if(id=="department_id"){
                if($('#department_id').val()!=""){
                    this.orgList=await this.getdivisionList($('#department_id').val());
                }
            }
            if(id=="org_id"){
                this.staffList = [];
                this.staffList=await this.staffOrgwise($('#org_id').val());
            }

            if(id=="staff"){
                this.resp_form.staff=$('#staff').val();
            }
            if(id=="offence_type_id"){
                this.resp_form.offence_type_id=$('#offence_type_id').val();
            }
            if(id=="case_type"){
                this.resp_form.case_type=$('#case_type').val();
            }
            if(id=="case_category"){
                this.resp_form.case_category=$('#case_category').val();
            }
        },
        async loadRespectiveDataData(org_id){
            this.staffList = [];
            this.staffList=await this.staffOrgwise(org_id);
        },

    },
    async mounted(){
        this.dzongkhagList= await this.loadactivedzongkhags();
        $('[data-toggle="tooltip"]').tooltip();
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

        Fire.$on('loadRespectiveDataData',(id)=>{
            this.loadRespectiveDataData(id);
        });

        // this.loadStaffList();
        this.offenceTypeList =  await this.loadstaffMasters('active','StaffOffenceType');
        this.CaseTypeList =  await this.loadstaffMasters('active','CaseType');
        this.CaseCategoryList =  await this.loadstaffMasters('active','CaseCategory');
        this.screen_id=this.$route.query.data;
    },

}
</script>
