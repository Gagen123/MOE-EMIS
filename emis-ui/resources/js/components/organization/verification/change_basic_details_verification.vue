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
                            <label class="mb-0.5">Classes & Streams </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label><u>Previous Details</u></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:</label>
                                <span class="text-indigo-600">Yangchenphug HSS</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Level:</label>
                                <span class="text-indigo-600">Middle Secondary School</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Category:</label>
                                <span class="text-indigo-600">Public School</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Dzongkhag:</label>
                                <span class="text-indigo-600">Thimphu</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Gewog:</label>
                                <span class="text-indigo-600">Thimthrom</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Chiwog:</label>
                                <span class="text-indigo-600">Thimthrom</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Location Type:</label>
                                <span class="text-indigo-600">Urban grade 1</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Geopolitically Located:</label>
                                <span class="text-indigo-600">No</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>SEN School:</label>
                                <span class="text-indigo-600">No</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Co-located with Parent School:</label>
                                <span class="text-indigo-600">No</span>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label><u>Application Details</u></label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:</label>
                                <span class="text-indigo-600">Yangchenphug HSS</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Level:</label>
                                <span class="text-indigo-600">Higher Secondary School</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Category:</label>
                                <span class="text-indigo-600">Public School</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Dzongkhag:</label>
                                <span class="text-indigo-600">Thimphu</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Gewog:</label>
                                <span class="text-indigo-600">Thimthrom</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Chiwog:</label>
                                <span class="text-indigo-600">Thimthrom</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Location Type:</label>
                                <span class="text-indigo-600">Urban grade 1</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Geopolitically Located:</label>
                                <span class="text-indigo-600">No</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>SEN School:</label>
                                <span class="text-indigo-600">No</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Co-located with Parent School:</label>
                                <span class="text-indigo-600">No</span>
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
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label><u>Previous Details</u></label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;PP</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;I</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;II</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;III</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;IV</label></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;V</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VI</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VII</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VIII</label></li>
                                            <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;IX</label></li>
                                            
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;X</label></li>
                                            <li><input type="checkbox"  id="xlsection_check" @click="showchild('xlsection')"><label> &nbsp;&nbsp;&nbsp;XI</label></li>
                                            <ul id="xlsection" style="display:none"  class="pl-4">
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                            </ul>
                                           <li><input type="checkbox"  id="xlisection_check" @click="showchild('xlisection')"><label> &nbsp;&nbsp;&nbsp;XII</label></li>
                                            <ul id="xlisection" style="display:none" class="pl-4">
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label><u>Application Details</u></label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;PP</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;I</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;II</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;III</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;IV</label></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;V</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VI</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VII</label></li>
                                            <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VIII</label></li>
                                            <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;IX</label></li>
                                            
                                        </ul>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <ul>
                                            <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;X</label></li>
                                            <li><input type="checkbox" checked id="xlsection_check" @click="showchild('xlsection')"><label> &nbsp;&nbsp;&nbsp;XI</label></li>
                                            <ul id="xlsection"   class="pl-4">
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                            </ul>
                                           <li><input type="checkbox" checked id="xlisection_check" @click="showchild('xlisection')"><label> &nbsp;&nbsp;&nbsp;XII</label></li>
                                            <ul id="xlisection"  class="pl-4">
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Remarks</label>
                                <textarea class="form-control" id="remarks"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('organization-tab')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-flat btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                                <button class="btn btn-flat btn-primary" @click="shownexttab('verify')"> <i class="fa fa-forward"></i>Verify </button>
                                <button class="btn btn-flat btn-dark" @click="shownexttab('approve')"> <i class="fa fa-check"></i>Approve </button>
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

        }
    },

    methods:{
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
                        this.form.post('organization/saveBifurcation')
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Bifurcation details is saved successfully'
                            })
                    })
                        .catch(() => {
                            console.log("Error......")
                     })
                    }
                });
            }
            else{
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
    }
}
</script>