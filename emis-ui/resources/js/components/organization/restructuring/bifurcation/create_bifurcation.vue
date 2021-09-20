<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="ApplicationUnderProcess">
           <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <a class="nav-link active" data-toggle="pill" role="tab">
                            <span class="card-title pt-2 mb-0">
                            <b id="screenName"></b>
                        </span>
                    </a>
                </ul>
            </div>
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
                                <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                    <td>
                                        <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                        <span class="text-danger" :id="'fileName'+(index+1)+'_err'"></span>
                                    </td>
                                    <td>
                                        <input type="file" name="attachments" class="form-control application_attachment" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
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
            form: new form({
                id: '',parent_id:'',name:'', application_for:'Bifurcation',application_type:'bifurcation',action_type:'add', status:'Submitted',
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
        addMore: function(){
            this.form.attachments.push({file_name:'', file_upload:''})
        },
        remove(index){
            if(this.form.attachments.length>1){
                this.form.attachments.pop();
            }
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
                this.getGewogList($('#dzongkhag').val(),'');
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
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data'
                            }
                        }
                        let formData = new FormData();
                        formData.append('id', this.form.id);
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
                        formData.append('screenId', this.screenId);
                        formData.append('SysRoleId', this.SysRoleId);
                        formData.append('Sequence', this.Sequence);
                        formData.append('Status_Name', this.Status_Name);
                        formData.append('screen_name', this.screen_name);
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
                                let message="Application response.data.application_numberfor Bifurcation has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.notification_appNo+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                this.$router.push({name:'bifurcation_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Bifurcation details has been submitted for further action.'
                                });
                            }

                        })
                        .catch((er) => {
                            console.log("Error:"+er);
                            this.form.errors.errors = err.response.data.errors;
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
        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
            });
        },
        //loading the screen id
        loadScreenDetails(){
            axios.get('organizationApproval/getScreenId/Application For Bifurcation__'+1)
            .then(response => {
                let data = response.data.data;
                if(data!=undefined && data!="NA"){
                    $('#screenName').html('<b>Creating Application for '+data.screenName+'</b>');
                    this.screenId=data.screen;
                    this.SysRoleId=data.SysRoleId;
                    this.Sequence=data.Sequence;
                    this.Status_Name=data.Status_Name;
                    this.screen_name=data.screenName;
                    $('#screenPermission').hide();
                    $('#mainform').show();
                }
                else{
                    $('#message').html('<b>You are not eligible to visit this page. Please contact system administrator for further assistant</b>');
                    $('#screenPermission').show();
                    $('#mainform').hide();
                }
            })
            .catch(errors => {
                console.log(errors)
            });
        },
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
        this.loadScreenDetails();
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
        // this.checkPendingApplication();
    }
}
</script>
