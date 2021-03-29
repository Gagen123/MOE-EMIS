<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-details-tabs" @click="shownexttab('','personal-details-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label>Current Details </label>                              
                        </a> 
                    </li>
                    <li class="nav-item appointment-tab">
                        <a class="nav-link" data-toggle="pill" @click="shownexttab('personal-details-tabs','appointment-tab')" role="tab">
                            <label>Bifurcation Details</label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Code:</label>
                                <span class="text-indigo-600">23423423</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:</label>
                                <span class="text-indigo-600">Yangchenphug HSS</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Category:</label>
                                <span class="text-indigo-600">Public School</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Level:</label>
                                <span class="text-indigo-600">Higher Secondary School</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Dzongkhag:</label>
                                <span class="text-indigo-600">Thimphu</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Gewog:</label>
                                <span class="text-indigo-600">Thimthrom</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Chiwog:</label>
                                <span class="text-indigo-600">Thimthrom</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Location Type:</label>
                                <span class="text-indigo-600">Urban grade 1</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Geopolitically Located:</label>
                                <span class="text-indigo-600">No</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>SEN School:</label>
                                <span class="text-indigo-600">No</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Co-located with Parent School:</label>
                                <span class="text-indigo-600">No</span>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0">Classes and Streams</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <span v-for="(item, key, index) in  classList" :key="index">
                                    <br>
                                    <input type="checkbox" v-model="classStreamForm.class" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                    <span v-for="(stm, key, index) in streamList" :key="index" >
                                        <span v-if="item.class=='XI' || item.class=='XII'">
                                            <br>
                                            <input type="checkbox" v-model="classStreamForm.stream"  :id="stm.id" :value="item.id+'##'+stm.id"> <label class="pr-3"> {{ stm.stream  }}</label>
                                        </span>
                                    </span>
                                </span> 
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
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="card card-success card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">School/ECR/ECCD 1</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Name:<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="cname" v-model="form.name"/>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Level:<span class="text-danger">*</span></label>
                                                    <select name="category" id="clevel" class="form-control currentDetails" v-model="form.level">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">Higher Secondary School</option>
                                                        <option value="2">Middle Secondary School</option>
                                                        <option value="3">Lower Secondary School</option>
                                                        <option value="4">Primary School</option>
                                                        <option value="5">ECR</option>
                                                        <option value="6">ECCD</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Category:<span class="text-danger">*</span></label><br>
                                                    <input type="radio" v-model="form.category" name="category" @change="showprivatedetails('public')" value="Public"> Public
                                                    <input type="radio" v-model="form.category" name="category" @change="showprivatedetails('private')" value="Private"> Private
                                                    <span id="othercategoryforeccd"></span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Dzongkhag:<span class="text-danger">*</span></label>
                                                    <select name="dzongkhag" v-model="form.dzongkhag" id="cdzongkhag" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">Thimphu</option>
                                                        <option value="2">Paro</option>
                                                        <option value="3">punakha</option>
                                                        <option value="4">Lhuntse</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Gewog:<span class="text-danger">*</span></label>
                                                    <select name="category" v-model="form.gewog" id="cgewog" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">Kabisa</option>
                                                        <option value="2">Babesa</option>
                                                        <option value="3">Motithang</option>
                                                        <option value="4">Chubachu</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Chiwog:<span class="text-danger">*</span></label>
                                                    <select name="category" v-model="form.chiwog" id="cchiwog" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">olakha</option>
                                                        <option value="2">chngbandu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Location Category:</label>
                                                    <select name="category" v-model="form.location" id="clocationCategory" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="2">Urban grade 1</option>
                                                        <option value="1">Urban grade 2</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Geopolitically Located:</label>
                                                    <br>
                                                    <label><input  type="radio" v-model="form.geoLocated" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.geoLocated" value="0"  tabindex=""/> No</label>
                                                </div>
                                            </div> 
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>SEN School:<span class="text-danger">*</span></label>
                                                    <br>
                                                    <label><input  type="radio" v-model="form.senSchool" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.senSchool" value="0"  tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Co-located with Parent School:</label>
                                                    <br>
                                                    <label><input  type="radio" v-model="form.coLocated" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.coLocated" value="0"  tabindex=""/> No</label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Parent School:</label>
                                                    <select name="category" id="cparentSchool" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">Kabisa</option>
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="mb-0">Select classes and streams</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                                    <span v-for="(item, key, index) in  classList" :key="index">
                                                        <br>
                                                        <input type="checkbox" v-model="classStreamForm.class" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                                        <span v-for="(stm, key, index) in streamList" :key="index" >
                                                            <span v-if="item.class=='XI' || item.class=='XII'">
                                                                <br>
                                                                <input type="checkbox" v-model="classStreamForm.stream"  :id="stm.id" :value="item.id+'##'+stm.id"> <label class="pr-3"> {{ stm.stream  }}</label>
                                                            </span>
                                                        </span>
                                                    </span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="card card-warning card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">School/ECR/ECCD 2</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Name:<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control currentDetails" id="" v-model="form.name1"/>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Level:<span class="text-danger">*</span></label>
                                                    <select name="category" v-model="form.category1" id="afterChangeLevel" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">Higher Secondary School</option>
                                                        <option value="2">Middle Secondary School</option>
                                                        <option value="3">Lower Secondary School</option>
                                                        <option value="4">Primary School</option>
                                                        <option value="5">ECR</option>
                                                        <option value="6">ECCD</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Category:<span class="text-danger">*</span></label><br>
                                                    <input type="radio" name="category" @change="showprivatedetails('public')" value="Public"> Public
                                                    <input type="radio" name="category" @change="showprivatedetails('private')" value="Private"> Private
                                                    <span id="othercategoryforeccd"></span>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Dzongkhag:<span class="text-danger">*</span></label>
                                                    <select name="dzongkhag" v-model="form.dzongkhag1" id="afterChangeDzongkhag" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">Thimphu</option>
                                                        <option value="2">Paro</option>
                                                        <option value="3">punakha</option>
                                                        <option value="4">Lhuntse</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Gewog:<span class="text-danger">*</span></label>
                                                    <select name="category" v-model="form.gewog1" id="afterChangeGewog" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">Kabisa</option>
                                                        <option value="2">Babesa</option>
                                                        <option value="3">Motithang</option>
                                                        <option value="4">Chubachu</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Chiwog:<span class="text-danger">*</span></label>
                                                    <select name="chiwog" v-model="form.chiwog1" id="afterChangeChiwog" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">olakha</option>
                                                        <option value="2">chngbandu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Location Category:</label>
                                                    <select name="location1" v-model="form.location1" id="" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="2">Urban grade 1</option>
                                                        <option value="1">Urban grade 2</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Geopolitically Located:</label>
                                                    <br>
                                                    <label><input  type="radio" v-model="form.geoLocated1" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.geoLocated1" value="0"  tabindex=""/> No</label>
                                                </div>
                                            </div> 
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>SEN School:<span class="text-danger">*</span></label>
                                                    <br>
                                                    <label><input  type="radio" v-model="form.senSchool1" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.senSchool1" value="0"  tabindex=""/> No</label>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Co-located with Parent School:</label><br>
                                                    <label><input  type="radio" v-model="form.parentSchool" value="1" tabindex=""/> Yes</label>
                                                    <label><input  type="radio" v-model="form.parentSchool" value="0"  tabindex=""/> No</label>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <label>Parent School:</label>
                                                    <select name="category" v-model="form.parentSchool1" id="" class="form-control currentDetails">
                                                        <option value="">--- Please Select ---</option>
                                                        <option value="1">Kabisa</option>
                                                    </select>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="mb-0">Select classes and streams</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                                <span v-for="(item, key, index) in  classList" :key="index">
                                                    <br>
                                                    <input type="checkbox" v-model="classStreamForm.class" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                                    <span v-for="(stm, key, index) in streamList" :key="index" >
                                                        <span v-if="item.class=='XI' || item.class=='XII'">
                                                            <br>
                                                            <input type="checkbox" v-model="classStreamForm.stream"  :id="stm.id" :value="item.id+'##'+stm.id"> <label class="pr-3"> {{ stm.stream  }}</label>
                                                        </span>
                                                    </span>
                                                </span> 
                                            </div>
                                            </div>
                                        </div>
                                    </div>
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
            form: new form({
                id: '',name:'',
                
            }),
        }
    },
    methods:{
        shownexttab(presentclass,nextclass){ 
            let nexttype=true;
            // if(nextclass=="appointment-tab"){
            //     nexttype=this.validatedate();
            // }
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
                        text: "Are you sure you wish to submit the application for bifurcation?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Success!',
                                'Application for Bifurcation has been submitted successfully. You may track your application status with application number: #112211',
                                'success',
                            )
                            this.$router.push({name: 'changeBasicDetails', params: {data:'Apply Basic Change',link:'/apply_for_basic_change' } });
                        }
                    });
                }
            }
        },

    }
}
</script>