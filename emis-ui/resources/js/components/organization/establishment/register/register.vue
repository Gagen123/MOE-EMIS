<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="existmessage"></div>
        </div>
        <div class="card" id="mainform">
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Category:<span class="text-danger">*</span></label>
                        <select name="category" id="category" v-model="applicaitondetailsform.category" class="form-control select2" >
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                            <option value="ECCD">ECCD</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label>Year of Establishment:</label>
                        <input type="text" class="form-control" id="yearOfEst" v-model="applicaitondetailsform.yearestb" name="yearOfEst"/>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="zest_code_section">
                        <!-- <label>ZEST Working Agency Code:<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="text" id="workingAgencyCode" class="form-control" v-model="applicaitondetailsform.zestcode" @change="remove_error('workingAgencyCode')"/>
                            <div class="input-group-append">
                                <span type="button" class="col-md-12 btn  btn-primary" @click="getApprovedOrgDetails('1')"><i class="fa fa-search">&nbsp;Search</i></span>
                            </div>
                        </div>
                        <span id="workingAgencyCode_err" class="text-danger"></span> -->
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                <label class="col-md-12 ">School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="organizationid" id="organizationid" v-model="applicaitondetailsform.organizationid" :class="{ 'is-invalid': applicaitondetailsform.errors.has('organizationid') }" class="form-control select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in publicorgList" :key="index" v-bind:value="item.id">{{ item.proposedName }}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                                <br/>
                                <span type="button" class="btn  btn-primary" @click="getApprovedOrgDetails()"><i class="fa fa-search">&nbsp;Search</i></span>
                            </div>
                        </div>
                    </div>
                    <span class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="approved_schol_list" style="display:none">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
                                <label class="col-md-12 ">School/ECR/ECCD:<span class="text-danger">*</span></label>
                                <select name="organizationid" id="pri_organizationid" v-model="applicaitondetailsform.organizationid" :class="{ 'is-invalid': applicaitondetailsform.errors.has('organizationid') }" class="form-control select2">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.proposedName }}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                                <br/>
                                <span type="button" class="btn  btn-primary" @click="getApprovedOrgDetails()"><i class="fa fa-search">&nbsp;Search</i></span>
                            </div>
                        </div>
                    </span>
                </div>
                <!-- for private category -->
                <div id="org_details" style="display:none">
                    <div class="callout callout-success">
                        <h5><u>Organization Details</u></h5>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Proposed Name:</label>
                                <span class="text-blue text-bold">{{applicant_rog_details.proposedName}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-if="applicaitondetails.establishment_type!='Private ECCD' && applicaitondetails.establishment_type=='Public ECCD'">
                                <label class="mb-0">Level:</label>
                                <span class="text-blue text-bold">{{levelArray[orgLevel]}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Category:</label>
                                <span class="text-blue text-bold"> {{ applicaitondetails.establishment_type }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Dzongkhag:</label>
                                <span class="text-blue text-bold">{{applicaitondetails.dzongkhag}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Gewog:</label>
                                <span class="text-blue text-bold">{{applicaitondetails.gewog}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Chiwog:</label>
                                <span class="text-blue text-bold">{{applicaitondetails.village}}</span>
                            </div>
                        </div>

                        <div v-if="applicaitondetails.establishment_type=='Private School'">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Propose Location:</label>
                                    <span class="text-blue text-bold">{{applicaitondetails.org_details.proposedLocation}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Total Proposed Land:</label>
                                    <span class="text-blue text-bold"> {{ applicaitondetails.org_details.totalLand }}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Type of School:</label>
                                    <span class="text-blue text-bold"> {{ applicaitondetails.org_details.typeOfSchool == 1 ? "Day" :  "Boarding" }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Expected Enrollment (Boys):</label>
                                    <span class="text-blue text-bold">{{applicaitondetails.org_details.enrollmentBoys}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Expected Enrollment (Girls):</label>
                                    <span class="text-blue text-bold"> {{ applicaitondetails.org_details.enrollmentGirls }}</span>
                                </div>
                            </div>
                            <div class="row pb-2">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h5><u>Proprietor Details</u></h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">CID:</label>
                                    <span class="text-blue text-bold">{{applicaitondetails.org_details.proprietorCid}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Full Name:</label>
                                    <span class="text-blue text-bold">{{applicaitondetails.org_details.proposedName}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Mobile No:</label>
                                    <span class="text-blue text-bold">{{applicaitondetails.org_details.proprietorMobile}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Phone No:</label>
                                    <span class="text-blue text-bold">{{applicaitondetails.org_details.proprietorPhone}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="mb-0">Email:</label>
                                    <span class="text-blue text-bold">{{applicaitondetails.org_details.proprietorEmail}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="callout callout-success">
                        <h5><u>Class Section Details</u></h5>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <span v-for="(item, index) in  org_class_details" :key="index">
                                <br>
                                <input type="checkbox" checked="true"><label class="pr-4"> &nbsp;{{ calssArray[item.classId] }}<span v-if="item.streamId"> - {{ streamArray[item.streamId] }}</span> </label>
                            </span>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Remarks</label>
                                <textarea class="form-control" @change="remove_error('remarks')" v-model="applicaitondetailsform.remarks" id="remarks"></textarea>
                                <span class="text-danger" id="remarks_err"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="display:none" id="register_footer">
                <div class="row form-group fa-pull-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="button" class="btn btn-flat btn-primary" @click="savedetails()"> <i class="fa fa-save"></i> Register</button>
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
            orgList:[],
            publicorgList:[],
            levelArray:{},
            classStreamList:[],
            calssArray:{},
            streamArray:{},
            orgLevel:'',
            proposedName:'',
            applicant_rog_details:[],
            applicaitondetails:[],
            org_class_details:[],
            applicaitondetailsform: new form({
                // organizationid:'',applicationNo:'',application_date:'',
                // service:'',proposedName:'',dzongkhagId:'',dzongkhag:'',gewogId:'',gewog:'',isColocated:'',
                // levelId:'',level:'',chiwogId:'',village:'',locationId:'',locationType:'',parentSchoolId:'',
                // isGeopoliticallyLocated:'',senSchool:'0',parentSchool:'',
                // coLocatedParent:'0',cid:'',name:'',phoneNo:'',email:'',status:'',isSenSchool:'',
                // proprietorList:[],
                // class_section:[],
                // sectionList:[],
                yearestb:'',category:'1',zestcode:'',remarks:'',
                applicaitondetails:[]
            }),
        }
    },
    methods:{
        display_respective_section: function(school_type){
            $("#zest_code_section").hide();
            $("#approved_schol_list").hide();
             this.loadApproveSchoolname(this.applicaitondetailsform.category);
             $("#approved_schol_list").show();
            // if(this.applicaitondetailsform.category == 1){
            //    $("#zest_code_section").show();
            //     this.loadApproveSchoolname('Public');
            //     //integration with Zest
            // }else{

            //     $("#approved_schol_list").show();
            // }
        },
        // getClassStream:function(){
        //     axios.get('/masters/loadClassStreamMapping')
        //       .then(response => {
        //         this.classStreamList = response.data.data;
        //     });
        // },
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.calssArray[data[i].id] = data[i].class;
                }
            });
        },

        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.streamArray[data[i].id] = data[i].stream;
                }
            });
        },
        loadApproveSchoolname(type){
            this.orgList=[];
            axios.get('organization/loadApprovedOrgs/'+type)
            .then((response) => {
                let data=response.data.data;
                // if(type=="Private"){
                //     this.orgList   =   data;
                // }
                // else{
                //     this.publicorgList   =   data;
                // }
                this.orgList   =   data;
            })
            .catch((error) => {
                console.log("Error:"+error);
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        async changefunction(id){
            if(id=="category"){
                this.applicaitondetailsform.category=$('#category').val();
                this.display_respective_section($('#category').val());
            }
            if(id=="organizationid"){
                this.applicaitondetailsform.organizationid=$('#organizationid').val();
            }
        },

        getApprovedOrgDetails(type){
            let key="";
            // if(type==1){
            //     key=this.applicaitondetailsform.zestcode;
            // }
            // if(type=="private"){
            //     key=$('#pri_organizationid').val();
            // }
            // if(type=="public"){
            //     key=$('#organizationid').val();
            // }
            key=$('#pri_organizationid').val();
            type=$('#category').val();
            axios.get('organization/getApprovedOrgDetails/'+type+'/'+key)
            .then((response) => {
                let data=response.data.data;
                this.applicaitondetails=data;
                if(data.establishment_type!="Private ECCD" && data.establishment_type!="Public ECCD"){
                    this.orgLevel=data.org_details.levelId;
                }
                this.proposedName=data.org_details.proposedName;
                this.applicant_rog_details=data.org_details;
                this.org_class_details=data.org_class_stream;
                if(type==0){
                    // this.applicaitondetailsform.applicationNo           =data.application_no;
                    // this.applicaitondetailsform.dzongkhagId             =data.dzongkhagId;
                    // // this.applicaitondetailsform.dzongkhag               =data.dzongkhag;
                    // this.applicaitondetailsform.gewogId                 =data.gewogId;
                    // this.applicaitondetailsform.gewog                   =data.gewog;
                    // this.applicaitondetailsform.village                 =data.village;
                    // // this.applicaitondetailsform.locationId              =data.locationId;
                    // // this.applicaitondetailsform.locationType            =data.locationType;
                    // this.applicaitondetailsform.levelId                 =data.levelId;
                    // this.applicaitondetailsform.level                   =data.level;
                    // this.applicaitondetailsform.proposedName            =data.proposedName;
                    // this.applicaitondetailsform.parentSchoolId          =data.parentSchoolId;
                    // this.applicaitondetailsform.isGeopoliticallyLocated =data.isGeopoliticallyLocated;
                    // this.applicaitondetailsform.isColocated             =data.isColocated;
                    // this.applicaitondetailsform.isSenSchool             =data.isSenSchool;
                    // this.applicaitondetailsform.proprietorList          =data.proprietor;
                    // this.applicaitondetailsform.class_section           =data.class_section;
                    // this.applicaitondetailsform.sectionList             =data.sections;
                }
                $("#org_details").show();
                $("#register_footer").show();

            })
            .catch((error) =>{
                $("#org_details").hide();
                console.log("Error:"+error);
            });
        },
        savedetails(){
            Swal.fire({
                text: "Are you sure you wish to register this organization ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    this.applicaitondetailsform.applicaitondetails=this.applicaitondetails;
                    this.applicaitondetailsform.post('organization/registerOrganizationDetails')
                    .then((response) => {
                        if(response!=""){
                            Toast.fire({
                                icon: 'success',
                                title: "New organization details has been registered. Thank You !"
                            });
                            this.$router.push({name:'list_register'});
                        }
                    })
                    .catch((err) => {
                        console.log("Error:"+err)
                    })
                }
            });
        },

        getScreenAccess(){
            axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data.acess_level;
                if(data != "Ministry"){
                    $('#mainform').hide();
                    $('#screenPermission').show();
                    $('#existmessage').html('You have no access to this page.');
                }

            })
            .catch(errors => {
                console.log(errors)
            });
        },
         getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },
    },
    mounted() {
        this.loadApproveSchoolname('Public');
        this.getLevel();
        // this.getClassStream();
        this.getClass();
        this.getStream();
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
    },
    created(){
        // this.getScreenAccess();
        let currentdate = new Date();
        let current_year =(currentdate.getFullYear());
        // let month =(currentdate.getMonth() + 1);
        // let day = currentdate.getDate();
        this.applicaitondetailsform.yearestb=current_year;
    }
}
</script>
