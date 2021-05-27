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
                            </div>
                            <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Name:<span class="text-danger">*</span></label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" v-model="form.proprietorName" :class="{ 'is-invalid': form.errors.has('proprietorName') }" @change="remove_error('proprietorName')" class="form-control" id="proprietorName" placeholder="Proprietor Name"/>
                                <has-error :form="form" field="proprietorName"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">CID:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="number" v-model="form.proprietorCid" :class="{ 'is-invalid': form.errors.has('proprietorCid') }" @change="remove_error('proprietorCid')" class="form-control" id="proprietorCid" placeholder="CID No."/>
                                    <has-error :form="form" field="proprietorCid"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Contact Information:<span class="text-danger">*</span></label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" v-model="form.proprietorPhone" :class="{ 'is-invalid': form.errors.has('proprietorPhone') }" @change="remove_error('proprietorPhone')" class="form-control" id="proprietorPhone" placeholder="Phone No" />
                                    <has-error :form="form" field="proprietorPhone"></has-error>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="number" v-model="form.proprietorMobile" :class="{ 'is-invalid': form.errors.has('proprietorMobile') }" @change="remove_error('proprietorMobile')" class="form-control" id="proprietorMobile" placeholder="Mobile No"/>
                                    <has-error :form="form" field="proprietorMobile"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Email:<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" v-model="form.proprietorEmail" :class="{ 'is-invalid': form.errors.has('proprietorEmail') }" @change="remove_error('proprietorEmail')" class="form-control" id="proprietorEmail" placeholder="Email"/>
                                    <has-error :form="form" field="proprietorEmail"></has-error>
                                </div>
                            </div>
                            </form>
                            <hr>
                            <div class="row form-group fa-pull-right">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary" @click="shownexttab('final-tab')">Save </button>
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
            orgList:'',
            levelList:[],
            locationList:[],
            dzongkhagList:[],
            gewog_list:[],
            villageList:[], 
            classList1:[],
            streamList1:[],
            classList:[],
            streamList:[],
            form: new form({
                organizationId:'',proprietorName:'',proprietorCid:' ', proprietorPhone:'', proprietorMobile:'', proprietorEmail:'',
                application_type:'proprietor_change', application_for:'Change in Proprietor', action_type:'add', status:'pending',organization_type:'',
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

        getOrgList(uri = '/organization/getOrgList'){
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
                                        title: 'Technical Errors: please contact system admimnistrator for further details'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Applicaiton for Change basic details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                    this.$router.push({name:'restr_acknowledgement',params: {data:message}});
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
                this.form.organization_type=response.data.data.organizationType;
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
        
        this.getOrgList();
    }
}
</script>
