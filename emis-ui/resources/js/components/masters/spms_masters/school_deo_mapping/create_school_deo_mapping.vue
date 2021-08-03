<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="classTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="class-teacher-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Class</th>
                                <th>Class Teacher</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classTeacherList" :key="index">
                                 <td>{{ index+1}}</td>
                                <td>
                                    <input v-model="classTeacherList[index].org_class_id" class="form-control" type="hidden">
                                    <input v-model="classTeacherList[index].org_stream_id" class="form-control" type="hidden">
                                    <input v-model="classTeacherList[index].org_section_id" class="form-control" type="hidden">
                                    {{ item.class_stream_section }}
                                </td>
                                <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <select v-model="classTeacherList[index].stf_staff_id" class="form-control select2">
                                            <option selected="selected" value="">---Select---</option>
                                            <option v-for="(item1, index1) in teacherList" :key="index1" :value="item1.stf_staff_id">
                                                <span v-if="item1.cid_work_permit">{{item1.cid_work_permit}}: </span>
                                                {{ item1.name }}, {{item1.position_title}}
                                            </option>
                                        </select>
                                        <!-- <has-error :form='form' field="aca_assmnt_frequency_id"></has-error> -->
                                    </div>
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
            classTeacherList: [],
            teacherList:[],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
       async getTeacher(){
             let finalTeachers = []
            try{
                let teachers = await axios.get('loadCommons/loadFewDetailsStaffList/userworkingagency/NA').then(response => response.data.data)
                let bb = []
                teachers.forEach((item => {
                    bb['cid_work_permit'] = item.cid_work_permit
                    bb['emp_id'] = item.emp_id;
                    bb['gender'] = item.gender;
                    bb['name'] = item.name;
                    bb['position_title'] = item.position_title;
                    bb['position_title_id'] = item.position_title_id;
                    bb['sex_id'] = item.sex_id;
                    bb['stf_staff_id'] = item.id
                    const obj = {...bb};
                    finalTeachers.push(obj);
                }))
                this.teacherList = finalTeachers
            }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }
        },
        async classTeacher(){
            try{
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                let finalClassStreamsSection = [];
                let renameId = []
                classSections.forEach((item => {
                    if(item.stream && item.section){
                       renameId['class_stream_section'] = item.class+' '+item.stream+' '+item.section
                    }else if(item.stream){
                        renameId['class_stream_section'] = item.class+' '+item.stream
                    }
                    else if(item.section){
                        renameId['class_stream_section'] = item.class+' '+item.section
                    }else{
                        renameId['class_stream_section'] = item.class
                    }
                    renameId['org_class_id'] = item.org_class_id;
                    renameId['org_stream_id'] = item.org_stream_id;
                    renameId['org_section_id'] = item.org_section_id;
                    renameId['org_id'] = item.org_id;
                    renameId['org_class_stream_id'] = item.OrgClassStreamId;
                    renameId['stf_staff_id'] = "";
                    const obj = {...renameId};
                    finalClassStreamsSection.push(obj);
                }))
                let classTeachers = await axios.get('academics/getClassTeacher').then(response => response.data.data)
                finalClassStreamsSection.forEach((classSection,index) => {
                    classTeachers.forEach(item => {
                        if(classSection.org_class_id == item.org_class_id && (classSection.org_stream_id == item.org_stream_id || ((classSection.org_stream_id == null || classSection.org_stream_id == "") && (item.org_stream_id == null || item.org_stream_id == ""))) && (classSection.org_section_id == item.org_section_id || ((classSection.org_section_id == null || classSection.org_section_id == "") && (item.org_section_id == null || item.org_section_id == "")))){
                            finalClassStreamsSection[index].stf_staff_id = item.stf_staff_id
                        }
                    })
                })
                this.classTeacherList = finalClassStreamsSection

             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }
        },
        save(){
             axios.post('/academics/saveClassTeacher', {data:this.classTeacherList})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-class-teacher');
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
        this.classTeacher();
        this.getTeacher();
        this.dt = $("#class-teacher-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
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
    watch: {
        classTeacherList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#class-teacher-table").DataTable({
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
