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
                        <input type="hidden" class="form-control" v-model="form.id"/>
                        <div class="card-body">
                            <div class="form-group row" >  
                                <label class="col-md-7 ">ZEST Working Agency Code:<span class="text-danger">*</span></label>
                                <div class="input-group mb-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" id="workingAgencyCode" class="col-md-4 form-control editable_fields" @change="removeerror('workingAgencyCode','workingAgencyCode_error')"/>
                                    <div class="input-group-append">
                                        <span type="button" class="col-md-12 btn  btn-primary" @click="getOrgDetais()"><i class="fa fa-search">&nbsp;Search</i></span>
                                    </div>
                                </div>
                                <span id="workingAgencyCode_error" class="text-danger"></span>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="school1" style="display:none">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Working Agency Code:</label>
                                        <span class="text-indigo-600" id="scode">00020292</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Agency Name:</label>
                                        <span class="text-indigo-600" id="scode">SEN Department</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Parent Agency:</label>
                                        <span class="text-indigo-600" id="scode">MOE</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Dzongkhag:</label>
                                        <span class="text-indigo-600" id="scode">Thimphu</span>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Gewog:</label>
                                        <span class="text-indigo-600" id="scode">Thimphu throm</span>
                                    </div>
                                </div>

                                <div class="form-group" >    
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                                        <label class="col-md-7 ">Agency Type:<span class="text-danger">*</span></label>
                                        <select name="agencyType" id="agencyType" class="form-control editable_fields" @change="removeerror('agencyType','agencyType_error')">
                                                <option value="">--- Please Select ---</option>
                                                <option value="1">Agency in HQ</option>
                                                <option value="2">Dzongkhag Education Office</option>
                                        </select>
                                    </div> 
                                    <span id="workingAgencyCode_error" class="text-danger"></span>
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
                                    <tr id="record1" v-for='(user, index) in users' :key="index">
                                        <td>
                                            <select name="names" id="names" class="form-control editable_fields" v-model="user.names">
                                                <option value="">--- Please Select ---</option>
                                                <option value="principalOffice">Head Quater</option>
                                                <option value="generalOffice">General Office</option>
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
             users:
            [{
                names:'',phone:'',fax:'',mobile:'',email:''
            }] ,
            form: new form({
                id: '',proposedName:'',level:'',category:'1',dzongkhag:'',gewog:'',chiwog:'',locationType:'',
                geopolicaticallyLocated:'0',senSchool:'0',parentSchool:'',coLocatedParent:'0',cid:'',name:'',
                phoneNo:'',email:'',status:'pending'
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
            this.users.push({names:'',phone:'',fax:'',mobile:'',email:''})
        },

        remove(index){    
             this.users.splice(index,1);             
        },

        /** method to get HQ and Dzongkhag Office based on code */
        getOrgDetais: function(){
            if($('#workingAgencyCode').val()==""){
                $('#workingAgencyCode_error').html('Please enter zest working agency code.');
                $('#workingAgencyCode').focus();
                $('#workingAgencyCode').removeClass('is-invalid');
            }else{
                $("#agencyCode").val(2222);
                $("#workingAgencyCode").val(2222);
                $("#agencyName").val("SEN Department");
                $("#parentAgency").val("MOE");
                $("#dzongkhag").val("Thimphu");
                $("#gewog").val("Chang");
                $("#school1").show();
            }
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
                        this.classStreamForm.post('organization/saveClassStream')
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Establishment is saved successfully'
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
                     this.form.post('organization/saveEstablishment',this.form)
                     
                    .then(() => {
                        
                    })
                    .catch(() => {
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

    },

    created(){
        
    },
    
    mounted() {
       
       
    },
}
</script>
