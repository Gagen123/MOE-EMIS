<template>
    <div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <small>(You will be provided the list of previous academic year)</small><br>
                     <label>Class:</label>
                    <select v-model="student_form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_class') }" @change="aboveClass10()"  class="form-control select2" name="std_class" id="std_class">
                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                    </select>
                    <has-error :form="student_form" field="std_class"></has-error>
                </div>
            </div>
            <hr>
            <form>
                <div>
                    <table id="allocation-list-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr>
                                <th >SL#</th>
                                <th >Student Name</th>
                                <th >Student Code</th>
                                <th >Class</th>
                                <th >Section</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in studentList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.Name}}</td>
                                <td>{{ item.student_code}}</td>
                                <td>
                                    <select v-model="student_form.std_class[index]" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('class') }" class="form-control select2" name="class" id="class">
                                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                                    </select>
                                    <has-error :form="student_form" field="class"></has-error>
                                </td>
                                <td>
                                    <select v-model="student_form.std_section[index]" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_section') }" class="form-control select2" name="std_section" id="std_section">
                                        <option v-for="(item, index) in sectionList" :key="index" v-bind:value="item.section_id">{{ item.section }}</option>
                                    </select>
                                    <has-error :form="student_form" field="std_section"></has-error>
                                    <!-- <input type="checkbox" name="height" class="form-control-input screencheck" v-model="student_form.std_screened[index]"/> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
   data(){
        return{
            dt:'',
            screeningList:[],
            screeningTitle:[],
            screeningEndorser:[],
            classStreamSections:[],
            classList:[],
            sectionList:[],
            streamList:[],
            byClass:[],
            studentList:[],

            student_form: new form({
                screening: '',
                screening_position: '',
                prepared_by: '',
                screening_endorsed_by: '',
                std_class: '',
                std_stream: '',
                std_section: '',
                date: '',
                std_id: [],
                std_screened:[],
                std_referred:[]
            }),

        }
    },

    methods: {
        loadActiveScreeningList(uri="masters/loadActiveStudentMasters/health_screening"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.screeningList =  data.data.data;
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
                $("input[name='height']:checked").each( function () {
                    screenedArray.push($(this).val());
                });
                this.student_form.std_screened=screenedArray;
                
                this.student_form.std_referred=[];
                let referredArray=[];
                $("input[name='weight']:checked").each( function () {
                    referredArray.push($(this).val());
                });
                this.student_form.std_referred=referredArray;

                this.student_form.post('/students/addHealthScreeningRecords',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/std_health_screening_list');
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
            if(id=="screening"){
                this.student_form.screening=$('#screening').val();
            }
            if(id=="screening_position"){
                this.student_form.screening_position=$('#screening_position').val();
            }
            if(id=="screening_endorsed_by"){
                this.student_form.screening_endorsed_by=$('#screening_endorsed_by').val();
            }
            if(id=="std_class"){
                this.student_form.std_class=$('#std_class').val();
                let class_selected = $("#std_class").val();
                this.getStreamList();
                this.getSectionList();

                axios.get('/students/loadStudentByClass/'+$('#std_class').val())
                    .then((response) => {
                        this.studentList = response.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
            }

            if(id=="std_stream"){
                this.student_form.std_stream=$('#std_stream').val();
            }
            if(id=="std_section"){
                // axios.get('/students/loadStudentBySection/'+$('#std_class').val()+'__'+$('#std_stream').val()+'__'+$('#std_section').val())
                //     .then((response) => {
                //         this.studentList = response.data;  
                // })
                // .catch(() => {
                //     consoele.log("Error:"+e)
                // });

                this.student_form.std_section=$('#std_section').val();
            }
            
        },
        checkall(class_to_check,id){
            if($('#'+id).prop('checked')){
                $("."+class_to_check).prop("checked",true);
            }
            else{
                $("."+class_to_check).prop("checked",false);
            }
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

        this.loadActiveScreeningList();
        this.loadActiveScreeningTitleList();
        this.loadActiveScreeningEndorserList();
        
        this.loadClassList();
        // this.loadSectionList();
        // this.loadStreamList();
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