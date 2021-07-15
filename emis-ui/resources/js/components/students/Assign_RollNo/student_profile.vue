<template>
    <div>
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ol class="breadcrumb"> 
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="text-center">
							<img class="profile-user-img img-fluid img-circle"
								src=""
								alt="User profile picture">
						</div>
                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Class</strong>

                        <p class="text-muted">
                            Class: 10  Sec: B
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#basicdetails" data-toggle="tab">Basic Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#parents" data-toggle="tab">Parents Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#roles" data-toggle="tab">Roles & Responsibilities</a></li>
                            <li class="nav-item"><a class="nav-link" href="#programmes" data-toggle="tab">Programmes & Clubs</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="basicdetails">
                                <strong><i class="fas fa-file-alt mr-1"></i> Details</strong>
                                <p class="text-muted">
                                    To Serve the Nation
                                </p>

                                <strong><i class="fas fa-file-alt mr-1"></i> Detais</strong>
                                <p class="text-muted">
                                    Education for All
                                </p>
                            </div>
                            <div class="tab-pane" id="parents">
                                <strong><i class="fas fa-file-alt mr-1"></i> Parents Details</strong>
                                    <p class="text-muted">
                                        To Serve the Nation
                                    </p>

                                    <strong><i class="fas fa-file-alt mr-1"></i> Parents Details</strong>
                                    <p class="text-muted">
                                        Education for All
                                    </p>
                            </div>

                            <div class="tab-pane" id="roles">
                                <strong><i class="fas fa-file-alt mr-1"></i> Guardian Detais</strong>
                                    <p class="text-muted">
                                        To Serve the Nation
                                    </p>
                            </div>
                            <div class="tab-pane" id="programmes">
                                <strong><i class="fas fa-file-alt mr-1"></i> Guardian Detais</strong>
                                    <p class="text-muted">
                                        To Serve the Nation
                                    </p>
                            </div>
                        </div>
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
            studentDetails:[],
            parentsDetails:[],
            programmeDetails:[],
            roleDetails:[],
            sectionList:{},
            classList:[],
            classArray:{},
            streamList:{},
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
        getStudentDetails(id){
            axios.get('students/getStudentDetails/'+id)
            .then((response) => {  
                this.studentDetails = response.data.data;  
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

        /**
         * Method to get parents details of the student
         */
        getStudentParentsDetails(id){
            axios.get('/students/getStudentParentsDetails/'+id)
                    .then((response) => {
                        this.parentsDetails = response.data.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
        },

        /**
         * Method to get programme details of the student
         */
        getStudentProgrammeDetails(id){
            axios.get('/students/getStudentProgrammeDetails/'+id)
                    .then((response) => {
                        this.programmeDetails = response.data.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
        },

        /**
         * Method to get roles details of the student
         */
        getStudentRoleDetails(id){
            axios.get('/students/getStudentRoleDetails/'+id)
                    .then((response) => {
                        this.roleDetails = response.data.data;  
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
            axios.get('/students/getScreeningDetails/'+id)
                    .then((response) => {
                        this.screeningDetails = response.data.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
        },
        addMore: function(type){
            this.student_form.post('/students/updateHealthScreeningRecords',this.student_form)
            .then((response) => {  
                Toast.fire({
                    icon: 'success',
                    title: 'Data saved Successfully'
                });
                $('#screening-modal').modal('hide');
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
        this.getStudentDetails(this.$route.params.data.id);
        this.getStudentParentsDetails(this.$route.params.data.id);
        this.getStudentRoleDetails(this.$route.params.data.id);
        this.getStudentProgrammeDetails(this.$route.params.data.id);
    }
}
</script>