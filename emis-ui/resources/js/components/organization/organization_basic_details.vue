<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">Organization Profile</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="tab-pane">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Name:</label>
                                            <input type="text" class="form-control" :value="orgDetails.name" disabled>
                                        </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Level:</label>
                                            <input type="text" class="form-control" :value="levelArray[orgDetails.levelId]" disabled>
                                         </div>
                                    </div>
                                  
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Category:</label>
                                            <input type="text" class="form-control" :value="category" disabled>
                                        </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Year Of Establishment:</label>
                                            <input type="text" class="form-control" :value="orgDetails.yearOfEstablishment" disabled>
                                         </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>MOF Code:</label>
                                            <input type="text" class="form-control" v-model="form.mofCode">
                                        </div>
                                         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>RCSC/Zest Code:</label>
                                            <input type="text" class="form-control" v-model="form.mofCzestAgencyCodeode">
                                         </div>  
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Is AspNet School:</label><br>
                                            <label><input  type="radio" v-model="form.isAspNetSchool" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.isAspNetSchool" value="0" tabindex=""/> No</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="isSenSchool==1">
                                            <label>Co-Located to Parent School:</label><br>
                                            <label><input  type="radio" v-model="form.isColocated" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.isColocated" value="0" tabindex=""/> No</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Is GeoPoliticallyLocated:</label><br>
                                            <label><input  type="radio" v-model="form.isGeoPoliticallyLocated" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.isGeoPoliticallyLocated" value="0" tabindex=""/> No</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="isSenSchool==1">
                                            <label>Is Resource Center:</label><br>
                                            <label><input  type="radio" v-model="form.hasCounselingRoom" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.hasCounselingRoom" value="0" tabindex=""/> No</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Has Counselling room:</label><br>
                                            <label><input  type="radio" v-model="form.hasCounselingRoom" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.hasCounselingRoom" value="0" tabindex=""/> No</label>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" v-if="isSenSchool==1">
                                            <label>Has shift System:</label><br>
                                            <label><input  type="radio" v-model="form.hasShiftSystem" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.hasShiftSystem" value="0" tabindex=""/> No</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <label>Has CE:</label><br>
                                            <label><input  type="radio" v-model="form.hasCE" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.hasCE" value="0" tabindex=""/> No</label>
                                        </div>
                                    </div>
                                    <div class="row form-group fa-pull-right">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-flat btn-primary" @click="updateorg()"><i class="fa fa-check"></i> Update</button>
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
                orgDetails:'',
                isprofile:false,
                levelArray:{},
                category:'',
                form: new form({
                    org_id: '',
                    isAspNetSchool:'',
                    isColocated: '',
                    isFeedingSchool:'',
                    isGeoPoliticallyLocated:'',
                    isResourceCenter:'',
                    isSenSchool:'',
                    hasCounselingRoom:'',
                    hasShiftSystem:'',
                    hasCE:'',
                    mofCode:'',
                    zestAgencyCode:''
                }) 
            }
        },
        methods:{
            getorgProfile(org_id){
                axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
                .then(response => {
                    let response_data=response.data.data;
                    this.orgDetails=response_data;
                    if(response_data.category=="public_school"){
                        this.category="Public School";
                    }
                    if(response_data.category=="public_ecr"){
                        this.category="Public ECR";
                    }
                    if(response_data.category=="private_school"){
                        this.category="Private School";
                    }
                    if(response_data.category=="public_eccd"){
                        this.category="Public ECCD";
                    }
                    if(response_data.category=="private_eccd"){
                        this.category="Public ECCD";
                    }

                    this.form.isAspNetSchool=response_data.isAspNetSchool;
                    this.form.isColocated=response_data.isColocated;
                    this.form.isGeoPoliticallyLocated=response_data.isGeoPoliticallyLocated;
                    this.form.isResourceCenter=response_data.isResourceCenter;
                    this.form.isSenSchool=response_data.isSenSchool;
                    this.form.hasCounselingRoom=response_data.hasCounselingRoom;
                    this.form.hasShiftSystem=response_data.hasShiftSystem;
                    this.form.hasCE=response_data.hasCE;
                    this.form.mofCode=response_data.mofCode;
                    this.form.zestAgencyCode=response_data.zestAgencyCode;
                    
                })
                .catch((error) => {  
                    console.log("Error: "+error);
                });
            },
            updateorg(){
                this.form.post('organization/updateOrgBasicDetials')
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Basic Details has been saved successfully'
                    })
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occured:'+error
                    });
                })
            },
            getLevel(uri = '/organization/getLevelInDropdown'){
                axios.get(uri)
                .then(response => {
                    let data = response.data;
                    for(let i=0;i<data.length;i++){
                        this.levelArray[data[i].id] = data[i].name; 
                    }
                });
            },
        },
        mounted(){
            this.getLevel();

            axios.get('common/getSessionDetail')
            .then(response =>{
                let data = response.data.data;
                this.form.org_id=data['Agency_Code'];
                this.getorgProfile(data['Agency_Code']);
            })    
            .catch(errors =>{ 
                console.log(errors)
            });
            
        }
    }
</script>
