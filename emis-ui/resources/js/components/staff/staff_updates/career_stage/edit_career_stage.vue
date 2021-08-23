<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Emp Id:</label><br>
                    {{emp_id}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Name:</label><br>
                    {{name}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Position Title:</label><br>
                    {{position_title}}
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
            cureerstageList:[],
            positiontitleList:{},
            position_title:'',name:'',emp_id:'',
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
                this.form.post('staff/staffUpdateController/saveStaffcareerStage')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updaetd successfully'
                    })
                    this.$router.push('/list_career_stage');
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
        loadpositionTitleList(positionid){
            let uri = 'staff/loadStaffMasters/active/PositionTitle';
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.positiontitleList[data.data.data[i].id] = data.data.data[i].name;
                }
                this.position_title=this.positiontitleList[positionid];
            })
            .catch(function (error){
                console.log('Error: '+error);
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
        this.loadpositionTitleList(this.$route.query.data.position_title_id);
        this.emp_id=this.$route.query.data.emp_id;
        this.name=this.$route.query.data.name;
        this.form.id=this.$route.query.data.id;
        this.form.currier_stage=this.$route.query.data.cureer_stagge_id;
        $('#cureer_stagge_id').val(this.$route.query.data.cureer_stagge_id).trigger('change');
    },
}
</script>
