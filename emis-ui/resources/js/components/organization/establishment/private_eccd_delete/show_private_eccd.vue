<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Organization Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item attachments-tab" @click="shownexttab('attachments-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Attachments & Verification </label>                              
                        </a>
                    </li>
                    <li class="nav-item class-tab" @click="shownexttab('class-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Classes and Stream </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <h4><u>Application Details</u></h4>
                            <div class="form-group row"> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Application Number:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.application_no}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Submitted Date:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.application_date}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Service Name:</label>
                                    <span class="text-blue text-bold">Establishment of {{applicationdetails.establishment_type}}</span>
                                </div> 
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <h5><u>Organization Details</u></h5>
                            <div class="form-group row"> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicationdetails.establishment_type=='Public School'">
                                    <label class="mb-0">Proposal Initiated By:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.initiated_by}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Proposed Name:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proposedName}}</span>
                                </div>  
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.dzongkhag}}</span>
                                </div>  
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Gewog:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Chiwog:</label>
                                    <span class="text-blue text-bold">{{applicationdetails.village}}</span>
                                </div>                 
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Location:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proposedLocation}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Proposed ECCD Infrastructure:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proposedInfrastructure}}</span>
                                </div> 
                                  
                            </div>
                           <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Proprietor Details</u></h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">CID:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorCid}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Full Name:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorName}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Mobile No:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorMobile}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Phone No:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorPhone}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Email:</label>
                                    <span class="text-blue text-bold">{{applicationOrgdetails.proprietorEmail}}</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-primary" @click="shownexttab('attachments-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div> 
                    <div class="tab-pane fade tab-content-details" id="attachments-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Applicant Attachments</u></h5>
                                    <table id="participant-table" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Attachment Name</th> 
                                                <th>Attachment</th> 
                                                <th>File</th> 
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                                <template v-if="attach.upload_type == null || attach.upload_type=='Applicant'">
                                                    <td> {{attach.user_defined_file_name}} </td>
                                                    <td>  {{attach.name}}</td>
                                                    <td>    
                                                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    </td>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-success">
                            <h4><u>Site Visit and Verification Details</u></h4>
                            <div class="row pb-2" style="display:none" id="tentativeAttachment">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Verifying Agency:</label>
                                    <span class="text-blue text-bold">{{ verification.verifyingAgency }}</span>
                                </div>   
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Tentative Date:</label>
                                    <span class="text-blue text-bold">{{ verification.verifyingAgency }}</span>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Attachments</u></h5>
                                    <table id="participant-table" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Attachment Name</th> 
                                                <th>Attachment</th> 
                                                <th>File</th> 
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                                <template v-if="attach.upload_type=='tentative'">
                                                    <td>  {{attach.user_defined_file_name}}</td>
                                                    <td>  {{attach.name}}</td>
                                                    <td>    
                                                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    </td>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div id="verifier_team" style="display:none">
                                <h5><u>Team Verification</u></h5>
                                <div class="row form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-4">
                                        <table id="nomination-list-table" class="table table-sm table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>CID/Passport</th>
                                                    <th>Position Title</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for='(user, index) in nomi_staffList' :key="index">
                                                    <td> {{user.name}}</td>
                                                    <td> {{user.cid}}</td>
                                                    <td> {{user.po_title}}</td>
                                                </tr>
                                            </tbody>
                                            <span id="nminees_error" class="text-danger"></span>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2" style="display:none" id="team_verificationAttachment">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Attachments</u></h5>
                                    <table id="participant-table" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Attachment Name</th> 
                                                <th>Attachment</th> 
                                                <th>File</th> 
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                                <template v-if="attach.upload_type=='team_verification'">
                                                    <td>{{attach.user_defined_file_name}} </td>
                                                    <td>  {{attach.name}}</td>
                                                    <td>    
                                                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    </td>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Attachments for Final Approval</u></h5>
                                    <table id="participant-table" class="table w-100 table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Attachment Name</th> 
                                                <th>Attachment</th> 
                                                <th>File</th> 
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <tr v-for='(attach,count) in applicationdetails.attachments' :key="count+1">
                                                <template v-if="attach.upload_type=='final_verification'">
                                                    <td>{{attach.user_defined_file_name}} </td>
                                                    <td>  {{attach.name}}</td>
                                                    <td>    
                                                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                                    </td>
                                                </template>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 fa-pull-right">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <h4><u>Select classes and streams</u></h4>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                    <span v-for="(item, index) in  class_section" :key="index">
                                        <br>
                                        <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ calssArray[item.classId] }}<span v-if="item.streamId"> - {{ streamArray[item.streamId] }}</span> </label>
                                    </span> 
                                </div> 
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('attachments-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
    components: {
    },
    data(){
        return{ 
            calssArray:{},
            streamArray:{},
            levelList:{},
            locationList:{},
            applicationdetails:'',
            applicationOrgdetails:'',
            class_section:[],
            nomi_staffList:[],
            verification:'',
        } 
    },
    methods:{
        loadestablishmentapplicationdetails(appId){
            axios.get('organization/loadEstbDetailsForView/'+appId)
            .then((response) => {  
                let data=response.data.data;
                this.applicationdetails=data;
                this.applicationOrgdetails=data.org_details;
                this.class_section=data.org_class_stream;
                this.verification=data.app_verification;
                if(data.app_verification!=""){
                    $('#tentativeAttachment').show();
                }
                if(data.app_verification_team.length>0){
                    $('#team_verificationAttachment').show();
                    $('#verifier_team').show();
                    for(let i=0;i<data.app_verification_team.length;i++){
                        this.nomi_staffList.push({id:'NA',staff_id:data.app_verification_team[i].teamMember,
                            name:data.app_verification_team[i].name,
                            cid:data.app_verification_team[i].cid,
                            po_title:data.app_verification_team[i].po_title,
                        })
                    }
                }
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },
        openfile(file){ 
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        shownexttab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.levelList[data[i].id] = data[i].name; 
                }
            });
        },
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.locationList[data[i].id] = data[i].name; 
                }
            });
        },
        getClassStream:function(){
            axios.get('/masters/loadClassStreamMapping')
              .then(response => {
                this.classStreamList = response.data.data;
                let data = response.data.data;
                //this.calssArray[data[i].id] = data[i].name;
            });
        },

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.calssArray[data[i].id] = data[i].class; 
                }
            });
        },

        getstream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.streamArray[data[i].id] = data[i].stream; 
                }
            });
        },
    },
    mounted(){
        this.getLevel();
        this.getLocation();
        this.getClassStream();
        this.getClass();
        this.getstream();
        this.loadestablishmentapplicationdetails(this.$route.query.id);
    }
}
</script>