<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-details-tabs" @click="shownexttab('','personal-details-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label> School Details </label>                              
                        </a> 
                    </li>
                    <li class="nav-item appointment-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('personal-details-tabs','appointment-tab')" role="tab">
                            <label> Merge the schools</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>1st School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="organization1" id="organization1" class="form-control" @change="getSchoolDetails()">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">YHSS</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>2nd School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="organization2" id="organization2" class="form-control" @change="getSchool2Details()">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">MHSS</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Year of Merger:</label>
                                <input type="text" class="form-control" id="yearOfMerger"/>
                            </div>                                                                                          
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school1" style="display:none">
                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">School/ECR/ECCD 1</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Code:</label>
                                                <span class="text-indigo-600" id="scode">00020292</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Name:</label>
                                                <span class="text-indigo-600" id="sname">YangchenPhug HSS</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Category:</label>
                                                <span class="text-indigo-600" id="scategory">Public</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Level:</label>
                                                <span class="text-indigo-600" id="slevel">Higher Secondary School</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag:</label>
                                                <span class="text-indigo-600" id="sdzongkhag">Thimphu</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Gewog:</label>
                                                <span class="text-indigo-600" id="sgewog">Thimthrom</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Chiwog:</label>
                                                <span class="text-indigo-600" id="schiwog">Yangchenphug</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Location Type:</label>
                                                <span class="text-indigo-600" id="slocationtype">Urban grade 1</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Geopolitically Located:</label>
                                                <span class="text-indigo-600" id="sgeo">No</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>SEN School:</label>
                                                <span class="text-indigo-600" id="ssen">No</span>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Co-located with Parent School:</label>
                                                <span class="text-indigo-600" id="ccolocated"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Parent School:</label>
                                                <span class="text-indigo-600" id="cparent"></span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="school2" style="display:none">
                                <div class="card card-warning card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">School/ECR/ECCD 2</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Code:</label>
                                                <span class="text-indigo-600" id="ccode">00020299</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Name:</label>
                                                <span class="text-indigo-600" id="cname">Motithang HSS</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Level:</label>
                                                <span class="text-indigo-600" id="ccategory">Higher Secondary School</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Category:</label>
                                                <span class="text-indigo-600" id="clevel">Public</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Dzongkhag:</label>
                                                <span class="text-indigo-600" id="cdzongkhag">Thimthrom</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Gewog:</label>
                                                <span class="text-indigo-600" id="cgewog">Thimthrom</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Chiwog:</label>
                                                <span class="text-indigo-600" id="cchiwog">Mothithang</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Location Type:</label>
                                                <span class="text-indigo-600" id="clocationtype">Urban grade 1</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Geopolitically Located:</label>
                                                <span class="text-indigo-600" id="cgeo">No</span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>SEN School:</label>
                                                <span class="text-indigo-600" id="csen">No</span>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Co-located with Parent School:</label>
                                                <span class="text-indigo-600" id="ccolocated"></span>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <label>Parent School:</label>
                                                <span class="text-indigo-600" id="cparent"></span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn  btn-primary" @click="shownexttab('personal-details-tabs','appointment-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade tab-content-details" id="appointment-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name"/>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Level:<span class="text-danger">*</span></label>
                                <select name="category" id="level" class="form-control">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">Higher Secondary School</option>
                                    <option value="2">Middle Secondary School</option>
                                    <option value="3">Lower Secondary School</option>
                                    <option value="4">Primary School</option>
                                    <option value="5">ECR</option>
                                    <option value="6">ECCD</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Category:<span class="text-danger">*</span></label>
                                <br>
                                <input type="radio" name="category" @change="showprivatedetails('public')" value="Public"> Public
                                <input type="radio" name="category" @change="showprivatedetails('private')" value="Private"> Private
                                <span id="othercategoryforeccd"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Dzongkhag:<span class="text-danger">*</span></label>
                                <select name="dzongkhag" id="dzongkhag" class="form-control">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">Thimphu</option>
                                    <option value="2">Paro</option>
                                    <option value="3">punakha</option>
                                    <option value="4">Lhuntse</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Gewog:<span class="text-danger">*</span></label>
                                <select name="category" id="gewog" class="form-control">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">Kabisa</option>
                                    <option value="2">Babesa</option>
                                    <option value="3">Motithang</option>
                                    <option value="4">Chubachu</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Chiwog:<span class="text-danger">*</span></label>
                                <select name="category" id="chiwog" class="form-control">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">olakha</option>
                                    <option value="2">chngbandu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Location Category:</label>
                                <select name="category" id="locationCategory" class="form-control">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">Kabisa</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Geopolitically Located:</label>
                                <br>
                                <input type="radio" name="geoLocated" value="Yes"> Yes
                                <input type="radio" name="coLocatedParent" value="No" > No
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>SEN School:<span class="text-danger">*</span></label>
                                <br>
                                <input type="radio" name="senSchool" value="Yes"> Yes
                                <input type="radio" name="senSchool" value="No" > No
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Parent School:</label>
                                <select name="category" id="parentSchool" class="form-control">
                                    <option value="">--- Please Select ---</option>
                                    <option value="1">Kabisa</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Co-located with Parent School:</label>
                                <br>
                                <input type="radio" name="coLocated" value="Yes"> Yes
                                <input type="radio" name="coLocated" value="No" > No
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select classes and streams</label>
                            </div>
                        </div>
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
                                    <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;IX</label></li>
                                    
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <ul>
                                    <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;X</label></li>
                                    <li><input type="checkbox" id="xlsection_check" @click="showchild('xlsection')"><label> &nbsp;&nbsp;&nbsp;XI</label></li>
                                    <ul id="xlsection"  style="display:none" class="pl-4">
                                        <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                        <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                        <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                    </ul>
                                   <li><input type="checkbox" id="xlisection_check" @click="showchild('xlisection')"><label> &nbsp;&nbsp;&nbsp;XII</label></li>
                                    <ul id="xlisection" style="display:none" class="pl-4">
                                        <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                        <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                        <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                    </ul>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn  btn-success" @click="shownexttab('','personal-details-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn  btn-primary" @click="shownexttab('appointment-tab','final-tab')"> <i class="fa fa-save"></i>Submit </button>
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
        getSchoolDetails: function(){
            $('#school1').show();
        },
        getSchool2Details: function(){
            $('#school2').show();
        },
        shownexttab(presentclass,nextclass){  
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            //body
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
            if(nextclass=="final-tab"){ 
                Swal.fire({
                    text: "Are you sure you wish to submit the form detials?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Success!',
                            'Details has been saved successfully.',
                            'success',
                        )
                        window.location.reload();
                        // this.$router.push('/');
                    }
                });
            }
        },
        showchild(type){
            if($('#'+type+'_check').prop('checked')){
                $('#'+type).show();
            }
            else{
                $('#'+type).hide();
            }
        },
    }
}
</script>