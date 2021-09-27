<template>
    <div> 
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Vaccine Type:</label>
                        <select v-model="student_form.vaccination" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('vaccination') }"  class="form-control select2" name="vaccination" id="vaccination">
                            <option v-for="(item, index) in vaccineList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="vaccination"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Vacination: </label><small>(Optional)</small>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                        <has-error :form="student_form" field="date"></has-error>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Dose:</label><br>
                        <label><input  type="radio" v-model="student_form.dose" value="1" tabindex=""/> 1st</label>
                        <label class="pl-2"><input  type="radio" v-model="student_form.dose" value="2" tabindex=""/> 2nd</label>
                        <label class="pl-2"><input  type="radio" v-model="student_form.dose" value="3" tabindex=""/> 3rd</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0.5">Class & Section:<i class="text-danger">*</i></label>
                        <select v-model="student_form.class_section" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('class_section') }" class="form-control select2" name="class_section" id="class_section" >
                            <option v-for="(item, index) in classSection" :key="index" v-bind:value="[item.org_class_stream_id, item.org_stream_id, item.org_section_id]">{{ item.class_stream_section}}</option>
                        </select>
                        <has-error :form="student_form" field="class_section"></has-error>
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
                                    <th>Received Vaccine
                                        <input type="checkbox" name="vaccinated" class="form-control-input" id="vaccinatedid" @change="checkall('vaccinatedcheck','vaccinatedid')"/>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr v-for="(student, index) in studentList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ student.Name}}</td>
                                    <td> {{genderArray[student.CmnSexId]}} </td>
                                        <!-- <input type="hidden" name="student_id" class="form-control" v-model="student_form.std_id[index]=student.id">{{ student.StdStudentId}} -->
                                    <td>{{getAge(student.DateOfBirth)}} (Y), {{getMonth(student.DateOfBirth)}} (M)</td>
                                    <td>
                                        <input type="checkbox" name="vaccinated" class="form-control-input vaccinatedcheck" v-model="student_form.std_vaccinated[index]" :value="student.std_student_id"/>
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
            genderList:[],
            vaccineList:[],
            classList:[],
            sectionList:[],
            streamList:[],
            byClass:[],
            studentList:[],
            genderArray:{},
            classSection:[],
            id:'2',

            student_form: new form({
                vaccination: '',
                class_section:'',
                std_class: '',
                std_stream: '',
                std_section: '',
                date: '',
                std_id: [],
                std_vaccinated:[],
                dose:'1'
            }),
        }
    },

    methods: {
        getClassTeacher(){
            axios.get('academics/getClassTeacherClasss')
            .then(response =>{
                let data = response.data.data
                this.classSection = data;
            })
        },
        loadActiveVaccineList(uri="masters/loadActiveStudentMasters/VaccineType"){
            axios.get(uri)
            .then(response => {
                //let data = response.data;
                //alert(JSON.stringify(response.data.data.name));
                this.vaccineList = response.data.data;

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
            let selectedDate=new Date();
            let date_of_birth = new Date(DateOfBirth);
            // var diff_ms = Date.now() - date_of_birth.getTime();
            // var age_dt = new Date(diff_ms);
            // return Math.abs(age_dt.getUTCFullYear()-1970);
            let year = selectedDate.getFullYear() - date_of_birth.getFullYear();
            return year;
        },
        getMonth(DateOfBirth){
            let selectedDate=new Date();
            let date_of_birth = new Date(DateOfBirth);
            let month=0;
            if (selectedDate.getMonth() + 1 < date_of_birth.getMonth() + 1){
                // example: March 2010 (3) and January 2011 (1); this should be 10 monts
                // 12 - 3 + 1 = 10
                // Take the 12 months of a year into account
                month = 12 - date_of_birth.getMonth() + 1 + selectedDate.getMonth() + 1;
            }
            else{
                month = selectedDate.getMonth() + 1 - date_of_birth.getMonth() + 1;
            }
            return month;
        },
        
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.date='';
                this.student_form.class_section='';
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
                        this.student_form.std_vaccinated=[];
                        let vaccinatedArray=[];
                        let oTable = $('#student-list-table').dataTable({
                            stateSave: true,
                            destroy: true,
                        });
                        $("input[name='vaccinated']:checked",oTable.fnGetNodes()).each( function () {
                            vaccinatedArray.push($(this).val());
                        });
                        this.student_form.std_vaccinated=vaccinatedArray;
                        
                        this.student_form.post('/students/addVaccinationRecords',this.student_form)
                            .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Details added successfully'
                            })
                            this.$router.push('/std_vaccination_list');
                        })
                        .catch(() => {
                            console.log("Error......")
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
            if(id=="vaccination"){
                this.student_form.vaccination=$('#vaccination').val();
            }
            // if(id=="std_class"){
            //     this.student_form.std_class=$('#std_class').val();
            //     let class_selected = $("#std_class").val();
            //     this.getStreamList();
            //     this.getSectionList();
            //     if(class_selected == 11 || class_selected == 12){
            //         $(".stream_selection").show();
            //         $(".section_selection").show();
            //     }else{
            //         $(".section_selection").show();
            //         $(".stream_selection").hide();
            //     }
            // }

            // if(id=="std_stream"){
            //     this.student_form.std_stream=$('#std_stream').val();
            // }
            // if(id=="std_section"){
            //     axios.get('/students/studentListByGender/'+$('#std_class').val()+'__'+$('#std_stream').val()+'__'+$('#std_section').val()+'__'+$('#vaccination').val())
            //         .then((response) => {
            //             this.studentList = response.data.data;  
            //     })
            //     .catch(() => {
            //         consoele.log("Error:"+e)
            //     });

            //     this.student_form.std_section=$('#std_section').val();
            // }
            if(id=="class_section"){
                if($('#vaccination').val()==null){
                    this.student_form.class_section='';
                    Swal.fire({
                        html: "Please select Vaccination Type",
                        icon: 'error'
                    });
                    
                } else {
                    this.studentList = [];
                    var classVals = $('#class_section').val().split(',');
                    let class_id = classVals[0];
                    let stream_id = classVals[1];
                    let section_id = classVals[2];
                    
                    this.student_form.std_class = classVals[0];
                    this.student_form.std_stream = classVals[1];
                    this.student_form.std_section = classVals[2];
                        
                    let route = class_id+'__'+stream_id+'__'+section_id;
                    if(stream_id == ''){
                        route = class_id+'__'+"NULL"+'__'+section_id;
                    }
                    axios.get('/students/studentListByGender/'+route+'__'+$('#vaccination').val())
                        .then((response) => {
                            this.studentList = response.data.data;  
                    })
                    .catch(() => {
                        consoele.log("Error:"+e)
                    });
                }
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

        this.loadClassList();
        this.loadGenderArrayList();
        this.loadActiveVaccineList();
        this.getClassTeacher();
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