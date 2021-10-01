<template>
    <div>
        <div class="card card-primary card-outline">
        </div> 
        <form class="bootbox-form" id="connectivity-detial">
            <div class="card-body">
                <div class="row form-group">
                    <div class="card-header pt-1 pb-sm-0 col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                     <span class="card-title">
                         <b>Road Connectivity</b>
                     </span>
                    </div>
                </div>
                <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                    <label class="mb-1">What is the type of road nearest to your school:<i class="text-danger">*</i></label>
                    <select v-model="form.road_typeyes" class="form-control" name="road_typeyes" id="road_typeyes">
                        <option v-for="(item, index) in roadTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="road_typeyes"></has-error>
                </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Is your School Connected to Road?<span class="text-danger">*</span> </label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-8">
                        <label><input  type="radio" v-model="form.connectedtoroad" value="1" tabindex="" @click="showtextbox('Yes')"/> Yes</label>
                        <label><input  type="radio" v-model="form.connectedtoroad" value="0" tabindex="" @click="showtextbox('No')"/> No</label>
                        <has-error :form="form" field="connectedtoroad"></has-error>
                    </div>
                    <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="display:none" id="roadtypeyes">
                        <label class="mb-1">Type of Road:<i class="text-danger">*</i></label>
                        <select v-model="form.road_typeyes" class="form-control" name="road_typeyes" id="road_typeyes">
                            <option v-for="(item, index) in roadTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="road_typeyes"></has-error>
                    </div>  -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="display:none" id="roadtypeno">
                        <label class="mb-1">If No, what is the distance from the nearest road? (Km)<i class="text-danger">*</i></label>
                        <input type="text" v-model="form.road_typeno" class="form-control editable_fields" id="road_typeno" />
                        <has-error :form="form" field="road_typeno"></has-error>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <label>Distance of the School/ECCD/ECR from Headquarter? (In Km)<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @change="removeerror('hqdistance')" :class="{ 'is-invalid': form.errors.has('hqdistance') }" id="hqdistance" v-model="form.hqdistance" >
                        <has-error :form="form" field="hqdistance"></has-error>
                    </div>
                </div>
               
                <div class="form-group row">
                   <div class="card-header pt-1 pb-sm-0 col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                     <span class="card-title">
                         <b>Internet Connectivity</b>
                     </span>
                    </div>
                </div>
             
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Is your School/ECCD/ECR connected to Internet?<span class="text-danger">*</span> </label>
                    </div>
                </div>
                <div class="form-group row">
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <label><input  type="radio" v-model="form.connectedtointernet" value="1" tabindex="" @click="showtextboxI('connected')"/> Yes</label>
                     <label><input  type="radio" v-model="form.connectedtointernet" value="0" tabindex="" @click="showtextboxI('notconnected')"/> No</label>
                     <has-error :form="form" field="connectedtointernet"></has-error>
                   </div>
                </div>
                
                <div class="form-group row" style="display:none" id="internetyes">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                        <label>Types of connections :</label>
                        <label  v-for="(item, key, index) in  connection_type_list" :key="index" class="pr-4">
                            <input  type="radio" v-model="form.connectiontype" :value="item.id" tabindex=""/> 
                            {{item.name}}
                        </label>
                    </div>
                    <br><br>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                     <label>Internet Service provider :</label>
                     <label  v-for="(item, key, index) in  serviceProviderList1" :key="index" class="pr-4">
                         <input  type="radio" v-model="form.serviceprovider" :value="item.id" tabindex=""/> 
                         {{item.name}}
                      </label> 
                  </div>
                  <br><br>
                   <!-- <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Structure No:<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input class="form-control editable_fields " id="structureNo" type="text" v-model="form.structureNo">
                            </div>
                        </div> -->
                 <!-- <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" > 
                     <label>Speed/Bandwidth :</label>
                     <input type="text" name="speedbandwidth" v-model="form.speedbandwidth" class="form-control editable_fields" id="speedbandwidth"/>
                </div> -->
                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Speed/Bandwidth:<span class="text-danger">*</span></label>
                <div class="col-lg-8 col-md-8 col-sm-8">
                <input class="form-control editable_fields " id="speedbandwidth" type="text" v-model="form.speedbandwidth">
                </div>
                  <br> <br><br>
                  
                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Is your School/ECCD/ECR connected to:<span class="text-danger">*</span> </label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label><input  type="checkbox" v-model="form.DrukREN" value="1" tabindex=""/> DrukREN</label>
                        <label><input  type="checkbox" v-model="form.GovNET" value="1" tabindex="" /> GovNET</label>
                        <label><input  type="checkbox" v-model="form.independent" value="1" tabindex="" /> Independent</label>
                    </div>
                    <br><br>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label >Does your School/ECCD/ECR use Internet Connection shared from Gewog/Community center/Dzongkhag?<span class="text-danger">*</span> </label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label><input  type="radio" v-model="form.sharedconnection" value="1" tabindex="" @click="showtextboxS('yes')"/> Yes</label>
                        <label><input  type="radio" v-model="form.sharedconnection" value="0" tabindex="" @click="showtextboxS('no')"/> No</label>
                        <has-error :form="form" field="sharedconnection"></has-error>
                    </div>
                   
                   
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none" id="sharedconnection">
                       <label>Specify the Connection Type<span class="text-danger">*</span></label>
                       <input type="text" class="form-control" @change="removeerror('connectionsharedtype')" :class="{ 'is-invalid': form.errors.has('connectionsharedtype') }" id="connectionsharedtype" v-model="form.connectionsharedtype" >
                       <has-error :form="form" field="connectionsharedtype"></has-error>
                    </div>
                    <br><br>
                    <!-- <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Internet Accessible to:</label><br>
                        <label  v-for="(item, index) in  internetAccessibleList" :key="index" class="pr-4">
                            <input  type="checkbox" name="internetAccessible" v-model="form.internetAccessible" :value="item.id"/> 
                            {{item.name}}
                        </label>
                    </div> -->
                  
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Internet Accessible to:</label><br>
                        <label  v-for="(item, index) in  internetAccessibleList" :key="index" class="pr-4">
                            <input  type="checkbox" name="internetAccessible" v-model="form.internetAccessible" :value="item.id" :id="'accessible'+item.id"/> 
                            {{item.name}}
                        </label>
                    </div>
               

                    
                  
               </div>
               <!-- <div class="form-group row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label >Is your School/ECCD/ECR connected to:<span class="text-danger">*</span> </label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label><input  type="checkbox" v-model="form.DrukREN" value="1" tabindex=""/> DrukREN</label>
                        <label><input  type="checkbox" v-model="form.GovNET" value="1" tabindex="" /> GovNET</label>
                        <label><input  type="checkbox" v-model="form.independent" value="1" tabindex="" /> Independent</label>
                    </div>
               </div> -->
               <!-- <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label >Does your School/ECCD/ECR use Internet Connection shared from Gewog/Community center/Dzongkhag?<span class="text-danger">*</span> </label>
                    </div>
               </div> -->
                <!-- <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label><input  type="radio" v-model="form.sharedconnection" value="1" tabindex="" @click="showtextboxS('yes')"/> Yes</label>
                        <label><input  type="radio" v-model="form.sharedconnection" value="0" tabindex="" @click="showtextboxS('no')"/> No</label>
                        <has-error :form="form" field="sharedconnection"></has-error>
                    </div>
                </div>
                <div class="form-group row" style="display:none" id="sharedconnection">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none" id="sharedconnection">
                       <label>Specify the Connection Type<span class="text-danger">*</span></label>
                       <input type="text" class="form-control" @change="removeerror('connectionsharedtype')" :class="{ 'is-invalid': form.errors.has('connectionsharedtype') }" id="connectionsharedtype" v-model="form.connectionsharedtype" >
                       <has-error :form="form" field="connectionsharedtype"></has-error>
                    </div>
                    
                </div> -->
                <!-- <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Internet Accessible to:</label><br>
                        <label  v-for="(item, key, index) in  internetAccessibleList" :key="index" class="pr-4">
                            <input  type="checkbox" v-model="form.internetAccessible" :value="item.id" tabindex=""/> 
                            {{item.name}}
                        </label>
                    </div>
                </div> -->
                <div class="form-group row">
                   <div class="card-header pt-1 pb-sm-0 col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                     <span class="card-title">
                         <b>Electricity Connection</b>
                     </span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label >Does your School/ECCD/ECR have electricity?<span class="text-danger">*</span> </label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label><input  type="radio" v-model="form.electricity" value="1" tabindex=""  @click="showtextboxE('yes')" /> Yes</label>
                      <label><input  type="radio" v-model="form.electricity" value="0" tabindex="" @click="showtextboxE('no')"/> No</label>
                      <has-error :form="form" field="electricity"></has-error>
                   </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none" id="electricity">
                       <label>Source of Electricity<span class="text-danger">*</span></label>
                       <select v-model="form.electricitysource" class="form-control" name="electricitysource" id="electricitysource">
                        <option v-for="(item, index) in electricitysourceList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="electricitysource"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label >Is your School/ECCD/ECR connected to nearest electricity Substation?<span class="text-danger">*</span> </label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label><input  type="radio" v-model="form.electricitysubstation" value="1" tabindex="" /> Yes</label>
                      <label><input  type="radio" v-model="form.electricitysubstation" value="0" tabindex=""/> No</label>
                      <has-error :form="form" field="electricitysubstation"></has-error>
                   </div>
                </div>
            </div>
            <div class="row form-group fa-pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-flat btn-primary" @click="updateconnectivity()"><i class="fa fa-check"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
    
</template>

<script>
export default {
    data(){
        return{
             roadTypeList:[],
             internetAccessibleList:[],
             connection_type_list:[],
             serviceProviderList1:[],
             display:'',
             electricitysourceList:[],
           
            form: new form({
                id: '', 
                org_id:'',
                connectedtoroad:'', 
                road_typeyes: '',
                road_typeno: '',
                hqdistance:'',
                connectedtointernet:'',
                connectiontype: '',
                serviceprovider: '',
                speedbandwidth: '',
                DrukREN:'',
                GovNET:'',
                independent:'',
                sharedconnection:'',
                connectionsharedtype:'',
                internetAccessible:[],
                electricity:'',
                electricitysubstation:'',
                electricitysource:'',
               
            })
        }
    },

    methods:{
        loadDataList(org_id){
        axios.get('organization/loadConnectivityInformation/' +org_id)
            .then(response => {
                let response_data=response.data; 
                this.display=response.data;
                this.form.connectedtoroad=response_data.connectedtoroad;
                this.form.road_typeyes=response_data.road_typeyes;
                this.form.road_typeno=response_data.road_typeno;
                this.form.hqdistance=response_data.hqdistance;
                this.form.connectedtointernet=response_data.connectedtointernet;
                this.form.connectiontype=response_data.connectiontype;
                this.form.serviceprovider=response_data.serviceprovider;
                this.form.speedbandwidth=response_data.speedbandwidth;
                this.form.DrukREN=response_data.DrukREN;
                this.form.GovNET=response_data.GovNET;
                this.form.independent=response_data.independent;
                this.form.sharedconnection=response_data.sharedconnection;
                this.form.connectionsharedtype=response_data.connectionsharedtype;
                this.form.internetAccessible=response_data.internetAccessible;
                this.form.electricity=response_data.electricity;
                this.form.electricitysource=response_data.electricitysource;
                this.form.electricitysubstation=response_data.electricitysubstation;

            })
            .catch((error) => {  
                    console.log("Error: "+error);
            });
            
        },

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        getRoadTypeDropdown(uri = '/organization/getRoadTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.roadTypeList = data;
            });
        },
        getServiceProviderDropdown1(uri = '/organization/getServiceProviderDropdown1'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.serviceProviderList1 = data;
            });
        },
        getElectricitySourceDropdown(uri = '/organization/getElectricitySourceDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.electricitysourceList = data;
            });
        },

        updateconnectivity(){
                this.form.post('organization/saveConnectivityDetails')
                .then((response) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Detail is Updated Successfully'
                    })
                    this.loadexsitingDetails();
                    this.$router.push('/edit_connectivity');
                   // alert(response);
                })
                .catch(function (error) {
                    console.log('error: '+error);
                });
        },
        loadexsitingDetails(){
                axios.get('common/getSessionDetail')
                .then(response =>{
                    let data = response.data.data;
                    this.form.org_id=data['Agency_Code'];
                    this.loadDataList(data['Agency_Code']);
                })    
                .catch(errors =>{ 
                    console.log(errors)
                });
            },

        showtextbox:function(type){
        if(type=="No"){
            $('#roadtypeno').show();
        }
            else{
                $('#roadtypeno').hide();
            }
        },

        // showtextbox:function(type){
        //  if(type=="Yes"){
        //      $('#roadtypeyes').show();
        //      $('#roadtypeno').hide(); 
        //     }
        //     else if(type=="No"){
        //      $('#roadtypeno').show();
        //      $('#roadtypeyes').hide();
        //     }
        //     else{
        //      $('#roadtypeyes').hide();
        //      $('roadtypeno').show();
        //     }
        // },
      
        showtextboxI:function(type){
            if(type=="connected"){
                $('#internetyes').show();
            }
            else{
                $('#internetyes').hide();
            }
        },
        showtextboxS:function(type){
           if(type=="yes"){
                $('#sharedconnection').show();
            }
            else{
                $('#sharedconnection').hide();
            }  
        },
        showtextboxE:function(type){
           if(type=="yes"){
                $('#electricity').show();
            }
            else{
                $('#electricity').hide();
            }   
        },
        loadAccessibilityList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/InternetAccessible'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.internetAccessibleList =  data;
             })
        },
        loadConnectionTypeList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/InternetConnectionType'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.connection_type_list =  data;
             })
        },
        
       
        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html(''); 
            }
        },
      
        
    },
     mounted() {
         this.getElectricitySourceDropdown();
         this.loadexsitingDetails(); 
         this.loadDataList();
         this.getRoadTypeDropdown();
         this.loadAccessibilityList();
         this.loadConnectionTypeList();
         this.getServiceProviderDropdown1();

      
           $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
    },
  

}
</script>