<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Assigning RollNo To Students</h6></li>
        </ol>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header pt-0 mt-0 pb-0">
                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="required">Assign Order:</label>
                                <br>
                                <label><input v-model="student_form.assign_order"  type="radio" value="ASC" name="assign_order" id="assign_order1"/> Ascending</label>
                                <label><input v-model="student_form.assign_order"  type="radio" value="DESC" name="assign_order" id="assign_order2"/> Descending</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="required">Sort By:</label>
                                <br>
                                <label><input v-model="student_form.sort_by"  type="radio" value="Female" name="sort_by"  id="sort_by1"/> Girls First</label>
                                <label><input v-model="student_form.sort_by"  type="radio" value="Male" name="sort_by" id="sort_by2"/> Boys First</label>
                                <label><input v-model="student_form.sort_by"  type="radio" value="Mixed" name="sort_by" id="sort_by3"/> Mixed</label>
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
                        <hr>
                        <div>
                            <table id="student-list-table" class="table table-bordered text-sm table-striped">
                                <thead>
                                    <tr>
                                        <th >SL#</th>
                                        <th >Student Name</th>
                                        <th >Student Code</th>
                                        <th >Assign RollNo</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr v-for="(item, index) in studentList" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ item.Name}}</td>
                                        <td>{{ item.student_code}}</td>
                                        <td>
                                            <input type="number" name="roll_no" class="form-control" :value = "item.roll_no = index+1" readonly/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                             <div class="card-footer text-right">
                                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dt:'',
            org_id:'2',
            studentList:[],
            sectionList:{},
            classList:[],
            studentClassArray:{},
            studentStreamArray:{},
            studentSectionArray:{},
            streamList:{},
            classSectionStreamList:{},

            student_form: new form({
                sort_by:'',
                assign_order:'',
                std_class: '',
                std_stream: '',
                std_section: '',
                roll_no:[],
                studentList:[]
            }),
        }
    },
    methods:{
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
        loadClassStreamSectionList(uri="loadCommons/loadClassStreamSection/userworkingagency/org"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.testData = data;
                if(data!=null && data!="" && data!=undefined){
                    for(let i=0;i<data.length;i++){
                        this.studentClassArray[data[i].id] = data[i].class;
                        this.studentSectionArray[data[i].id] = data[i].section;
                        this.studentStreamArray[data[i].id] = data[i].stream;
                    }
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.std_class= " ";
                this.student_form.std_stream='';
                this.student_form.std_section= '';
                this.student_form.roll_no= '';
            }
            if(type=="save"){
                this.student_form.post('/students/saveStudentRollNumber',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/students_rollNo');
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
                if(class_selected == 11 || class_selected == 'XI' || class_selected == 12 || class_selected == 'XII'){
                    $(".stream_selection").show();
                    $(".section_selection").show();
                }else{
                    $(".section_selection").show();
                    $(".stream_selection").hide();
                }
            }
            if(id == 'assign_order'){
                this.student_form.assign_order=$('#assign_order').val();
            }
            if(id == 'sort_by'){
                this.student_form.sort_by=$('#sort_by').val();
            }
            if(id=="std_stream"){
                this.student_form.std_stream=$('#std_stream').val();
            }
            if(id=="std_section"){
                let sort_by = $("input[name='sort_by']:checked").val();
                let assign_by = $("input[name='assign_order']:checked").val();
                let params = $('#std_class').val()+'__'+$('#std_stream').val()+'__'+$('#std_section').val()+'__'+assign_by+'__'+sort_by;
                axios.get('/students/loadStudentBySectionForRollNo/'+params)
                    .then((response) => {
                        this.studentList = response.data;
                        this.student_form.studentList=response.data;
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
                this.student_form.std_section=$('#std_section').val();
            }

        },
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

        this.loadClassStreamSectionList();
        this.loadClassList();

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
