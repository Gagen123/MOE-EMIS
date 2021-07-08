<template>
   <div>
        <form @submit.prevent="save" class="bootbox-form">
            <div class="row form-group">
                <div class="ml-3 col-lg-3 col-md-3 col-sm-4 col-xs-12" style="padding-left:0px;">
                    <label>Date:<span class="text-danger">*</span></label>
                    <input  id="attendance_date"  class="form-control form-control-sm" v-model="attendance_date"  type="date">
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <label>Select Class:<span class="text-danger">*</span></label> 
                    <select class="form-control form-control-sm select2" id="class_stream_section_id" v-model="class_stream_section_id" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="remove_err('class_stream_section_id')">
                        <option selected="selected" value="">---SELECT CLASS---</option>
                        <option selected v-for="(item, index) in classTecherClass" :key="index" :value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                            {{ item.class_stream_section }}
                        </option>
                    </select> 
                    <span id= "errorId" class="text-danger">{{ errorMessage }}</span>
                </div>
                <div class="col-auto pt-1 mt-4">
                    <button type="button" class="btn btn-primary btn-sm" @click="getStudents()"><i class="fa fa-download"></i> Fetch Student</button>
                </div>
            </div>
            <div v-if="studentList.length" class="form-group row mt-2">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="student-attendance-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Student Code</th>
                                <th>Name</th>
                                <th>Present</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in studentList" :key="index">
                                <td>{{ item.CidNo }}</td>
                                <td>
                                    <input v-model='studentList[index].std_student_id' type="hidden">
                                    {{ item.Name }}
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input  v-model="studentList[index].is_present" class="form-check-input" type="checkbox" value="" id="present">
                                    </div>
                                </td>   
                                <td>
                                    <div>
                                        <select class="form-control select2" v-model="studentList[index].remarks_id">
                                            <option selected="selected" value="">---SELECT---</option>
                                            <option selected v-for="(item1, index1) in remarkList" :key="index1" :value="item1.id">
                                                {{ item1.name }}
                                            </option>
                                        </select> 
                                    </div>
                                </td>                                                                           
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button v-if="studentList.length" type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button v-if="studentList.length" type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>        
        </form>
    </div>     
</template>

<script>
export default {
    data(){
        return {
            classTecherClass:[],
            remarkList:[],
            studentList:[],
            class_stream_section_id:'',
            attendance_date:new Date().toISOString().substr(0, 10),
            message:'',
            action:'add',
            dt:'',
            errorMessage: '',
        }
    },
    methods:{
        remove_err(id){
            if($('#' + id).val()!=""){
               $('#'+id).removeClass('is-invalid select2');
               $('#'+id).addClass('select2');
               $('#errorId').remove()
            }
        },
        async getClassTeacherClasss(){
            try{
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
                this.classTecherClass = classTeachers

             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }
        },
        getStudents(){
            if($('#class_stream_section_id').val()===''){
             
                this.errorMessage = "This field is required"
            }
           let uri = 'academics/getStudentsForAttendance'
            uri += ('?action='+this.action+'&attendance_date='+this.attendance_date+'&class_stream_section='+this.class_stream_section_id[4]+'&OrgClassStreamId='+this.class_stream_section_id[0]+'&classId='+this.class_stream_section_id[1])
           if(this.class_stream_section_id[2] !== null){
                    uri += ('&streamId='+this.class_stream_section_id[2])
            }
            if(this.class_stream_section_id[3] !== null){
                uri += ('&sectionId='+this.class_stream_section_id[3])
            }
                axios.get(uri)
                .then(response => {
                    if(response.data.error){
                        Swal.fire({
                            icon: 'warning',
                            text: response.data.error,
                        })
                    }else{
                        let studentList = response.data.student 
                        let aa = []
                        studentList.forEach((item)=>{
                            aa['CidNo'] = item.CidNo
                            aa['Name'] = item.Name
                            aa['std_student_id'] = item.std_student_id
                            aa['is_present'] = 1 
                            const obj = {...aa};
                            this.studentList.push(obj);
                        })
                    }

                }).catch(function (error) {
                    if(error.toString().includes("500")){
                        $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                    }
                });
        },
        loadReasonsForAbsentList(uri = 'masters/loadAcademicMasters/all_active_reasons_for_absent'){
            axios.get(uri)
            .then(response => {
                this.remarkList =  response.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        save(){
            axios.post('academics/saveStudentAttendance', {action:this.action,org_class_id:this.class_stream_section_id[1],org_stream_id:this.class_stream_section_id[2],org_section_id:this.class_stream_section_id[3],class_stream_section:this.class_stream_section_id[4],attendance_date:this.attendance_date,data:this.studentList})
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/list-student-attendance');
                })
                .catch(function(error){
                console.log( error);
            });
       
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
        this.getClassTeacherClasss()
        this.loadReasonsForAbsentList()
        this.dt = $("#student-attendance-table").DataTable({
            columnDefs: [
                { width: 20, targets: 0},
            ],
            "lengthChange": false,
            "searching": false,
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
    watch: {
        studentList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#student-attendance-table").DataTable({
                    "lengthChange": false,
                    "searching": false,
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