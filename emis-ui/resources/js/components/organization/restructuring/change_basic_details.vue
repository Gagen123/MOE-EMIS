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
                            <label class="mb-0.5">Classes and Streams </label>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body pt-0 mt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="organization-tab" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row form-group">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Name:</label>
                                        <input type="text" class="form-control" v-model="form.name" value="Yangchenphug HSS" id="name"/>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Level:</label>
                                        <select name="level" id="level" class="form-control" v-model="form.level">
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
                                        <label><input  type="radio" v-model="form.category" value="1" tabindex=""/> Public</label>
                                        <label><input  type="radio" v-model="form.category" value="0" tabindex=""/> Private</label>
                                    </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Dzongkhag:</label>
                                            <select name="dzongkhag" id="dzongkhag" v-model="form.dzongkhag" class="form-control">
                                                <option value="1">Thimphu</option>
                                                <option value="2">Paro</option>
                                                <option value="3">punakha</option>
                                                <option value="4">Lhuntse</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Gewog:</label>
                                            <select name="gewog" id="gewog" v-model="form.gewog" class="form-control">
                                                <option value="1">Thimthrom</option>
                                                <option value="2">Babesa</option>
                                                <option value="3">Motithang</option>
                                                <option value="4">Chubachu</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Chiwog:</label>
                                            <select name="chiwog" id="chiwog" v-model="form.chiwog" class="form-control">
                                                <option value="1">Thimthrom</option>
                                                <option value="2">chngbandu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <label>Location Type:</label>
                                            <select name="locationType" id="locationType" v-model="form.locationType" class="form-control editable_fields">
                                                <option value="1">Urban Grade 1</option>
                                                <option value="1">Urban Grade 2</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Geopolitically Located:</label><br>
                                            <label><input  type="radio" v-model="form.geoLocated" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.geoLocated" value="0" tabindex=""/> No</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>SEN School:</label><br>
                                            <label><input  type="radio" v-model="form.senSchool" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.senSchool" value="0" tabindex=""/> No</label>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label>Co-located with Parent School:</label><br>
                                            <label><input  type="radio" v-model="form.coLocated" value="1" tabindex=""/> Yes</label>
                                            <label><input  type="radio" v-model="form.coLocated" value="0" tabindex=""/> No</label>
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
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select classes and streams</label>
                            </div>
                        </div><br>
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
           classList:[],
            streamList:[],
            form: new form({
                name:'sdf',level:'1',category:'1',dzongkhag:'1',gewog:'1',chiwog:'1',
                locationType:'1',geoLocated:'0',senSchool:'0', coLocated:'0'
            }),
            classStreamForm: new form({
                id: '',class:[], stream:[]
            })
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

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList = response.data;
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                this.streamList = response.data;
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
                        this.classStreamForm.post('organization/saveChangeClass')
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Change Details is saved successfully'
                            })
                    })
                        .catch(() => {
                            console.log("Error......")
                     })
                    window.reload();
                    }
                });
            }
            else{
                if(nextclass=="class-tab"){
                     this.form.post('organization/saveChangeBasicDetails',this.form)
                    .then(() => {
                       // this.change_tab(nextclass);
                    })
                    .catch(() => {
                        console.log("Error......")
                    })
                }
                this.change_tab(nextclass);
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
    },
    
    mounted() {
        this.getClass();
        this.getStream();
    },
    
     mounted() { 
        this.getClass();
        this.getStream();
    }
}
</script>
