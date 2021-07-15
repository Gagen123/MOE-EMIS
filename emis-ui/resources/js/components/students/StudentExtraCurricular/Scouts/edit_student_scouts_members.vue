<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Student:<i class="text-danger">*</i></label>
                    <select v-model="student_form.student" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('student') }" class="form-control select2" name="student" id="student">
                        <option v-for="(item, index) in studentList" :key="index" v-bind:value="item.id">{{ item.Name}} ({{item.student_code}})</option>
                    </select>
                    <has-error :form="student_form" field="student"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0.5">Scout Section:<i class="text-danger">*</i></label>
                    <select v-model="student_form.CeaScoutSectionId" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('CeaScoutSectionId') }" class="form-control select2" name="CeaScoutSectionId" id="CeaScoutSectionId">
                        <option v-for="(item, index) in scoutSectionList" :key="index" v-bind:value="item.id">{{ item.name}}</option>
                    </select>
                    <has-error :form="student_form" field="CeaScoutSectionId"></has-error>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0.5">Scout Advancement Level:</label>
                    <select v-model="student_form.CeaScoutSectionLevelId" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('CeaScoutSectionLevelId') }" class="form-control select2" name="CeaScoutSectionLevelId" id="CeaScoutSectionLevelId">
                        <option v-for="(item, index) in scoutSectionLevelList" :key="index" v-bind:value="item.id">{{ item.name}}</option>
                    </select>
                    <has-error :form="student_form" field="CeaScoutSectionLevelId"></has-error>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Joining Date:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" type="date">
                        <has-error :form="student_form" field="date"></has-error>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="student_form.remarks" :class="{ 'is-invalid': student_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="student_form" field="remarks"></has-error>
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
            studentList:[],
            scoutList:[],
            scoutSectionList:[],
            scoutSectionLevelList:[],
            classTecherClass:[],
            classId:'',
            streamId:'',
            sectionId:'',
            OrgClassStreamId:'',
            orgId:'',
            student_form: new form({
                id:'',
                student: '',
                CeaScoutSectionId:'',
                CeaScoutSectionLevelId:'',
                date: '',
                remarks:'',
                action_type:'edit',
            }),
        }
    },
    methods: {
        getClassTeacher(){
            axios.get('academics/getClassTeacherClasss')
            .then(response =>{
                let data = response.data.data
                data.forEach((item)=>{
                    this.classId = item.org_class_id
                    if(item.org_stream_id != null){
                        this.streamId = item.org_stream_id;
                    }else if(item.org_section_id != null){
                        this.sectionId = item.org_section_id;
                    }else{
                        this.classId = item.org_class_id
                    }
                    this.OrgClassStreamId = item.org_class_stream_id;
                    this.orgId = item.org_id;
                    this.getStudentBasedOnTeacherClassSect();
                })
            })
        },
        getStudentBasedOnTeacherClassSect(){
            axios.get("common/getStudentList/"+ this.orgId +'/'+ this.OrgClassStreamId)
            .then(response => {
                this.studentList = response.data;
            })
        },
        loadActiveScoutSection(uri="masters/getScoutSection"){
            axios.get(uri)
            .then(response => {
                this.scoutSectionList =  response.data;
            }).catch(function (error) { console.log("Error......"+error)});
        },
        
        loadActiveScoutSectionLevel(id){
            let scout_section=$('#CeaScoutSectionId').val();
            if(id!="" && scout_section==null){
                scout_section=id;
            }
            let uri = '/masters/getScoutSectionLevel/'+scout_section;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.scoutSectionLevelList = data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            
            if(id=="student"){
                this.student_form.student=$('#student').val();
            }
            if(id=="CeaScoutSectionId"){
                this.student_form.CeaScoutSectionId=$('#CeaScoutSectionId').val();
                let scout_section_selected = $('#CeaScoutSectionId').val();
                this.loadActiveScoutSectionLevel();
            }
            if(id=="CeaScoutSectionLevelId"){
                this.student_form.CeaScoutSectionLevelId=$('#CeaScoutSectionLevelId').val();
            }
            
        },
        formaction: function(type){
            if(type=="save"){
                if(this.student_form.StdStudentId == ''){
                    alert('Please Select Student');
                }else if(this.CeaSchoolScoutsId == ''){
                    alert('Please Select Scout Section');
                }else {
                    this.student_form.post('/students/saveScoutParticipants',this.student_form)
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/student_scouts_members_list');
                    }).catch(() => {console.log("Error......") })
                }
            }
		},

    },
    mounted() {
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

        this.getClassTeacher();
        this.loadActiveScoutSection();
    },

    created() {
        this.student_form.id=this.$route.params.data.id;
        this.student_form.student=this.$route.params.data.StdStudentId;
        this.student_form.CeaScoutSectionId=this.$route.params.data.CeaScoutSectionId;
        this.student_form.CeaScoutSectionLevelId=this.$route.params.data.CeaScoutSectionLevelId;
        this.student_form.date=this.$route.params.data.joiningDate;
        this.student_form.remarks=this.$route.params.data.remarks;
    },

}
</script>

