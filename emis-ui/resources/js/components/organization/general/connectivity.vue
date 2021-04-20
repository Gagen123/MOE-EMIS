<template>
    <div>
        <form class="bootbox-form" id="connectivityId">
            <div class="form-group row">
                <input type="hidden" class="form-control" v-model="form.organizationId"/>
                <input type="hidden" class="form-control" v-model="form.id"/>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-8 ">Approach Road:<span class="text-danger"> *</span></label>
                                    <select name="approachRoad" id="approachRoad" class="form-control" v-model="form.approachRoad" :class="{ 'is-invalid': form.errors.has('approachRoad') }"  @change="approachRoadIsNoRoad(),remove_err('approachRoad')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in roadTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="approachRoad"></has-error>
                                </div> 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-8 ">Electricity Source:<span class="text-danger"> *</span></label>
                                    <select name="electricitySource" id="electricitySource" class="form-control" v-model="form.electricitySource" :class="{ 'is-invalid': form.errors.has('electricitySource') }"  @change="electricitySourceIsGrid(),remove_err('electricitySource')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in electricitySourceList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="electricitySource"></has-error>
                                </div> 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-12 ">Telephone Service Provider:<span class="text-danger"> *</span></label>
                                    <select name="telephone" id="telephone" class="form-control" v-model="form.telephone" :class="{ 'is-invalid': form.errors.has('telephone') }" @change="remove_err('telephone')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in serviceProviderList1" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="telephone"></has-error>
                                </div> 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-10 ">Internet Service Provider:<span class="text-danger"> *</span></label>
                                    <select name="internet" id="internet" class="form-control" v-model="form.internet" @change="internet(),remove_err('internet')" :class="{ 'is-invalid': form.errors.has('internet') }" >
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in serviceProviderList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="internet"></has-error>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  noRoad" style="display:none">
                                    <label class="col-md-12 ">Distance from Road Head:</label>
                                    <input type="number" id="" v-model="form.distanceFromRoad" class="form-control" placeholder="KM"/>
                                </div> 
                        
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  noRoad" style="display:none">
                                    <label class="col-md-10 ">Days from Road Head:</label>
                                    <input type="number" id="" v-model="form.daysFromRoad" class="form-control" placeholder="Days"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 noRoad" style="display:none">
                                    <label class="col-md-12 ">Hours from Road Head:</label>
                                    <input type="number" id="" v-model="form.hoursFromRoad" class="form-control" placeholder="Hours"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  grid" style="display:none">
                                    <label class="col-md-12 ">Electricity Main Line Supply:</label>
                                    <select name="electricitySupply" id="electricitySupply" class="form-control" v-model="form.electricitySupply">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in electricitySupplyList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                </div> 
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  grid" style="display:none">
                                    <label class="col-md-10 ">Electrical substation:</label>
                                    <br>
                                    <label><input v-model="form.electricalSubstation"  type="radio" value="1" tabindex="2"/> Yes</label>
                                    <label><input v-model="form.electricalSubstation"  type="radio" value="0" tabindex="3"/> No</label>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  showDiv" style="display:none">
                                    <label class="col-md-10 ">Bandwidth (Mbps):</label>
                                    <input type="text" v-model="form.bandwidth" id="" class="form-control" placeholder="Mbps"/>
                                </div> 
                                    
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  showDiv" style="display:none">
                                    <label class="col-md-10 ">DrukREN Connection:</label>
                                    <br>
                                    <label><input v-model="form.drukRen"  type="radio" value="1" tabindex="2"/> Yes</label>
                                    <label><input v-model="form.drukRen"  type="radio" value="0" tabindex="3"/> No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label class="mb-0">Contact Details</label>
            </div>    
            <div class="card">
                <div class="form-group row">
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Mobile</th>
                                    <th>Email</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1" v-for='(user, index) in form.users' :key="index">
                                    <td>
                                        <select name="contactName" id="contactName" class="form-control" v-model="user.contactName" :class="{ 'is-invalid': form.errors.has('contactName') }" @change="remove_err('contactName')">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in contactTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="user.contactName"></has-error>
                                    </td>
                                    <td>                                
                                        <input type="text" name="phone" id="phone" class="form-control" v-model="user.phone" :class="{ 'is-invalid': form.errors.has('phone') }" @change="remove_err('phone')"/>
                                        <has-error :form="form" field="phone"></has-error>
                                    </td>
                                    <td>                                
                                        <input type="text" name="mobile" id="mobile" class="form-control" v-model="user.mobile" :class="{ 'is-invalid': form.errors.has('mobile') }" @change="remove_err('mobile')"/>
                                        <has-error :form="form" field="mobile"></has-error>
                                    </td>
                                    <td>                                
                                        <input type="email" name="email" id="email" class="form-control" v-model="user.email" :class="{ 'is-invalid': form.errors.has('email') }" @change="remove_err('email')"/>
                                        <has-error :form="form" field="email"></has-error>
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
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            count:1,
            roadTypeList:[],
            electricitySourceList:[],
            electricitySupplyList:[],
            serviceProviderList:[],
            serviceProviderList1:[],
            contactTypeList:[],
            users: [],
            form: new form({
                id: '',
                organizationId:'',
                approachRoad: '',
                electricitySource: '',
                telephone:'',
                internet:'',
                distanceFromRoad:'',
                daysFromRoad:'',
                hoursFromRoad:'',
                electricitySupply:'',
                electricalSubstation:'0',
                bandwidth:'',
                drukRen:'0',
                users:
                [{
                    contactName:'',phone:'', mobile:'',email:''
                }],
            }),
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.approachRoad= '';
            this.form.electricitySource= '';
            this.form.telephone= '';
            this.form.internet= '';
            this.form.distanceFromRoad= '';
            this.form.daysFromRoad= '';
            this.form.hoursFromRoad= ''; 
            this.form.electricitySupply= '';  
            this.form.electricalSubstation= '0';  
            this.form.bandwidth= ''; 
            this.form.drukRen= '0'; 
            $(".grid").hide();
            $(".noRoad").hide();
            $(".showDiv").hide();
            let formReset =this.form.users;
            formReset.splice(0, formReset.length);
            this.form.users.push({contactName:'',phone:'',mobile:'',email:''}) 
        },

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                this.form.post('/organization/saveConnectivity',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Connectivity is added successfully'
                    })

                    if(this.form.organizationId != null || this.form.organizationId != ""){
                        this.$router.push("/school_list")
                    }else{
                        this.restForm();
                    }

                   
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        /**
         * method to get road type in dropdown
         */
        getRoadTypeDropdown(uri = '/organization/getRoadTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.roadTypeList = data;
            });
        },
        /**
         * method to get service provider in dropdown
         */
        getServiceProviderDropdown(uri = '/organization/getServiceProviderDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.serviceProviderList = data;
            });
        },

        /**
         * method to get service provider in dropdown
         */
        getServiceProviderDropdown1(uri = '/organization/getServiceProviderDropdown1'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.serviceProviderList1 = data;
            });
        },

        /**
         * method to get road type in dropdown
         */
        getElectricitySourceDropdown(uri = '/organization/getElectricitySourceDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.electricitySourceList = data;
            });
        },

        /**
         * method to get road type in dropdown
         */
        getContactTypeDropdown(uri = '/organization/getContactTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.contactTypeList = data;
            });
        },

        /**
         * method to get electricity supply in dropdown
         */
        getElectricitySupplyDropdown(uri = '/organization/getElectricitySupplyDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.electricitySupplyList = data;
            });
        },

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.users.push({contactName:'',phone:'',mobile:'',email:''})    
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.form.users.length>1){
                this.count--;
                this.form.users.splice(index,1); 
            }
        },
       
       /**
        * method to show hidden field if electricity source is grid
        */
        electricitySourceIsGrid: function(){
            let electricitySource = $('#electricitySource option:selected').text();
            if(electricitySource == "Grid"){
                $(".grid").show();
            }else{
                $(".grid").hide();
            }
        },

        /**
         * method to show hidden fields if approach road is no road
         */
        approachRoadIsNoRoad: function(){
            let approachRoad = $('#approachRoad option:selected').text();
            if(approachRoad == "No Road"){
                $(".noRoad").show();
            }else{
                $(".noRoad").hide();
            }
        },

        /**
         * method to show hidden fields if internet is BT or TCell
         */
        internet: function(){
            let service = $('#internet option:selected').text();
            if(service != "No telephone connection"){
                $(".showDiv").show();
            }else{
                $(".showDiv").hide();
            }
        },

        /**
         * method to get connectivity details by id
        */
        getConnectivityDetails(orgId){
            axios.get('organization/getConnectivityDetails/'+orgId)
            .then((response) => {  
                let data=response.data.data;
                this.form.id                    = data.id;
                this.form.approachRoad          = data.roadTypeId;
                this.form.electricitySource     = data.electricitySourceId;
                this.form.telephone             = data.telephoneServiceProvoderId;
                this.form.internet              = data.internetServiceProviderId;

                if(data.roadType == "No Road"){
                    $(".noRoad").show();
                    this.form.distanceFromRoad   = data.distanceFromRoad;
                    this.form.daysFromRoad       = data.daysFromRoad;
                    this.form.hoursFromRoad      = data.hoursFromRoad;
                }

                if(data.electricitySource == "Grid"){
                    $(".grid").show();
                    this.form.electricitySupply     = data.electricitySupplyId;
                    this.form.electricalSubstation  = data.hasElectricalSubstation;
                }

                if(data.internet != "No telephone connection"){
                    $(".showDiv").show();
                    this.form.bandwidth   = data.mbps;
                    this.form.drukRen     = data.drukRenConnection;
                }

                let prop=data.contact;
                let contactDetails=[];
                for(let i=0;i<prop.length;i++){
                    contactDetails.push({contactName:prop[i].contactTypeId,phone:prop[i].phone,mobile:prop[i].mobile,email:prop[i].email,});
                }
                this.count=data.length;
                this.form.users=contactDetails;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

    },
    created(){
        this.getConnectivityDetails(this.$route.query.orgId);
    },
     mounted() { 
        this.getRoadTypeDropdown();
        this.getElectricitySourceDropdown();
        this.getElectricitySupplyDropdown();
        this.getServiceProviderDropdown();
        this.getServiceProviderDropdown1();
        this.getContactTypeDropdown();
        this.form.organizationId = this.$route.query.orgId;

    }
}
</script>