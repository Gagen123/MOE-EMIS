<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="ApplicationUnderProcess">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-sm-3 col-form-label pl-5">Select School:<span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                    <select name="organizationId" id="organizationId" v-model="form.organizationId" :class="{ 'is-invalid': form.errors.has('organizationId') }" class="form-control select2" @change="getCategory(),remove_error('organizationId')">
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="organizationId"></has-error>
                    </div>
                </div>
            </div>
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

                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">SEN School:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold">{{data.isSenSchool == 1 ? "Yes" :  "No"}}</span>
                                    </div>
                                </div>
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
                                        <span class="text-blue text-bold" id="chewogName"> </span>
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
                            <h3 class="card-title">Reasons/Remarks for Closure</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="mb-0">Reason:<span class="text-danger">*</span></label>
                                        <textarea class="form-control" v-model="form.reason" :class="{ 'is-invalid': form.errors.has('reason') }" @change="remove_error('reason')"></textarea>
                                        <has-error :form="form" field="reason"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Remarks:</label>
                                        <textarea class="form-control" v-model="form.remark"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Proposal Letter</label>
                                        <input type="file" class="form-control" v-on:change="onChangeFileUpload">
                                    </div>
                                </div>
                            </form>
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
            gewogArray:{},
            villageArray:{},
            classList:[],
            streamList:[],
            classArray:[],
            streamArray:[],
            sectionArray:[],
            classStreamList:[],

            form: new form({
                organizationId:'',
                reason:'',
                remark:'',
                attachments:'',
                application_type:'Closure',
                application_for:'Closure',
                screen_id:'',
                status:'Submitted'

            }),
        }
    },
    methods: {
        //File Upload
        onChangeFileUpload(e){
            this.form.attachments = e.target.files[0];
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
        async getgewoglist(id,gewogId){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
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
         * method to get village list
         */
        async getvillagelist(id,villageId){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList = data.data.data;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name;
                }
                $('#chewogName').html(this.villageArray[villageId]);
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
            if(id=="organizationId"){
                this.form.organizationId=$('#organizationId').val();
                this.getOrgDetails($('#organizationId').val());
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
                        formData.append('organizationId', this.form.organizationId);
                        formData.append('reason', this.form.reason);
                        formData.append('remark', this.form.remark);
                        formData.append('application_for', this.form.application_for);
                        formData.append('screen_id', this.form.screen_id);
                        formData.append('attachments', this.form.attachments);
                        axios.post('organization/saveClosure',formData, config)
                        .then((response) => {
                            if(response.data!=""){
                                let message="Application for Closure has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'closure_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Closure details has been submitted for further action.'
                                });
                            }
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured:'+error
                            });
                        })

                        // this.form.post('organization/saveClosure')
                    //     .then((response) => {
                    //         if(response!=""){
                    //             let message="Application for Closure has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.application_no+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                    //             this.$router.push({name:'closure_acknowledgement',params: {data:message}});
                    //             Toast.fire({
                    //                 icon: 'success',
                    //                 title: 'Closure details has been submitted for further action.'
                    //             });
                    //         }

                    //     })
                    //     .catch((er) => {
                    //         console.log("Error:"+er)
                    //  })
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
            // axios.get('organization/getFullSchoolDetials/'+id)
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+id)
            .then((response) => {
                let data=response.data.data;
                this.form.organizationId=data.id;
                this.getgewoglist(data.dzongkhagId,data.gewogId);
                alert(data.chiwogId);
                this.getvillagelist(data.gewogId,data.chiwogId);
                this.data=data;
            })
            .catch((error) =>{
                console.log("Error:"+error);
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

        this.getClass();
        this.getStream();
        this.loadactivedzongkhagList();
        this.loadactivedzongkhagList1();
        // this.checkPendingApplication();
    }
}
</script>
