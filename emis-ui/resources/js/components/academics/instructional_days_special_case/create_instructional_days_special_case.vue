<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Class:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="class_stream_section_id" v-model="class_stream_section_id" :class="{ 'is-invalid select2-hidden-accessible': form.errors.has('org_class_id') }"  @change="getTerms(); getStudents(); remove_err('org_class_id'); formaction('reset');">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in classes" :key="index" v-bind:value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                                {{ item.class_stream_section }} 
                            </option>
                        </select> 
                        <has-error :form="form" field="org_class_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Student:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="std_student_id" v-model="form.std_student_id" :class="{ 'is-invalid select2-hidden-accessible': form.errors.has('std_student_id') }"  @change="getAttendanceData(); remove_err('std_student_id')">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in studentList" :key="index" :value="item.std_student_id">
                                {{ item.Name }} 
                            </option>
                        </select> 
                        <has-error :form="form" field="std_student_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Term:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="aca_assmt_term_id" v-model="form.aca_assmt_term_id" :class="{ 'is-invalid select2-hidden-accessible': form.errors.has('aca_assmt_term_id') }"  @change="getAttendanceData(); remove_err('aca_term_id')">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in terms" :key="index" v-bind:value="item.id">
                                {{ item.name }} 
                            </option>
                        </select> 
                        <has-error :form="form" field="aca_assmt_term_id"></has-error>
                    </div>
                </div> 
                <div class="row form-group">
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. of Instructional Days for Regular Students:</label>
                        <input class="form-control form-control-sm text-right" v-model="no_instructional_days" type="number" disabled>
                    </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. of Days the Student was Present:</label>
                        <input class="form-control form-control-sm text-right" v-model="no_days_present" type="number" disabled>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>No. of Instructional Days for the Student:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm text-right" v-model="form.instructional_days" :class="{ 'is-invalid': form.errors.has('instructional_days') }" @change="remove_err('instructional_days')" type="number" min="0" :max="no_instructional_days">
                        <has-error :form="form" field="instructional_days"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Remarks:<span class="text-danger">*</span></label>
                        <textarea class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" @change="remove_err('remarks')"></textarea>
                        <has-error :form="form" field="remarks"></has-error>
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
            classes:[],
            studentList:[],
            no_instructional_days:'0',
            no_days_present:'0',
            terms:[],
            class_stream_section_id:'',
            form: new form({
                aca_assmt_term_id:'',
                std_student_id:'',
                instructional_days:'',
                remarks:'',
                action:'add'
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
               $('#'+field_id).removeClass('is-invalid select2');
               $('#'+field_id).addClass('select2');
            }
        },
       async getClassTeacherClasss(){
            let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
            let classTeachers = await axios.get('academics/getClassTeacherClasss').then(response => response.data.data)
            classTeachers.forEach((classTeacher,index) => {
                classSections.forEach(item => {
                    if(classTeacher.org_class_id == item.org_class_id && (classTeacher.org_stream_id == item.org_stream_id || (classTeacher.org_stream_id == null && item.org_stream_id == null)) && (classTeacher.org_section_id == item.org_section_id || (classTeacher.org_section_id == null && item.org_section_id == null))){
                        classTeachers[index].org_class_id = item.org_class_id;
                        classTeachers[index].org_stream_id = item.org_stream_id
                        classTeachers[index].org_section_id = item.org_section_id
                        classTeachers[index].OrgClassStreamId = item.OrgClassStreamId
                        if(item.stream && item.section){
                            classTeachers[index]['class_stream_section'] = item.class+' '+item.stream+' '+item.section
                        }else if(item.stream){
                            classTeachers[index]['class_stream_section'] = item.class+' '+item.stream
                        }else if(item.section){
                            classTeachers[index]['class_stream_section'] = item.class+' '+item.section
                        }else{
                            classTeachers[index]['class_stream_section'] = item.class
                        }
                    }
                })
            });
            this.classes = classTeachers
       },
      getStudents(){
          this.studentList = [];
           let uri = 'academics/getStudentsForAttendance'
            uri += ('?class_stream_section='+this.class_stream_section_id[4]+'&OrgClassStreamId='+this.class_stream_section_id[0]+'&classId='+this.class_stream_section_id[1])
           if(this.class_stream_section_id[2] !== null){
                uri += ('&streamId='+this.class_stream_section_id[2])
            }
            if(this.class_stream_section_id[3] !== null){
                uri += ('&sectionId='+this.class_stream_section_id[3])
            }
            axios.get(uri)
            .then(response => {
                    this.studentList = response.data.student 
                })
        },
        getTerms(){
            this.terms = [];
            let uri = 'academics/getTermsByClass/'+this.class_stream_section_id[1]
            if(this.class_stream_section_id[2] !== null){
                uri += ('/'+this.class_stream_section_id[2])
            }
            axios.get(uri).then((response)=>{
                this.terms = response.data.data
            })
        },
        getAttendanceData(){
            let uri = 'academics/getAttendanceData'
            let std_id = $('#std_student_id').val()
            uri += ('?studentId='+std_id+'&termId='+this.form.aca_assmt_term_id+'&classId='+this.class_stream_section_id[1])
           if(this.class_stream_section_id[2] !== ""){
                uri += ('&streamId='+this.class_stream_section_id[2])
            }
            if(this.class_stream_section_id[3]!==""){
                uri += ('&sectionId='+this.class_stream_section_id[3])
            }
            axios.get(uri).then(response =>{
                let instructional_days = response.data.data
                console.log(instructional_days);
                instructional_days.forEach(item=>{
                    this.no_instructional_days = item.no_instructional_days
                    this.no_days_present = item.no_days_present
                })
               
            })
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.class_stream_section_id = '';
                this.form.std_student_id = '';
                this.form.aca_assmt_term_id = '';
                this.no_instructional_days= '';
                this.no_days_present= '';
                this.form.instructional_days='';
                this.form.remarks='';
            }
            if(type=="save"){
             const assignName = {org_class_stream_id:this.class_stream_section_id[0], org_class_id:this.class_stream_section_id[1],org_stream_id:this.class_stream_section_id[2],org_section_id:this.class_stream_section_id[3],class_stream_section:this.class_stream_section_id[4] }
             const newForm = Object.assign(this.form,assignName)
             console.log(this.form)
                this.form.post('academics/saveInstrunctionalDays',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list-instructional-days-special-case');
                })
                .catch(() => {
                    console.log("Error.")
                })
            }
		}, 
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true });
            e.params.data.element.parentElement.dispatchEvent(event);
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true });
        e.params.data.element.parentElement.dispatchEvent(event);
        });
        this.getClassTeacherClasss();
    }
}
</script>