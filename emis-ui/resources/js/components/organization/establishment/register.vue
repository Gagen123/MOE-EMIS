<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Category:<span class="text-danger">*</span></label>
                        <select name="category" id="category" v-model="applicaitondetailsform.category" class="form-control select2" >
                            <option value="1">Public</option>
                            <option value="0">Private & Others</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Year of Establishment:</label>
                        <input type="text" class="form-control" id="yearOfEst" v-model="applicaitondetailsform.yearestb" name="yearOfEst"/>
                    </div>   
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="zest_code_section">
                        <label>ZEST Working Agency Code:<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" id="workingAgencyCode" class="form-control" v-model="applicaitondetailsform.zestcode" @change="remove_error('workingAgencyCode')"/>
                            <div class="input-group-append">
                                <span type="button" class="col-md-12 btn  btn-primary" @click="getApprovedOrgDetails('1')"><i class="fa fa-search">&nbsp;Search</i></span>
                            </div>
                        </div>
                        <span id="workingAgencyCode_err" class="text-danger"></span>
                    </div>
                    <span class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="approved_schol_list" style="display:none">  
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                <label class="col-md-12 ">School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="organizationid" id="organizationid" v-model="applicaitondetailsform.organizationid" :class="{ 'is-invalid': applicaitondetailsform.errors.has('organizationid') }" class="form-control select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.proposedName }}</option>
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                                <br/>
                                <span type="button" class="btn  btn-primary" @click="getApprovedOrgDetails('0')"><i class="fa fa-search">&nbsp;Search</i></span>
                            </div> 
                        </div>
                    </span>           
                </div>
                <!-- for private category -->
                <div class="hidden" id="org_details" style="display:none">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="privateSchoolDetails" style="display:none">
                        <div class="form-group row"> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Proposed Name:</label>
                                <span class="text-blue text-bold">{{applicaitondetailsform.proposedName}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Level:</label>
                                <span class="text-blue text-bold">{{applicaitondetailsform.level}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Category:</label>
                                <span class="text-blue text-bold">
                                    {{ applicaitondetailsform.category  == 1 ? "public" :  "private"}}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Dzongkhag:</label>
                                <span class="text-blue text-bold">{{applicaitondetailsform.dzongkhag}}</span>
                            </div>  
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Gewog:</label>
                                <span class="text-blue text-bold">{{applicaitondetailsform.gewog}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Chiwog:</label>
                                <span class="text-blue text-bold">{{applicaitondetailsform.village}}</span>
                            </div>                 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Location Type:</label>
                                <span class="text-blue text-bold">{{applicaitondetailsform.locationType}}</span>
                            </div>   
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Geopolitically Located:</label>
                                <span class="text-blue text-bold">
                                    {{ applicaitondetailsform.geopolicaticallyLocated  == 1 ? "Yes" :  "No"}}
                                </span>
                            </div> 
                        </div>

                        <div class="form-group row" v-if="applicaitondetailsform.senSchool==1">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                <label class="mb-0">Parent School:</label>
                                <span class="text-blue text-bold">{{applicaitondetailsform.parentSchool}}</span>
                            </div>   
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Co-located with Parent School</label>
                                <span class="text-blue text-bold">
                                    {{ applicaitondetailsform.coLocated  == 1 ? "Yes" :  "No"}}
                                </span>
                            </div> 
                        </div>
                        <div v-if="applicaitondetailsform.category==0">
                            <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h4><u>Proprietor Details</u></h4>
                                </div>
                            </div>
                            <div v-for="(pro, index) in proprietorList" :key="index">
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">CID:</label>
                                        <span class="text-blue text-bold">{{pro.cid}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Full Name:</label>
                                        <span class="text-blue text-bold">{{pro.fullName}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Phone No:</label>
                                        <span class="text-blue text-bold">{{pro.phoneNo}}</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label class="mb-0">Email:</label>
                                        <span class="text-blue text-bold">{{pro.email}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row form-group fa-pull-right">
                    <div class="col-md-12">
                        <!-- <button type="button" class="btn btn-flat btn-danger" id="reset" @click="reset()"><i class="fa fa-ban"></i> Reset</button> -->
                        <button type="button" class="btn btn-flat btn-primary" @click="save()"> <i class="fa fa-save"></i> Save</button>                                                
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
            orgList:[],
            proprietorList:[],
             applicaitondetailsform: new form({
                id: '',category:'1',yearestb:'',zestcode:'',organizationid:'',applicationNo:'',application_date:'',service:'',proposedName:'',
                level:'',category:'1',dzongkhag:'',gewog:'',village:'',locationType:'',
                geopolicaticallyLocated:'0',senSchool:'0',parentSchool:'',coLocatedParent:'0',cid:'',name:'',
                phoneNo:'',email:'',status:'',remarks:''
            }),
             
        }
    },
    methods:{
        display_respective_section: function(){
            $("#zest_code_section").hide();
            $("#approved_schol_list").hide();
            if(this.applicaitondetailsform.category == 1){
               $("#zest_code_section").show();

            }else{
                this.loadApproveSchoolname();
                $("#approved_schol_list").show();
            }
        },
        loadApproveSchoolname(){
            axios.get('organization/loadApprovedOrgs')
            .then((response) => {  
                let data=response.data.data;
                this.orgList   =   data;
            })
            .catch((error) => {  
                console.log("Error:"+error);
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        }, 
        async changefunction(id){
            if(id=="category"){
                this.applicaitondetailsform.category=$('#category').val();
                this.display_respective_section();
            }
            if(id=="organizationid"){
                this.applicaitondetailsform.organizationid=$('#organizationid').val();
            }
        },

        getApprovedOrgDetails(type){
            let key="";
            if(type==1){
                key=this.applicaitondetailsform.zestcode;
            }
            if(type==0){
                key=this.applicaitondetailsform.zestcode;
            }
            axios.get('organization/getApprovedOrgDetails/'+type+'/')
            .then((response) => {  
                let data=response.data.data;
                this.orgList   =   data;
                $("#org_details").show();
            })
            .catch((error) =>{  
                $("#org_details").hide();
                console.log("Error:"+error);
            });
        },
    },
    mounted() {
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
    created(){
        let currentdate = new Date();
        let current_year =(currentdate.getFullYear());
        // let month =(currentdate.getMonth() + 1);
        // let day = currentdate.getDate();
        this.applicaitondetailsform.yearestb=current_year;
    }
}
</script>