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
                    <select v-model="resp_form.staff" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('staff') }" class="form-control select2" name="staff" id="staff">
                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.emp_id }} : {{ item.name }}, {{item.position_title_name}}</option>
                    </select>
                    <has-error :form="resp_form" field="staff"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Responsibility:<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="responsibility" v-model="resp_form.responsibility" :class="{ 'is-invalid select2 select2-hidden-accessible': resp_form.errors.has('responsibility') }">
                        <option v-for="(item, index) in responsibilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="resp_form" field="responsibility"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Year:<span class="text-danger">*</span></label>
                    <input type="number" class="form-control" v-model="resp_form.year" :class="{ 'is-invalid': resp_form.errors.has('year') }">
                    <has-error :form="resp_form" field="year"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="resp_form.remarks" :class="{ 'is-invalid': resp_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="resp_form" field="remarks"></has-error>
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
            responsibilityList:[],
            id:'',
            resp_form: new form({
                id:'',
                staff: '',
                responsibility:'',
                year:'',
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

        formaction: function(type){
            if(type=="reset"){
                this.resp_form.staff= '';
                this.resp_form.responsibility='';
                this.resp_form.remarks='';
                this.resp_form.status= 1;
            }
            if(type=="save"){
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',  
                    cancelButtonText: 'No',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.resp_form.post('staff/staffServices/saveStaffResponsibility')
                            .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Details added successfully'
                            })
                            this.$router.push({name:'list_roles_responsibilities',query: {data:this.screen_id}});
                        })
                        .catch(() =>{
                            console.log("Error:")
                        })
                    }
                });
            }
		},

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag_id"){
                this.departmentList=[];
                this.orgList=[];
                if($('#organization_type_id').val()==""){
                    $('#organization_type_id_err').html('Please select Organization type');
                }else{
                    $('#organization_type_id_err').html('');
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
            if(id=="responsibility"){
                this.resp_form.responsibility=$('#responsibility').val();
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
        this.responsibilityList =  await this.loadstaffMasters('active','StaResponsiblity');
        this.screen_id=this.$route.query.data;
    },

}
</script>
