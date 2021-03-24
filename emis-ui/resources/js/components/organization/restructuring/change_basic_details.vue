<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-details-tabs" @click="shownexttab('','personal-details-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label> Basic Details </label>                              
                        </a> 
                    </li>
                    <li class="nav-item appointment-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('personal-details-tabs','appointment-tab')" role="tab">
                            <label> Classes and Streams</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="">
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Code:</label>
                                            <input type="text" class="form-control" id="afterChangeCode" value="01001.1010.21"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Level:</label>
                                            <select name="category" id="afterChangeLevel" class="form-control">
                                                <option value="1">Higher Secondary School</option>
                                                <option value="2">Middle Secondary School</option>
                                                <option value="3">Lower Secondary School</option>
                                                <option value="4">Primary School</option>
                                                <option value="5">ECR</option>
                                                <option value="6">ECCD</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Category:</label><br>
                                            <input type="radio" name="category" value="Public" checked> Public
                                            <input type="radio" name="category" value="Private"> Private
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Name:</label>
                                            <input type="text" class="form-control" value="Yangchenphug HSS" id="afterChangeName"/>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Dzongkhag:</label>
                                            <select name="dzongkhag" id="afterChangeDzongkhag" class="form-control">
                                                <option value="1">Thimphu</option>
                                                <option value="2">Paro</option>
                                                <option value="3">punakha</option>
                                                <option value="4">Lhuntse</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Gewog:</label>
                                            <select name="category" id="afterChangeGewog" class="form-control">
                                                <option value="1">Thimthrom</option>
                                                <option value="2">Babesa</option>
                                                <option value="3">Motithang</option>
                                                <option value="4">Chubachu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Chiwog:</label>
                                            <select name="category" id="afterChangeChiwog" class="form-control">
                                                <option value="1">Thimthrom</option>
                                                <option value="2">chngbandu</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Location Type:</label>
                                            <select name="locationCategory" id="locationCategory" class="form-control editable_fields" @change="removeerror('locationCategory','locationCategory_error')">
                                                <option value="1">Urban Grade 1</option>
                                                <option value="1">Urban Grade 2</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Geopolitically Located:</label><br>
                                            <input type="radio" name="geo1"  value="Yes"> Yes
                                            <input type="radio" name="geo1" checked value="No"> No
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>SEN School:</label><br>
                                            <input type="radio" name="sen1"  value="Yes"> Yes
                                            <input type="radio" name="sen1" checked value="No"> No
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Co-located with Parent School:</label><br>
                                            <input type="radio" name="colocated1"   value="Yes"> Yes
                                            <input type="radio" name="colocated1" checked  value="No"> No
                                        </div>
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
        shownexttab(presentclass,nextclass){ 
            let nexttype=true;
            if(nexttype){
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
                        text: "Are you sure you wish to apply for this changes you made in this form ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Success!',
                                'Change of basic details application has been submitted successfully with the system getenrate application number #12322. You may track your application status using this number at any time.',
                                'success',
                            )
                            this.$router.push({name: 'changeBasicDetails', params: {data:'Apply Basic Change',link:'/apply_for_basic_change' } });
                        }
                    });
                }
            }
        },

        remove_err(fieldId,errorId){
            if($('#'+fieldId).val()!=""){
                $('#'+errorId).html('');
                $('#'+fieldId).removeClass('is-invalid');
            }
        },
    }
}
</script>