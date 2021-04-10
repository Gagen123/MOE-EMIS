<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item organization-tab" @click="shownexttab('organization-tab')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-0.5">Basic Details </label>                              
                        </a>
                    </li>
                    <li class="nav-item class-tab" @click="shownexttab('class-tab')">
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
                                    <input type="text" id="workingAgencyCode" class="col-md-4 form-control"/>
                                        <div class="input-group-append">
                                            <span type="button" class="col-md-12 btn btn-primary" @click="getOrgDetais(),remove_error('workingAgencyCode')"><i class="fa fa-search">&nbsp;Search</i></span>
                                        </div>
                                </div>
                                <has-error :form="form" field="workingAgencyCode"></has-error>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showDetails" style="display:none">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Working Agency Code:</label>
                                        <span class="text-indigo-600" id="agencyCode">{{form.agencyCode}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Agency Name:</label>
                                        <span class="text-indigo-600" id="agencyName">{{form.agencyName}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Parent Agency:</label>
                                        <span class="text-indigo-600" id="parentAgency">{{form.agencyName}}</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Dzongkhag:</label>
                                        <span class="text-indigo-600" id="dzongkhag">{{form.dzongkhag}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Gewog:</label>
                                        <span class="text-indigo-600" id="gewog">{{form.gewog}}</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Chiwog:</label>
                                        <span class="text-indigo-600" id="chiwog">{{form.chiwog}}</span>
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
                            <button class="btn btn-primary" @click="shownexttab('class-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                    </div>
                    
                    <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="contactDetails" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name/Description</th>
                                        <th>Phone</th>
                                        <th>Fax</th>
                                        <th>Mobile</th>
                                        <th>Email</th>                            
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="record1" v-for='(user, index) in form1.users' :key="index">
                                        <td>
                                            <select name="name" id="name" class="form-control" v-model="user.names" :class="{ 'is-invalid': form1.errors.has('spo_name') }">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in contactTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                        </td>
                                        <td>                                
                                            <input type="text" name="phone" class="form-control" v-model="user.phone"/>
                                        </td>
                                        <td>                                
                                            <input type="text" name="fax" class="form-control" v-model="user.fax"/>
                                        </td>
                                        <td>                                
                                            <input type="text" name="mobile" class="form-control" v-model="user.mobile"/>
                                        </td>
                                        <td>                                
                                            <input type="text" name="email" class="form-control" v-model="user.email"/>
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
            form: new form({
                id: '',organizationId:'',agencyCode:'',agencyName:'',parentAgency:'',dzongkhag:'',
                gewog:'',chiwog:'',agencyType:'',status:'pending'
            }),

            form1: new form({
                id: '',organizationId:'',
                users:
                [{
                    names:'',phone:'',fax:'',mobile:'',email:''
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
            this.form1.users.push({names:'',phone:'',fax:'',mobile:'',email:''})
        },

        remove(index){    
             this.form1.users.splice(index,1);             
        },

        /** method to get HQ and Dzongkhag Office based on code */
        getOrgDetais: function(){
            if($('#workingAgencyCode').val()==""){
                $('#workingAgencyCode_error').html('Please enter zest working agency code.');
                $('#workingAgencyCode').focus();
                $('#workingAgencyCode').removeClass('is-invalid');
            }else{
                this.form.agencyCode = '00001';
                this.form.agencyName = 'SPPD';
                this.form.parentAgency = 'MOE';
                this.form.dzongkhag = 'Thimphu';
                this.form.gewog = 'Chang';
                this.form.chiwog = 'Chang';
                $("#showDetails").show();
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
                if(nextclass=="class-tab"){
                     this.form.post('organization/saveBasicDetails')
                     
                    .then(() => {
                        Toast.fire({
                                icon: 'success',
                                title: 'Data is saved successfully'
                            })
                            this.change_tab(nextclass);
                    })
                    .catch(() => {
                        this.change_tab('organization-tab');
                        console.log("Error......")
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

        /**
         * method to load organization details
         */
         loadBasicDetails(){
            axios.get('organization/loadBasicDetails')
            .then((response) => {  
                let data=response.data.data;
                if(data != null){
                    $("#showDetails").show();
                    this.form.id  =   data.id;
                    this.form.agencyCode  =   data.zestAgencyCode;
                    this.form.agencyName  =   data.agencyName;
                    this.form.chiwog  =   data.chiwogId;
                    this.form.agencyType  =   data.organizationType;
                }
            })
            .catch((error) => {  
                console.log("Error......"+error);
            });
        },
    },

       
    mounted() {
        this.getContactTypeDropdown();
        this.loadBasicDetails();
    },
}
</script>
