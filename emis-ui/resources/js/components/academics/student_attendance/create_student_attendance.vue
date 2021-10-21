<template>
   <div>
        <form class="bootbox-form">
            <div class="row form-group">
                <div class="ml-3 col-lg-3 col-md-3 col-sm-4 col-xs-12" style="padding-left:0px;">
                    <label>Date:<span class="text-danger">*</span></label>
                    <input :class="{'is-invalid': attendance_dateError }" type="text" id="attendance_date_id" placeholder="dd/mm/yyyy" class="form-control form-control-sm popupDatepicker" @change="remove_error('attendance_date_id','err_id')">
                    <span id= "err_id" class="text-danger">{{ attendance_dateError }}</span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <label>Select Class:<span class="text-danger">*</span></label>
                    <select :class="{'is-invalid select2 select2-hidden-accessible': classError  }" class="form-control form-control-sm select2" id="class_stream_section_id" v-model="class_stream_section_id"  @change="remove_err('class_stream_section_id','class_id')">
                        <option selected="selected" value="">---Select---</option>
                        <option selected v-for="(item, index) in classTecherClass" :key="index" :value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                            {{ item.class_stream_section }}
                        </option>
                    </select>
                    <span id= "class_id" class="text-danger">{{ classError }}</span>
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
                                <th>Roll No.</th>
                                <th>Name</th>
                                <th>Present</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in studentList" :key="index">
                                <td>{{ item.roll_no }}</td>
                                <td>
                                    <input v-model='studentList[index].std_student_id' type="hidden">
                                    {{ item.Name }}
                                </td>
                                <td>
                                    <div class="form-check">
                                        <input  v-model="studentList[index].is_present" class="form-check-input" type="checkbox" id="present">
                                    </div>
                                </td>
                                <td>
                                    <div v-if="item.is_present==0">
                                        <select class="select2 form-control form-control-sm" required v-model="studentList[index].aca_absence_reason_id">
                                            <option selected="selected" value="">---Select---</option>
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
                <button v-if="studentList.length"  @click.prevent="save"  class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
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
            attendance_date:'',
            message:'',
            action:'add',
            dt:'',
            attendance_dateError:'',
            classError: '',
        }
    },
    methods:{
        remove_err(id,error_id){
            if($('#' + id).val()!=""){
                if(error_id ==='err_id'){
                    $('#'+id).removeClass('is-invalid');
                }else{
                    $('#'+id).removeClass('is-invalid select2 select2-hidden-accessible');
                    $('#'+id).addClass('select2');
                }
                $('#'+error_id).remove();
            }
        },
        async getClassTeacherClasss(){
            try{
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                let classTeachers = await axios.get('academics/getClassTeacherClasss').then(response => response.data.data)
                classTeachers.forEach((classTeacher,index) => {
                    classSections.forEach(item => {
                        if(classTeacher.org_class_id == item.org_class_id && (classTeacher.org_stream_id == item.org_stream_id || ((classTeacher.org_stream_id == null ||classTeacher.org_stream_id == "") && (item.org_stream_id == null || item.org_stream_id == ""))) && (classTeacher.org_section_id == item.org_section_id || ((classTeacher.org_section_id == null || classTeacher.org_section_id == "") && (item.org_section_id == null || item.org_section_id == "")))){
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
                this.classTecherClass = classTeachers;
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }
        },
        getStudents(){
            if($('#attendance_date_id').val()==''){
                this.attendance_dateError = "This field is required"
            }else if($('#class_stream_section_id').val()==''){
                this.classError = "This field is required"
            }else{
                let uri = 'academics/getStudentsForAttendance'
                uri += ('?action='+this.action+'&attendance_date='+this.attendance_date+'&class_stream_section='+this.class_stream_section_id[4]+'&OrgClassStreamId='+this.class_stream_section_id[0]+'&classId='+this.class_stream_section_id[1])
                if(this.class_stream_section_id[2] !== null && this.class_stream_section_id[2] !== ""){
                        uri += ('&streamId='+this.class_stream_section_id[2])
                }
                if(this.class_stream_section_id[3] !== null && this.class_stream_section_id[3] !== ""){
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
                            aa['roll_no'] = item.roll_no
                            const obj = {...aa};
                            this.studentList.push(obj);
                        })
                    }

                }).catch(function (error) {
                    if(error.toString().includes("500")){
                        $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                    }
                });
            }
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
            this.attendance_date = this.formatYYYYMMDD($('#attendance_date_id').val());
            axios.post('academics/saveStudentAttendance', {
                action:this.action,
                org_class_id:this.class_stream_section_id[1],
                org_stream_id:this.class_stream_section_id[2],
                org_section_id:this.class_stream_section_id[3],
                class_stream_section:this.class_stream_section_id[4],
                attendance_date:this.attendance_date,
                data:this.studentList})
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/list-student-attendance');
                })
                .catch(function(error){
                    console.log(error);
                 this.attendance_date = error
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
