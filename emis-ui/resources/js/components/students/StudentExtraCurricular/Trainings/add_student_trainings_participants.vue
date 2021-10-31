<template>
    <div> 
        <div class="alert alert-warning alert-dismissible" style="display:none" id="warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Information!</h5>
            <div id="message"></div>
        </div>
        <form class="bootbox-form">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Class:<i class="text-danger">*</i></label>
                    <!-- @change="aboveClass10()" -->
                    <select v-model="student_form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_class') }"  class="form-control select2" name="std_class" id="std_class">
                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                    </select>
                    <has-error :form="student_form" field="std_class"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stream_selection" style="display:none">
                    <label>Streams:<i class="text-danger">*</i></label>
                    <select v-model="student_form.std_stream" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_stream') }" class="form-control select2" name="std_stream" id="std_stream">
                        <option v-for="(item, index) in streamList" :key="index" v-bind:value="item.stream_id">{{ item.stream }}</option>
                    </select>
                    <has-error :form="student_form" field="std_stream"></has-error>
                </div> 
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 section_selection" style="display:none">
                    <label>Section:<i class="text-danger">*</i></label>
                    <select v-model="student_form.std_section" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_section') }" class="form-control select2" name="std_section" id="std_section">
                        <option v-for="(item, index) in sectionList" :key="index" v-bind:value="item.section_id">{{ item.section }}</option>
                    </select>
                    <has-error :form="student_form" field="std_section"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Training:<i class="text-danger">*</i></label>
                    <select v-model="student_form.training_id" :class="{'is-invalid is-invalid select2 select2-hidden-accessible': student_form.errors.has('training_id') }" class="form-control select2" name="training_id" id="training">
                        <option v-for="(item1, index1) in trainingList" :key="index1" :value="item1.id">{{ item1.Name }}</option>
                    </select>
                    <has-error :form="student_form" field="training_id"></has-error>
                </div> 
            </div>
            <div v-show="studentList.length" class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="student-list-table" class="table w-100 table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                    <th>
                                    <input type="checkbox" name="participants" class="form-control-input" id="participantsid" @change="checkall('participantsCheck','participantsid')"/>
                                    Participants
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(student, index1) in studentList" :key="index1">  
                                <td>{{ index1 + 1 }}</td>
                                <td>{{ student.Name}}</td>
                                <td>
                                    <input type="checkbox" name="participants" v-model="student_form.student_id[index1]" :value="student.id" class="ml-2 form-control-input participantsCheck" />
                                </td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div v-show="studentList.length" class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea v-model="student_form.remarks" placeholder="remarks" class="form-control" rows="2" id="remarks"></textarea>
                </div> 
            </div>
            <hr>
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
        return{
            dt:'',
            classStreamSections:[],
            classList:[],
            sectionList:[],
            streamList:[],
            byClass:[],
            studentList:[],
            trainingList:[],
            student_form: new form({
                form_type:'add',
                student_id:[],
                std_class: '',
                std_stream: '',
                std_section: '',
                training_id:'',
                remarks:''
            }),

        }
    },

    methods: {
        /**
         * to load the class list
         */
        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get stream list
         */
        getStreamList(id){
            let classId=$('#std_class').val();
            if(id!="" && classId==null){
                classId=id;
            }
            let uri = 'loadCommons/loadStreamList/'+classId;
            this.streamList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.streamList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getSectionList(id){
            let classId=$('#std_class').val();
            if(id!="" && classId==null){
                classId=id;
            }
            let uri = 'loadCommons/loadSectionList/'+classId;
            this.sectionList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.sectionList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadTrainingList(uri='masters/loadActiveStudentMasters/CeaTrainingType'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.trainingList = data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
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
                this.student_form.std_class= '';
                this.student_form.std_stream='';
            }
            if(type=="save"){
                let Participants=[];
                let oTable = $('#student-list-table').dataTable({
                    stateSave: true,
                    destroy: true,
                });
                
                $("input[type='checkbox']:checked",oTable.fnGetNodes()).each( function () {
                    Participants.push($(this).val());
                });
                this.student_form.student_id=Participants;
                console.log(this.student_form)
                this.student_form.post('/students/saveTrainingParticipants',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/student_trainings_participants_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="std_class"){
                this.student_form.std_class=$('#std_class').val();
                let class_selected = $("#std_class").val();
                this.getStreamList();
                this.getSectionList();
                if(class_selected == 11 || class_selected == 12){
                    $(".stream_selection").show();
                    $(".section_selection").show();
                }else{
                    $(".section_selection").show();
                    $(".stream_selection").hide();
                }
            }

            if(id=="std_stream"){
                this.student_form.std_stream=$('#std_stream').val();
            }
            if(id=="std_section"){
                axios.get('/students/loadStudentBySection/'+$('#std_class').val()+'__'+$('#std_stream').val()+'__'+$('#std_section').val())
                    .then((response) => {
                        console.log(response);
                        this.studentList = response.data;  
                })
                .catch((e) => {
                    consoele.log("Error:"+e)
                });

                this.student_form.std_section=$('#std_section').val();
            }
            if(id=="training"){
                this.student_form.training_id=$('#training').val();
            }
        },
        checkall(){
            let oTable = $('#student-list-table').dataTable({
                stateSave: true,
                destroy: true,
            });

            let allPages = oTable.fnGetNodes();

            if ($(this).hasClass('allChecked')) {
                $('input[name="participants"]', allPages).prop('checked', false);
            } else {
                $('input[name="participants"]', allPages).prop('checked', true);
            }
            $(this).toggleClass('allChecked');
        }
   
    },
    mounted() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
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

        this.loadClassList();
        this.loadTrainingList();
        this.dt =  $("#student-list-table").DataTable()
    },
    watch: {
        studentList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#student-list-table").DataTable()
            });
        }
    },
    
}
</script>