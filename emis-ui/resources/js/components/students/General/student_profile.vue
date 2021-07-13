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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <!-- <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#basicdetails" data-toggle="tab">Basic Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#parents" data-toggle="tab">Parents Details</a></li>
                            <li class="nav-item"><a class="nav-link" href="#roles" data-toggle="tab">Roles & Responsibilities</a></li>
                            <li class="nav-item"><a class="nav-link" href="#programmes" data-toggle="tab">Programmes & Clubs</a></li>
                        </ul>
                    </div> -->
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs border-primary" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item border-left border-right">
                                <a class="nav-link active" id="basicdetails-tab" data-toggle="pill" href="#basicdetails" role="tab" aria-controls="basicdetails" aria-selected="true">Basic Details</a>
                            </li>
                            <li class="nav-item border-left border-right">
                                <a class="nav-link" id="parents_tab-tab" data-toggle="pill" href="#parents_tab" role="tab" aria-controls="parents_tab" aria-selected="false">Parents Details</a>
                            </li>
                            <li class="nav-item border-left border-right">
                                <a class="nav-link" id="roles-tab" data-toggle="pill" href="#roles" role="tab" aria-controls="roles" aria-selected="false">Roles & Responsibilities</a>
                            </li>
                            <li class="nav-item border-left border-right">
                                <a class="nav-link" id="programmes-tab" data-toggle="pill" href="#programmes" role="tab" aria-controls="programmes" aria-selected="false">Programmes & Clubs</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- <div class="active tab-pane" id="basicdetails"> -->
                            <div class="tab-pane fade show active" id="basicdetails" role="tabpanel" aria-labelledby="basicdetails-tab">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle" src="img/user.png" alt="User profile picture">
                                                </div>
                                                <hr>
                                                <strong> {{studentDetails.Name}}</strong>
                                                <p class="text-muted">
                                                    Student Code:  <b>{{studentDetails.student_code}}</b><br>
                                                    Class:<b> {{calsssream.class}}</b>,  Sec: <b>{{section.section}}</b>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <table class="table table-sm">
                                            <thead class="bg-info">
                                                    <tr>
                                                        <th>Student Name</th>
                                                        <th><span class="text-bold">{{studentDetails.Name}}</span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>CID</td>
                                                    <td>{{studentDetails.CidNo}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Dzongkhag</td>
                                                    <td>{{dzongkhag.name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gewog</td>
                                                    <td>{{gewog.name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Village</td>
                                                    <td>{{village.name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Is Border</td>
                                                    <td>{{studentDetails.isBoarder==1? 'Yes':'No'}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="tab-pane" id="parents_tab" aria-labelledby="parents_tab" > -->
                            <div class="tab-pane fade" id="parents_tab" role="tabpanel" aria-labelledby="parents_tab-tab">
                                <strong><i class="fas fa-file-alt mr-1"></i> Parents Details</strong>
                                 <table class="table table-sm">
                                    <thead class="bg-info">
                                        <tr>
                                            <th>Name</th>
                                            <th>Relationship</th>
                                            <th>contact Number</th>
                                            <th>Email</th>
                                            <th>Workint Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in parentsDetails" :key="index">
                                            <td>{{ item.Name}}</td>
                                            <td>{{ item.Relationship}}</td>
                                            <td>{{ item.ContactNo}}</td>
                                            <td>{{ item.Email}}</td>
                                            <td>{{ item.WorkAddress}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="roles" aria-labelledby="roles-tab">
                                <strong><i class="fas fa-file-alt mr-1"></i> Roles & responsibility</strong>
                                <table class="table table-sm">
                                    <thead class="bg-info">
                                        <tr>
                                            <th>Role</th>
                                            <th>Created Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in roleDetails" :key="index">
                                            <td>{{ item.role_name}}</td>
                                            <td>{{ item.created_at}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="programmes" aria-labelledby="programmes-tab">
                                <strong><i class="fas fa-file-alt mr-1"></i> Programmes & Clubs</strong>
                                <table class="table table-sm">
                                    <thead class="bg-info">
                                        <tr>
                                            <!-- <th>Programme</th> -->
                                            <th>Name</th>
                                            <th>Responsibility</th>
                                            <th>Joining Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in programmeDetails" :key="index">
                                            <!-- <td>{{ item.CeaProgrammeId}}</td> -->
                                            <td>{{ item.program_name}}</td>
                                            <td>{{ item.Responsibility}}</td>
                                            <td>{{ item.JoiningDate}}</td>
                                        </tr>
                                    </tbody>
                                </table>
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
            calsssream:{},
            section:[],
            village:[],
            gewog:[],
            dzongkhag:[],
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
                this.studentDetails = response.data;
                this.loadClassStream(response.data.classDetails.OrgClassStreamId);
                this.loadsections(response.data.classDetails.SectionDetailsId);
                if(response.data.CmnChiwogId!=""){
                    this.loadchewog(response.data.CmnChiwogId);
                }
                if(response.data.CmnGewogId!=""){
                    this.loadgewog(response.data.CmnGewogId);
                }
            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
        },

        loadchewog(villId){
            let uri = 'masters/loadGlobalMasters/load_village_details_by_village_id/'+villId;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.village =  data.data.data;
            })
            .catch(function (error) {
            console.log('error: '+error);
            });
        },
        loadgewog(gewogId){
            let uri = 'masters/load_gewog_details_by_id/'+gewogId;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.gewog =  data;
                this.loaddzongkhag(data.dzongkhag_id);
            })
            .catch(function (error) {
            console.log('error: '+error);
            });
        },

        loaddzongkhag(dzo_id){
            let uri = 'masters/load_dzongkhag_details_by_id/'+dzo_id;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.dzongkhag =  data;
            })
            .catch(function (error) {
            console.log('error: '+error);
            });
        },

        loadClassStream(id){
            axios.get('loadCommons/getOrgClassStreambyId/'+id)
            .then((response) => {
                this.calsssream = response.data.data;
            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
        },

        loadsections(id){
            axios.get('loadCommons/getSectionById/'+id)
            .then((response) => {
                this.section = response.data.data;
            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
        },

        getStudentParentsDetails(id){
            axios.get('/students/getStudentParentsDetails/'+id)
                .then((response) => {
                    this.parentsDetails = response.data;
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
                    this.programmeDetails = response.data;
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
                    this.roleDetails = response.data;
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
            .catch((error) =>{
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
