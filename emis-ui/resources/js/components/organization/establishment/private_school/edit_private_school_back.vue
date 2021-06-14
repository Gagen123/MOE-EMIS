<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Organization Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item file-tab" @click="shownexttab('file-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">File Uploads </label>
                        </a>
                    </li>
                    <li class="nav-item class-tab" @click="shownexttab('class-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Classes and Stream </label>
                        </a>
                    </li>
                </ul>
            </div>
            <br />
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <form class="form-horizontal">
                        <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                        <label class="mb-0"><i><u>Proprietor Details</u></i></label>
                        <p>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">CID:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="number" @keyup.enter="getDetailsbyCID('proprietorCid')" @blur="getDetailsbyCID('proprietorCid')" v-model="form.proprietorCid" :class="{ 'is-invalid': form.errors.has('proprietorCid') }" @change="remove_error('proprietorCid')" class="form-control" id="proprietorCid" placeholder="CID No."/>
                                <has-error :form="form" field="proprietorCid"></has-error>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Name:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.proprietorName" :class="{ 'is-invalid': form.errors.has('proprietorName') }" @change="remove_error('proprietorName')" class="form-control" id="proprietorName" placeholder="Proprietor Name"/>
                                <has-error :form="form" field="proprietorName"></has-error>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Contact Information:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input type="number" v-model="form.proprietorPhone" :class="{ 'is-invalid': form.errors.has('proprietorPhone') }" @change="remove_error('proprietorPhone')" class="form-control" id="proprietorPhone" placeholder="Phone No" />
                                <has-error :form="form" field="proprietorPhone"></has-error>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input type="number" v-model="form.proprietorMobile" :class="{ 'is-invalid': form.errors.has('proprietorMobile') }" @change="remove_error('proprietorMobile')" class="form-control" id="proprietorMobile" placeholder="Mobile No"/>
                                <has-error :form="form" field="proprietorMobile"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Email:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="email" v-model="form.proprietorEmail" :class="{ 'is-invalid': form.errors.has('proprietorEmail') }" @change="remove_error('proprietorEmail')" class="form-control" id="proprietorEmail" placeholder="Email"/>
                                <has-error :form="form" field="proprietorEmail"></has-error>
                            </div>
                        </div>
                        <hr>
                        <label class="mb-0"><i><u>School Details</u></i></label>
                        <p>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Name:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" placeholder="Proposed Name"/>
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Level:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <select name="level" id="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" class="form-control select2" @change="remove_error('level')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="level"></has-error>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Expected Enrollment:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input type="number" v-model="form.enrollmentBoys" :class="{ 'is-invalid': form.errors.has('enrollmentBoys') }" @change="remove_error('enrollmentBoys')" class="form-control" id="enrollmentBoys" placeholder="Boys" />
                                <has-error :form="form" field="enrollmentBoys"></has-error>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input type="number" v-model="form.enrollmentGirls" :class="{ 'is-invalid': form.errors.has('enrollmentGirls') }" @change="remove_error('enrollmentGirls')" class="form-control" id="enrollmentGirls" placeholder="Girls"/>
                                <has-error :form="form" field="enrollmentGirls"></has-error>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Gewog:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="gewog"></has-error>
                            </div>
                            <label class="col-lg-1.5 col-md-1.5 col-sm-1.5 col-form-label">Chiwog:<span class="text-danger">*</span></label>
                            <div class="col-lg-2.5 col-md-2.5 col-sm-2.5">
                                <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="chiwog"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Location:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.proposedLocation" :class="{ 'is-invalid': form.errors.has('proposedLocation') }" @change="remove_error('proposedLocation')" class="form-control" id="proposedLocation" placeholder="Proposed Location"/>
                                <has-error :form="form" field="proposedLocation"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Type of School:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                <label><input  type="radio" v-model="form.typeOfSchool" value="1" tabindex=""/> Day</label>
                                <label><input  type="radio" v-model="form.typeOfSchool" value="0" tabindex=""/> Boarding</label>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Total Area of Land Proposed:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.totalLand" :class="{ 'is-invalid': form.errors.has('totalLand') }" @change="remove_error('totalLand')" class="form-control" id="totalLand" />
                                <has-error :form="form" field="totalLand"></has-error>
                            </div>
                        </div> -->
                        </form>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('file-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade tab-content-details" id="file-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Upload the Required Documents<span class="text-danger">*</span></label>
                            </div>
                        </div><br>
                        <div class="card">
                            <div class="form-group row">
                                <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>File Name</th>
                                                <th>Upload File</th>                     
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="record1" v-for='(att, index) in file_form.fileUpload' :key="index">
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
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('class-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select classes and streams:<span class="text-danger">*</span></label>
                            </div>
                        </div><br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row" >
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Classes</th>
                                        <th class="strm_clas">Stream</th>  
                                        <th></th>                     
                                    </tr>
                                </thead>
                                <tbody id="afer_verification" style="display:none">
                                    <tr v-for="(item, key, index) in  class_section" :key="index">
                                        <td>
                                            <label class="pr-4"> &nbsp;{{ calssArray[item.classId] }} </label>
                                        </td>
                                        <td class="strm_clas" v-if="calssArray[item.classId]=='Class 11' || calssArray[item.classId]=='XI' || calssArray[item.classId]=='Class 12' || calssArray[item.classId]=='XII'">                                
                                            {{  streamArray[item.streamId]  }}
                                        </td>
                                        <td class="strm_clas" v-else>                                
                                        
                                        </td>
                                        <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">                                
                                            <input type="checkbox" v-model="classStreamForm.stream"  :id="item.id" :value="item.id">
                                        </td>
                                        <td v-else>  
                                            <input type="checkbox" checked="true">                           
                                        </td>
                                    </tr> 
                                </tbody>
                                <tbody id="class_edit" style="display:none">
                                    <tr v-for="(item, key, index) in  classStreamList" :key="index">
                                        <td>
                                            <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                        </td>
                                        <td class="strm_clas" v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">                                
                                            {{  item.stream  }}
                                        </td>
                                        <td class="strm_clas" v-else>                                
                                          
                                        </td>
                                        <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">                                
                                            <input type="checkbox" v-model="classStreamForm.stream"  :id="item.id" :value="item.id">
                                        </td>
                                        <td v-else>  
                                            <input type="checkbox" v-model="classStreamForm.class" :value="item.classId">                              
                                            
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="classStreamForm.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('file-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-danger" id="rejectbtn" @click="shownexttab('reject')"> <i class="fa fa-times"></i>Reject </button>
                                <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Submit </button>
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
            dzongkhag:'',
            levelList:[],
            locationList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            orgList:[],
            levelArray:{},
            proposed_by_list:[],
            classList:[],
            streamList:[],
            classStreamList:[],
            fileUpload: [],
            draft_data:[],
            class_section:[],
            calssArray:{},
            streamArray:{},
            file_form: new form({
                id:'',
                file_name: '',
                fileUpload: [],
                record_type:'edit',
                application_number:'',
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
            form: new form({
                id: '', proposedName:'', level:'',category:'2', dzongkhag:'', gewog:'', chiwog:'0', proposedLocation:'',
                proprietorCid:'', proprietorName:'', proprietorPhone:'', proprietorMobile:'', proprietorEmail:'', totalLand:'',
                enrollmentBoys:'', enrollmentGirls:'', typeOfSchool:'', establishment_type:'private_school', status:'pending',
                action_type:'edit',application_number:'',
                
            }),
            classStreamForm: new form({
                id: '',class:[], stream:[], proposed_establishment:'Private School', status:'submitted',application_number:'',
                action_type:'edit',submit_type:'',remarks:'',proposedName:'',update_type:'',
            }) 
        } 
    },
    methods: {
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
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
                 for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name; 
                }
            });
        },
        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
            });
        },

        /**
         * method to get location in dropdown
         */
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList = data;
            });
        },

        /**
         * method to get Gewog in dropdown
         */
        getGewogList(dzongkhag){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.gewog_list = data.data;
            });
        },

        
        async getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && (gewogId==null || gewogId=="")){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.file_form.fileUpload.push({file_name:'', file_upload:''})
        },
        addMoreStudents: function(){
            this.count++;
            this.file_form.assigned_student.push({student:'',std_role:'', remarks:''})   
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.file_form.roles.length>1){
                this.count--;
                this.file_form.roles.splice(index,1); 
            }
        },
        removeStudents(index){    
             if(this.file_form.assigned_student.length>1){
                this.count--;
                this.file_form.assigned_student.splice(index,1); 
            }
        },

        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#fileName'+currentcount).val()!=""){
                this.file_form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#fileName'+currentcount).prop('readonly',true);
            }
            else{
                $('#fileName'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            } 
        },


        /**
         * method to populate dropdown
         */
        async changefunction(id,text){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="level"){
                this.form.level=$('#level').val();
                 this.getClassStream(text);
            }
            // if(id=="dzongkhag"){
            //     this.form.dzongkhag=$('#dzongkhag').val();
            //     this.getgewoglist();
            // }
            if(id=="gewog"){
                this.form.gewog=$('#gewog').val();
                this.getvillagelist();
            }
            if(id=="chiwog"){
                this.form.chiwog=$('#chiwog').val();
            }
        },

        /**
         * method to get class stream in checkbox
         */
        getClassStream(text){
            $('.strm_clas').hide();
            let level = text;
            if(level.toLowerCase().includes('middle')){
                level="10";
            }
            else if(level.toLowerCase().includes('lower')){
                level="8";
            }
            else if(level.toLowerCase().includes('primary')){
                level="6";
            }
            else{
                level="12";
                $('.strm_clas').show();
            }
            axios.get('/masters/loadClassStreamMapping/school_'+level)
              .then(response => {
                this.classStreamList = response.data.data;
            });
        },

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                let data = response.data;
                this.classList = data;
                for(let i=0;i<data.length;i++){
                    this.calssArray[data[i].id] = data[i].class; 
                }
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                  let data=response.data;
                this.streamList = data;
                for(let i=0;i<data.length;i++){
                    this.streamArray[data[i].id] = data[i].class; 
                }
            });
        },

        /**
         * method to show next tab
         */
        shownexttab(nextclass){ 
            // if(nextclass=="final-tab"){ 
            //     Swal.fire({
            //         text: "Are you sure you wish to save this details ?",
            //         icon: 'info',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Yes!',
            //         }).then((result) => {
            //         if (result.isConfirmed) {
            //             this.classStreamForm.post('organization/saveClassStream')
            //             .then((response) => {
            //                 if(response.data=="No Screen"){
            //                     Toast.fire({  
            //                         icon: 'error',
            //                         title: 'Technical Errors: please contact system administrator for further details'
            //                     });
            //                 }
            //                 if(response!="" && response!="No Screen"){
            //                     let message="Applicaiton for new Establishment has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
            //                     this.$router.push({name:'acknowledgement_private_school',params: {data:message}});
            //                     Toast.fire({  
            //                         icon: 'success',
            //                         title: 'Application for new establishment has been submitted for further action'
            //                     });
            //                 } 
            //             })
            //             .catch((err) => {
            //                 console.log("Error:"+err)
            //             })
            //         }
            //     });
            // }
            if(nextclass=="final-tab" || nextclass=="reject"){ 
                let subform=true;
                let status="";
                let message="";
                if(nextclass=="reject"){
                    if($('#remarks').val()==""){
                        subform=false;
                        $('#remarks_err').html('Please mention remarks');
                    }
                    else{
                        status="Are you sure you wish to reject this application? ";
                        message="Applicaiton for new Establishment has been recorded in the system as reject. System Generated application number for this transaction is: ";
                    }
                }
                if(nextclass=="final-tab"){
                    status="Are you sure you wish to submit this application for further approval ? ";
                    message="Applicaiton details for new Establishment has been updated and send for further approval. ";
                }
                if(subform){
                    Swal.fire({
                        text: status,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.classStreamForm.submit_type=nextclass;
                            this.classStreamForm.proposedName=this.form.proposedName;
                            this.classStreamForm.post('organization/saveClassStream')
                            .then((response) => {
                                if(response=="No Screen"){
                                    Toast.fire({  
                                        icon: 'error',
                                        title: 'Technical Errors: please contact system administrator for further details'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let res=' <br><b>Thank You !</b>';
                                    this.$router.push({name:'acknowledgement_private_school',params: {data:message+res }});
                                    Toast.fire({  
                                        icon: 'success',
                                        title: 'Application for new establishment has been udpated for further action'
                                    });
                                } 
                            })
                            .catch((err) => {
                                console.log("Error:"+err)
                            })
                        }
                    });
                }
            }
            else{
                if(nextclass=="file-tab"){
                    this.form.post('organization/saveEstablishment',this.form)
                    .then((response) => {
                        if(response.data!=""){
                            this.loadpendingdetails('Private_School');
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                       this.applyselect2();
                        this.change_tab('organization-tab');
                        console.log("Error:"+error)
                    })
                }
                else if(nextclass=="class-tab"){
                    const config = {
                        headers: {
                            'content-type': 'multipart/form-data'
                        }
                    }
                    let formData = new FormData();
                    formData.append('id', this.file_form.id);
                    formData.append('ref_docs[]', this.file_form.ref_docs);
                    for(let i=0;i<this.file_form.ref_docs.length;i++){
                        formData.append('attachments[]', this.file_form.ref_docs[i].attach);
                        formData.append('attachmentname[]', this.file_form.ref_docs[i].name);
                    }
                    formData.append('application_number', this.file_form.application_number);
                    axios.post('organization/saveUploadedFiles', formData, config)
                    .then((response) => {
                        if(response.data!=""){
                            this.change_tab(nextclass);
                        }
                    })
                    .catch((error) => {
                       this.applyselect2();
                        this.change_tab('organization-tab');
                        console.log("Error:"+error)
                    })
                }else{
                    this.change_tab(nextclass);
                }
            }
        },
        loadApplicaitonDetials(){
            axios.get('organization/loadEstablishmentApplciaiton/'+this.record_id)
            .then(response => {
                let data = response.data.data;
                this.form.id        =data.id;
                this.form.application_number=data.application_no;
                this.classStreamForm.application_number=data.application_no;
                this.file_form.application_number=data.application_no;
                this.form.proprietorCid=data.estb_details.proprietorCid;
                this.form.proprietorEmail=data.estb_details.proprietorEmail;
                this.form.proprietorMobile=data.estb_details.proprietorMobile;
                this.form.proprietorName=data.estb_details.proprietorName;
                this.form.proprietorPhone   =data.estb_details.proprietorPhone;
                this.form.proposedLocation   =data.estb_details.proposedLocation;
                this.form.typeOfSchool   =data.estb_details.typeOfSchool;

                this.form.proposedName  =data.estb_details.proposedName;
                this.form.level=data.estb_details.levelId;
                $('#level').val(data.estb_details.levelId).trigger('change');
                
                this.getClassStream(this.levelArray[data.estb_details.levelId]);

                this.form.gewog  =data.gewogId;
                $('#gewog').val(data.gewogId).trigger('change');

                if(data.status=="Notified For Team Verification"){
                    this.getAttachmentType('');//Attachment name here
                    $('#class_edit').hide();
                    $('#rejectbtn').hide();
                    this.class_section=data.estb_classStream;
                    $('#afer_verification').show();
                    this.classStreamForm.update_type="Document Update";
                }
                else{
                    this.getAttachmentType('ForTransaction__Private_School');
                    $('#class_edit').show();
                    $('#afer_verification').hide();
                }

                this.getvillagelist(data.gewogId,data.chiwogId);
                this.form.chiwog=data.chiwogId;
                this.attachment_details=data.estb_attachments;
                this.form.dzongkhag=data.dzongkhagId;
                this.getgewoglistunderdzo(data.dzongkhagId,data.gewogId);
                
            })    
            .catch(errors => { 
                console.log('error in retrieving: '+errors)
            });
        },
       loadpendingdetails(type){
            axios.get('organization/loaddraftApplication/'+type)
              .then(response => {
                let draft = response.data.data;
                if(draft!=null){
                    
                }
            });
        },
        applyselect2(){
            if(!$('#level').attr('class').includes('select2-hidden-accessible')){
                $('#level').addClass('select2-hidden-accessible');
            }
            // if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
            //     $('#dzongkhag').addClass('select2-hidden-accessible');
            // }
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#chiwog').attr('class').includes('select2-hidden-accessible')){
                $('#chiwog').addClass('select2-hidden-accessible');
            }
        },

        /**
         * method to change tabs
         */
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
            this.applyselect2();
        },

        loadProprietorDetails(){
            axios.get('organization/loadProprietorDetails')
            .then((response) => {  

                let data=response.data.data[0];
                this.form.cid           =   data.cid;
                this.form.name          =   data.fullName;
                this.form.phoneNo       =   data.phoneNo;
                this.form.email         =   data.email;
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },
        getDetailsbyCID(fieldId){
            axios.get('getpersonbycid/'+ $('#'+fieldId).val())
            .then(response => {
                if (JSON.stringify(response.data)!='{}'){
                    let personal_detail = response.data.citizenDetail[0];
                    this.form.proprietorName = personal_detail.firstName + " " + personal_detail.lastName;
                }else{
                    Swal.fire({
                        html: "No data found for this CID",
                        icon: 'error'
                    });
                }
            })
            .catch((exception) => {
                console.log(exception);
            });
        },
        
        getScreenAccess(){
            axios.get('common/getScreenAccess/workflow__establishment__private_school')
            .then(response => {
                let data = response.data[0].total_count;
                if(data<1){
                    $('#screenPermission').show();
                    $('#mainform').hide();
                    $('#message').html('This page is not accessible to you. Please contact system administrator for further assistant<br> Thank you');
                }
            })    
            .catch(errors => { 
                console.log(errors)
            });
        },
        getAttachmentType(type){
            axios.get('masters/organizationMasterController/loadOrganizaitonmasters/'+type+'/DocumentType')
            .then(response => {
                let data = response.data;
                data.forEach((item => {
                    this.count++;
                    this.file_form.fileUpload.push({file_name:item.name, file_upload:''})
                }));
            })    
            .catch(errors => { 
                console.log(errors)
            });   
        }
    },
    mounted() {
        this.getScreenAccess();
        this.getClass();
        this.getStream();
        this.getLevel();
        this.getLocation();
        this.getOrgList();
        
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.dzongkhag=data['Dzo_Id'];
            this.form.dzongkhag=data['Dzo_Id'];
            this.getGewogList(data['Dzo_Id']);
        })    
        .catch(errors => { 
            console.log(errors)
        });
        
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'),$(this).find('option:selected').text()); 
        });
        
        Fire.$on('changefunction',(id,text)=> {
            this.changefunction(id,text);
        });
       this.loadpendingdetails('Private_School');

        this.record_id=this.$route.params.id;
        this.loadApplicaitonDetials();
    }, 
}
</script>
