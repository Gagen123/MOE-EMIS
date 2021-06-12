<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Vaccine Type:</label>
                        <select v-model="student_form.vaccination" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('vaccination') }"  class="form-control select2" name="vaccination" id="vaccination">
                            <option v-for="(item, index) in vaccineList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="student_form" field="vaccination"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Vacination:</label>
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
                <div class="hidden" id="TDvaccine" style="display:none">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Student vaccinated with TD</th>
                                        <th>Boys</th> 
                                        <th>Girls</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                          Number of Student who received TD at 6 years
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="student_form.td_at6_boys" :class="{ 'is-invalid': student_form.errors.has('td_at6_boys') }" id="td_at6_boys" @change="remove_err('td_at6_boys')" type="number">
                                            <has-error :form="student_form" field="td_at6_boys"></has-error>
                                        </td>
                                         <td>
                                            <input class="form-control" v-model="student_form.td_at6_girls" :class="{ 'is-invalid': student_form.errors.has('td_at6_girls') }" id="td_at6_girls" @change="remove_err('td_at6_girls')" type="number">
                                            <has-error :form="student_form" field="td_at6_girls"></has-error>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          Number of Student who received TD at 12 years
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="student_form.td_at12_boys" :class="{ 'is-invalid': student_form.errors.has('td_at12_boys') }" id="td_at12_boys" @change="remove_err('td_at12_boys')" type="number">
                                            <has-error :form="student_form" field="date"></has-error>
                                        </td>
                                         <td>
                                            <input class="form-control" v-model="student_form.td_at12_girls" :class="{ 'is-invalid': student_form.errors.has('td_at12_girls') }" id="td_at12_girls" @change="remove_err('td_at12_girls')" type="number">
                                            <has-error :form="student_form" field="td_at12_girls"></has-error>
                                        </td>
                                     </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="hidden" id="HPVvaccine" style="display:none">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Number of Girls who received 1st Dose</th>
                                        <th>Number of Girls who received 2nd Dose</th> 
                                        <th>Number of Girls who received 3rd Dose</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input class="form-control" v-model="student_form.dose_1" :class="{ 'is-invalid': student_form.errors.has('dose_1') }" id="dose_1" @change="remove_err('dose_1')" type="number">
                                            <has-error :form="student_form" field="dose_1"></has-error>
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="student_form.dose_2" :class="{ 'is-invalid': student_form.errors.has('dose_2') }" id="dose_2" @change="remove_err('dose_2')" type="number">
                                            <has-error :form="student_form" field="dose_2"></has-error>
                                        </td>
                                        <td>
                                            <input class="form-control" v-model="student_form.dose_3" :class="{ 'is-invalid': student_form.errors.has('dose_3') }" id="dose_3" @change="remove_err('dose_3')" type="number">
                                            <has-error :form="student_form" field="dose_3"></has-error>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    data() {
        return {
            vaccineList:[],
            classList:[],
            sectionList:[],
            streamList:[],
            byClass:[],
            studentList:[],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                screening: '',
                screening_position: '',
                screening_endorsed_by: '',
                date: '',
            }),

            users:
            [{
                class:'',number:'',number1:''
            }] 
        }
    },

    methods: {
        loadActiveVaccineList(uri="masters/loadActiveStudentMasters/vaccine_type"){
            axios.get(uri)
            .then(response => {
                let data = response;
                alert(JSON.stringify(response.data.data.name));
                this.vaccineList =  data.data[0];
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
                $("input[name='screened']:checked").each( function () {
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
            if(id=="vaccination"){
                this.student_form.vaccination=$('#vaccination').val();
                let vaccination_selected = $("#vaccination").val();
                
                if(vaccination_selected == '32abba18-889d-4018-ba66-c9b8d7ef7385'){
                    $("#HPVvaccine").show();
                    $("#TDvaccine").hide();
                }else{
                    $("#HPVvaccine").hide();
                    $("#TDvaccine").show();
                }
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

        this.loadActiveVaccineList();
        
        this.loadClassList();
        // this.loadSectionList();
        // this.loadStreamList();
    },
    
}
</script>