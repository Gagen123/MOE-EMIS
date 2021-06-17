<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="ApplicationUnderProcess">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <div class="form-group row">
                    <label class="col-lg-3 col-md-3 col-sm-3 col-form-label">Select School:<span class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                    <select name="parent_id" id="parent_id" v-model="form.parent_id" :class="{ 'is-invalid': form.errors.has('parent_id') }" class="form-control select2" @change="getCategory(),remove_error('parent_id')">
                        <option value="">--- Please Select ---</option>
                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="parent_id"></has-error>
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
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Proposed Name:<small><i>(Blank to keep same name)</i></small></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" class="form-control currentDetails" id="name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" @change="remove_error('name')"/>
                                        <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
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
                                        <span class="text-blue text-bold">{{data.gewog}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Chiwog:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <span class="text-blue text-bold" id="name"> </span>
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
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" class="form-control currentDetails" id="name1" v-model="form.name1" :class="{ 'is-invalid': form.errors.has('name1') }" @change="remove_error('name1')"/>
                                        <has-error :form="form" field="name1"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Level:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <select name="level1" id="level1" v-model="form.level1" :class="{ 'is-invalid': form.errors.has('level1') }" class="form-control editable_fields" @change="getCategory1(),remove_error('level1')">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in levelList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="level1"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Category:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <label><input type="radio" v-model="form.category1" value="1" tabindex="" @change="showprivatedetails('private')"/> Public</label>
                                        <label><input type="radio" v-model="form.category1"  value="0"  tabindex="" @change="showprivatedetails('public')"/> Private</label>
                                        <label style="display:none" class="eccd1"><input type="radio" name="category" v-model="form.category" @change="showprivatedetails('ngo')" value="2" tabindex=""/> Ngo</label>
                                        <label style="display:none" class="eccd1"><input type="radio" name="category" v-model="form.category" @change="showprivatedetails('coporate')" value="3"  tabindex=""/> Coporate</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Location Category:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <select name="locationCategory" v-model="form.location1" :class="{ 'is-invalid': form.errors.has('locationType') }" id="location1" class="form-control editable_fields" @change="remove_error('location1')">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in locationList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="location1"></has-error>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Geo-Politically Located:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <label><input  type="radio" v-model="form.geoLocated1" value="1" tabindex=""/> Yes</label>
                                        <label><input  type="radio" v-model="form.geoLocated1" value="0"  tabindex=""/> No</label>
                                    </div>
                                </div>

                                <!-- <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">SEN School:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <label><input  type="radio" v-model="form.senSchool1" value="1" tabindex=""/> Yes</label>
                                        <label><input  type="radio" v-model="form.senSchool1" value="0"  tabindex=""/> No</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Co-Located with Parent School:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <label><input  type="radio" v-model="form.coLocated1" value="1" tabindex=""/> Yes</label>
                                        <label><input  type="radio" v-model="form.coLocated1" value="0"  tabindex=""/> No</label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Parent School:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <select name="category" v-model="form.parentSchool1" id="" class="form-control currentDetails">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                    </div>
                                </div> -->
                                <label class="mb-0"><i><u>Other Details</u></i></label>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Dzongkhag:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <select v-model="form.dzongkhag1" :class="{ 'is-invalid': form.errors.has('dzongkhag1') }" class="form-control select2" name="dzongkhag1" id="dzongkhag1">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in dzongkhagList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="dzongkhag1"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Gewog:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <select v-model="form.gewog1" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog1') }" class="form-control select2" name="gewog1" id="gewog1">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in gewog_list1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="gewog1"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-md-4 col-sm-4 col-form-label">Chiwog:<span class="text-danger">*</span></label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 pt-2">
                                        <select v-model="form.chiwog1" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog1') }" class="form-control select2" name="chiwog1" id="chiwog1">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in villageList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="chiwog1"></has-error>
                                    </div>
                                </div>
                                <label class="mb-0"><i><u>Class & Stream Details</u></i></label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                    <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Classes</th>
                                                <th class="strm_clas">Stream</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                    <input type="checkbox" v-model="form.stream"  :id="item.id" :value="item.id">
                                                </td>
                                                <td v-else>
                                                    <input type="checkbox" v-model="form.class" :value="item.classId">

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
            gewog_list1:[],
            villageList1:[],
            classList:[],
            streamList:[],
            classArray:[],
            streamArray:[],
            sectionArray:[],
            classStreamList:[],

            form: new form({
                id: '',parent_id:'',name:'',
                name1:'',level1:'',category1:'1',dzongkhag1:'',gewog1:'',chiwog1:'',location1:'',
                geoLocated1:'0',senSchool1:'0',coLocated1:'0',parentSchool1:'',class:[],stream:[]

            }),
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
         * method to get gewog1 list in dropdown
         */
        async getgewoglist1(id){
            let dzoId=$('#dzongkhag1').val();
            if(id!="" && dzoId==null){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list1 = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        /**
         * method to get village list
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
         * method to get village1 list
         */
        async getvillagelist1(id){
            let gewogId=$('#gewog1').val();
            if(id!="" && gewogId==null){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.villageList1 = data.data.data;
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
                this.getgewoglist();
            }
            if(id=="dzongkhag1"){
                this.form.dzongkhag1=$('#dzongkhag1').val();
                this.getgewoglist1();
            }
            if(id=="gewog"){
                this.form.gewog=$('#gewog').val();
                this.getvillagelist();
            }
            if(id=="gewog1"){
                this.form.gewog1=$('#gewog1').val();
                this.getvillagelist1();
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
                        this.form.post('organization/saveBifurcation')
                        .then((response) => {
                            if(response!=""){
                                let message="Application for Bifurcation has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'bifurcation_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Bifurcation details has been submitted for further action.'
                                });
                            }

                        })
                        .catch((er) => {
                            console.log("Error:"+er)
                     })
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
                this.form.parent_id=data.id;
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
