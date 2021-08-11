<template>
    <div>
        <form>
            <div class="form-group row">
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
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Staff:<i class="text-danger">*</i></label>
                    <select v-model="award_form.staff" :class="{ 'is-invalid select2 select2-hidden-accessible': award_form.errors.has('staff') }" class="form-control select2" name="staff" id="staff">
                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }} : {{ item.name }}, {{item.position_title.name}}</option>
                    </select>
                    <has-error :form="award_form" field="staff"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Award Category:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="award_category" v-model="award_form.award_category" :class="{ 'is-invalid select2 select2-hidden-accessible': award_form.errors.has('award_category') }">
                        <option v-for="(item, index) in awardCategoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="award_form" field="award_category"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Aardw Type:<span class="text-danger">*</span></label>
                     <select v-model="award_form.award_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': award_form.errors.has('award_type_id') }" class="form-control select2" name="award_type_id" id="award_type_id">
                        <option v-for="(item, index) in awardTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="award_form" field="award_type_id"></has-error>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Award Given By:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('award_given_by')" v-model="award_form.award_given_by" :class="{ 'is-invalid': award_form.errors.has('award_given_by') }" class="form-control" name="award_given_by" id="award_given_by" >
                        <has-error :form="award_form" field="award_given_by"></has-error>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Place:<span class="text-danger">*</span></label>
                    <input class="form-control" v-model="award_form.place" :class="{ 'is-invalid': award_form.errors.has('place') }" id="place" @change="remove_error('place')" type="text">
                    <has-error :form="award_form" field="place"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date:<span class="text-danger">*</span></label>
                    <input class="form-control" v-model="award_form.date" :class="{ 'is-invalid': award_form.errors.has('date') }" id="date" @change="remove_error('date')" type="date">
                    <has-error :form="award_form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="award_form.remarks" :class="{ 'is-invalid': award_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="award_form" field="remarks"></has-error>
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
            departmentList:[],
            orgList:[],

            screen_id:'',
            staffList:[],
            awardCategoryList:[],
            awardTypeList:[],
            id:'',
            award_form: new form({
                id:'',
                staff: '',
                award_given_by: '',
                award_category:'',
                award_type_id: '',
                place: '',
                date: '',
                remarks:'',
                action_type:'add',
            }),
        }
    },
    methods: {
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
        loadActiveAwardList(uri="masters/loadStaffMasters/all_active_staff_award_category_List"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.awardCategoryList =  data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadAwardType(id){
            let uri="masters/loadStaffDropdownMasters/StaffAwardType/"+id;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.awardTypeList =  data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
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
                this.award_form.staff= '';
                this.award_form.award_given_by='';
                this.award_form.award_type_id= '';
                $('#award_category').val('');
                $('#award_type_id').val('');
                this.award_form.place= '';
                this.award_form.date= '';
                this.award_form.remarks='';
                this.award_form.status= 1;
            }
            if(type=="save"){
                this.award_form.post('staff/staffServices/saveStaffAward')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push({name:'list_staff_awards',query: {data:this.screen_id}});
                })
                .catch(() => {
                    console.log("Error:")
                })
            }
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
            if(id=="award_category"){
                this.award_form.award_category=$('#award_category').val();
                this.loadAwardType($('#award_category').val());
            }
            if(id=="award_type_id"){
                this.award_form.award_type_id=$('#award_type_id').val();
            }
            if(id=="staff"){
                this.award_form.staff=$('#staff').val();
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

        this.loadStaffList();
        this.loadActiveAwardList();
        this.screen_id=this.$route.query.data;
    },

}
</script>
