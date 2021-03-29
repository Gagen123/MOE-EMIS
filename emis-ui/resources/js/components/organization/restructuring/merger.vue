<template>
    <div>
        <form class="bootbox-form" id="mergerId">
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
                                    <select name="organization1" id="organization1" v-model="form.orgId1" class="form-control" @change="getSchoolDetails()">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">YHSS</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>2nd School/ECR/ECCD:<span class="text-danger">*</span></label>
                                    <select name="organization2" id="organization2" v-model="form.orgId2" class="form-control" @change="getSchool2Details()">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">MHSS</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Year of Merger:</label>
                                    <input type="text" class="form-control" id="yearOfMerger" v-model="form.year"/>
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
                                    <input type="text" class="form-control" id="name" v-model="form.name"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Level:<span class="text-danger">*</span></label>
                                    <select name="level" id="level" v-model="form.level" :class="{ 'is-invalid': form.errors.has('level') }" class="form-control editable_fields" @change="getClassAndStream('level'),remove_err('level')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="level"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Category:<span class="text-danger">*</span></label>
                                    <br> 
                                    <label><input  type="radio" v-model="form.category" @change="showprivatedetails('public')" value="1" tabindex=""/> Public</label>
                                    <label><input  type="radio" v-model="form.category" @change="showprivatedetails('private')" value="0"  tabindex=""/> Private</label>
                                    <span id="othercategoryforeccd"></span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:<span class="text-danger">*</span></label>
                                    <select name="dzongkhag" id="dzongkhag" class="form-control" v-model="form.dzongkhag">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">Thimphu</option>
                                        <option value="2">Paro</option>
                                        <option value="3">punakha</option>
                                        <option value="4">Lhuntse</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:<span class="text-danger">*</span></label>
                                    <select name="category" id="gewog" class="form-control" v-model="form.gewog">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">Kabisa</option>
                                        <option value="2">Babesa</option>
                                        <option value="3">Motithang</option>
                                        <option value="4">Chubachu</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Chiwog:<span class="text-danger">*</span></label>
                                    <select name="category" id="chiwog" class="form-control" v-model="form.chiwog">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">olakha</option>
                                        <option value="2">chngbandu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Location Type:<span class="text-danger">*</span></label>
                                    <select name="locationCategory" v-model="form.location" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationCategory" class="form-control editable_fields" @change="remove_err('locationCategory')">
                                        <option value="">--- Please Select ---</option>
                                        <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="proposedName"></has-error>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Geopolitically Located:</label>
                                    <br> 
                                    <label><input  type="radio" v-model="form.geoLocated" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" v-model="form.geoLocated" value="0"  tabindex=""/> No</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>SEN School:<span class="text-danger">*</span></label>
                                    <br>
                                    <label><input  type="radio" v-model="form.senSchool" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" v-model="form.senSchool" value="0"  tabindex=""/> No</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Parent School:</label>
                                    <select name="category" id="parentSchool" class="form-control" v-model="form.parentSchool">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">Kabisa</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Co-located with Parent School:</label>
                                    <br> 
                                    <label><input type="radio" v-model="form.coLocated"  value="1" tabindex=""/> Yes</label>
                                    <label><input type="radio" v-model="form.coLocated"  value="0"  tabindex=""/> No</label>
                                </div>
                            </div>
                             <div id="privatedetails" style="display:none">
                                <div class="row pb-2">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="mb-0">Proprietor Details</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">CID:<span class="text-danger">*</span></label>
                                        <input type="nubmer" v-model="form.cid" class="form-control" id="cid"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Full Name:<span class="text-danger">*</span></label>
                                        <input type="text" v-model="form.name" class="form-control" id="fullname"/>
                                    </div>
                                </div>
                                <div class="form-group row" >
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Phone No:<span class="text-danger">*</span></label>
                                        <input type="nubmer" v-model="form.phoneNo" class="form-control" id="cid"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label class="mb-0">Email:<span class="text-danger">*</span></label>
                                        <input type="email" v-model="form.email" class="form-control" id="fullname"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0">Select classes and streams</label>
                                </div>
                            </div>
                            <br>
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
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return{
            levelList:[],
            locationList:[],
            classList:[],
            streamList:[],

            form: new form({
                id: '',orgId1:'1',orgId2:'1',year:'1990',name:'ugyen',level:'386b85e8-4af5-4cce-83c3-b2375ee11007',category:'1',dzongkhag:'1',gewog:'1',
                chiwog:'1',location:'69b095c5-c35d-4572-bced-171f74ba25c0',geoLocated:'0',senSchool:'0',parentSchool:'',coLocated:'0',
                cid:'',name:'',phoneNo:'',email:''
                
            }),
             classStreamForm: new form({
                id: '',class:[], stream:[]
            })
        }
    },
    methods:{
        getSchoolDetails: function(){
            $('#school1').show();
        },

        getSchool2Details: function(){
            $('#school2').show();
        },

        showprivatedetails(type){
            if(type=='private'){
                $('#privatedetails').show();
            }
            else{
                $('#privatedetails').hide();
            }
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
                        this.form.post('organization/saveMerger')
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Merger is saved successfully'
                                })
                        })
                            .catch(() => {
                                console.log("Error......")
                         })
                    }
                });
            }
        },

        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
            });
        },

        getLocation(uri = '/organization/getLocationInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.locationList = data;
            });
        },

        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList = response.data;
            });
        },

        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                this.streamList = response.data;
            });
        },

        showchild(type){
            if($('#'+type+'_check').prop('checked')){
                $('#'+type).show();
            }
            else{
                $('#'+type).hide();
            }
        },
    },
    mounted() { 
        this.getLevel();
        this.getLocation();
        this.getClass();
        this.getStream();
    }
}
</script>