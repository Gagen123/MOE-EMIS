<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs" id="mainform">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Change Name of Organization</label>                              
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                            <form class="form-horizontal">
                            <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Organization Name:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <select name="organizationId" v-model="form.organizationId" :class="{ 'is-invalid': form.errors.has('organizationId') }" id="organizationId" class="form-control select2" @change="remove_error('organizationId')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="organizationId"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label>Org Type: {{form.category}}</label>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Current Name:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" readonly :value="organization_details.name"  class="form-control" id="proposedName"/>
                                </div>
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Level:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" readonly :value="levelArray[organization_details.levelId]"  class="form-control" id="proposedName"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label>Dzongkhag:</label>
                                    <input type="text" readonly :value="dzongkhagArray[organization_details.dzongkhagId]"  class="form-control" id="proposedName"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label>Gewog:</label>
                                    <input type="text" readonly  class="form-control" id="gewogid"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label>Village:</label>
                                    <input type="text" readonly class="form-control" id="proposedName"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposal Initiated By:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <select name="initiatedBy" id="initiatedBy" v-model="form.initiatedBy" :class="{ 'is-invalid': form.errors.has('initiatedBy') }" class="form-control" @change="remove_error('initiatedBy')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in proposed_by_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="initiatedBy"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Proposed Name:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_error('proposedName')" class="form-control" id="proposedName" placeholder="Proposed Name"/>
                                    <has-error :form="form" field="proposedName"></has-error>
                                </div>
                            </div>
                            </form>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" @click="shownexttab('final-tab')">Submit </button>
                                </div>
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
            organization_details:'',
            proposed_by_list:[],
            levelArray:{},
            dzongkhagArray:{},
            gewogArray:{},
            villageArray:{},
            orgList:'',
            classList:[],
            streamList:[],
            form: new form({
                organizationId:'',proposedName:'',initiatedBy:' ', application_type:'name_change', 
                application_for:'Change in Name', action_type:'add', status:'pending',organization_type:'',
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
        

        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
            });
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
                        this.form.post('organization/saveChangeBasicDetails')
                        .then((response) => {
                            if(response!=""){
                                if(response.data=="No Screen"){
                                    Toast.fire({  
                                        icon: 'error',
                                        title: 'No dont have privileged to submit this application. Please contact system administrator'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Applicaiton for Change basic details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                    this.$router.push({name:'name_change_acknowledgement',params: {data:message}});
                                    Toast.fire({  
                                        icon: 'success',
                                        title: 'Change details is saved successfully'
                                    });
                                }
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err)
                        })
                    }
                });
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

        /**
         * method to populate dropdown
         */
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="organizationId"){
                this.form.organizationId=$('#organizationId').val();  
                this.getorgdetials($('#organizationId').val()); 
            }
            
        },
        getorgdetials(org_id){
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                // this.form.organization_type=response.data.data.organizationType;
                this.organization_details=response.data.data;
                this.getGewogList(response.data.data.dzongkhagId,response.data.data.gewogId);
                this.getvillagelist(response.data.data.gewogId,response.data.data.chiwogId);
            });
        },
        
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
        
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name; 
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        getGewogList(dzongkhag,gewogId){
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzongkhag;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.gewogArray[data[i].id] = data[i].name; 
                }
                $('#gewogId').val(this.gewogArray[gewogId]);
            });
        },

        getvillagelist(gewogId,vil_id){
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.length;i++){
                    this.villageArray[data[i].id] = data[i].name; 
                }
                $('#gewogId').val(this.gewogArray[gewogId])
                if(vil_id!=""){
                    this.form.chiwog=draft.chiwogId;
                    $('#chiwog').val(draft.chiwogId).trigger('change');;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
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
        },
        loadproposedBy(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ProposedBy'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.proposed_by_list =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        
    },
    
    mounted() { 
        this.loadproposedBy();
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
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.form.organizationId=data['Agency_Code'];
                this.getorgdetials(data['Agency_Code']);
                $('#organizationId').val(data['Agency_Code']).trigger('change');
            }
        })    
        .catch(errors => { 
            console.log(errors)
        });
    }
}
</script>
