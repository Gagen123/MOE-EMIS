<template>
    <div>
        <form>
            <div class="alert alert-warning alert-dismissible" style="display:none" id="warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Information!</h5>
                <div id="message"></div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Class & Section:<i class="text-danger">*</i></label>
                    <select v-model="student_award_form.class_section" :class="{ 'is-invalid select2 select2-hidden-accessible': student_award_form.errors.has('class_section') }" class="form-control select2" name="class_section" id="class_section" >
                        <option v-for="(item, index) in classSection" :key="index" v-bind:value="[item.org_class_stream_id, item.org_stream_id, item.org_section_id]">{{ item.class_stream_section}}</option>
                    </select>
                    <has-error :form="student_award_form" field="class_section"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Student:<i class="text-danger">*</i></label>
                    <select v-model="student_award_form.student" :class="{ 'is-invalid select2 select2-hidden-accessible': student_award_form.errors.has('student') }" class="form-control select2" name="student" id="student">
                        <option v-for="(item, index) in studentList" :key="index" v-bind:value="item.id">{{ item.Name }} ({{item.student_code}})</option>
                    </select>
                    <has-error :form="student_award_form" field="student"></has-error>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <!-- select -->
                    <div class="form-group">
                        <label class="mb-0.5">Award Type:<i class="text-danger">*</i></label>
                            <select v-model="student_award_form.award_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_award_form.errors.has('award_type_id') }" class="form-control select2" name="award_type_id" id="award_type_id">
                                <option v-for="(item, index) in awardType" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                            </select>
                            <has-error :form="student_award_form" field="award_type_id"></has-error>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- select -->
                    <div class="form-group">
                        <label class="mb-0.5">Award:<i class="text-danger">*</i></label>
                            <select v-model="student_award_form.award_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_award_form.errors.has('award_id') }" class="form-control select2" name="award_id" id="award_id">
                                <option v-for="(item, index) in awardList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                            </select>
                            <has-error :form="student_award_form" field="award_id"></has-error>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Award Given By:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('award_given_by')" v-model="student_award_form.award_given_by" :class="{ 'is-invalid': student_award_form.errors.has('award_given_by') }" class="form-control" name="award_given_by" id="award_given_by" >
                        <has-error :form="student_award_form" field="award_given_by"></has-error>
                    </div> 
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Place:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_award_form.place" :class="{ 'is-invalid': student_award_form.errors.has('place') }" id="place" @change="remove_err('place')" type="text">
                    <has-error :form="student_award_form" field="place"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_award_form.date" :class="{ 'is-invalid': student_award_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="student_award_form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="student_award_form.remarks" :class="{ 'is-invalid': student_award_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="student_award_form" field="remarks"></has-error>
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
            is_classTeacher:'1',
            studentList:[],
            classSection:[],
            awardList:[],
            awardType:[],
            classId:'',
            streamId:'',
            sectionId:'',
            OrgClassStreamId:'',
            id:'3',

            student_award_form: new form({
                is_classTeacher:'1',
                id:'',
                class_section:'',
                student: '',
                award_given_by: '',
                award_type_id: '',
                award_id: '',
                place: '',
                date: '',
                remarks:'',
                action_type:'add'
            }),
        }
    },
    methods: {
        getClassTeacher(){
            axios.get('academics/getClassTeacherClasss')
            .then(response =>{
                let data = response.data.data
                this.classSection = data;
                if(data != null && data !=''){
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
                        // this.getStudentBasedOnTeacherClassSect();
                    })
                } else {
                    this.is_classTeacher=0;
                    $('#warning').show();
                    $('#message').html('User is not assigned as Class Teacher. Please assign class teacher to proceed');
                }
                
            })
        },
        loadActiveAwardTypeList(uri="masters/loadActiveStudentMasters/StudentAwardType"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.awardType =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveAwardList(id){
            let uri="masters/getStudentAwards/"+id;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.awardList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_award_form.student= '';
                this.student_award_form.remarks='';
                this.student_award_form.status= 1;
            }
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.student_award_form.post('/students/saveStudentAward',this.student_award_form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/student_awards_list');
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured. Try again.'
                            });
                            console.log("Error:"+error);
                        })
                    }
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="student"){
                this.student_award_form.student=$('#student').val();
            }
            if(id=="award_id"){
                this.student_award_form.award_id=$('#award_id').val();
            }
            if(id=="award_type_id"){
                this.student_award_form.award_type_id=$('#award_type_id').val();
                let id = $('#award_type_id').val();
                this.loadActiveAwardList(id);
            }
            if(id=="class_section"){
               this.studentList = [];
               var classVals = $('#class_section').val().split(',');
               let class_id = classVals[0];
               let stream_id = classVals[1];
               let section_id = classVals[2];
               let route = class_id+'__'+stream_id+'__'+section_id;
               if(stream_id == ''){
                   route = class_id+'__'+"NULL"+'__'+section_id;
               }
               axios.get('/students/loadStudentBySection/'+route)
                    .then((response) => {
                        this.studentList = response.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
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

        //this.loadStudentList();
        this.getClassTeacher();
        this.loadActiveAwardTypeList();
        // this.loadActiveAwardList();
    },
    
}
</script>