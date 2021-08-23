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
                    <label class="mb-0.5">Is SEN:</label>
                    <input type="radio" v-model="form.is_sen" name="is_sen" value="1"> Yes
                    <input type="radio" v-model="form.is_sen" name="is_sen" value="0"> No
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Has teacher/ECCD facilitators received any training on supporting children/students with disabilities?</label>
                    <input type="radio" v-model="form.is_trained_in_sen" name="is_trained_in_sen" value="1"> Yes
                    <input type="radio" v-model="form.is_trained_in_sen" name="is_trained_in_sen" value="0"> No
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="form.sen_remarks" :class="{ 'is-invalid': form.errors.has('sen_remarks') }" name="sen_remarks" id="sen_remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return{
            positiontitleList:{},
            emp_id:'',name:'',position_title:'',
            form: new form({
                id:'',
                staff_id:'',
                is_sen: '',
                is_trained_in_sen: '',
                sen_remarks:'',
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
            if(type=="save"){
                this.form.post('staff/staffUpdateController/saveSEN')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updaetd successfully'
                    })
                    this.$router.push('/list_sen');
                })
                .catch(() => {
                    console.log("Error:")
                })
            }
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
        this.loadpositionTitleList(this.$route.params.data.position_title_id);
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
        // this.loadStaff(this.$route.params.id);
        this.emp_id=this.$route.params.data.emp_id;
        this.name=this.$route.params.data.name;
        this.form.id=this.$route.params.data.id;
        this.form.is_sen=this.$route.params.data.is_sen;
        this.form.is_trained_in_sen=this.$route.params.data.is_trained_in_sen;
        this.form.sen_remarks=this.$route.params.data.sen_remarks;
    },
}
</script>
