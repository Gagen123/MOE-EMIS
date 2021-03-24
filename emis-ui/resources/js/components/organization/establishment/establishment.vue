<template>
    <div>
        <form class="bootbox-form" id="establishmentId">
            <div class=""> 
                <div class="" >
                    <div class="card card-primary card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="tabhead">
                                <li class="nav-item organization-details-tabs" @click="shownexttab('','organization-details-tabs')">
                                    <a class="nav-link active" data-toggle="pill" role="tab"> 
                                        <label> Organization Details </label>                              
                                    </a>
                                </li>
                                <li class="nav-item class-tab">
                                    <a class="nav-link" data-toggle="pill" @click="shownexttab('organization-details-tabs','class-tab')" role="tab">
                                        <label> Classes and Streams</label>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade active show tab-content-details" id="organization-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                                    <div class="form-group row"> 
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Proposed Name:<span class="text-danger">*</span></label>
                                            <input type="text" v-model="form.proposedName" :class="{ 'is-invalid': form.errors.has('proposedName') }" @change="remove_err('proposedName')" class="form-control" id="proposedName" />
                                            <has-error :form="form" field="proposedName"></has-error>
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
                                            <label class="mb-0">Category:<span class="text-danger">*</span></label>
                                            <br> 
                                            <label><input  type="radio" v-model="form.category" @change="showprivatedetails('public')" value="1" tabindex=""/> Public</label>
                                            <label><input  type="radio" v-model="form.category" @change="showprivatedetails('private')" value="0"  tabindex=""/> Private</label>
                                            <span id="othercategoryforeccd"></span>
                                            <has-error :form="form" field="proposedName"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Dzongkhag:<span class="text-danger">*</span></label>
                                            <select v-model="form.dzongkhag" name="dzongkhag" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" id="dzongkhag" class="form-control editable_fields" @change="remove_err('dzongkhag')">
                                                <option value="">--- Please Select ---</option>
                                                <option value="1">Thimphu</option>
                                            </select>
                                            <has-error :form="form" field="dzongkhag"></has-error>
                                        </div>  
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Gewog:<span class="text-danger">*</span></label>
                                            <select v-model="form.gewog" name="gewog" id="gewog" :class="{ 'is-invalid': form.errors.has('gewog') }" class="form-control editable_fields" @change="remove_err('gewog')">
                                                <option value="">--- Please Select ---</option>
                                                <option value="1">chang</option>
                                            </select>
                                            <has-error :form="form" field="gewog"></has-error>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Chiwog:<span class="text-danger">*</span></label>
                                            <select v-model="form.chiwog" name="chiwog" id="chiwog" :class="{ 'is-invalid': form.errors.has('chiwog') }" class="form-control editable_fields" @change="remove_err('chiwog')">
                                                <option value="">--- Please Select ---</option>
                                                <option value="1">chang</option>
                                            </select>
                                            <has-error :form="form" field="proposedName"></has-error>
                                        </div>                 
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Location Type:<span class="text-danger">*</span></label>
                                            <select name="locationCategory" v-model="form.locationType" :class="{ 'is-invalid': form.errors.has('locationType') }" id="locationCategory" class="form-control editable_fields" @change="remove_err('locationCategory')">
                                                <option value="">--- Please Select ---</option>
                                                <option v-for="(item, index) in locationList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                            </select>
                                            <has-error :form="form" field="proposedName"></has-error>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Geopolitically Located:</label>
                                            <br>
                                            <label><input  type="radio" v-model="form.geopolicaticallyLocated" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.geopolicaticallyLocated" value="0" tabindex=""/> No</label>
                                        </div> 
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label class="mb-0">Sen School/ECCD:<span class="text-danger">*</span></label>
                                            <br>
                                            <label><input  type="radio" v-model="form.senSchool" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.senSchool" value="0" tabindex=""/> No</label>
                                        </div>                  
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="parentSchoolDiv">
                                            <label class="mb-0">Parent School:</label>
                                            <select name="parentSchool" v-model="form.parentSchool" id="parentSchool" class="form-control  editable_fields">
                                                <option value="">--- Please Select ---</option>
                                                <option value="1">Kabisa</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="coLocatedDiv">
                                            <label class="mb-0">Co-located with Parent School:</label>
                                            <br>
                                            <label><input  type="radio" v-model="form.coLocatedParent" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.coLocatedParent" value="0" tabindex=""/> No</label>
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
                                    
                                    <hr>
                                    <div class="row form-group fa-pull-right">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-flat btn-primary" @click="shownexttab('organization-details-tabs','class-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade tab-content-details" id="class-tab" role="tabpanel" aria-labelledby="basicdetails">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label class="mb-0">Select classes and streams</label>
                                        </div>
                                    </div><br>
                                    <!-- <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <ul>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="PP"><label> &nbsp;&nbsp;&nbsp;PP</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="I"><label> &nbsp;&nbsp;&nbsp;I</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="II"><label> &nbsp;&nbsp;&nbsp;II</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="III"><label> &nbsp;&nbsp;&nbsp;III</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="IV"><label> &nbsp;&nbsp;&nbsp;IV</label></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <ul>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="V"><label> &nbsp;&nbsp;&nbsp;V</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="VI"><label> &nbsp;&nbsp;&nbsp;VI</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="VII"><label> &nbsp;&nbsp;&nbsp;VII</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="VIII"><label> &nbsp;&nbsp;&nbsp;VIII</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="IX"><label> &nbsp;&nbsp;&nbsp;IX</label></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <ul>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="X"><label> &nbsp;&nbsp;&nbsp;X</label></li>
                                                <li><input type="checkbox" v-model="classStreamForm.class" value="XI" id="xlsection_check" @click="showchild('xlsection')"><label> &nbsp;&nbsp;&nbsp;XI</label></li>
                                                <ul id="xlsection"  style="display:none" class="pl-4">
                                                    <li><input type="checkbox" v-model="classStreamForm.stream" value="XI##Science"><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                    <li><input type="checkbox" v-model="classStreamForm.stream" value="XI##Commerce"><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                    <li><input type="checkbox" v-model="classStreamForm.stream" value="XI##Arts"><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                                </ul>
                                            <li><input type="checkbox" v-model="classStreamForm.class" value="XII" id="xlisection_check" @click="showchild('xlisection')"><label> &nbsp;&nbsp;&nbsp;XII</label></li>
                                                <ul id="xlisection" style="display:none" class="pl-4">
                                                    <li><input type="checkbox" v-model="classStreamForm.stream" value="XII##Sciences"><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                                    <li><input type="checkbox" v-model="classStreamForm.stream" value="XII##Commerces"><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                                    <li><input type="checkbox" v-model="classStreamForm.stream" value="XII##Artss"><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                        <span v-for="(item, key, index) in  classList" :key="index">
                                            <br>
                                            <input type="checkbox" v-model="classStreamForm.class" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                            <span v-for="(stm, key, index) in streamList" :key="index" >
                                                <span v-if="item.class=='XI' || item.class=='XII'">
                                                    <br>
                                                    <input type="checkbox" v-model="classStreamForm.stream"  :id="stm.id" :value="stm.id"> <label class="pr-3"> {{ stm.stream  }}</label>
                                                </span>
                                            </span>
                                        </span> 
                                    </div>
                                    <hr>
                                    <div class="row form-group fa-pull-right">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <button class="btn btn-flat btn-success" @click="shownexttab('','organization-details-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                            <button type="button" class="btn btn-flat btn-primary" @click="shownexttab('class-tab','final-tab')"> <i class="fa fa-save"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        </div>
                    </div> 
                </div>
            </div>
        </form>
    </div>
    
</template>

,<script>
export default {
    data(){
        return{
            levelList:[],
            locationList:[],
            classList:[],
            streamList:[],
            form: new form({
                id: '',proposedName:'',level:'',category:'1',dzongkhag:'',gewog:'',chiwog:'',locationType:'',
                geopolicaticallyLocated:'0',senSchool:'0',parentSchool:'',coLocatedParent:'0',cid:'',name:'',
                phoneNo:'',email:''
            }),
            classStreamForm: new form({
                id: '',class:[], stream:[]
            })
        }
    },
    methods:{
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
                        window.reload();
                    }
                });
            }else{
                this.form.post('organization/saveEstablishment',this.form)
                    .then(() => {
                })
                .catch(() => {
                    console.log("Error......")
                })
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
        getClassAndStream(level){
            if($('#level').val()=="6"){
                $('#othercategoryforeccd').html('<input type="radio" name="category" value="NGO" @change="showprivatedetails("ngo")" > NGO <input type="radio"  @change="showprivatedetails("public")"  name="category" value="Coporate"> Coporate');
            }
            else{
                $('#othercategoryforeccd').html('');
            }
        },
        showprivatedetails(type){
            if(type=='private'){
                $('#privatedetails').show();
            }
            else{
                $('#privatedetails').hide();
            }
        }
    },
    mounted() { 
        this.getLevel();
        this.getLocation();
        this.getClass();
        this.getStream();
    }
}
</script>