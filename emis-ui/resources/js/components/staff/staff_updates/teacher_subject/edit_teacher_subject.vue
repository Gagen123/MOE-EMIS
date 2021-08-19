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
                    <select v-model="form.comp_sub_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('comp_sub_id') }" class="form-control select2" name="comp_sub_id" id="comp_sub_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id+'__'+item.is_special_educational_needs">{{ item.name }}</option>
                    </select>
                     <has-error :form="form" field="comp_sub_id"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Elective Subject 1:</label>
                    <select v-model="form.elective_sub_id1" :class="{'is-invalid select2 select2-hidden-accessible': form.errors.has('elective_sub_id1') }" class="form-control select2" name="elective_sub_id1" id="elective_sub_id1">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="elective_sub_id1"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Elective Subject 2:</label>
                    <select v-model="form.elective_sub_id2" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('elective_sub_id2') }" class="form-control select2" name="elective_sub_id2" id="elective_sub_id2">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in subjectList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="elective_sub_id2"></has-error>
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
                comp_sub_id:'',
                elective_sub_id1: '',
                elective_sub_id2: '',
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
                this.form.post('staff/staffUpdateController/saveTeachinSubject')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updaetd successfully'
                    })
                    this.$router.push('/list_teacher_subject');
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
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="comp_sub_id"){
                this.form.comp_sub_id=$('#comp_sub_id').val();
            }
            if(id=="elective_sub_id1"){
                this.form.elective_sub_id1=$('#elective_sub_id1').val();
            }
            if(id=="elective_sub_id2"){
                this.form.elective_sub_id2=$('#elective_sub_id2').val();
            }
        },
    },
     mounted(){
        this.loadAcademicMasters();
        this.loadpositionTitleList(this.$route.query.data.position_title_id);
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
        this.emp_id=this.$route.query.data.emp_id;
        this.name=this.$route.query.data.name;
        this.form.id=this.$route.query.data.id;
        this.form.comp_sub_id=this.$route.query.data.comp_sub_id;
        $('#comp_sub_id').val(this.$route.query.data.comp_sub_id).trigger('change');
        this.form.elective_sub_id1=this.$route.query.data.elective_sub_id1;
        $('#elective_sub_id1').val(this.$route.query.data.elective_sub_id1).trigger('change');
        this.form.elective_sub_id2=this.$route.query.data.elective_sub_id2;
        $('#elective_sub_id2').val(this.$route.query.data.elective_sub_id2).trigger('change');
    },
}
</script>
