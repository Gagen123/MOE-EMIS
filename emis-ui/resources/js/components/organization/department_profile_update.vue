<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">Organization Profile</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img v-if="isprofile" class="img-fluid img-circle" v-bind:src="'storage/'+form.profile_path" alt="LOGO" onerror="this.src='img/question.PNG'">
                                <img v-else class="profile-user-img img-fluid img-circle" src="img/question.PNG" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{orgDetails}}</h3>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <span>Upload/Change logo</span>
                                <input type="file" class="form-control" v-on:change="onChangeFileUpload" id="attachments" :class="{ 'is-invalid': form.errors.has('attachments') }">
                                <has-error :form="form" field="attachments"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-sm-9 col-md-9 col-lg-9">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="tab-pane">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Mission</label>
                                            <textarea v-model="form.mission" class="form-control" id="mission"></textarea>
                                        </div>
                                    </div>
                                    <div class= "form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Vision</label>
                                            <textarea v-model="form.vission" class="form-control" id="vission"></textarea>
                                        </div>
                                    </div>
                                    <div class= "form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Objective</label>
                                            <textarea v-model="form.objective" class="form-control" id="vission"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row form-group fa-pull-right">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-flat btn-primary" @click="updateorg('details-tab')"><i class="fa fa-check"></i> Update</button>
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
                access_level:'',
                orgDetails:'',
                isprofile:false,
                form: new form({
                    org_id: '',
                    attachments:'',
                    vission: '',
                    mission:'',
                    profile_path:'',
                    objective:'',
                    type:'department',
                })
            }
        },
        methods:{
            onChangeFileUpload(e){
                this.form.attachments = e.target.files[0];
            },
            getorgProfile(rogId){
                axios.get('organization/getOrgProfile/'+rogId)
                .then(response => {
                    let data = response.data.data;
                    this.form.vission=data.vission;
                    this.form.mission=data.mission;
                    this.form.org_id=data.org_id;
                    this.form.profile_path=data.logo_path;
                    this.form.objective=data.objective;
                    this.orgDetails=data.orgName+' '+data.level;
                    if(data.logo_path!=""){
                        this.isprofile=true;
                    }
                })
                .catch(errors =>{
                    console.log(errors)
                });
            },
            updateorg(){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let formData = new FormData();
                formData.append('org_id', this.form.org_id);
                formData.append('vission', this.form.vission);
                formData.append('profile_path', this.form.profile_path);
                formData.append('mission', this.form.mission);
                formData.append('type', this.form.type);
                formData.append('objective', this.form.objective);
                formData.append('attachments', this.form.attachments);
                axios.post('organization/udpateOrgProfile',formData, config)
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Profile Details has been saved successfully'
                    })
                })
                .catch((error, response) => {
                    // alert(JSON.stringify(response));
                    Toast.fire({
                        icon: 'error',
                        title: 'Required field is missing or Only jpeg, png, bmp,tiff can be uploaded.<br \> please check file extension.'
                    });
                })
            }
        },
        mounted(){
            this.getLevel();
	        if(this.$route.query.org_id!=undefined && this.$route.query.org_id!=""){
		        this.getorgProfile(this.$route.query.org_id);
		        this.loadPriviousOrgDetails(this.$route.query.org_id);
	        }
            axios.get('common/getSessionDetail')
            .then(response =>{
                let data = response.data.data;
                this.access_level = data['acess_level'];
                this.form.org_id=data['Agency_Code'];
                this.getorgProfile(data['Agency_Code']);
                this.loadPriviousOrgDetails(data['Agency_Code']);
            })
            .catch(errors =>{
                console.log(errors)
            });
        }
    }
</script>
