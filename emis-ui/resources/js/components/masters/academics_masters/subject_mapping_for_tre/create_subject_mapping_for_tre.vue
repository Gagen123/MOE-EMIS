<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectTeacher">
             <div class="ml-0 row form-group">
                <div class="mr-3">
                    <strong>Class: </strong> {{ class_stream }} 
                </div>
            </div>  
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="subject-teacher-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Subject</th>
                                <th>Teacher's Subject</th>
                                <th>Standard Hour(s)</th>
                                <th>Standard Minutes(s)</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classSubjects" :key="index">
                                <td>{{ index+1}}</td>
                                <td>
                                    <input v-model="classSubjects[index].aca_sub_id" class="form-control" type="hidden">
                                    {{ item.name }} 
                                    <span v-if="item.dzo_name">( {{ item.dzo_name }} )</span>
                                </td>                                                                               
                                <td>
                                    <select v-model="classSubjects[index].aca_teacher_sub_id" class="form-control select2"> 
                                        <option selected="selected" value="">---Select---</option>
                                        <option v-for="(item1, index1) in main_subject" :key="index1" :value="item1.id">
                                            {{item1.name}}
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <input v-model="classSubjects[index].standard_hours" class="text-right form-control form-control-sm" type="number" name="standard_hours" id="standard_hours">
                                </td>
                                <td>
                                    <input v-model="classSubjects[index].standard_minutes" class="text-right form-control form-control-sm" type="number" name="standard_minutes" id="standard_minutes">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            class_stream:'',
            classSubjects: [],
            main_subject:[],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        getTeacherSubjects(){
            axios.get('masters/loadAcademicMasters/all_active_teacher_subject')
            .then(response =>{
                let data = response;
                this.main_subject = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
         async getsubjectTeachers(){
            let uri = 'academics/getSubjectTeacher'
            uri += ('?org_class_id='+this.org_class_id)
            if(this.org_stream_id !== null){
                    uri += ('&org_stream_id='+this.org_stream_id)
            }
            try{
                let data = await axios.get(uri).then(response => response.data)
                data.classSubjects.forEach((finalSubjectTeacher,index) => {
                    data.classSubjects[index].aca_teacher_sub_id = '';
                    data.classSubjects[index].standard_hours = 0;
                    data.classSubjects[index].standard_minutes = 0;
                    data.subjectMappingForTre.forEach(subjectMapping => {
                        if(finalSubjectTeacher.aca_sub_id == subjectMapping.aca_sub_id && finalSubjectTeacher.org_class_id == subjectMapping.org_class_id
                         && (finalSubjectTeacher.org_stream_id == subjectMapping.org_stream_id || ((finalSubjectTeacher.org_stream_id == null 
                         || finalSubjectTeacher.org_stream_id == "") && (subjectMapping.org_stream_id == null)|| subjectMapping.org_stream_id == ""))){
                            data.classSubjects[index].aca_teacher_sub_id = subjectMapping.aca_teacher_sub_id
                            data.classSubjects[index].standard_hours = subjectMapping.standard_hours;
                            data.classSubjects[index].standard_minutes = subjectMapping.standard_minutes;
                        }
                    });
                });
                this.classSubjects = data.classSubjects;
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }                           
        },
        save(){
             axios.post('/masters/saveSubjectMappingForTre', {class_stream:this.class_stream,org_class_id:this.org_class_id,org_stream_id:this.org_stream_id,data:this.classSubjects})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-subject-mapping-for-tre');
                }).catch(function(errors){
                    if(errors.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'You have not selected teacher\'s subject!',
                        })
                    }
                });
        },
	 
    },
    mounted(){ 
        this.getsubjectTeachers();
        this.getTeacherSubjects();
        this.dt = $("#subject-teacher-table").DataTable({
            columnDefs: [
                { width: 2, targets: 0},
                { width: 200, targets:1},
                { width: 200, targets:2},

            ],
            drawCallback: function(dt) {
                $('.select2').select2().
                on("select2:select", e => {
                    const event = new Event("change", { bubbles: true, cancelable: true });
                    e.params.data.element.parentElement.dispatchEvent(event);
                })
                .on("select2:unselect", e => {
                const event = new Event("change", { bubbles: true, cancelable: true });
                e.params.data.element.parentElement.dispatchEvent(event);
                });
            },
        })

        
    },
      created() {
        this.org_class_id=this.$route.params.data.org_class_id;
        this.org_stream_id=this.$route.params.data.org_stream_id;
        this.class_stream =this.$route.params.data.class_stream;
        this.id=this.$route.params.data.id;
    },
    watch: {
        classSubjects(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#subject-teacher-table").DataTable({
                    drawCallback: function(dt) {
                $('.select2').select2().
                on("select2:select", e => {
                    const event = new Event("change", { bubbles: true, cancelable: true });
                    e.params.data.element.parentElement.dispatchEvent(event);
                })
                .on("select2:unselect", e => {
                const event = new Event("change", { bubbles: true, cancelable: true });
                e.params.data.element.parentElement.dispatchEvent(event);
                });
            },
                })
            });
        }
    }
    
}
</script>