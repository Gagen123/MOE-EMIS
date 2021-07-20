<template>
    <div> 
        <div class="invoice p-3 mb-6">
            <div class="row">
                <div class="col-12">
                    <h5>Student Health BMI Details</h5>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-10 invoice-col">
                    <div class="table-responsive">
                        <table v-for="(item, index) in healthBmiDetails" :key="index">
                        <tr>
                            <th>Date of Measurement:</th>
                            <td>{{item.date}}</td>
                        </tr>
                        <tr>
                            <th>Class / Section / Stream:</th>
                            <td>&nbsp;{{classArray[item.class_id]}} &nbsp;/ &nbsp; {{sectionList[item.section_id]}}&nbsp;/ &nbsp; {{item.stream_id}}</td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h6>Student List and BMI Details</h6>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="list-screening" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Name</th>
                        <th>Student Code</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>BMI</th>
                        <th>Result</th>
                        <th>Action</th>                     
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in studentList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.Name}}</td>
                        <td>{{ item.student_code}}</td>
                        <td>{{ item.height}}</td>
                        <td>{{ item.weight}}</td>
                        <td>{{ item.bmi}}</td>
                        <td>{{ item.result}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showaddmodal(item.id+'__'+item.StdStudentId)"><i class="fas fa-edit"></i > Edit</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="screening-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Student BMI Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bootbox-body">
                            <form class="bootbox-form">
                                <div class="card-body">
                                    <div class="col-sm-10 invoice-col">
                                        <div class="table-responsive">
                                            <table v-for="(item, index) in bmiDetails" :key="index">
                                            <tr>
                                                <th style="width:50%">Name:</th>
                                                <td>{{item.Name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Student Code:</th>
                                                <td>{{item.student_code}}</td>
                                            </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <table id="student-list-table" class="table w-100 table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:15%">Height (in cm)</th>
                                            <th style="width:15%">Weight (in Kg)</th>
                                            <th style="width:10%">BMI</th>
                                            <th style="width:10%">Result</th>
                                            <!-- <th>Remarks</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        <tr>
                                            <td>
                                                <input type="number" name="height" id="height" class="form-control" v-model="student_form.height" @change="calcualteBMI()"/>
                                            </td>
                                            <td>
                                                <input type="number" name="weight" id="weight" class="form-control" v-model="student_form.weight" @change="calcualteBMI()"/>
                                            </td>
                                            <td>
                                                <!-- <input type="text" readonly name="bmi" :id="'bmi'+index" class="form-control" v-model="student.bmi"/> -->
                                                <span id="bmi" ></span>
                                            </td>
                                            <td>
                                                <span id="result"></span>
                                            </td>
                                            <!-- <td>
                                                <input type="text" name="remarks" class="form-control" v-model="student.remarks"/>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" v-model="student_form.action_type">
                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-flat btn-danger">Cancel</button>
                        <button  @click="addMore('nomination')" type="button" class="btn btn-flat btn-primary">Update</button>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</template>
<script>
export default {
   data(){
        return{
            globalStudentParams:'',
            healthBmiDetails:[],
            studentList:[],
            bmiDetails:'',
            sectionList:{},
            classList:[],
            classArray:{},
            streamList:{},

            student_form: new form({
                id:'',
                height:'',
                weight:'',
                bmi:'',
                result:'',
            }),
        }
    },

    methods: {
        calcualteBMI(index){
           let height=$('#height').val()/100;
           let weight=$('#weight').val();
           let bmi=(weight/(height*height)).toFixed(2);
           $('#bmi').html(bmi);
            // this.student_form.studentList.bmi=bmi;
           $('#result').html(bmi);
        },
        getAge(DateOfBirth){
            let date_of_birth = new Date(DateOfBirth);
            var diff_ms = Date.now() - date_of_birth.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear()-1970);
        },
        
        /**
         * method to get health screening details by id
        */
        getHealthBmiDetails(id){
            axios.get('students/getHealthBmiDetails/'+id)
            .then((response) => {  
                this.healthBmiDetails = response.data.data;  
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

        /**
         * method to get the student list
         */
        getStudentList(id){
            axios.get('/students/loadViewBmiDetails/'+id)
                    .then((response) => {
                        this.studentList = response.data.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
        },

        /**
         * to load the array definitions of class, stream and section
         */
        loadClassArrayList(uri="loadCommons/getClassArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.classArray[data[i].id] = data[i].class;
                }
            })
        },
        loadSectionArrayList(uri="loadCommons/getSectionArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.sectionList[data[i].id] = data[i].section;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadStreamArrayList(uri="loadCommons/getStreamArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.streamList[data[i].id] = data[i].stream;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        /**
         * For Modals
         */
        showaddmodal(id){ 
            $('#screening-modal').modal('show');
            axios.get('/students/getBmiDetails/'+id)
                    .then((response) => {
                        this.bmiDetails = response.data;
                        
                        this.student_form.id = response.data.data.id;
                        this.student_form.height = response.data.data.height;
                        this.student_form.weight = response.data.data.weight;
                        this.student_form.bmi = response.data.data.bmi;
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
        },
        addMore: function(type){
            this.student_form.post('/students/updateBmiRecord',this.student_form)
            .then((response) => {  
                Toast.fire({
                    icon: 'success',
                    title: 'Data saved Successfully'
                });
                $('#screening-modal').modal('hide');
                this.getStudentList(this.globalStudentParams);
            })
            .catch((error) => {  
                console.log("Error:"+error)
            });
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
    },
    created() {
        this.loadClassArrayList();
        this.loadSectionArrayList();
        this.loadStreamArrayList();
        this.getHealthBmiDetails(this.$route.params.data.id);
        let student_params = this.$route.params.data.class_id+'__'+this.$route.params.data.section_id+'__'+this.$route.params.data.stream_id+'__'+this.$route.params.data.id;
        this.globalStudentParams = this.$route.params.data.class_id+'__'+this.$route.params.data.section_id+'__'+this.$route.params.data.stream_id+'__'+this.$route.params.data.id;
        this.getStudentList(student_params);
    }
}
</script>