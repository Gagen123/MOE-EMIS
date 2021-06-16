<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="applicaitonUnderProcess">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
         <form class="bootbox-form" id="mainform">
            <div class="form-group row">
                <input type="hidden" v-model="form.organizationId"/>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Code:</label>
                    <span class="text-blue text-bold" id="code">{{form.code}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Name:</label>
                    <span class="text-blue text-bold" id="name">{{form.name}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Category:</label>
                    <span class="text-blue text-bold" id="name">{{form.category == 1 ? "public" : "private"}}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Level:</label>
                    <span class="text-blue text-bold" id="level">{{form.level}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Dzongkhag:</label>
                    <span class="text-blue text-bold" id="dzongkhag">{{form.dzongkhag}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Gewog:</label>
                    <span class="text-blue text-bold" id="gewog">{{form.gewog}}</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Chiwog:</label>
                    <span class="text-blue text-bold" id="chiwog">{{form.chiwog}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Location Type:</label>
                    <span class="text-blue text-bold" id="chiwog">{{form.location}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Geopolitically Located:</label>
                    <span class="text-blue text-bold" id="geoLocated">{{form.geoLocated == 1 ? "Yes" : "No"}}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>SEN School:</label>
                    <span class="text-blue text-bold" id="geoLocated">{{form.senSchool == 1 ? "Yes" : "No"}}</span>
                </div>
            </div>
            <div class="form-group row" id="parentDetails" style="display:none">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="coLocatedDiv">
                    <label>Co-located with Parent School:</label>
                    <span class="text-blue text-bold" id="coLocatedParent">{{form.coLocatedParent == 1 ? "Yes" : "No"}}</span>
                </div> 
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="parentSchoolDiv">
                    <label>Parent School:</label>
                    <span class="text-blue text-bold" id="parentSchool">{{form.parentSchool}}</span>
                </div>
            </div>
            <div id="privatedetails" style="display:none">
                <div class="row pb-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Proprietor Details</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">CID:<span class="text-danger">*</span></label>
                        <span class="text-blue text-bold" id="cid">{{form.cid}}</span>                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Full Name:<span class="text-danger">*</span></label>
                        <span class="text-blue text-bold" id="fullName">{{form.fullName}}</span>                        
                    </div>
                </div>
                <div class="form-group row" >
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Phone No:<span class="text-danger">*</span></label>
                        <span class="text-blue text-bold" id="phoneNo">{{form.phoneNo}}</span>                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Email:<span class="text-danger">*</span></label>
                        <span class="text-blue text-bold" id="email">{{form.email}}</span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0">Reason:<span class="text-danger">*</span></label>
                    <textarea class="form-control" v-model="form.reason" :class="{ 'is-invalid': form.errors.has('reason') }" @change="remove_error('reason')"></textarea>
                    <has-error :form="form" field="reason"></has-error>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label>Remarks:</label>
                    <textarea class="form-control" v-model="form.remark"></textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger" tabindex="5"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" tabindex="4"><i class="fa fa-save"></i> Close School</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form: new form({
                code:'',
                organizationId:'',
                name:'',
                category:'',
                level:'',
                levelId:'',
                dzongkhag:'',
                dzongkhagId:'',
                gewog:'',
                gewogId:'',
                chiwog:'',
                chiwogId:'',
                location:'',
                locationId:'',
                geoLocated:'',
                senSchool:'',
                coLocatedParent:'',
                parentSchool:'',
                cid:'',
                fullName:'',
                phoneNo:'',
                email:'',
                reason:'',
                remark:'',
                status:'submitted'
            })
        }
    },

    methods:{
        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.form.reason = '';
                this.form.remark = '';
            }
            if(type=="save"){
                this.form.post('/organization/saveClosure')
                    .then((response) => {
                    if(response!=""){
                        if(response.data=="No Screen"){
                            Toast.fire({  
                                icon: 'error',
                                title: 'Technical Errors: please contact system admimnistrator for further details'
                            });
                        }
                        if(response!="" && response!="No Screen"){
                            let message="applicaiton for Closure has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                            this.$router.push({name:'restr_acknowledgement',params: {data:message}});
                            Toast.fire({  
                                icon: 'success',
                                title: 'Closure details is saved successfully'
                            });
                        }
                    }
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        /**
         * method to check pending status
         */
        // checkPendingApplication(){
        //     axios.get('organization/checkPendingApplication/closure')
        //     .then((response) => {  
        //         let data=response.data;
        //         if(data!=""){
        //             $('#mainform').hide();
        //             $('#applicaitonUnderProcess').show();
        //             $('#existmessage').html('You have already submitted application for basic details change <b>('+data.application_number+')</b> which is under process.');
        //         }
        //     })
        //     .catch((error) => {  
        //         console.log("Error: "+error);
        //     });
        // },


        /**
         * method to get organization details
         */
        getOrgDetails(id){
            axios.get('organization/getFullSchoolDetials/'+id)
            .then((response) => {  
                let data=response.data.data;
                this.form.code = data.code;
                this.form.name = data.name;
                this.form.category = data.category;
                this.form.level = data.level;
                this.form.levelId = data.levelId;
                this.form.dzongkhag = data.dzongkhag;
                this.form.dzongkhagId = data.dzongkhagId;
                this.form.gewog = data.gewog;
                this.form.gewogId = data.gewogId;
                this.form.chiwog = data.village;
                this.form.chiwogId = data.chiwogId;
                this.form.location = data.locationType;
                this.form.locationId = data.locationId;
                this.form.geoLocated = data.isGeopoliticallyLocated;
                this.form.senSchool = data.isSenSchool;
                if(data.isSenSchool == 1){
                    $('#parentDetails').show();
                    this.form.coLocatedParent = data.isColocated;
                    this.form.parentSchool = data.parentSchoolId;
                }

                if(data.category == 0){
                    $('#privatedetails').show();
                    let prop=data.proprietor;
                    for(let i=0;i<prop.length;i++){
                        this.form.cid = prop[i].cid;
                        this.form.fullName = prop[i].fullName;
                        this.form.phoneNo = prop[i].phoneNo;
                        this.form.email = prop[i].email;
                    }
                }
                this.form.parent_id=data.id;
                this.data=data;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

    },

    created(){
        this.getOrgDetails(this.$route.query.data);
    },
    mounted(){
        // this.checkPendingApplication();
    }
}
</script>