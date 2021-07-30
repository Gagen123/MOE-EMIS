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
                    <label class="mb-0.5">Compulsory Subject:</label>
                    <select v-model="personal_form.comp_sub" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('comp_sub') }" class="form-control select2" name="comp_sub" id="comp_sub">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id+'__'+item.is_special_educational_needs">{{ item.name }}</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <select v-model="personal_form.elective_sub1" :class="{'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('elective_sub1') }" class="form-control select2" name="elective_sub1" id="elective_sub1">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="personal_form" field="elective_sub1"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <select v-model="personal_form.elective_sub2" :class="{ 'is-invalid select2 select2-hidden-accessible': personal_form.errors.has('elective_sub2') }" class="form-control select2" name="elective_sub2" id="elective_sub2">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="personal_form" field="elective_sub2"></has-error>
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
            subjectList:[],
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
            let uri = 'masters/loadStaffMasters/all_active_position_title';
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
        loadAcademicMasters(uri="masters/loadAcademicMasters/all_active_subject"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.subjectList =  data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
    },
     mounted(){
        this.loadAcademicMasters();
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
