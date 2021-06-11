<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Student <span class="text-danger">*</span></label>
                    <v-select :options="this.studentList" label="Name" v-model="student_form.StdStudentId">
                        <template #search="{attributes, events}">
                        <input
                            class="vs__search"
                            :required="!student_form.StdStudentId"
                            v-bind="attributes"
                            v-on="events" />
                        </template>
                    </v-select>
                    <has-error :form="student_form" field="student_form.StdStudentId"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label> Scout Section</label>
                            <v-select :options="this.scoutSectionList" label="Name" v-model="student_form.CeaSchoolScoutsId">
                                <template #search="{attributes, events}">
                                <input
                                    class="vs__search"
                                    :required="!student_form.CeaSchoolScoutsId"
                                    v-bind="attributes"
                                    v-on="events" />
                                </template>
                            </v-select>
                        <has-error :form="student_form" field="student_form.CeaSchoolScoutsId"></has-error>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Scout Level</label>
                            <v-select :options="this.scoutList" label="name" v-model="student_form.CeaSchoolSectionLevelId">
                                <template #search="{attributes, events}">
                                <input
                                    class="vs__search"
                                    :required="!student_form.CeaSchoolSectionLevelId"
                                    v-bind="attributes"
                                    v-on="events" />
                                </template>
                            </v-select>
                        <has-error :form="student_form" field="student_form.CeaSchoolSectionLevelId"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Joining Date:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" type="date">
                        <has-error :form="student_form" field="date"></has-error>
                    </div>
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
            classTecherClass:[],
            classId:'',
            streamId:'',
            sectionId:'',
            OrgClassStreamId:'',
            orgId:'',
            student_form: new form({
                id:'',
                StdStudentId: '',
                CeaSchoolScoutsId:'',
                CeaSchoolSectionLevelId:'',
                date: '',
                action_type:'add',
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
        loadActiveScoutSection(uri="masters/loadActiveStudentMasters/scout_section"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.scoutSectionList =  data.data.data;
            }).catch(function (error) { console.log("Error......"+error)});
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
        this.getClassTeacher();
        this.loadActiveScoutSection();
    },
    watch:{
        'student_form.CeaSchoolScoutsId': function(item){
            axios.get('/masters/getScoutSectionLevel/' + item.id)
            .then(response => {
                this.scoutList = response.data;
            }).catch(error => console.log(error));
        },
    }

}
</script>

