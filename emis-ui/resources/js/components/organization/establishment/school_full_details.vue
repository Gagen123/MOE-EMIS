<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" >
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Location</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editLocation()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body">
                        <input type="hidden" class="form-control" id="organizationId" v-model="form.organizationId"/>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Land Ownership:</label>
                                <span class="text-blue text-bold" id="ownership">{{form.landOwnership == 1 ? "Public" : "Private"}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Compound Fencing:</label>
                                <span class="text-blue text-bold" id="fencing">{{form.compoundFencing == 1 ? "Yes" : "No"}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Entrance Gate:</label>
                                <span class="text-blue text-bold" id="schiwog">{{form.entranceGate == 1 ? "Yes" : "No"}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Thram No:</label>
                                <span class="text-blue text-bold" id="schiwog">{{form.thramNo}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Compound Area:</label>
                                <span class="text-blue text-bold" id="schiwog">{{form.compoundArea}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school1" >
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Connectivity</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus" ></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm fa-pull-right" type="button" @click="editConnectivity()"> Edit &nbsp;&nbsp; </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Road Approach:</label>
                                <span class="text-blue text-bold" id="scode">{{form.approachRoad}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Electricity Source:</label>
                                <span class="text-blue text-bold" id="sname">{{form.electricitySource}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                 <label>Telephone Service Provider:</label>
                                 <span class="text-blue text-bold" id="scategory">{{form.telephone}}</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Internet Service Provider:</label>
                                <span class="text-blue text-bold" id="slevel">{{form.internet}}</span>
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
                        <h3 class="card-title">Equipment & Furniture</h3>
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
                                    <th>Location/Use</th>
                                    <th>Type</th>
                                    <th>Item</th>
                                    <th>Number</th>
                                </tr>
                            </thead>
                            <tr v-for="(item, index) in equipmentList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.type}}</td>
                                <td>{{ item.item}}</td>
                                <td>{{ item.location}}</td>
                                <td>{{ item.number}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school1" >
                    <div class="card card-success card-outline">
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
                                    <th>Sl No.</th>
                                    <th>Facility</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in sportList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.facilityName}}</td>
                                    <td>{{ item.type}}</td>
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
                                    <th>Sl No.</th>
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
    </div>
</template>

<script>
export default {
    data(){
        return{
            data:'',
            equipmentList:[],
            sportList:[],
            infrastructureList:[],
            form: new form({
                organizationId:'',
                landOwnership:'',
                compoundFencing:'',
                entranceGate:'',
                thramNo:'',
                compoundArea:'',
                approachRoad:'',
                electricitySource:'',
                telephone:'',
                internet:''
            })
        }
    },

    methods:{
        /**
         * method ti load equipment list
         */
        loadEquipmentList(uri = 'organization/loadEquipment'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.equipmentList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
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
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },

        /**
         * method to get infrastructure lists
         */
        loadInfrastructureList(uri = 'organization/loadInfrastructureList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.infrastructureList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },

        /**
         * method to get organization details by id
         */
        getLocationDetails(id){
            axios.get('organization/getLocationDetails/'+id)
            .then((response) => {  
                let data=response.data.data;
                this.form.landOwnership     = data.landOwnership;
                this.form.compoundFencing   = data.compoundFencing;
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

        /**
         * method to redirect to location page
         */
        editLocation:function(){
            let orgId = $("#organizationId").val();
            this.$router.push({name:'locations',query: {orgId:orgId}});
        },

        /**
         * method to redirect to connectivity page
         */
        editConnectivity:function(){
            let orgId = $("#organizationId").val();
            // this.$router.push("/connectivity")
            this.$router.push({name:'connectivity',query: {orgId:orgId}});
        },

        /**
         * method to redirect to equipment list
         */
         editEquipmentList: function(){
            this.$router.push("/equipment_list")
        },

        /**
         * method to redirect to infrastructure list
         */
        editStructureList: function(){
            this.$router.push("/infrastructure_list")
        },

        /**
         * method to redirect to sport list
         */
        editSportList: function(){
            this.$router.push("/sport_list")
        },
    },

    created(){
        this.getLocationDetails(this.$route.query.data);
        this.getConnectivityDetails(this.$route.query.data);
        this.form.organizationId = this.$route.query.data;
    },

     mounted(){
        this.loadEquipmentList();
        this.loadSportList();
        this.loadInfrastructureList();
    },
}
</script>