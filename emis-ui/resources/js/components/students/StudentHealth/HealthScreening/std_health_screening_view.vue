<template>
    <div> 
        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <h5>Health Screening Details</h5>
                </div>
            </div>
            <div class="row invoice-info">
                <div class="col-sm-10 invoice-col">
                    <div class="table-responsive">
                        <table v-for="(item, index) in healthScreeningDetails" :key="index">
                        <tr>
                            <th style="width:50%">Screening Type:</th>
                            <td>{{item.screening_type}}</td>
                        </tr>
                        <tr>
                            <th>Date of Screening:</th>
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
                            <td>{{item.class}} &nbsp;/ &nbsp; {{item.section}}&nbsp;/ &nbsp; {{item.stream}}</td>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <h6>Student List and Screening Details</h6>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table id="list-screening" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl#</th>
                        <th>Name</th>
                        <th>Student Code</th>
                        <th>Screened</th>
                        <th>Referred</th>
                        <th>Action</th>                     
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in studentList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.Name}}</td>
                        <td>{{ item.student_code}}</td>
                        <td>{{ }}</td>
                        <td>{{ }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> 
</template>
<script>
export default {
   data(){
        return{
            healthScreeningDetails:'',
            studentScreenedDetails:[],
            studentReferredDetails:[],

            //temporary definition
            classList:[{class:"7"}, {class:"8"}, {class:"9"}, {class:"10"}, {class:"11"}, {class:"12"}],
            sectionList:[{section:"A"}, {section:"B"}, {section:"C"}],
            streamList:[{stream:"Arts"}, {stream:"Science"}, {stream:"Commerce"}],
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
        getAge(DateOfBirth){
            let date_of_birth = new Date(DateOfBirth);
            var diff_ms = Date.now() - date_of_birth.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear()-1970);
        },
        
        /**
         * method to get health screening details by id
        */
        getHealthScreeningDetails(id){
            axios.get('students/getHealthScreeningDetails/'+id)
            .then((response) => {  
                this.healthScreeningDetails = response.data.data;  
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

        /**
         * method to get health screening details by id
        */
        getStudentScreenedDetails(id){
            axios.get('students/getStudentScreenedDetails/'+id)
            .then((response) => {  
                this.healthScreeningDetails = response.data.data;  
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

        /**
         * method to get health screening details by id
        */
        getStudentReferredDetails(id){
            axios.get('students/getStudentReferredDetails/'+id)
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
            axios.get('/students/loadStudentList/'+id)
                    .then((response) => {
                        this.studentList = response.data.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
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
        this.getHealthScreeningDetails(this.$route.params.data.id);
        let student_params = this.$route.params.data.class+'__'+this.$route.params.data.section+'__'+this.$route.params.data.stream;
        this.getStudentList(student_params);
        this.getStudentScreenedDetails(this.$route.params.data.id);
        this.getStudentReferredDetails(this.$route.params.data.id);
    }
}
</script>