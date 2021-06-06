<template>
    <div>
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
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="display:none" id="roadtypeyes">
                        <label class="mb-1">Type of Road:<i class="text-danger">*</i></label>
                        <select v-model="form.road_typeyes" class="form-control" name="road_typeyes" id="road_typeyes">
                            <option v-for="(item, index) in roadTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="road_typeyes"></has-error>
                    </div> 
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
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                     <label>Internet Service provider :</label>
                     <label  v-for="(item, key, index) in  serviceProviderList1" :key="index" class="pr-4">
                         <input  type="radio" v-model="form.serviceprovider" :value="item.id" tabindex=""/> 
                         {{item.name}}
                      </label> 
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" > 
                     <label>Speed/Bandwidth :</label>
                     <input type="text" name="speedbandwidth" v-model="form.speedbandwidth" class="form-control editable_fields" id="speedbandwidth"/>
                  </div>
               </div>
               <div class="form-group row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label >Is your School/ECCD/ECR connected to:<span class="text-danger">*</span> </label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label><input  type="checkbox" v-model="form.DrukREN" value="DrukREN" tabindex=""/> DrukREN</label>
                        <label><input  type="checkbox" v-model="form.GovNET" value="GovNET" tabindex="" /> GovNET</label>
                        <label><input  type="checkbox" v-model="form.independent" value="independent" tabindex="" /> Independent</label>
                    </div>
               </div>
               <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label >Does your School/ECCD/ECR use Internet Connection shared from Gewog/Community center/Dzongkhag?<span class="text-danger">*</span> </label>
                    </div>
               </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label><input  type="radio" v-model="form.sharedconnection" value="1" tabindex="" @click="showtextboxS('yes')"/> Yes</label>
                        <label><input  type="radio" v-model="form.sharedconnection" value="0" tabindex="" @click="showtextboxS('no')"/> No</label>
                        <has-error :form="form" field="sharedconnection"></has-error>
                    </div>
                </div>
                <div class="form-group row" style="display:none" id="sharedconnection">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <label>Specify the Connection Type<span class="text-danger">*</span></label>
                       <input type="text" class="form-control" @change="removeerror('connectionsharedtype')" :class="{ 'is-invalid': form.errors.has('connectionsharedtype') }" id="connectionsharedtype" v-model="form.connectionsharedtype" >
                       <has-error :form="form" field="connectionsharedtype"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                       <label>Speed/Bandwidth<span class="text-danger">*</span></label>
                       <input type="text" class="form-control" @change="removeerror('sharedspped')" :class="{ 'is-invalid': form.errors.has('sharedspped') }" id="sharedspped" v-model="form.sharedspped" >
                       <has-error :form="form" field="sharedspeed"></has-error>
                    </div>    
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Internet Accessible to:</label><br>
                        <label  v-for="(item, key, index) in  internetAccessibleList" :key="index" class="pr-4">
                            <input  type="checkbox" v-model="form.internetAccessible" :value="item.id" tabindex=""/> 
                            {{item.name}}
                        </label>
                    </div>
                </div>
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
                      <label><input  type="radio" v-model="form.electricity" value="1" tabindex="" /> Yes</label>
                      <label><input  type="radio" v-model="form.electricity" value="0" tabindex=""/> No</label>
                      <has-error :form="form" field="electricity"></has-error>
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
             roadTypeList:[],
             internetAccessibleList:[],
             connection_type_list:[],
             serviceProviderList1:[],
           
            form: new form({
                id: '', 
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
                sharedspeed:'',
                internetAccessible:'',
                electricity:'',
                electricitysubstation:'',
               
            })
        }
    },

    methods:{

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

        /**
         * method to reset form
         */
        restForm(){
            this.form.id='',
            this.form.connectedtoroad= '';
            this.form.road_typeyes = '';
            this.form.road_typeno = '';
            this.form.hqdistance= '';
            this.form.connectedtointernet= '';
            this.form.connectiontype= '';
            this.form.serviceprovider= '';
            this.form.speedbandwidth='';
            this.form.DrukREN = '';
            this.form.GovNET = '';
            this.form.independent = '';
            this.form.sharedconnection = '';
            this.form.connectionsharedtype = '';
            this.form.sharedspeed = '';
            this.form.internetAccessible = '';
            this.form.electricity = '';
            this.form.electricitysubstation = '';
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/organization/saveConnectivityDetails',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: ' Detail is added successfully'
                    })
                    this.$router.push('/list_connectivity');
                })
                .catch(() => {
                    console.log("Error......");
                    this.applyselect();
                })
            }
		},
        showtextbox:function(type){
         if(type=="Yes"){
             $('#roadtypeyes').show();
             $('#roadtypeno').hide(); 
            }
            else if(type=="No"){
             $('#roadtypeno').show();
             $('#roadtypeyes').hide();
            }
            else{
             $('#roadtypeyes').hide();
             $('roadtypeno').show();
            }
        },
      
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
        // async changefunction(id){
        //     if($('#'+id).val()!=""){
        //         $('#'+id).removeClass('is-invalid select2');
        //         $('#'+id+'_err').html('');
        //         $('#'+id).addClass('select2');
        //     }
        //     if(id=="sex_id"){
        //         this.form.sex_id=$('#sex_id').val();
        //     }
        //     if(id=="mother_tongue"){
        //         this.form.mother_tongue=$('#mother_tongue').val();
        //     }
        //     if(id=="country"){
        //         this.form.country=$('#country').val();
        //     }
             
        // },
        
    },
     mounted() { 
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
     created() {
        this.form.connectedtoroad=this.$route.params.data.connectedtoroad;
        this.form.road_typeyes=this.$route.params.data.road_typeyes;
        this.form.road_typeno=this.$route.params.data.road_typeno;
        this.form.hqdistance=this.$route.params.data.hqdistance;
        this.form.connectedtointernet=this.$route.params.data.connectedtointernet;
        this.form.connectiontype=this.$route.params.data.connectiontype;
        this.form.serviceprovider=this.$route.params.data.serviceprovider;
        this.form.speedbandwidth=this.$route.params.data.speedbandwidth;
        this.form.DrukREN=this.$route.params.data.DrukREN;
        this.form.GovNET=this.$route.params.data.GovNET;
        this.form.independent=this.$route.params.data.independent;
        this.form.sharedconnection=this.$route.params.data.sharedconnection;
        this.form.connectionsharedtype=this.$route.params.data.connectionsharedtype;
        this.form.sharedspeed=this.$route.params.data.sharedspeed;
        this.form.internetAccessible=this.$route.params.data.internetAccessible;
        this.form.electricity=this.$route.params.data.electricity;
        this.form.electricitysubstation=this.$route.params.data.electricitysubstation;
        this.form.id=this.$route.params.data.id;
    },
}
</script>