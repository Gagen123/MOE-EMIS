<template>
    <div> 
        <div class="invoice p-3 mb-6">
            <div class="row">
                <div class="col-12">
                    <h5>Health Supplementation Details</h5>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-10 invoice-col">
                    <div class="table-responsive">
                        <table v-for="(item, index) in healthScreeningDetails" :key="index">
                        <tr>
                            <th style="width:50%">Supplementation Type:</th>
                            <td>{{item.supplementation_type}}</td>
                        </tr>
                        <tr>
                            <th>Date of Supplementation Given:</th>
                            <td>{{item.date}}</td>
                        </tr>
                        <tr>
                            <th>Endorsed By:</th>
                            <td>{{item.endorsed_by}}</td>
                        </tr>
                        <tr>
                            <th>Position Title:</th>
                            <td>{{item.position}}</td>
                        </tr>
                        <tr>
                            <th>Class / Section / Stream</th>
                            <td>&nbsp;{{classArray[item.class]}} &nbsp;/ &nbsp; {{sectionList[item.section]}}&nbsp;/ &nbsp; {{item.stream}}</td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h6>Student List and Supplementation Details</h6>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="list-screening" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Name</th>
                        <th>Student Code</th>
                        <th>Given/Not Given</th>
                        <th>Action</th>                     
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in studentList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.Name}}</td>
                        <td>{{ item.student_code}}</td>
                        <td>{{ item.given ==  null ? "Given" : "Not Given" }}</td>
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
                        <h4 class="modal-title">Edit Student Supplementation Details</h4>
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
                                            <table v-for="(item, index) in screeningDetails" :key="index">
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
                                <div class="row form-group rp=0.5">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0.5">Supplementation Given/Not Given:<i class="text-danger">*</i></label>
                                        <label><input  type="radio" v-model="student_form.given" value="1" tabindex=""/> Yes</label>
                                        <label><input  type="radio" v-model="student_form.given" value="0" tabindex=""/> No</label>
                                    </div>
                                </div>
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
            healthScreeningDetails:[],
            studentList:[],
            screeningDetails:'',
            sectionList:{},
            classList:[],
            classArray:{},
            streamList:{},
            
            //to check for modal
            qualificationDescription:[],
            staffqualificationlist:[],

            student_form: new form({
                id:'',
                StdHealthSupplementationId:'',
                StdStudentId:'',
                given:''
            }),
        }
    },

    methods: {
        getAge(DateOfBirth){
            let date_of_birth = new Date(DateOfBirth);
            var diff_ms = Date.now() - date_of_birth.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear()-1970);
        },
        
        /**
         * method to get health screening details by id
        */
        getHealthSupplementationDetails(id){
            axios.get('students/getHealthSupplementationDetails/'+id)
            .then((response) => {  
                this.healthScreeningDetails = response.data.data;  
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

        /**
         * method to get the student list
         */
        getStudentList(id){
            axios.get('/students/loadViewSupplementationDetails/'+id)
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
            axios.get('/students/getSupplementationDetails/'+id)
                    .then((response) => {
                        this.screeningDetails = response.data;
                        
                        this.student_form.id = response.data.data.supplementation_id;
                        this.student_form.StdHealthSupplementationId = response.data.data.id;
                        this.student_form.StdStudentId = response.data.data.StdStudentId;

                        if(response.data.data.given==null){
                            this.student_form.given=1;
                        }
                        else{
                            this.student_form.given=0;
                        }
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
        },
        addMore: function(type){
            this.student_form.post('/students/updateHealthSupplementationRecords',this.student_form)
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
        this.getHealthSupplementationDetails(this.$route.params.data.id);
        let student_params = this.$route.params.data.OrgClassStreamId+'__'+this.$route.params.data.SectionDetailsId+'__'+this.$route.params.data.stream+'__'+this.$route.params.data.id;
        this.globalStudentParams = this.$route.params.data.class_id+'__'+this.$route.params.data.section_id+'__'+this.$route.params.data.stream_id+'__'+this.$route.params.data.id;
        this.getStudentList(student_params);
    }
}
</script>