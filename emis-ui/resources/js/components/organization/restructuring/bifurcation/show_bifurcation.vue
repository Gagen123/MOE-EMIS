<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="ApplicationUnderProcess">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Present School Details</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Name:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="name">{{data.name}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Code:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{data.code}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Level:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{levelArray[data.levelId]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Category:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{ data.category == 'public_school' ? "Public School" :  "Private & Other"}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Geo-Politically Located:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                         <span class="text-blue text-bold"> {{ data.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                </div>

                                <!-- <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">SEN School:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{data.isSenSchool == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                </div> -->
                                <label class="mb-0"><i><u>Other Details</u></i></label>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Dzongkhag:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{dzongkhagArray[data.dzongkhagId]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Gewog:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="gewogName"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Chiwog:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="chewogName" > </span>
                                    </div>
                                </div>
                                <label class="mb-0"><i><u>Class & Stream Details</u></i></label>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                        <span v-for="(item, index) in  data.classes" :key="index">
                                            <br>
                                            <input type="checkbox" checked="true" disabled><label class="pr-4"> &nbsp;{{ classArray[item.classId] }}</label>
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">School/ECR/ECCD 2</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Name:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="name">{{form.name1}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Level:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                            <span class="text-blue text-bold" id="name">{{levelArray[form.level1]}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Location Category:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="name">{{locationArray[form.location1]}}</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Geo-Politically Located:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                         <span class="text-blue text-bold"> {{ form.geoLocated1  == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                </div>

                                <label class="mb-0"><i><u>Other Details</u></i></label>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Dzongkhag:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{dzongkhagArray[form.dzongkhag1]}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Gewog:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="appgeowgName" > </span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Chiwog:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="appchewogName" > </span>
                                    </div>
                                </div>
                                <label class="mb-0"><i><u>Class & Stream Details</u></i></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                    <span v-for="(item, index) in  appclassStreamList" :key="index">
                                        <br>
                                        <input type="checkbox" checked="true" disabled><label class="pr-4"> &nbsp;{{ classArray[item.classId] }}</label>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Upload the Required Documents</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>File Name</th>
                                    <th>Upload File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for='(attach,count) in applicationdetailsatt' :key="count+1">
                                    <td>  {{attach.user_defined_file_name}} ({{attach.name}})</td>
                                    <td>
                                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row form-group fa-pull-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button class="btn btn-primary" @click="shownexttab('final-tab')"> <i class="fa fa-save"></i>Submit </button>
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
            data:'',
            orgList:'',
            levelList:[],
            levelArray:{},
            locationList:[],
            locationArray:{},
            locationList1:[],
            levelList1:[],
            dzongkhagList:[],
            dzongkhagArray:{},
            dzongkhagList1:[],
            gewog_list:[],
            villageList:[],
            gewog_list1:[],
            villageList1:[],
            classList:[],
            streamList:[],
            classArray:[],
            streamArray:[],
            sectionArray:[],
            classStreamList:[],
            gewogArray:{},
            villageArray:{},
            record_id:'',
            appclassStreamList:[],
            applicationdetailsatt:'',
            form: new form({
                id: '',appId:'', parent_id:'',name:'', application_for:'Bifurcation',application_type:'bifurcation',action_type:'edit', status:'Submitted',
                name1:'',level1:'',category1:'1',dzongkhag1:'',gewog1:'',chiwog1:'',location1:'',
                geoLocated1:'0',senSchool1:'0',coLocated1:'0',parentSchool1:'',class:[],stream:[],
                attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },
    methods: {
        openfile(file){
            let file_path=file.path+'/'+file.name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },

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
        /**
         * method to get location in dropdown
         */
        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList = data;
                for(let i=0;i<data.length;i++){
                    this.locationArray[data[i].id] = data[i].name;
                }
            });
        },

        /**
         * method to get other category if the category is 'ECCD'
         */
        getCategory(){
            let level = $('#level option:selected').text();
            if(level == "ECCD"){
                $(".eccd").show();
            }
            else{
                $(".eccd").hide();
            }
        },

        /**
         * method to get other category if the category is 'ECCD'
         */
        getCategory1(){
            let level = $('#level1 option:selected').text();
            $('.strm_clas').hide();
            // let level = text;
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
         * method to get level in dropdown
         */
        getLevel1(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList1 = data;
            });
        },
        /**
         * method to get location in dropdown
         */
        getLocation1(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList1 = data;
            });
        },

        /**
         * method to get active dzongkhag list
         */
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.dzongkhagList =  data;
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get active dzongkhag list
         */
        loadactivedzongkhagList1(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dzongkhagList1 =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get gewog list
         */
        getGewogList(id,gewogId){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.gewog_list = data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name;
                }
                $('#gewogName').html(this.gewogArray[gewogId]);
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        /**
         * method to get gewog1 list in dropdown
         */
        async getGewogList1(id,gewogId){
            let dzoId=$('#dzongkhag1').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list1 = data.data.data;
                this.form.gewog1=gewogId;
                $('#gewog1').val(gewogId).trigger('change');
                $('#appgewogName').html(this.gewogArray[gewogId]);
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        /**
         * method to get village list
         */
        async getvillagelist(id,vil_id){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.villageList = data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                $('#chewogName').html(this.villageArray[vil_id])
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        /**
         * method to get village1 list
         */
        async getvillagelist1(id,village){
            let gewogId=$('#gewog1').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList1 = data.data.data;
                this.form.chiwog1=village;
                $('#appgeowgName').html(this.villageArray[village])
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList = response.data;
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.classArray[data[i].id] = data[i].class;
                }
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                this.streamList = response.data;
            });
        },

        /**
         * method to get other category if the category is 'ECCD'
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
         * method to populate dropdown
         */
        async changefunction(id){
            if(id=="parent_id"){
                this.form.parent_id=$('#parent_id').val();
                this.getOrgDetails($('#parent_id').val());
            }
            if(id=="dzongkhag"){
                this.form.dzongkhag=$('#dzongkhag').val();
                this.getGewogList($('#dzongkhag').val(),'');
            }
            if(id=="dzongkhag1"){
                this.form.dzongkhag1=$('#dzongkhag1').val();
                this.getGewogList1($('#dzongkhag1').val(),'');
            }
            if(id=="gewog"){
                this.form.gewog=$('#gewog').val();
                this.getvillagelist();
            }
            if(id=="gewog1"){
                this.form.gewog1=$('#gewog1').val();
                this.getvillagelist1($('#gewog1').val(),'');
            }
            if(id=="chiwog"){
                this.form.chiwog=$('#chiwog').val();
            }
            if(id=="chiwog1"){
                this.form.chiwog1=$('#chiwog1').val();
            }
        },

        /**
         * method to show next and previous tab
         */
        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
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
                        formData.append('appId', this.form.appId);
                        formData.append('parent_id', this.form.parent_id);
                        formData.append('name', this.form.name);
                        formData.append('name1', this.form.name1);
                        formData.append('level1', this.form.level1);
                        formData.append('category1', this.form.category1);
                        formData.append('dzongkhag1', this.form.dzongkhag1);
                        formData.append('gewog1', this.form.gewog1);
                        formData.append('chiwog1', this.form.chiwog1);
                        formData.append('location1', this.form.location1);
                        formData.append('geoLocated1', this.form.geoLocated1);
                        formData.append('senSchool1', this.form.senSchool1);
                        formData.append('coLocated1', this.form.coLocated1);
                        formData.append('parentSchool1', this.form.parentSchool1);
                        for(let i=0;i<this.form.class.length;i++){
                            formData.append('class[]', this.form.class[i]);
                        }
                         for(let i=0;i<this.form.stream.length;i++){
                            formData.append('stream[]', this.form.stream[i]);
                        }

                        formData.append('application_for', this.form.application_for);
                        formData.append('action_type', this.form.action_type);
                        formData.append('status', this.form.status);
                        formData.append('application_type', this.form.application_type);
                        formData.append('ref_docs[]', this.form.ref_docs);

                        for(let i=0;i<this.form.ref_docs.length;i++){
                            formData.append('attachments[]', this.form.ref_docs[i].attach);
                            formData.append('attachmentname[]', this.form.ref_docs[i].name);
                        }
                        axios.post('organization/saveBifurcation', formData, config)
                        //this.form.post('organization/saveBifurcation')
                        .then((response) => {
                            if(response!=""){
                                let message="Application for Bifurcation has been updated and submitted for approval. <br><b>Thank You !</b>";
                                this.$router.push({name:'bifurcation_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Bifurcation details has been submitted for further action.'
                                });
                            }

                        })
                        .catch((er) => {
                            console.log("Error:"+er);
                            this.form.errors.errors = er.response.data.errors;
                        });
                    }
                });
            }
            else{
                this.change_tab(nextclass);
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
        },
        getOrgDetails(id){
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+id)
            .then((response) => {
                let data=response.data.data;
                this.form.parent_id=data.id;
                this.data=data;
                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId);
                this.form.name=data.name;
            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
        },
        loadApplicationDetials(){
            axios.get('organization/getChangeBasicDetails/'+this.record_id)
            .then(response => {
                let response_data=response.data.data;
                this.getOrgDetails(response_data.bifurcation_details.organizationId);
                this.form.id=response_data.bifurcation_details.id;
                this.form.appId=response_data.id;
                this.form.name1=response_data.bifurcation_details.proposedName;
                this.form.location1=response_data.bifurcation_details.locationId;
                this.form.geoLocated1=response_data.bifurcation_details.isGeoPoliticallyLocated;
                this.form.level1=response_data.bifurcation_details.levelId;
                this.getCategory1();
                this.form.dzongkhag1=response_data.dzongkhagId;
                $('#dzongkhag1').val(response_data.dzongkhagId).trigger('change');
                this.getGewogList1(response_data.dzongkhagId,response_data.gewogId);
                this.getvillagelist1(response_data.gewogId,response_data.chiwogId);
                this.appclassStreamList=response_data.change_class_details;

                //  id: '',parent_id:'',:'', application_for:'Bifurcation',application_type:'bifurcation',action_type:'edit',
                //   status:'Submitted',
                // :'',:'',category1:'1',dzongkhag1:'',gewog1:'',chiwog1:'',:'',
                // :'0',senSchool1:'0',coLocated1:'0',parentSchool1:'',class:[],stream:[],
                this.applicationdetailsatt=response_data.attachments;
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
         * method to check pending status
         */
        /** commented after discussing with phuntsho sir. Need to verify with MOE. */

        // checkPendingApplication(){
        //     axios.get('organization/checkPendingApplication/bifurcation')
        //     .then((response) => {
        //         let data=response.data;
        //         if(data!=""){
        //             $('#mainform').hide();
        //             $('#ApplicationUnderProcess').show();
        //             $('#existmessage').html('You have already submitted application for basic details change <b>('+data.application_number+')</b> which is under process.');
        //         }
        //     })
        //     .catch((error) => {
        //         console.log("Error: "+error);
        //     });
        // },
        getAttachmentType(type){
            this.form.attachments=[];
            axios.get('masters/organizationMasterController/loadOrganizaitonmasters/'+type+'/DocumentType')
            .then(response => {
                let data = response.data;
                data.forEach((item => {
                    this.form.attachments.push({file_name:item.name, file_upload:''});
                }));
            })
            .catch(errors => {
                console.log(errors)
            });
        },

    },
    created(){
        this.getLevel();
        this.getLocation();
        this.getLevel1();
        this.getLocation1();
        this.getOrgList();
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.getOrgDetails(data['Agency_Code']);
            }
        })
        .catch(errors => {
            console.log(errors)
        });
        this.getOrgList();
    },

    mounted(){
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
        this.getAttachmentType('ForTransaction__Application_for_Bifurcation');
        this.getClass();
        this.getStream();
        this.loadactivedzongkhagList();
        this.loadactivedzongkhagList1();
        this.record_id=this.$route.params.data.application_no;
        this.loadApplicationDetials();
    }
}
</script>
