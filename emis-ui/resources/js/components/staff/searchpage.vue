<template>
    <div>
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
    </div>
</template>
<script>
export default {
    data(){
        return{
            dzongkhagList:[],
            departmentList:[],
            orgList:[],
        }
    },

    methods:{
        async loadfunction(id){
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
                //this method should defind in respextice vues
                Fire.$emit("loadRespectiveDataData", $('#org_id').val());
                //in the parent vue, need write Fire finction and respective method, refer promotion list
            }
        },
    },
    async mounted(){
        this.dzongkhagList= await this.loadactivedzongkhags();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('loadfunction',$(this).attr('id'));
        });

        Fire.$on('loadfunction',(id)=>{
            this.loadfunction(id);
        });
    },
}
</script>

