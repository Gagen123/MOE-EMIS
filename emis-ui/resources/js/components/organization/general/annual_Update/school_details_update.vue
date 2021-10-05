<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Academic Year for:</label>
                <input class="form-control" v-model="form.year" :class="{ 'is-invalid': form.errors.has('year') }" id="year" @change="remove_err('year')" type="text" readonly>
                <has-error :form="form" field="year"></has-error>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" >
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Contact Detail</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editContacts()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="organizationId" v-model="form.organizationId"/>
                        <div class="form-group row"> 
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Offical Phone Number:</label>
                                <span class="text-blue text-bold" id="ownership">{{contactdetail.phone}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Offical Email:</label>
                                <span class="text-blue text-bold" id="fencing">{{contactdetail.email}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Offical website:</label>
                                <span class="text-blue text-bold" id="schiwog">{{contactdetail.website}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Facebook Link:</label>
                                <span class="text-blue text-bold" id="schiwog">{{contactdetail.facebookLink}}</span>
                            </div> 
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school1" >
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Basic Detail</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editBasicDetail()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Has Counselling Rooom:</label>
                                <span class="text-blue text-bold" id="scode">{{contactdetail.hasCounselingRoom == 1 ? "Yes" : "No"}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Is AspNet School:</label>
                                <span class="text-blue text-bold" id="sname">{{contactdetail.isAspNetSchool == 1 ? "Yes" : "No"}}</span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                 <label>Has Entrance Gate:</label>
                                 <span class="text-blue text-bold" id="scategory">{{loc_details.entranceGate == 1 ? "Yes" : "No"}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Compound Fencing:</label>
                                <span class="text-blue text-bold" id="slevel">{{fence_list[loc_details.fencingtypeId]}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" >
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Equipment</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editEquipmentList()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="equipment-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Type</th>
                                    <th>Item</th>
                                    <th>No. of Usable Item</th>
                                    <th>No. Not Usable Item</th>

                                </tr>
                            </thead>
                            <tr v-for="(item, index) in equipmentList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.type}}</td>
                                <td>{{ item.item}}</td>
                                <td>{{ item.usable}}</td>
                                <td>{{ item.notusable}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" >
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Furniture</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editFurnitureList()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="equipment-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Type</th>
                                    <th>Item</th>
                                    <th>No. of Usable Item</th>
                                    <th>No. Not Usable Item</th>
                                </tr>
                            </thead>
                            <tr v-for="(item, index) in furnitureList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.type}}</td>
                                <td>{{ item.item}}</td>
                                <td>{{ item.usable}}</td>
                                <td>{{ item.notusable}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school1" >
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Sport Facility</h3>
                            <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus" ></i>
                                    </button>
                                </div>
                                <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editSportList()"> Edit &nbsp;&nbsp; </button>
                        </div>
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="equipment-table" class="table text-center table-sm table-bordered table-striped">
                            <thead>
                                <tr>  
                                    <th>SL#</th>
                                    <th>Facility</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in sportList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.facility}}</td>
                                    <td>{{ item.type}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" >
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Infrastructure</h3>
                    <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editStructureList()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="structure-table" class="table text-center table-sm table-bordered table-striped">
                            <thead>
                                <tr>  
                                    <th>SL#</th>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    <th>Structure No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in infrastructureList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.categorgName}}</td>
                                    <td>{{ item.subCategoryName}}</td>
                                    <td>{{ item.structureNo}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" >
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Connectivity Detail</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editConnectivity()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="organizationId" v-model="form.organizationId"/>
                        <div class="form-group row"> 
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                                <label>Nearest Road Type :</label>
                                <span class="text-blue text-bold" id="ownership">{{roadTypeList[connectivityDetails.road_typeyes]}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Connected to Road::</label>
                                <span class="text-blue text-bold" id="fencing">{{connectivityDetails.connectedtoroad ==1 ? "Yes" : "No"}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Internet Connection:</label>
                                <span class="text-blue text-bold" id="schiwog">{{connectivityDetails.connectedtointernet ==1 ? "Yes" : "No"}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Electricity:</label>
                                <span class="text-blue text-bold" id="schiwog">{{connectivityDetails.electricity ==1 ? "Yes" : "No"}}</span>
                            </div> 
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Play Ground Area:</label>
                                <span class="text-blue text-bold" id="schiwog">{{contactdetail.website}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Agricultural Area:</label>
                                <span class="text-blue text-bold" id="schiwog">{{contactdetail.facebookLink}}</span>
                            </div> 
                        </div> -->
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" >
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Compound Detail</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editCompound()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="organizationId" v-model="form.organizationId"/>
                        <div class="form-group row"> 
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Tharm No:</label>
                                <span class="text-blue text-bold" id="ownership">{{compoundDetails.thramNo}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Plot No::</label>
                                <span class="text-blue text-bold" id="fencing">{{compoundDetails.plotNo}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Size of compound area:</label>
                                <span class="text-blue text-bold" id="schiwog">{{compoundDetails.compoundArea}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Land Ownership type:</label>
                                <span class="text-blue text-bold" id="schiwog">{{compoundDetails.ownership}}</span>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Play Ground Area:</label>
                                <span class="text-blue text-bold" id="schiwog">{{compoundDetails.statusofplay ==1 ? "Yes" : "No"}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Agricultural Area:</label>
                                <span class="text-blue text-bold" id="schiwog">{{compoundDetails.status ==1 ? "Yes" : "No"}}</span>
                            </div> 
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group fa-pull-right">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-flat btn-primary" @click="AnnualDetail('final-tab')"><i class="fa fa-check"></i> Submit</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            data:'',
            contactdetail:[],
            loc_details:[],
            stream_array:{},
            class_array:{},
            equipmentList:[],
            connectivityDetails:[],
            sportList:[],
            furnitureList:[],
            equipmentList:[],
            fence_list:[],
            compoundDetails:[],
            infrastructureList:[],
            sectionList:[],
            roadTypeList:[],
            form: new form({
                id:'',
                rolename:'',
                year: new Date().getFullYear(),
                // date: new Date()
            })
        }
    },

    methods:{
        /**
         * method to load equipment list
         */
        loadEquipmentList(uri = 'organization/loadEquipment'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.equipmentList =  data.data;
            })
            .catch(function (error) {

            });
        },
        loadFurnitureList(uri = 'organization/loadFurniture'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.furnitureList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#furniture-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },

        /**
         * method to load sport facility
         */
        loadSportList(uri = 'organization/loadSport'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sportList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                   
                }
            });
            setTimeout(function(){
                $("#sport-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },

        /**
         * method to get infrastructure lists
         */
        loadInfrastructureList(uri = 'organization/loadInfrastructureList/null'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.infrastructureList =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        /**
         * method to get organization details by id
         */
        getLocationDetails(id){
            axios.get('organization/getLocationDetails/'+id)
            .then((response) => {  
                let data=response.data.data;
                // this.form.landOwnership     = data.landOwnership;
                // this.form.compoundFencing   = data.compoundFencing;
                this.form.entranceGate      = data.entranceGate;
                this.form.thramNo           = data.thramNo;
                this.form.compoundArea      = data.compoundArea;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

        /**
         * method to get connectivity details by id
         */
        getConnectivityDetails(id){
            axios.get('organization/getConnectivityDetails/'+id)
            .then((response) => {  
                let data=response.data.data;
                this.form.approachRoad          = data.roadType;
                this.form.electricitySource     = data.electricitySource;
                this.form.telephone             = data.telephone;
                this.form.internet              = data.internet;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                for(let i=0;i<response.data.length;i++){
                    this.class_array[response.data[i].id] = response.data[i].class; 
                }
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                for(let i=0;i<response.data.length;i++){
                    this.stream_array[response.data[i].id] = response.data[i].stream; 
                }
                
            });
        },

        /**
         * method to get section details by id
         */
        getSectionDetails(id){
            axios.get('organization/getSectionDetails/'+id)
            .then((response) => {  
                let data = response;
                this.sectionList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },

        /**
         * method to redirect to location page
         */
        editCompound:function(){
            let orgId = $("#organizationId").val();
            this.$router.push({name:'compound_information',query: {orgId:orgId}});
        },
        editConnectivity:function(){
            let orgId = $("#organizationId").val();
            this.$router.push({name:'connectivity_details',query: {orgId:orgId}});
        },

        /**
         * method to redirect to connectivity page
         */
        editBasicDetail:function(){
            let orgId = $("#organizationId").val();
            this.$router.push({name:'detailed_information_school',query: {orgId:orgId}});
        },

        /**
         * method to edit section
         */
        editContacts:function(){
            let orgId = $("#organizationId").val();
            this.$router.push({name:'basic_details_index',query: {orgId:orgId}});
        },

        /**
         * method to redirect to equipment list
         */
        editEquipmentList: function(){
            this.$router.push("/equipment_index")
        },
        editFurnitureList: function(){
            this.$router.push("/furniture_index")
        },

        /**
         * method to redirect to infrastructure list
         */
        editStructureList: function(){
            this.$router.push("/infrastructure_index")
        },

        /**
         * method to redirect to sport list
         */
        editSportList: function(){ 
            this.$router.push("/sport_index")
        },

        loadPriviousOrgDetails(org_id){
            axios.get('loadCommons/loadOrgDetails/fullOrgDetbyid/'+org_id)
            .then(response => {
                
                this.existing_details=response.data.data;
                this.contactdetail=response.data.data.contactDetails;
                this.loc_details=response.data.data.loc_details;
                this.compoundDetails=response.data.data.compoundDetails;
                this.connectivityDetails=response.data.data.connectivityDetails;


                // alert(this.loc_details);
                
                
                // this.getgewog(response.data.data.dzongkhagId,response.data.data.gewogId);
                // this.getVillage(response.data.data.gewogId,response.data.data.chiwogId);
            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },
        loadexsitingDetails(){
            axios.get('common/getSessionDetail')
            .then(response =>{
                let data = response.data.data;
                this.form.org_id=data['Agency_Code'];
                this.getorgProfile(data['Agency_Code']);
            })
            .catch(errors =>{
                console.log(errors)
            });
        },
      
        loadfencingList(uri='masters/organizationMasterController/loadOrganizaitonmasters/active/FencingType'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.fence_list[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadRoadTypeList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/RoadType'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.roadTypeList[data.data.data[i].id] = data.data.data[i].name;
                }
               // this.roadTypeList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        loadtransferwindow(){
            axios.get('masters/loadGlobalMasters/data_submission')
           .then((response) => {
                let data=response.data.data[0];
                 if(data!=null){
                    this.form.transferwindow_id=data.id;
                    this.form.t_from_date=data.from_date;
                    this.form.t_to_date=data.to_date;
                    this.form.t_year=data.year;
                    this.form.t_remarks=data.remarks;
                    this.form.t_id=data.id;
                    let todate=new Date(data.to_date);
                    let formdate = new Date();
                    // One day in milliseconds
                    const oneDay = 1000 * 60 * 60 * 24;
                    // Calculating the time difference between two dates
                    let diffInTime = todate.getTime() - formdate.getTime();
                    //consider last day
                    diffInTime=diffInTime+oneDay;
                    // Calculating the no. of days between two dates
                    const diffInDays =(diffInTime / oneDay);
                    if(diffInDays<=5 && diffInDays>0){
                        this.t_warning_message="Only "+Math.ceil(diffInDays)+" day(s) left to apply";
                        this.t_warning=true;
                    }
                    else if(diffInDays<=0){
                        $('#err_message').html("<b>Sorry!</b><br> Tranfer period is over for this year");
                        $('#invalidsection').show();
                        $('#t_form_details').hide();
                    }
                }
                else{
                    $('#err_message').html('<b>Sorry!</b><br> System cannot find a valid Transfer configuration. Might be the tranfer period is over for this year or might not yet reach for the period');
                    $('#invalidsection').show();
                    $('#t_form_details').hide();
                }
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },
        AnnualDetail: function(type){
            if(this.form.rolename=="Principal"){
            if(type=="final-tab"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        if(this.form.t_to_date >=this.form.current_date || this.form.t_from_date <=this.form.current_date){
                            this.form.post('organization/saveAnnualData',this.form)
                            .then((response) =>{
                                Toast.fire({
                                icon: 'success',
                                title: 'Details added successfully'
                            })
                         //  this.$router.push('/school_details_acknowledgement');
                            if(response!="" && response!=null){
                                let message="Your Annual Detail has been Submitted Successfully ";
                                this.$router.push({name:'school_details_acknowledgement',params: {data:message}});
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Annual details is saved successfully'
                                });
                            }
                            })
                            .catch((error) => {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Unexpected error occured. Try again.'
                                });
                                console.log("Error:"+error);
                            })
                        }
                        else{
                        Swal.fire({
                            text: "Time period for applying intra transfer is closed for the moment!",
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay!',
                            })
                        }
                       
                    }
                })
            }
            
            }
            else{
            Swal.fire({
                title: 'You donot have privilege to Submit these form',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                })

            }
		},
        printDate: function () {
            return new Date().toLocaleDateString();
        },
    },

    created(){
        this.getClass();
        this.getStream();
        this.getLocationDetails(this.$route.query.data);
        this.getConnectivityDetails(this.$route.query.data);
        // this.form.organizationId = this.$route.query.data;
        if(this.$route.query.org_id!=undefined && this.$route.query.org_id!=""){
            this.loadPriviousOrgDetails(this.$route.query.org_id);
        }
        else{
            axios.get('common/getSessionDetail')
            .then(response =>{
                let data = response.data.data;
                this.form.rolename=data.roles[0].roleName
               // alert(JSON.stringify(this.form.rolename));
                this.loadPriviousOrgDetails(data['Agency_Code']);
            }) ;
        }
    },
    mounted(){
        this.loadEquipmentList();
        this.loadSportList();
        this.loadRoadTypeList();
        this.loadInfrastructureList();
        this.loadFurnitureList();
        this.loadEquipmentList();
        // this.getSectionDetails(this.$route.query.data);
        this.loadexsitingDetails();
        this.loadfencingList();
        this.date = this.printDate();
        
    },
}
</script>