<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2 pl-3" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Application Verification/Approval(School Merger)</h6></li>
        </ol>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                     <!-- Information of first organization -->
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="callout callout-success">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Current Details School to be merged to:</u><small><i>(The details of first organization to merge from submitter)</i></small></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:</label>
                                    <span class="text-blue text-bold">{{existing_details.name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[existing_details.levelId]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Year of Establishment:</label>
                                    <span class="text-blue text-bold">{{existing_details.yearOfEstablishment}}</span>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Zest Code:</label>
                                    <span class="text-blue text-bold">{{existing_details.zestAgencyCode}}</span>
                                </div> -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:</label>
                                    <span class="text-blue text-bold">{{existing_details.category}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[existing_details.dzongkhagId]}}</span>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[existing_details.dzongkhagId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-blue text-bold">{{selected_gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Village:</label>
                                    <span class="text-blue text-bold">{{selected_village}}</span>
                                </div>
                            </div> -->
                            <hr>

                            <!-- Information of second organization -->
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Current Details School to be merged:</u><small><i>(The details of second organization to merge from submitter)</i></small></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:</label>
                                    <span class="text-blue text-bold">{{oldOrg2.name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[oldOrg2.levelId]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Year of Establishment:</label>
                                    <span class="text-blue text-bold">{{oldOrg2.yearOfEstablishment}}</span>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Zest Code:</label>
                                    <span class="text-blue text-bold">{{oldOrg2.zestAgencyCode}}</span>
                                </div> -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:</label>
                                    <span class="text-blue text-bold">{{oldOrg2.category}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[oldOrg2.dzongkhagId]}}</span>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[oldOrg2.dzongkhagId]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-blue text-bold">{{selected_gewog}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Village:</label>
                                    <span class="text-blue text-bold">{{selected_village}}</span>
                                </div>
                            </div> -->
                            <hr>

                            <!-- if new organization is form -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="displayNewOrg">
                                <div class="form-group row" >
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label><u>New Organization Details</u><small><i>(The details of newly created organization from submitter)</i></small></label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>New Organization Name:</label>
                                        <span class="text-blue text-bold">{{this.form.proposedName}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Level:</label>
                                        <span class="text-blue text-bold">{{levelArray[this.form.levelId]}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Location:</label>
                                        <span class="text-blue text-bold">{{locationArray[this.form.locationId]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Dzongkhag/Thromde:</label>
                                        <span class="text-blue text-bold">{{dzoArray[this.form.Dzo]}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Gewog/Demkhong:</label>
                                        <span class="text-blue text-bold">{{gewogArray[this.form.Gewog]}}</span>
                                    </div>
                                </div>
                            </div>
                    </div><hr>
                    <!-- preferences organization -->
                    <div class="callout callout-info">
                        <!-- organization1 -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="org1">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Preference Organization:</u><small><i>(The details of selected organization from submitter)</i></small></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:</label>
                                    <span class="text-blue text-bold">{{oldOrg2.name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[oldOrg2.levelId]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Year of Establishment:</label>
                                    <span class="text-blue text-bold">{{oldOrg2.yearOfEstablishment}}</span>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Zest Code:</label>
                                    <span class="text-blue text-bold">{{oldOrg2.zestAgencyCode}}</span>
                                </div> -->
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:</label>
                                    <span class="text-blue text-bold">{{oldOrg2.category}}</span>
                                </div>
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[oldOrg2.dzongkhagId]}}</span>
                                </div>
                            </div>
                        </div>
                            <!-- organization 2 -->
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="org2">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Preference Organization Details:</u><small><i>(The details of selected organization from submitter)</i></small></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:</label>
                                    <span class="text-blue text-bold">{{existing_details.name}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[existing_details.levelId]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Year of Establishment:</label>
                                    <span class="text-blue text-bold">{{existing_details.yearOfEstablishment}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:</label>
                                    <span class="text-blue text-bold">{{existing_details.category}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-blue text-bold">{{dzoArray[existing_details.dzongkhagId]}}</span>
                                </div>
                            </div>
                        </div>  
                        
                        <!-- new organization details -->
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="neworg">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label><u>Preference Organization Details:</u><small><i>(The details of selected organization from submitter)</i></small></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>New Organization Name:</label>
                                    <span class="text-blue text-bold">{{this.form.proposedName}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-blue text-bold">{{levelArray[this.form.levelId]}}</span>
                                </div>
                                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Location:</label>
                                    <span class="text-blue text-bold">{{locationArray[this.form.locationId]}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag/Thromde:</label>
                                    <span class="text-blue text-bold">{{dzoArray[this.form.Dzo]}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog/Demkhong:</label>
                                    <span class="text-blue text-bold">{{gewogArray[this.form.Gewog]}}</span>
                                </div>
                            </div>
                        </div>   

                        <!-- Class and streams wil display here -->
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Classes</th>
                                            <th class="strm_clas">Stream</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, key, index) in  oldOrg2.classes" :key="index">
                                            <td>
                                                <label class="pr-4"> &nbsp;{{ calssArray[item.classId] }} </label>
                                            </td>
                                            <td class="strm_clas" v-if="calssArray[item.classId]=='Class 11' || calssArray[item.classId]=='XI' || calssArray[item.classId]=='Class 12' || calssArray[item.classId]=='XII'">
                                                {{  streamArray[item.streamId]  }}
                                            </td>
                                            <td class="strm_clas" v-else> </td>
                                            <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                <input type="checkbox" checked="true">
                                            </td>
                                            <td v-else>
                                                <input type="checkbox" checked="true">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>    
                        <div class="callout callout-info">
                            <div class="form-group row">
                                <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <h5><u>Any Supporting Documents and Attachments (if applicable)</u></h5>
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th>Upload File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="record1" v-for='(att, index) in form.fileUpload' :key="index">
                                                <td>
                                                    <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                                    <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                                    <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                                    @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                                    <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                                    @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                         </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="form.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <!-- <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button> -->
                                <button class="btn btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                                <button class="btn btn-primary" @click="shownexttab('verify')" style="display:none" id="verifyId"> <i class="fa fa-forward"></i>Verify </button>
                                <button class="btn btn-dark" @click="shownexttab('approve')" id="approveId"> <i class="fa fa-check"></i>Approve </button>
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
            count:1,
            proprietorList1:[],
            proprietorList:[],
            class_section:[],
            sectionList:[],
            class_section1:[],
            sectionList1:[],
            existing_details:'',
            oldOrg2:'',
            levelArray:{},
            dzoArray:{},
            gewogArray:{},
            calssArray:{},
            streamArray:{},
            proposed_by_list:{},
            locationArray:{},
            selected_gewog:'',
            selected_village:'',
            appicationDetails:[],
            isfeedingschool:'',
            senSchool:'',
            form: new form({
                id: '',applicationNo:'',actiontype:'',remarks:'',establishment_type:'',proposedName:'',
                levelId:'',locationId:'',Dzo:'',Gewog:'',OrgType:'', class:[],stream:[],ApplicationDetailsId:'',
                ref_docs:[],fileUpload: [],sequence:'',screen_id:'',effective_date:'',
            }),
        }
    },

    methods:{
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },
        addMore: function(){
            this.count++;
            this.form.fileUpload.push({file_name:'', file_upload:''})
        },
        remove(index){
             if(this.form.fileUpload.length>1){
                this.count--;
                this.form.fileUpload.splice(index,1);
            }
        },
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
         /**
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },
        /**
         * method to load previous org details
         */
        loadPriviousOrgDetails(org_id){
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
            .then(response => {
                this.existing_details=response.data.data;
                this.form.category=existing_details.category;
                this.getgewog(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getVillage(response.data.data.gewogId,response.data.data.chiwogId);
            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },
        /**
         * method to load previous org details
         */
        loadPriviousOrgDetails2(org_id){
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
            .then(response => {
                this.oldOrg2=response.data.data;
                this.form.category=oldOrg2.category;
                this.getgewog(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getVillage(response.data.data.gewogId,response.data.data.chiwogId);
            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },
        /**
         * method to load previous org details
         */
        loadMergerApplicationDetails(appId,type){
            axios.get('organization/loadMergerForVerification/'+appId+'/'+type)
            .then((response) => {
                let data=response.data.data;
                this.form.org1=data.merger.OldOrganizationId;
                this.form.org2=data.merger.OldOrganizationId2;
                this.loadPriviousOrgDetails(data.merger.OldOrganizationId);
                this.loadPriviousOrgDetails2(data.merger.OldOrganizationId2);
                this.appicationDetails=data;
                this.form.sequence=response.data.sequence;
                this.form.screen_id=response.data.screen_id;
                this.form.establishment_type=data.establishment_type;
                this.isfeedingschool=data.merger.proposedChange;
                this.form.proposedName=data.merger.proposedName;
                this.form.levelId=data.merger.levelId;
                this.form.locationId=data.merger.locationId;
                this.form.OrgType=data.merger.OrgType;
                this.form.Dzo=data.merger.Dzo;
                this.form.ApplicationDetailsId=data.merger.ApplicationDetailsId;
                this.form.Gewog=data.merger.Gewog;
                this.form.chiwog=data.merger.chiwog;
                this.OrgType=data.merger.OrgType;

                if(this.OrgType=="org1"){
                    $('#org1').show();
                    $('#org2').hide();
                    $('#neworg').hide();
                    $('#displayNewOrg').hide();
                    
                }
                if(this.OrgType=="org2"){
                    $('#org1').hide();
                    $('#org2').show();
                    $('#neworg').hide();
                    $('#displayNewOrg').hide();
                }
                if(this.OrgType=="newOrg"){
                    $('#org1').hide();
                    $('#org2').hide();
                    $('#neworg').show();
                }
                if(data.change_feeding!="" && data.change_feeding!=undefined && data.change_feeding.length>0){
                    for(let i=0; i< data.change_feeding.length; i++){
                        if(i==0){
                            this.feeding1=data.change_feeding[i].noOfMeals;
                        }
                        if(i==1){
                            this.feeding2=data.change_feeding[i].noOfMeals;
                        }
                        if(i==2){
                            this.feeding3=data.change_feeding[i].noOfMeals;
                        }
                    }
                }
                
                if(response.data.app_stage.toLowerCase().includes('verifi')){
                    $('#verifyId').show();
                }
                if(response.data.app_stage.toLowerCase().includes('approve')){
                    $('#approveId').show();
                }
            })
            .catch((error) => {
                console.log("Error......"+error);
            });
        },

        /**
         * method to show next tab and update application accordingly
         */
        shownexttab(nextclass){
            if(nextclass=="reject" || nextclass=="verify" || nextclass=="approve"){
                let action=true;
                if(nextclass=="reject" && this.form.remarks==""){
                    $('#remarks_err').html('Please mention remarks');
                    $('#remarks').addClass('is-invalid');
                    action=false;
                }
                if(action){
                    Swal.fire({
                        text: "Are you sure you wish to "+nextclass+" this Application ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            const config = {
                                headers: {
                                    'content-type': 'multipart/form-data'
                                }
                            }
                            let formData = new FormData();
                            formData.append('id', this.form.id);
                            formData.append('actiontype', nextclass);
                            formData.append('category', this.form.category);
                            formData.append('sequence', this.form.sequence);
                            formData.append('screen_id', this.form.screen_id);
                            formData.append('applicationNo', this.form.applicationNo);
                            formData.append('remarks', this.form.remarks);
                            formData.append('service_name', this.form.establishment_type);
                            formData.append('org1', this.form.org1);
                            formData.append('org2', this.form.org2);
                            formData.append('proposedName', this.form.proposedName);
                            formData.append('levelId', this.form.levelId);
                            formData.append('locationId', this.form.locationId);
                            formData.append('OrgType', this.form.OrgType);
                            formData.append('ApplicationDetailsId', this.form.ApplicationDetailsId);
                            formData.append('Dzo', this.form.Dzo);
                            formData.append('Gewog', this.form.Gewog);
                            formData.append('chiwog', this.form.chiwog);

                            formData.append('ref_docs[]', this.form.ref_docs);
                            for(let i=0;i<this.form.ref_docs.length;i++){
                                formData.append('attachments[]', this.form.ref_docs[i].attach);
                                formData.append('attachmentname[]', this.form.ref_docs[i].name);
                            }
                            axios.post('organization/updateMergerApplication', formData, config)
                            .then((response) => {
                                if(response!=""){
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Application details has been updated.'
                                    });
                                    this.$router.push({path:'/tasklist'});
                                }
                            })
                            .catch((err) => {
                                Swal.fire(
                                    'error!',
                                    'Not able to update this application details. Please contact system administrator.Error: '+err,
                                    'error',
                                );
                                console.log("Error:"+err)
                            })
                        }
                    });
                }
            }
            else{
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
            }
        },
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzoArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getgewog(dzoId,gewogId){
            axios.get('masters/all_active_dropdowns/dzongkhag/'+dzoId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                this.selected_gewog=this.gewogArray[gewogId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getVillage(gewogId,villageId){
            axios.get('masters/all_active_dropdowns/gewog/'+gewogId)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                this.selected_village=this.villageArray[villageId];
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.calssArray[data[i].id] = data[i].class;
                }
            });
        },

        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.streamArray[data[i].id] = data[i].stream;
                }
            });
        },
        loadproposedBy(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ProposedBy'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.proposed_by_list[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.locationArray[data[i].id] = data[i].name;
                }
            });
        },
    },

    mounted(){
        this.getLocation();
        this.loadproposedBy();
        this.getLevel();
        this.getClass();
        this.getStream();
        this.loaddzongkhagList();
        this.form.applicationNo=this.$route.params.data.application_number;
        this.loadMergerApplicationDetails(this.$route.params.data.application_number,this.$route.params.type);

    }
}
</script>
