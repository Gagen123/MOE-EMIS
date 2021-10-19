<template>
    <div>
        <div class="form-group row">
           <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Class:<span class="text-danger">*</span></label> 
                <select class="form-control form-control-sm select2" id="class_stream_section_id" v-model="class_stream_section_id" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="getApprovedTerms(); remove_err('class_stream_section_id')">
                    <option selected="selected" value="">---Select---</option>
                    <option selected v-for="(item, index) in Classes" :key="index" :value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                        {{ item.class_stream_section }}
                    </option>
                </select> 
                <span id= "errorId" class="text-danger">{{ errorMessage }}</span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <label>Academic Year:</label> 
                <select class="form-control select2" id="academic_year" v-model="academic_year" @change="getApprovedTerms();">
                        <option :value="academic_year+1">{{academic_year+1}}</option>
                        <option :value="academic_year">{{academic_year}}</option>
                        <option :value="academic_year-1">{{academic_year-1}}</option>
                        <option :value="academic_year-2">{{academic_year-2}}</option>
                        <option :value="academic_year-3">{{academic_year-3}}</option>
                        <option :value="academic_year-4">{{academic_year-4}}</option>
                        <option :value="academic_year-5">{{academic_year-5}}</option>
                </select> 
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                <table id="stduent-progress-report-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Term</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in approvedTerms" :key="index">
                            <td>{{ item.term_name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('view_student_progress_report',item)"> <i class="fas fa-eye"></i > View/Print Progress Report</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return{
            Classes:[],
            approvedTerms:[],
            class_stream_section_id:'',
            academic_year:new Date().getFullYear(),
            errorMessage:'',
            dt:''
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
        async getClassses(){
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
            this.Classes = classTeachers;
        }, 
        getApprovedTerms(){
            if($('#class_stream_section_id').val() !=''){
                let uri = 'academics/getApprovedTerms'
                uri += ('?academic_year='+this.academic_year+'&org_class_id='+this.class_stream_section_id[1])
                if(this.class_stream_section_id[2] !== null){
                    uri += ('&org_stream_id='+this.class_stream_section_id[2])
                }
                if(this.class_stream_section_id[3] !== null){
                    uri += ('&org_section_id='+this.class_stream_section_id[3])
                }
                axios.get(uri).then(response => {
                    this.approvedTerms =  response.data.data
                })
                 
             }else{
                 this.errorMessage = "This field is required"
             } 
           },
        showedit(route,data){
            this.$router.push({name:route,params: {data:data}});
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
        this.getClassses()
        this.dt = $("#stduent-progress-report-table").DataTable({
            "order": [[ 0, "asc" ]],
            "lengthChange": false,
            "searching": false,
        })
    },
    watch: {
        approvedTerms(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#stduent-progress-report-table").DataTable({
                "order": [[ 0, "asc" ]],
                "lengthChange": false,
                "searching": false,
                })
            });
        }
    }
}
</script>