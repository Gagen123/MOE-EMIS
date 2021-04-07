<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">School Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item class-tab" @click="shownexttab('class-tab')">
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
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>1st School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="organization1" id="organization1" v-model="form.orgId1" class="form-control" @change="getSchoolDetails()">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">YHSS</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>2nd School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="organization2" id="organization2" v-model="form.orgId2" class="form-control" @change="getSchool2Details()">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">MHSS</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Year of Merger:</label>
                                <input type="text" class="form-control" id="yearOfMerger" v-model="form.year"/>
                            </div>                                                                                          
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school1" style="display:none">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">School/ECR/ECCD 1</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Code:</label>
                                                <span class="text-indigo-600" id="mergerCode1">00020292</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Name:</label>
                                                <span class="text-indigo-600" id="mergerName1">YangchenPhug HSS</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Category:</label>
                                                <span class="text-indigo-600" id="megerCategory1">Public</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Level:</label>
                                                <span class="text-indigo-600" id="mergerLevel1">Higher Secondary School</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag:</label>
                                                <span class="text-indigo-600" id="mergerDzongkhag1">Thimphu</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Gewog:</label>
                                                <span class="text-indigo-600" id="mergerGewog1">Thimthrom</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Chiwog:</label>
                                                <span class="text-indigo-600" id="mergerChiwog1">Yangchenphug</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Location Type:</label>
                                                <span class="text-indigo-600" id="mergerLocationtype1">Urban grade 1</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Geopolitically Located:</label>
                                                <span class="text-indigo-600" id="mergerGeoLocated1">No</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>SEN School:</label>
                                                <span class="text-indigo-600" id="mergerSen1">No</span>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Co-located with Parent School:</label>
                                                <span class="text-indigo-600" id="ccolocated"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Parent School:</label>
                                                <span class="text-indigo-600" id="cparent"></span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" style="display:none">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">School/ECR/ECCD 2</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Code:</label>
                                                <span class="text-indigo-600" id="mergerCode2">00020299</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Name:</label>
                                                <span class="text-indigo-600" id="mergerName2">Motithang HSS</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Level:</label>
                                                <span class="text-indigo-600" id="mergerCategory2">Higher Secondary School</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Category:</label>
                                                <span class="text-indigo-600" id="mergerLevel2">Public</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag:</label>
                                                <span class="text-indigo-600" id="mergerDzongkhag2">Thimthrom</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Gewog:</label>
                                                <span class="text-indigo-600" id="mergerGewog2">Thimthrom</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Chiwog:</label>
                                                <span class="text-indigo-600" id="mergerChiwog2">Mothithang</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Location Type:</label>
                                                <span class="text-indigo-600" id="mergerLocationType2">Urban grade 1</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Geopolitically Located:</label>
                                                <span class="text-indigo-600" id="mergerGeoLocated2">No</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>SEN School:</label>
                                                <span class="text-indigo-600" id="mergerSen2">No</span>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Co-located with Parent School:</label>
                                                <span class="text-indigo-600" id="ccolocated"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Parent School:</label>
                                                <span class="text-indigo-600" id="cparent"></span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" @click="shownexttab('class-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" v-model="form.name"/>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Level:<span class="text-danger">*</span></label>
                                <select name="level" id="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" class="form-control editable_fields" @change="getClassAndStream('level'),remove_err('level')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="level"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Category:<span class="text-danger">*</span></label>
                                <br> 
                                <label><input  type="radio" v-model="form.category" @change="showprivatedetails('public')" value="1" tabindex=""/> Public</label>
                                <label><input  type="radio" v-model="form.category" @change="showprivatedetails('private')" value="0"  tabindex=""/> Private</label>
                                <span id="othercategoryforeccd"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Dzongkhag:<span class="text-danger">*</span></label>
                                <select v-model="form.dzongkhag" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="dzongkhag"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Gewog:<span class="text-danger">*</span></label>
                                <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="gewog"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Chiwog:<span class="text-danger">*</span></label>
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
                                <select name="locationCategory" v-model="form.location" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationCategory" class="form-control editable_fields" @change="remove_err('locationCategory')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="proposedName"></has-error>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Geopolitically Located:</label>
                                <br> 
                                <label><input  type="radio" v-model="form.geoLocated" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" v-model="form.geoLocated" value="0"  tabindex=""/> No</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>SEN School:<span class="text-danger">*</span></label>
                                <br>
                                <label><input  type="radio" v-model="form.senSchool" value="1" tabindex=""/> Yes</label>
                                <label><input  type="radio" v-model="form.senSchool" value="0"  tabindex=""/> No</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Parent School:</label>
                                <select name="category" id="parentSchool" class="form-control" v-model="form.parentSchool">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">Kabisa</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Co-located with Parent School:</label>
                                <br> 
                                <label><input type="radio" v-model="form.coLocated"  value="1" tabindex=""/> Yes</label>
                                <label><input type="radio" v-model="form.coLocated"  value="0"  tabindex=""/> No</label>
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
                                    <input type="text" v-model="form.fullName" class="form-control" id="fullName"/>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Phone No:<span class="text-danger">*</span></label>
                                    <input type="nubmer" v-model="form.phoneNo" class="form-control" id="cid"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Email:<span class="text-danger">*</span></label>
                                    <input type="email" v-model="form.email" class="form-control" id="fullname"/>
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
            levelList:[],
            locationList:[],
            classList:[],
            streamList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            form: new form({
                id: '',orgId1:'',orgId2:'',year:'',name:'',level:'',category:'1',dzongkhag:'',gewog:'',
                chiwog:'',location:'',geoLocated:'0',senSchool:'0',parentSchool:'',coLocated:'0',
                cid:'',fullName:'',phoneNo:'',email:'',class:[], stream:[]
            }),
        } 
    },
    methods: {
        /**
         * method to get school 1 details
         */
        getSchoolDetails: function(){
            $('#school1').show();
        },

        /**
         * method to get school 2 details
         */
        getSchool2Details: function(){
            $('#school2').show();
        },

        /**
         * method to show private details
         */
        showprivatedetails(type){
            if(type=='private'){
                $('#privatedetails').show();
            }
            else{
                $('#privatedetails').hide();
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
            axios.get('/organization/getClass')
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

        /**
         * method to populate dropdown
         */
        async changefunction(id){
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
                        this.form.post('organization/saveMerger')
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Establishment is saved successfully'
                            })
                    })
                        .catch(() => {
                            console.log("Error......")
                     })
                    }
                });
            }
            else{
                
                this.change_tab(nextclass);
            }
        },
        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
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

        this.getLevel();
        this.getLocation();
        this.getClass();
        this.getStream();
        this.loadactivedzongkhagList();

    },
}
</script>
