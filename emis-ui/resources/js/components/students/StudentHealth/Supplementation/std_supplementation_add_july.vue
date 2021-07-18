<template>
    <div> 
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Term:</label>
                        <select v-model="student_form.term_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('term_id') }" class="form-control select2" name="term_id" id="term_id">
                            <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="term_id"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Supplementation:</label>
                        <select v-model="student_form.supplementation" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('supplementation') }" class="form-control select2" name="supplementation" id="supplementation">
                            <option v-for="(item, index) in supplementationList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="supplementation"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Supplementation Issued:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                        <has-error :form="student_form" field="date"></has-error>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Prepared by:</label>
                        <input type="text" @change="remove_error('prepared_by')" v-model="student_form.prepared_by" :class="{ 'is-invalid': student_form.errors.has('prepared_by') }" class="form-control" name="prepared_by" id="prepared_by" >
                        <has-error :form="student_form" field="prepared_by"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Position Title:</label>
                        <select v-model="student_form.supplementation_position" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('supplementation_position') }" class="form-control select2" name="supplementation_position" id="supplementation_position">
                            <option v-for="(item, index) in screeningTitle" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="supplementation_position"></has-error>
                    </div> 
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Endorsed By:</label>
                        <select v-model="student_form.supplementation_endorsed_by" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('supplementation_endorsed_by') }" class="form-control select2" name="supplementation_endorsed_by" id="supplementation_endorsed_by">
                            <option v-for="(item, index) in screeningEndorser" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="supplementation_endorsed_by"></has-error>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Class:</label>
                        <select v-model="student_form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_class') }" @change="aboveClass10()"  class="form-control select2" name="std_class" id="std_class">
                            <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                        </select>
                        <has-error :form="student_form" field="std_class"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stream_selection" style="display:none">
                        <label>Streams:</label>
                        <select v-model="student_form.std_stream" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_stream') }" class="form-control select2" name="std_stream" id="std_stream">
                            <option v-for="(item, index) in streamList" :key="index" v-bind:value="item.stream_id">{{ item.stream }}</option>
                        </select>
                        <has-error :form="student_form" field="std_stream"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 section_selection" style="display:none">
                        <label>Section:</label>
                        <select v-model="student_form.std_section" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_section') }" class="form-control select2" name="std_section" id="std_section">
                            <option v-for="(item, index) in sectionList" :key="index" v-bind:value="item.section_id">{{ item.section }}</option>
                        </select>
                        <has-error :form="student_form" field="std_section"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="student-list-table" class="table w-100 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th> 
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Given
                                        <input type="checkbox" name="screened" class="form-control-input" id="screenid" @change="checkall('screencheck','screenid')"/>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr v-for="(student, index) in studentList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ student.Name}}</td>
                                    <td> {{genderArray[student.CmnSexId]}}  </td>
                                        <!-- <input type="hidden" name="student_id" class="form-control" v-model="student_form.std_id[index]=student.id">{{ student.StdStudentId}} -->
                                    <td>{{getAge(student.DateOfBirth)}}</td>
                                    <td>
                                        <input type="checkbox" name="screened" class="form-control-input screencheck" v-model="student_form.std_screened[index]" :value="student.id"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div> 
</template>
<script>
export default {
   data(){
        return{
            dt:'',
            termList:[],
            supplementationList:[],
            screeningList:[],
            screeningTitle:[],
            screeningEndorser:[],
            classStreamSections:[],
            classList:[],
            sectionList:[],
            genderArray:{},
            streamList:[],
            byClass:[],
            studentList:[],

            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                term_id: '',
                supplementation_position: '',
                prepared_by: '',
                supplementation_endorsed_by: '',
                std_class: '',
                std_stream: '',
                std_section: '',
                date: '',
                std_id: [],
                std_screened:[]
            }),
        }
    },

    methods: {
        loadActiveTermList(uri="masters/loadActiveStudentMasters/term_type"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.termList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveSupplementationList(uri="masters/loadActiveStudentMasters/HealthSupplementation"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.supplementationList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveScreeningTitleList(uri="masters/loadActiveStudentMasters/screening_position"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.screeningTitle =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveScreeningEndorserList(uri="masters/loadActiveStudentMasters/screening_endorser"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.screeningEndorser =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * to load the array definitions of class, stream and section
         */
        loadGenderArrayList(uri="masters/loadGlobalMasters/all_gender"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.genderArray[data[i].id] = data[i].name;
                }
            })
        },

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

        
        getAge(DateOfBirth){
            let date_of_birth = new Date(DateOfBirth);
            var diff_ms = Date.now() - date_of_birth.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear()-1970);
        },
        
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.screening= '';
                this.student_form.prepared_by='';
                this.student_form.screening_position='';
                this.student_form.screening_endorsed_by= '';
                this.student_form.date='';
            }
            if(type=="save"){
                this.student_form.std_screened=[];
                let screenedArray=[];
                let oTable = $('#student-list-table').dataTable({
                    stateSave: true,
                    destroy: true,
                });
                $("input[name='screened']:not(:checked)",oTable.fnGetNodes()).each( function () {
                    screenedArray.push($(this).val());
                });
                this.student_form.std_screened=screenedArray;
                
                this.student_form.post('/students/addSupplementationRecords',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/std_supplementation_list');
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
            if(id=="term_id"){
                this.student_form.term_id=$('#term_id').val();
            }
            if(id=="supplementation"){
                this.student_form.supplementation=$('#supplementation').val();
            }
            if(id=="supplementation_position"){
                this.student_form.supplementation_position=$('#supplementation_position').val();
            }
            if(id=="supplementation_endorsed_by"){
                this.student_form.supplementation_endorsed_by=$('#supplementation_endorsed_by').val();
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
                        this.studentList = response.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });

                this.student_form.std_section=$('#std_section').val();
            }
            
        },
        checkall(class_to_check,id){
            let oTable = $('#student-list-table').dataTable({
                stateSave: true,
                destroy: true,
            });

            let allPages = oTable.fnGetNodes();

            if($('#'+id).prop('checked')){
                $("."+class_to_check, allPages).prop("checked",true);
            }
            else{
                $("."+class_to_check, allPages).prop("checked",false);
            }
            $("."+class_to_check).toggleClass('allChecked');
            
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

        this.loadActiveScreeningTitleList();
        this.loadActiveScreeningEndorserList();
        this.loadClassList();
        this.loadGenderArrayList();
        this.loadActiveTermList();
        this.loadActiveSupplementationList();
        
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