<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Staff:<i class="text-danger">*</i></label><br>
                    <select v-model="form.staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('staff_id') }" class="form-control select2" name="staff_id" id="staff_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in staffList" :key="index" v-bind:value="item.id">{{ item.cid_work_permit }}: {{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="staff_id"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Career Stage:<i class="text-danger">*</i></label><br>
                    <select @change="remove_error('currier_stage')" v-model="form.currier_stage" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('currier_stage') }" class="form-control select2" name="currier_stage" id="currier_stage">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in cureerstageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="currier_stage"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
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
            cureerstageArray:{},
            staffList:[],
            cureerstageList:[],
            form: new form({
                id:'',
                staff_id:'',
                currier_stage: '',
                remarks:'',
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
                this.form.currier_stage= '';
                $('#currier_stage').val('').trigger('change');
                this.form.remarks= '';
            }
            if(type=="save"){
                this.form.post('staff/staffUpdateController/saveStaffMaritialStatus')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updaetd successfully'
                    })
                    this.$router.push('/list_maritial_status');
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
            if(id=="currier_stage"){
                this.form.currier_stage=$('#currier_stage').val();
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
        loadactivecureerstageList(uri="masters/loadStaffMasters/all_active_cureer_stage_list"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.cureerstageArray[data.data.data[i].id] = data.data.data[i].name;
                }
                this.cureerstageList=data.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
    },
     mounted(){
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

        this.loadactivecureerstageList();
        this.loadstaff();
        this.form.id=this.$route.params.id;
        this.form.staff_id=this.$route.params.id;
    },
}
</script>
