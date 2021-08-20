<template>
  <div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="images/user.png" alt="User profile picture">
                    </div>
                    <hr>
                    <h3 class="profile-username text-center">{{ name }}</h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Name</b><a class="float-right">{{ name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>User Id</b> <a class="float-right">{{ email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Contact</b> <a class="float-right">{{ contact }}</a>
                            </li>
                            <template v-if="is_student">
                                <li class="list-group-item">
                                    <b>CID</b> <a class="float-right">{{ cid }}</a>
                                </li>
                            </template>
                            <template v-else>
                                <li class="list-group-item">
                                    <b>User Type</b> <a class="float-right">{{ type }}</a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-8" v-if="is_student">
                <div class="card">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs border-primary" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item border-left border-right">
                                <a class="nav-link active" id="parents_tab-tab" data-toggle="pill" href="#parents_tab" role="tab" aria-controls="parents_tab" aria-selected="false">Parents Details</a>
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
                            <!-- <div class="tab-pane" id="parents_tab" aria-labelledby="parents_tab" > -->
                            <div class="tab-pane active show fade" id="parents_tab" role="tabpanel" aria-labelledby="parents_tab-tab">
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
  data() {
    return {
      is_student:false,
      user: "",
      cid:'',
      code:'',
      email:'',
      name:'',
      contact:'',
      type:'',
      parentsDetails:[],
      roleDetails:[],
      programmeDetails:[],
    };
  },

    mounted() {
        axios.get('getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.cid=data['std_id'];
            this.code=data['std_code'];
            this.type=data['user_type'];
            this.email=data['email'];
            this.name=data['full_name'];
            this.contact=data['phone_number'];
            if(data['user_type']!="Parent" && data['user_type']!="Feedback" && data['user_type']!="Leadership"){
                this.is_student=true;
            }
        })
        .catch(errors => {
            console.log(errors)
        });
    },
};
</script>
