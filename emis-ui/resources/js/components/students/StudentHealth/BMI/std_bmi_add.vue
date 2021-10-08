<template>
    <div>
        <div class="alert alert-warning alert-dismissible" style="display:none" id="warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Information!</h5>
            <div id="message"></div>
        </div>
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
                        <label>Date of Measurement:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                        <has-error :form="student_form" field="date"></has-error>
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
                                    <th style="width:5%">Sl#</th>
                                    <th style="width:15%">Name</th>
                                    <th style="width:5%">Sex</th>
                                    <th style="width:13%">DOB</th>
                                    <th style="width:12%">Age (Months)</th>
                                    <th style="width:15%">Height (in cm)</th>
                                    <th style="width:15%">Weight (in Kg)</th>
                                    <th style="width:10%">BMI</th>
                                    <th style="width:10%">Result</th>
                                    <!-- <th>Remarks</th> -->
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr v-for="(student, index) in student_form.studentList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ student.Name}}</td>
                                    <td> {{genderArray[student.CmnSexId]}}  </td>
                                        <!-- <input type="hidden" name="student_id" class="form-control" v-model="student_form.std_id[index]=student.id">{{ student.StdStudentId}} -->
                                    <td>{{student.DateOfBirth}}</td>
                                    <td>{{monthDiff(student.DateOfBirth)}}
                                        <!-- I: {{incrementedval(monthDiff(student.DateOfBirth))}} -->
                                        <!-- {{getAge(student.DateOfBirth)}} (Y), {{getMonth(student.DateOfBirth)}} (M) -->
                                    </td>
                                    <td>
                                        <input type="number" name="height" :id="'height'+index" class="form-control" v-model="student.height" @change="calcualteBMI(index,monthDiff(student.DateOfBirth),genderArray[student.CmnSexId])"/>
                                    </td>
                                    <td>
                                        <input type="number" name="weight" :id="'weight'+index" class="form-control" v-model="student.weight" @change="calcualteBMI(index,monthDiff(student.DateOfBirth),genderArray[student.CmnSexId])"/>
                                    </td>
                                    <td>
                                        <!-- <input type="text" readonly name="bmi" :id="'bmi'+index" class="form-control" v-model="student.bmi"/> -->
                                        <span :id="'bmi'+index" ></span>
                                    </td>
                                    <td>
                                        <span :id="'result'+index"></span>
                                    </td>
                                    <!-- <td>
                                        <input type="text" name="remarks" class="form-control" v-model="student.remarks"/>
                                    </td> -->
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
            is_classTeacher:'1',
            termList:[],
            classList:[],
            sectionList:[],
            streamList:[],
            byClass:[],
            // studentList:[],
            genderArray:{},
            id:'NA',
            classSection:[],

            student_form: new form({
                term_id: '',
                std_class: '',
                std_stream: '',
                std_section: '',
                studentList:[],
                date: '',
                std_id: [],
                height:[],
                weight:[],
                remarks:[]
            }),
        }
    },

    methods: {
        calcualteBMI(index,months,gender){
            let height=$('#height'+index).val()/100;
            let weight=$('#weight'+index).val();
            let bmi=(weight/(height*height)).toFixed(2);
            $('#bmi'+index).html(bmi);
            // this.student_form.studentList.bmi=bmi;
            axios.get('/students/loadresult/'+months+'/'+gender+'/'+bmi)
                .then((response) => {
                $('#result'+index).html(response.data);
            })
            .catch(() => {
                consoele.log("Error:"+e)
            });
        },
        getClassTeacher(){
            axios.get('academics/getClassTeacherClasss')
            .then(response =>{
                let data = response.data.data
                this.classSection = data;
                if(data != null && data !=''){
                    this.is_classTeacher='1';
                } else {
                    this.is_classTeacher='0';
                    $('#warning').show();
                    $('#message').html('User is not assigned as Class Teacher. Please assign class teacher to proceed');
                }
            })
        },
        loadActiveTermList(uri="masters/loadActiveStudentMasters/HealthTerm"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.termList =  data.data.data;
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
            let selectedDate=new Date($('#date').val());


            let date_of_birth = new Date(DateOfBirth);
            // var diff_ms = Date.now() - date_of_birth.getTime();
            // var age_dt = new Date(diff_ms);
            // return Math.abs(age_dt.getUTCFullYear()-1970);
            let year = selectedDate.getFullYear() - date_of_birth.getFullYear();
            return year;
        },
        getMonth(DateOfBirth){
            let selectedDate=new Date($('#date').val());
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
            // month = selectedDate.getMonth() + 1 - date_of_birth.getMonth() + 1
            return month;
        },
        monthDiff(DateOfBirth){
            let selectedDate=new Date($('#date').val());
            let date_of_birth = new Date(DateOfBirth);
            // One day in milliseconds
            const oneDay = 1000 * 60 * 60 * 24;

            // Calculating the time difference between two dates
            const diffInTime = selectedDate.getTime() - date_of_birth.getTime();

            // Calculating the no. of days between two dates
            const diffInDays = Math.round(diffInTime / oneDay);

            //calcualting the months
            return (diffInDays/30.4375).toFixed(2);
        },
        incrementedval(months,gender){
            let num=(parseFloat(months)+0.5);
            let rewult=months-parseInt(num);
            //alert(val+' : '+num+' : '+parseInt(num)+': '+parseFloat(rewult+0.5) );
            let val=parseFloat(rewult+0.5).toFixed(2);
            return val;
        },

        remove_err(field_id){
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
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.student_form.post('/students/addBmiRecords',this.student_form)
                            .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Details added successfully'
                            })
                            this.$router.push('/std_bmi_list');
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
            if(id=="term_id"){
                this.student_form.term_id=$('#term_id').val();
            }
            // if(id=="std_class"){
            //     if($('#date').val()==""){
            //         Swal.fire({
            //         text: "Pease select date of Measurement",
            //         icon: 'error',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'OK!',
            //         });
            //     }else{
            //         this.student_form.std_class=$('#std_class').val();
            //         let class_selected = $("#std_class").val();
            //         this.getStreamList();
            //         this.getSectionList();
            //         if(class_selected == 11 || class_selected == 12){
            //             $(".stream_selection").show();
            //             $(".section_selection").show();
            //         }else{
            //             $(".section_selection").show();
            //             $(".stream_selection").hide();
            //         }
            //     }
            // }

            if(id=="class_section"){
                if($('#date').val()==""){
                    Swal.fire({
                    text: "Pease select date of Measurement",
                    icon: 'error',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK!',
                    });
                }else{
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
                    axios.get('/students/loadStudentBySection/'+route)
                        .then((response) => {
                            this.student_form.studentList = response.data;  
                    })
                    .catch(() => {
                        consoele.log("Error:"+e)
                    });
                }
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

        this.loadActiveTermList();
        this.loadGenderArrayList();
        this.getClassTeacher();
        this.loadClassList();
        // this.loadStreamList();
    },

}
</script>
