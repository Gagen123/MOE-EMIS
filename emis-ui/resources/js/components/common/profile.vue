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
                            <h3 class="profile-username text-center text-blue text-bold">{{full_name}} </h3>
                            <p class="text-center text-blue text-bold">({{position_title !="" ? position_title : ''}})</p>
                            <p class="text-muted text-center">
                                Loged In AS:
                                <span class="text-blue text-bold">{{roles}}</span>
                            </p>
                            <p class="text-muted text-center">
                                Access Level:
                                <span class="text-blue text-bold">{{accessLevel}}</span>
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
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Full Name: </label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.name}}</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">EID: </label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.emp_id}}</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Position Title: </label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.position_title_name}}</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Position Level: </label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.positionlevel}}</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Email:</label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.email}}</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Contact Number:</label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.contact_no}}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Passport/CID: </label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.cid_work_permit}}</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Merital Status: </label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.merital_status}}</span>
                                            </div>

                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Dzongkhag</label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.dzongkhag}}</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Gewog</label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.gewog}}</span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-form-label col-lg-5 col-md-5 col-sm-5 col-xs-12">Working Agency</label>
                                                <span class="text-blue text-bold col-lg-7 col-md-7 col-sm-7 col-xs-12">{{staff_details.working_agency}}</span>
                                            </div>
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
                staff_details:[],
                staff_id:'',
                position_title:'',
                userDetails: '',
                user_name:'',full_name:'',role:'',
                email:'',contact:'',cid:'',
                dzongkhag:'',gewog:'',orgDetails:'',accessLevel:'',
                roles:''
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
                this.roles=roleName;
                this.staff_id=data['staff_id'];
                this.accessLevel=data['acess_level'];

                let uri = 'loadCommons/viewStaffDetails/by_id/'+this.staff_id;
                axios.get(uri)
                .then(response =>{
                    let data = response.data.data;
                    this.staff_details=data;
                    this.position_title=data.position_title_name;
                    this.user_name=data.email;
                    this.full_name=data.name;
                    this.email=data.email;
                    this.contact=data.contact_no;
                    this.cid=data.cid_work_permit;
                })
            })
            .catch(errors => {
                console.log(errors)
            });


        }
    }
</script>
