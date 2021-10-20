<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Class:<span class="text-danger">*</span></label> 
                    <select class="form-control select2" id="class_stream_section_id" v-model="class_stream_section_id"  @change="remove_err('error_class'); getSubjectByClass();">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in class_list" :key="index" :value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                            {{ item.class_stream_section }} 
                        </option>
                    </select> 
                    <span id="error_class" class="text-danger"></span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Subject:<span class="text-danger">*</span></label> 
                    <select class="form-control select2" id="aca_sub_id" v-model="form.aca_sub_id"  :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('aca_sub_id') }" @change="remove_err('aca_sub_id'); getSubjectTeacherBySubId();">
                        <option value=""> --Select--</option>
                        <option v-for="(item1, index1) in classSubjects" :key="index1" :value="item1.aca_sub_id">
                            {{ item1.subject }} 
                        </option>
                    </select> 
                    <has-error :form="form" field="aca_sub_id"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Teacher:<span class="text-danger">*</span></label> 
                    <select class="form-control select2" id="stf_staff_id" v-model="form.stf_staff_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('stf_staff_id') }"  @change="remove_err('stf_staff_id'); getStudents();">
                        <option value=""> --Select--</option>
                        <option v-for="(item1, index1) in getSubjectTeachers" :key="index1" :value="item1.stf_staff_id">
                            {{ item1.name }} [{{item1.emp_id}}]
                        </option>
                    </select> 
                    <has-error :form="form" field="stf_staff_id"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>From Date:<span class="text-danger">*</span></label> 
                    <input placeholder="dd/mm/yyyy" type="text" name="from_date" id="from_date" class="form-control form-control-sm popupDatepicker" :class="{ 'is-invalid': form.errors.has('from_date') }"  @change="remove_err('from_date')" />
                    <has-error :form="form" field="from_date"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>To Date:<span class="text-danger">*</span></label> 
                    <input placeholder="dd/mm/yyyy" type="text" name="to_date" id="to_date" class="form-control form-control-sm popupDatepicker" :class="{ 'is-invalid': form.errors.has('to_date') }" @change="remove_err('to_date')" />
                    <has-error :form="form" field="from_date"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Total No. of Hours:<span class="text-danger">*</span></label> 
                    <input v-model="form.total_hrs" type="number" name="total_hrs" id="total_hrs" class="text-right form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('total_hrs') }" @change="remove_err('total_hrs')" />
                    <has-error :form="form" field="total_hrs"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Time Description:<span class="text-danger">*</span></label> 
                    <textarea v-model="form.time_description" name="time_description" id="time_description" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('time_description') }" @change="remove_err('time_description')"></textarea>
                    <has-error :form="form" field="time_description"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="student-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="min-width:3em; max-width:5em;">Select</th>
                                <th>Roll No.</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in studentList" :key="index">
                                <td>
                                    <input v-model="form.std_student_id" :value="item.std_student_id" class="ml-2 form-check-input" type="checkbox">
                                </td>
                                <td>{{ item.roll_no }}</td>
                                <td>{{ item.Name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Remarks:</label> 
                    <textarea v-model="form.remarks" id="remarks" class="form-control form-control-sm"></textarea>
                </div>
            </div>
             <div class="card-footer text-right">
                <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                class_list:[],
                class_stream_section_id:'',
                classSubjects:[],
                getSubjectTeachers:[],
                studentList:[],
                form: new form({
                    aca_sub_id: '',
                    stf_staff_id:'',
                    from_date:'',
                    to_date:'',
                    total_hrs:'',
                    time_description:'',
                    remarks:'',
                    std_student_id:[],
                }),
                dt:'',            }
        },
        methods:{
            remove_err(id){
                if($('#' + id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id).addClass('select2');
                $('#errorId').remove()
                }
            },
            getClasses(){
                axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA')
                .then((response) => {
                    let classStreamSectionArray = []
                    let classes = response.data
                    classes.forEach(item => {
                        let CombineClassStreamSection =[]
                        CombineClassStreamSection['class_stream_section'] = item.class
                        if(item.stream && item.section){
                            CombineClassStreamSection['class_stream_section'] = item.class+' '+item.stream+' '+item.section
                        }
                        if(item.stream){
                            CombineClassStreamSection['class_stream_section'] = item.class+' '+item.stream
                        } 
                        if(item.section){
                            CombineClassStreamSection['class_stream_section'] = item.class+' '+item.section
                        }
                        CombineClassStreamSection["org_class_id"] = item.org_class_id;
                        CombineClassStreamSection["org_stream_id"] = item.org_stream_id;
                        CombineClassStreamSection["org_section_id"] = item.org_section_id;
                        CombineClassStreamSection["org_id"] = item.org_id;
                        CombineClassStreamSection['OrgClassStreamId'] = item.OrgClassStreamId
                        const object = {...CombineClassStreamSection}
                        classStreamSectionArray.push(object)
                    });
                    this.class_list = classStreamSectionArray
                    console.log(this.class_list)
                })
                .catch(function(e){
                    if(e.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                    }
                })                         
            },
            getSubjectByClass(){
                let uri = 'academics/getSubjectByClass/'+this.class_stream_section_id[1]
                if(this.class_stream_section_id[2] !== null){
                    uri += ('/'+this.class_stream_section_id[2])
                }
                axios.get(uri)
                .then(response => {
                    let classSubject = response.data.data
                    let classSubjects = []
                    let tempValue = []
                    classSubject.forEach(item => {
                        tempValue['aca_sub_id'] = item.aca_sub_id
                        tempValue['subject'] = item.subject
                        const obj = {...tempValue}
                        classSubjects.push(obj)
                    });
                    this.classSubjects = classSubjects
                    
                })
                .catch(function (error){
                    console.log('Error..... '+error)
                });
            },
            async getSubjectTeacherBySubId(){
                let teacherList = []
                let subjectTeachers = await axios.get('academics/getSubjectTeacherBySubId/'+this.form.aca_sub_id).then(response => response.data.data)
                let teachers = await axios.get('loadCommons/loadFewDetailsStaffList/userworkingagency/NA').then(response => response.data.data);
                  
                subjectTeachers.forEach(item => {
                    let aa = [];
                    teachers.forEach(item1 => {
                        if(item.stf_staff_id == item1.id){
                            aa['stf_staff_id'] = item1.id
                            aa['name'] = item1.name
                            aa['emp_id'] = item1.emp_id
                            const object = {...aa}
                            teacherList.push(object)
                        }
                    })
                })
                this.getSubjectTeachers = teacherList
            },
            getStudents(){
                this.studentList = [];
                if($('#class_stream_section_id').val()==''){
                    let errorMessage = "This field is required"
                    $('#error_class').text(errorMessage);
                    $('#class_stream_section_id').addClass('has-error');
                }
                let uri = 'academics/getStudentsForAttendance'
                uri += ('?class_stream_section='+this.class_stream_section_id[4]+'&OrgClassStreamId='+this.class_stream_section_id[0]+'&classId='+this.class_stream_section_id[1])
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
                            aa['roll_no'] = item.roll_no
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
            save(){
             this.form.from_date =this.formatYYYYMMDD($('#from_date').val())
             this.form.to_date = this.formatYYYYMMDD($('#to_date').val())
             axios.post('/academics/saveRemedialClass', {
                 org_class_id:this.class_stream_section_id[1],
                 org_stream_id:this.class_stream_section_id[2],
                 org_section_id:this.class_stream_section_id[3],
                 class_stream_section:this.class_stream_section_id[4],
                 data:this.form
                 }).then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/list-remedial-class');
                }).catch(function(errors){
                    if(errors.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'All the fields are required!',
                        })
                    }
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
            this.getClasses()
            this.dt = $("#student-table").DataTable({
                "lengthChange": false,
                "searching": false,
            })
        },
        watch: {
        studentList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#student-table").DataTable({
                    "lengthChange": false,
                    "searching": false,
                })
            });
        }
    }
    }
</script>
