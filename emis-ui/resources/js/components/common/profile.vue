<template>
<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"> 
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="img/user.png" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{full_name}}</h3>
                            <p class="text-muted text-center">
                                Loged In AS:
                                {{roles}}
                            </p>
                        </div>
                    </div>
                    <!-- <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Roles</strong>
                            <p class="text-muted pl-3">
                               {{role}}
                            </p>
                            <hr> 
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            <p class="text-muted">MInistry of education, Mothithang, Thimphu</p>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-9">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label">Full Name</label>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <input type="email" class="form-control" id="full_name" v-model="full_name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label">Email</label>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <input type="email" class="form-control" v-model="email"  id="email" placeholder="Email">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label">Contact Number</label>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="form-control" v-model="contact"  id="contact" placeholder="Contact Number">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label">Passport/CID</label>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="form-control" v-model="cid" id="cid" placeholder="Passport_CID">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label">Dzongkhag</label>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="form-control" v-model="dzongkhag" id="dzongkhag" placeholder="Dzongkhag">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 col-form-label">Gewog</label>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" class="form-control" v-model="gewog" id="gewog" placeholder="Gewog">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
</div>
</template>
<script>
    export default {
        data(){
            return{
                userDetails: '',
                user_name:'',full_name:'',role:'',
                email:'',contact:'',cid:'',
                dzongkhag:'',gewog:'',
                roles:''
            }
        },
        methods:{
            getdzongkhag(dzo_id){
                axios.get('common/getDzoNameById/'+dzo_id)
                .then(response => {
                    let data = response.data;
                    this.dzongkhag=data.name;
                })    
                .catch(errors => { 
                    console.log(errors)
                });
            },
            getgewog(gewog_id){
                axios.get('common/getGewogNameById/'+gewog_id)
                .then(response => {
                    let data = response.data;
                    this.gewog=data.name;
                })    
                .catch(errors => { 
                    console.log(errors)
                });
            }
        },
        mounted() {
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                let roleName="";
                for(let i=0;i<data['roles'].length;i++){
                    if(i==data['roles'].length-1){
                        roleName+=data['roles'][i].roleName;
                    }
                    else{
                        roleName+=data['roles'][i].roleName+', ';
                    }
                }
                this.user_name=data['Email'];
                this.full_name=data['Full_Name'];
                this.role=data['Full_Name'];
                this.email=data['Email'];
                this.contact=data['Contact_Number'];
                this.cid=data['Passport_CID'];
                this.roles=roleName;
                this.getdzongkhag(data['Dzo_Id']);
                this.getgewog(data['Geo_Id']);
          })    
          .catch(errors => { 
             console.log(errors)
          });
        }
    }
</script>
