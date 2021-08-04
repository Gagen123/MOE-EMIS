<template>
  <div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img
                            class="profile-user-img img-fluid img-circle"
                            src="/images/logo.png"
                            alt="User profile picture"
                        />
                        </div>
                        <h3 class="profile-username text-center">{{ name }}</h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Name</b><a class="float-right">{{ name }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Contact</b> <a class="float-right">{{ contact }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ email }}</a>
                            </li>
                            <template v-if="is_student">
                                <li class="list-group-item">
                                    <b>CID</b> <a class="float-right">{{ cid }}</a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-8" v-if="is_student">
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3> (Loged In as <b>{{type}}</b>)
                    </div>
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>
                        <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at
                        Knoxville
                        </p>
                        <hr />
                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        <p class="text-muted">Malibu, California</p>
                        <hr />
                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                        <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                        </p>
                        <hr />
                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        <p class="text-muted">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                        fermentum enim neque.
                        </p>
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
    };
  },

    mounted() {
        axios.get('getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.cid=data['std_cid'];
            this.code=data['std_code'];
            this.type=data['user_type'];
            this.email=data['email'];
            this.name=data['full_name'];
            this.contact=data['phone_number'];
            if(data['user_type']!="Parent"){
                this.is_student=true;
            }
        })
        .catch(errors => {
            console.log(errors)
        });
    },
};
</script>
