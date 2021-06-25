<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab">
                            <label class="mb-0.5">School Details </label>
                        </a>
                    </li>
                    <li class="nav-item merger-tab" @click="shownexttab('merger-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Merge the schools </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Year of Merger:</label>
                                <span class="text-blue text-bold">{{form.year}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>1st School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="orgId1" id="orgId1" v-model="form.orgId1" :class="{ 'is-invalid': form.errors.has('orgId1') }" class="form-control select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>2nd School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="orgId2" id="orgId2" v-model="form.orgId2" :class="{ 'is-invalid': form.errors.has('orgId2') }" class="form-control select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <h3 class="card-title">School/ECR/ECCD 1</h3>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Code:</label>
                                                <span class="text-blue text-bold" id="mergerCode1">{{org1_details.code}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Name:</label>
                                                <span class="text-blue text-bold" id="mergerName1">{{org1_details.name}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Category:</label>
                                                <span class="text-blue text-bold" id="megerCategory1">{{org1_details.category  == 1 ? "public" :  "private"}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Level:</label>
                                                <span class="text-blue text-bold" id="mergerLevel1">{{org1_details.level}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag:</label>
                                                <span class="text-blue text-bold" id="mergerDzongkhag1">{{org1_details.dzongkhag}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Gewog:</label>
                                                <span class="text-blue text-bold" id="mergerGewog1">{{org1_details.gewog}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Chiwog:</label>
                                                <span class="text-blue text-bold" id="mergerChiwog1">{{org1_details.village}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Location Type:</label>
                                                <span class="text-blue text-bold" id="mergerLocationtype1">{{org1_details.locationType}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Geopolitically Located:</label>
                                                <span class="text-blue text-bold" id="mergerGeoLocated1">{{org1_details.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>SEN School:</label>
                                                <span class="text-blue text-bold" id="mergerSen1">{{org1_details.isSenSchool  == 1 ? "Yes" :  "No"}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-body">
                                        <h3 class="card-title">School/ECR/ECCD 2</h3>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Code:</label>
                                                <span class="text-blue text-bold" id="mergerCode1">{{org2_details.code}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Name:</label>
                                                <span class="text-blue text-bold" id="mergerName1">{{org2_details.name}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Category:</label>
                                                <span class="text-blue text-bold" id="megerCategory1">{{org2_details.category  == 1 ? "public" :  "private"}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Level:</label>
                                                <span class="text-blue text-bold" id="mergerLevel1">{{org2_details.level}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag:</label>
                                                <span class="text-blue text-bold" id="mergerDzongkhag1">{{org2_details.dzongkhag}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Gewog:</label>
                                                <span class="text-blue text-bold" id="mergerGewog1">{{org2_details.gewog}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Chiwog:</label>
                                                <span class="text-blue text-bold" id="mergerChiwog1">{{org2_details.village}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Location Type:</label>
                                                <span class="text-blue text-bold" id="mergerLocationtype1">{{org2_details.locationType}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Geopolitically Located:</label>
                                                <span class="text-blue text-bold" id="mergerGeoLocated1">{{org2_details.isGeopoliticallyLocated  == 1 ? "Yes" :  "No"}}</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>SEN School:</label>
                                                <span class="text-blue text-bold" id="mergerSen1">{{org2_details.isSenSchool  == 1 ? "Yes" :  "No"}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('merger-tab')"> Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="merger-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Proposed Name:<span class="text-danger">*</span></label>
                                <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" />
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Level:<span class="text-danger">*</span></label>
                                <select name="level" id="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" class="form-control select2" @change="getClassAndStream('level'),remove_error('level')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="level"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Category:<span class="text-danger">*</span></label>
                                <br>
                                <label><input  type="radio" v-model="form.category" @change="showprivatedetails('public')" value="1" tabindex=""/> Public</label>
                                <label><input  type="radio" v-model="form.category" @change="showprivatedetails('private')" value="0"  tabindex=""/> Private</label>
                                <label style="display:none" class="eccd"><input type="radio" name="category" v-model="form.category" @change="showprivatedetails('ngo')" value="2" tabindex=""/> Ngo</label>
                                <label style="display:none" class="eccd"><input type="radio" name="category" v-model="form.category" @change="showprivatedetails('coporate')" value="3"  tabindex=""/> Coporate</label>
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Dzongkhag:<span class="text-danger">*</span></label>
                                <select v-model="form.dzongkhag" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="dzongkhag"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Gewog:<span class="text-danger">*</span></label>
                                <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="gewog"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Chiwog:<span class="text-danger">*</span></label>
                                <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="chiwog"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Location Type:<span class="text-danger">*</span></label>
                                <select name="locationType" v-model="form.locationType" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationType" class="form-control select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="locationType"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Geopolitically Located:</label>
                                <br>
                                <label><input  type="radio" v-model="form.geopolicaticallyLocated" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" v-model="form.geopolicaticallyLocated" value="0" tabindex=""/> No</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Sen School:<span class="text-danger">*</span></label>
                                <br>
                                <label><input  type="radio" @change="show_parent_school_details(true)" v-model="form.senSchool" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" @change="show_parent_school_details(false)" v-model="form.senSchool" value="0" tabindex=""/> No</label>
                            </div>
                        </div>
                        <div class="form-group row" id="parentDetails" style="display:none">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="parentSchoolDiv">
                                <label class="mb-0">Parent School:</label>
                                <select name="parentSchool" v-model="form.parentSchool" id="parentSchool" class="form-control  select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="coLocatedDiv">
                                <label class="mb-0">Co-located with Parent School:</label>
                                <br>
                                <label><input  type="radio" v-model="form.coLocatedParent" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" v-model="form.coLocatedParent" value="0" tabindex=""/> No</label>
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
                                    <input type="nubmer" v-model="form.cid" class="form-control" id="cid"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Full Name:<span class="text-danger">*</span></label>
                                    <input type="text" v-model="form.name" class="form-control" id="fullname"/>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Phone No:<span class="text-danger">*</span></label>
                                    <input type="nubmer" v-model="form.phoneNo" class="form-control" id="cid"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Email:<span class="text-danger">*</span></label>
                                    <input type="email" v-model="form.email" class="form-control" id="email"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select classes and streams</label>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <span v-for="(item, key, index) in  classList" :key="index">
                                <br>
                                <input type="checkbox" v-model="form.class" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                <span v-for="(stm, key, index) in streamList" :key="index" >
                                    <span v-if="item.class=='XI' || item.class=='XII'">
                                        <br>
                                        <input type="checkbox" v-model="form.stream"  :id="stm.id" :value="item.id+'##'+stm.id"> <label class="pr-3"> {{ stm.stream  }}</label>
                                    </span>
                                </span>
                            </span>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
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
            orgList:[],
            org1_details:'',
            org2_details:'',
            next_tab:false,
            form: new form({
                id: '',
                orgId1:'',
                orgId2:'',
                year:'',
                proposedName:'',
                level:'',
                category:'1',
                dzongkhag:'',
                gewog:'',
                chiwog:'',
                locationType:'',
                geoLocated:'0',
                senSchool:'0',
                parentSchool:'',
                coLocated:'0',
                cid:'',
                name:'',
                phoneNo:'',
                email:'',
                class:[],
                stream:[]
            }),
            levelList:[],
            locationList:[],
            classList:[],
            streamList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
        }
    },
    methods: {
        /**
         * method to get current school unbder current user
         */
        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
            });
        },
        getOrgDetails(id,fieldId){
            let getdet=true;
            if(fieldId=="orgId2" && id==this.form.orgId1){
                Swal.fire({
                    text: "You cannot select same school",
                    icon: 'error',
                    confirmButtonText: 'Ok!',
                });
                this.form.orgId2="";
                this.next_tab=false;
                this.org2_details='';
                getdet=false;
            }
            if(fieldId=="orgId1" && id==this.form.orgId2){
                Swal.fire({
                    text: "Sorry! You cannot select same school",
                    icon: 'error',
                    confirmButtonText: 'OK!',
                });
                getdet=false;
                this.next_tab=false;
                this.org1_details='';
                this.form.orgId1="";
            }
            if(getdet){
                this.next_tab=true;
                let uri = '/organization/loadCurrentOrgDetails/'+id;
                axios.get(uri)
                .then(response =>{
                    if(fieldId=="orgId1"){
                        this.org1_details=response.data.data;
                        this.org1_details.village=response.data.data.village.data.name;
                        this.org1_details.gewog=response.data.data.gewog.data.name;
                        this.org1_details.dzongkhag=response.data.data.dzongkhag.data.name;
                    }
                    if(fieldId=="orgId2"){
                        this.org2_details=response.data.data;
                        this.org2_details.village=response.data.data.village.data.name;
                        this.org2_details.gewog=response.data.data.gewog.data.name;
                        this.org2_details.dzongkhag=response.data.data.dzongkhag.data.name;
                    }
                });
            }
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

        showprivatedetails(type){
            if(type=='private'){
                $('#privatedetails').show();
            }
            else{
                $('#privatedetails').hide();
            }
        },
        show_parent_school_details(param){
            if(param){
                $('#parentDetails').show();
            }
            else{
                $('#parentDetails').hide();
            }
        } ,
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

        /**
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
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
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/loadCommons/getClassByType/school')
              .then(response => {
                this.classList = response.data;
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
         * method to get active dzongkhag list
         */
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dzongkhagList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        /**
         * method to get gewog list
         */
        async getgewoglist(id){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        /**
         * method to get gewog list
         */
        async getvillagelist(id){
            let gewogId=$('#gewog').val();
            if(id!="" && gewogId==null){
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

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="orgId1"){
                this.form.orgId1 = $('#orgId1').val();
                this.getOrgDetails(this.form.orgId1,''+id);
            }
            if(id=="orgId2"){
                this.form.orgId2 = $('#orgId2').val();
                this.getOrgDetails(this.form.orgId2,''+id);
            }
            if(id=="level"){
                this.form.level=$('#level').val();
                this.getCategory();
            }
            if(id=="dzongkhag"){
                this.form.dzongkhag = $('#dzongkhag').val();
                this.getgewoglist();
            }
            if(id=="gewog"){
                this.form.gewog = $('#gewog').val();
                this.getvillagelist();
            }
            if(id=="chiwog"){
                this.form.chiwog=$('#chiwog').val();
            }
            if(id=="locationType"){
                this.form.locationType=$('#locationType').val();
            }
            if(id=="parentSchool"){
                this.form.parentSchool=$('#parentSchool').val();
            }

        },

        /**
         * method to show next and previous tab
         */
        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to submit this details for approval ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('organization/saveMerger')
                        .then((response) => {
                            if(response!=""){
                                let message="Application for Merger has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.applicationNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'restr_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Merger details has been submitted for further action.'
                                });
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err);
                            this.applyselect2();
                        })
                    }
                });
            }
            else{
                if(this.form.orgId2!="" && this.form.orgId1!=""){
                    this.change_tab(nextclass);
                }
                else{
                    Swal.fire({
                        text: "Form is not completely filled up. Please complete them all",
                        icon: 'error',
                        confirmButtonText: 'OK!',
                    });
                }
            }
        },
        change_tab(nextclass){
            if(this.next_tab){
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
            }
            else{
                Swal.fire({
                    text: "Form is not completely filled up. Please complete them all",
                    icon: 'error',
                    confirmButtonText: 'OK!',
                });
            }
        },
        applyselect2(){
            if(!$('#level').attr('class').includes('select2-hidden-accessible')){
                $('#level').addClass('select2-hidden-accessible');
            }
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#chiwog').attr('class').includes('select2-hidden-accessible')){
                $('#chiwog').addClass('select2-hidden-accessible');
            }
            if(!$('#locationType').attr('class').includes('select2-hidden-accessible')){
                $('#locationType').addClass('select2-hidden-accessible');
            }
            if(!$('#parentSchool').attr('class').includes('select2-hidden-accessible')){
                $('#parentSchool').addClass('select2-hidden-accessible');
            }
        },

        // getScreenAccess(){
        //     axios.get('common/getSessionDetail')
        //     .then(response => {
        //         let data = response.data.data.acess_level;
        //         if(data == "Org" || data == "Ministry"){
        //             $('#mainform').hide();
        //             $('#ApplicationUnderProcess').show();
        //             $('#existmessage').html('You have no access to this page.');
        //         }

        //     })
        //     .catch(errors => {
        //         console.log(errors)
        //     });
        // }

        /**
         * method to check pending status
         */
        // checkPendingApplication(){
        //     axios.get('organization/checkPendingApplication/merger')
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

    mounted() {
        let currentdate = new Date();
        let current_year =(currentdate.getFullYear());
        this.form.year=current_year;
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
        this.getOrgList();

        this.getLevel();
        this.getLocation();
        this.getClass();
        this.getStream();
        this.loadactivedzongkhagList();
        // this.checkPendingApplication();

    },
}
</script>
