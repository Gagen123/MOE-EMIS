<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Basic Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item contact-tab" @click="shownexttab('contact-tab')">
                        <a class="nav-link" data-toggle="pill" role="tab">
                            <label class="mb-0.5">Contact Details </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="card-body">
                            <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                            <input type="hidden" class="form-control" v-model="form.organizationId"/>
                            <div class="form-group row" >  
                                <label class="col-md-7 ">ZEST Working Agency Code:<span class="text-danger">*</span></label>
                                <div class="input-group mb-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="workingAgencyCode" class="col-md-4 form-control" v-model="form.workingAgencyCode"/>
                                        <div class="input-group-append">
                                            <span type="button" class="col-md-12 btn btn-primary" @click="getOrgDetais(),remove_error('workingAgencyCode')"><i class="fa fa-search">&nbsp;Search</i></span>
                                        </div>
                                </div>
                                <has-error :form="form" field="workingAgencyCode"></has-error>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showDetails">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Working Agency Code:</label>
                                        <input type="text" class="form-control" v-model="form.agencyCode"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Department:</label>
                                         <select v-model="form.department" :class="{ 'is-invalid': form.errors.has('department') }" class="form-control select2" name="department" id="department">
                                            <option value="">--- Please Select ---</option>
                                            <option value="Directorate">Directorate</option>
                                            <option value="Department of School Education">Department of School Education</option>
                                            <option value="Policy And Planning Division">Policy And Planning Division</option>
                                            <option value="Human Resource Division">Human Resource Division</option>
                                        </select> 
                                        <!-- <input type="text" class="form-control" v-model="form.parentAgency"/> -->
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Agency Name:</label>
                                        <input type="text" class="form-control" v-model="form.agencyName"/>
                                    </div>
                                   
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Dzongkhag:</label>
                                        <select v-model="form.dzongkhag" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select> 
                                        <has-error :form="form" field="dzongkhag"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Gewog:</label>
                                        <select v-model="form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="gewog"></has-error>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Chiwog:</label>
                                        <select v-model="form.chiwog" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('chiwog') }" class="form-control select2" name="chiwog" id="chiwog">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error :form="form" field="chiwog"></has-error>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                        <label class="col-md-7 ">Agency Type:<span class="text-danger">*</span></label>
                                        <select name="agencyType" id="agencyType" v-model="form.agencyType" class="form-control" :class="{ 'is-invalid': form.errors.has('agencyType') }" @change="remove_error('agencyType')">
                                            <option value="">--- Please Select ---</option>
                                            <option value="1">Agency in HQ</option>
                                            <option value="2">Dzongkhag Education Office</option>
                                        </select>
                                        <has-error :form="form" field="agencyType"></has-error>
                                    </div> 
                                </div>
                            </div>
                        </div>    
                    <hr>
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" @click="shownexttab('contact-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                    </div>
                    
                    <div class="tab-pane fade tab-content-details" id="contact-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="contactDetails" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name/Description</th>
                                        <th>Phone</th>
                                        <th>Mobile</th>
                                        <th>Email</th>                            
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="record1" v-for='(contact, index) in form1.contacts' :key="index">
                                        <td>
                                            <select name="name" id="name" class="form-control" v-model="contact.names" :class="{ 'is-invalid': form1.errors.has('spo_name') }">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in contactTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                        </td>
                                        <td>                                
                                            <input type="text" name="phone" class="form-control" v-model="contact.phone"/>
                                        </td>
                                        <td>                                
                                            <input type="text" name="mobile" class="form-control" v-model="contact.mobile"/>
                                        </td>
                                        <td>                                
                                            <input type="text" name="email" class="form-control" v-model="contact.email"/>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan="5"> 
                                            <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                            @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                            <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore" 
                                            @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                        </td>
                                    </tr>                                          
                                </tbody>
                            </table>
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
            contactTypeList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[],
            form: new form({
                id: '',organizationId:'',workingAgencyCode:'',agencyCode:'',agencyName:'',parentAgency:'',dzongkhag:'',
                gewog:'',chiwog:'',agencyType:'',status:'pending',department:''
            }),

            form1: new form({
                id: '',organizationId:'',
                contacts:
                [{
                    names:'',phone:'',mobile:'',email:''
                }] ,
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

        addMore: function(){
            this.form1.contacts.push({names:'',phone:'',fax:'',mobile:'',email:''})
        },

        remove(index){    
             this.form1.contacts.splice(index,1);             
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
                console.log("Error:"+error)
            });
        },

        /**
         * method to get gewog list
         */
        getgewoglist(id){
            let dzoId=$('#dzongkhag').val();
            if(id!="" && (dzoId==null || dzoId=="")){
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
            if(id!="" && (gewogId==null || gewogId=="")){
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
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            
            if(id=="dzongkhag"){
                this.form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist();
            }
            if(id=="gewog"){
                this.form.gewog=$('#gewog').val();
                this.getvillagelist();
            }
            if(id=="chiwog"){
                this.form.chiwog=$('#chiwog').val();
            }
            if(id=="department"){
                this.form.department=$('#department').val();
            }
            
        },

        applyselect2(){
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#chiwog').attr('class').includes('select2-hidden-accessible')){
                $('#chiwog').addClass('select2-hidden-accessible');
            }
        },


        /** method to get HQ and Dzongkhag Office based on code */
        getOrgDetais: function(){
            if($('#workingAgencyCode').val()==""){
                $('#workingAgencyCode_error').html('Please enter zest working agency code.');
                $('#workingAgencyCode').focus();
                $('#workingAgencyCode').removeClass('is-invalid');
            }else{
                this.form.agencyCode                = '00001';
                this.form.agencyName                = 'SPPD';
                this.form.parentAgency              = 'MOE';
                this.form.dzongkhag                 =  1;
                $('#dzongkhag').val(1).trigger('change');
                this.getgewoglist(1);
                this.form.gewog                     = 1;
                this.getvillagelist(1);
                this.form.chiwog                    = 1;
            }
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
         * method to show next tab
         */
        shownexttab(nextclass){ 
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to safe this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form1.post('organization/saveContactDetails')
                        .then(() => {
                            let message="Head Quater details has been added: <br><b>Thank You !</b>";
                            this.$router.push({name:'estb_acknowledgement',params: {data:message}});
                            Toast.fire({
                                icon: 'success',
                                title: 'Data is saved successfully'
                            })
                        })
                        .catch(() => {
                            console.log("Error......")
                        })
                    }
                });
            }
            else{
                if(nextclass=="contact-tab"){
                    this.form.post('organization/saveBasicDetails')
                    .then((response) => {
                        this.form1.organizationId=response.data.data.id;
                        Toast.fire({
                            icon: 'success',
                            title: 'Data is saved successfully'
                        })
                        this.change_tab(nextclass);
                    })
                    .catch((ex) => {
                        this.change_tab('organization-tab');
                        console.log("Error......" + ex)
                    })
                }
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

        getScreenAccess(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data.acess_level;
                if(data != "Ministry"){
                    $('#mainform').hide();
                    $('#screenPermission').show();
                    $('#existmessage').html('You have no access to this page.');
                }
                
            })    
            .catch(errors => { 
                console.log(errors)
            });
        },

        /**
         * method to load organization details
         */
         loadBasicDetails(){
            axios.get('organization/loadBasicDetails')
            .then((response) => {  
                let data=response.data.data;
                this.form.id  =   data.id;
                this.form.agencyCode = data.zestAgencyCode;
                this.form.agencyName = data.agencyName;
                this.form.agencyType = data.organizationType;
                this.form.workingAgencyCode = data.zestAgencyCode;
                
                $('#dzongkhag').val(response.data.data.dzongkhagId).trigger('change');
                this.form.dzongkhag = response.data.data.dzongkhagId;
                this.getgewoglist(response.data.data.dzongkhagId);
                this.form.gewog = response.data.data.gewogId;
                this.getvillagelist(response.data.data.gewogId);
                this.form.chiwog = response.data.data.chiwogId;
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },

    },

       
    mounted() {
        // this.getScreenAccess();
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
        this.loadactivedzongkhagList();
        this.getContactTypeDropdown();
        this.loadBasicDetails();
    },
}
</script>