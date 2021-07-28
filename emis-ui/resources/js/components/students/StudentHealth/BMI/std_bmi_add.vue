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
                        <label>Date of Measurement:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                        <has-error :form="student_form" field="date"></has-error>
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
            termList:[],
            classList:[],
            sectionList:[],
            streamList:[],
            byClass:[],
            // studentList:[],
            genderArray:{},
            id:'NA',

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
            if(id=="std_class"){
                if($('#date').val()==""){
                    Swal.fire({
                    text: "Pease select date of Measurement",
                    icon: 'error',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK!',
                    });
                }else{
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
            }

            if(id=="std_stream"){
                this.student_form.std_stream=$('#std_stream').val();
            }
            if(id=="std_section"){
                axios.get('/students/loadStudentBySection/'+$('#std_class').val()+'__'+$('#std_stream').val()+'__'+$('#std_section').val())
                    .then((response) => {
                        this.student_form.studentList = response.data;
                })
                .catch(() => {
                    console.log("Error:"+e)
                });

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

        this.loadActiveTermList();
        this.loadGenderArrayList();

        this.loadClassList();
        // this.loadStreamList();
    },

}
</script>
