<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="tabhead">
                    <li class="nav-item personal-details-tabs " @click="shownexttab('','personal-details-tabs')">
                        <a class="nav-link active" data-toggle="pill" role="tab"> 
                            <label class="mb-1">Appointment</label>
                        </a>
                    </li>                  
                    <li class="nav-item qualification-tab">
                        <a class="nav-link " data-toggle="pill" @click="shownexttab('appointment-tab','qualification-tab')" role="tab">
                            <label class="mb-1">Qualification</label>
                        </a>
                    </li>  
                </ul>
            </div>
            <div class="card-body pt-1">
                <div class="tab-content">
                    <div class="tab-pane fade active show tab-content-details" id="personal-details-tabs" role="tabpanel" aria-labelledby="basicdetails">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Nationality: <i class="text-danger">*</i></label>
                                <select class="form-control h-50 select2bs4" name="sub1" @change="remove_err('nationality','nationality_error')" id="nationality">
                                    <option value=""> --Select--</option>
                                    <option value="1"> Bhutanese</option>
                                    <option value="2"> Indian</option>
                                    <option value="3"> Bangladesh</option>
                                    <option value="4"> Chainese</option>
                                </select>
                                <span class="text-danger" id="nationality_error"></span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">CID/Work Permit No:<i class="text-danger">*</i></label>
                                <input type="number" class="form-control h-50" @change="remove_err('cid','cid_error')" name="cid" id="cid">
                                <span class="text-danger" id="cid_error"></span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Full Name:<i class="text-danger">*</i></label>
                                <input type="text" class="form-control h-50"  @change="remove_err('fullname','fullname_error')" name="emp_id" id="fullname" >
                                <span class="text-danger" id="fullname_error"></span>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Contact No:<i class="text-danger">*</i></label>
                                <input type="text" class="form-control h-50"  @change="remove_err('contactno','contactno_error')" name="contact" id="contactno">
                                <span class="text-danger" id="contactno_error"></span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Email:</label>
                                <input type="text" class="form-control h-50" name="emp_id" id="email" >
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Is in SEN Team:</label><br>
                                <input type="radio" name="sen" value="Yes"> Yes
                                <input type="radio" name="sen" value="No"> No
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0.5">Career Stage:</label><br>
                                <select  class="form-control h-50 select2bs4" name="sub1" id="sub3">
                                    <option value=""> --Select--</option>
                                    <option value="Beginning"> Beginning</option>
                                    <option value="Proficient"> Proficient</option>
                                    <option value="Accomplished"> Accomplished</option>
                                    <option value="Distinguished"> Distinguished</option>
                                </select>
                            </div> 
                            <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Has Received Training on Supporting Children with Disabilities:</label><br>
                                <input type="radio" name="sen" value="Yes"> Yes
                                <input type="radio" name="sen" value="No"> No
                            </div>  -->
                        </div>
                         <div class="form-group row">
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0.5">Has Received Training on Supporting Children with Disabilities:</label><br>
                                <input type="radio" name="sentraining" value="Yes"> Yes
                                <input type="radio" name="sentraining" value="No"> No
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Position:<i class="text-danger">*</i></label>
                                <select class="form-control h-50 select2bs4" name="sub1" id="position ">
                                    <option value=""> --Select--</option>
                                    <option value="1"> Teacher 1</option>
                                    <option value="2"> Teacher 2</option>
                                    <option value="3"> Position 3</option>
                                </select>
                            </div> 
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Compulsory Subject:</label>
                                <select class="form-control h-50 select2bs4" name="sub1" id="sub1">
                                    <option value=""> --Select--</option>
                                    <option value="1"> English</option>
                                    <option value="2"> Dzongkha</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Elective Subject 1:</label>
                                    <select class="form-control h-50 select2bs4" name="sub1" id="sub2">
                                    <option value=""> --Select--</option>
                                    <option value="1"> English</option>
                                    <option value="2"> Dzongkha</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-1">Elective Subject 2:</label>
                                <select class="form-control h-50 select2bs4" name="sub1" id="sub3">
                                    <option value=""> --Select--</option>
                                    <option value="1"> English</option>
                                    <option value="2"> Dzongkha</option>
                                    <option value="3"> Mathematics</option>
                                </select>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-1">Remarks:</label>
                                <textarea class="form-control h-50" name="remarks" id="remarks"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i>Cancel </button>
                                <button class="btn btn-primary" @click="shownexttab('personal-details-tabs','qualification-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="tab-pane fade tab-content-details" id="appointment-tab" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab" >
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="alert alert-default-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    Details for: Karma Sonam, Teacher
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('','personal-details-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button class="btn btn-primary" @click="shownexttab('appointment-tab','qualification-tab')">Save & Next <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div> -->

                    <div class="tab-pane fade tab-content-details" id="qualification-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="alert alert-default-info alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    Details for: Karma Sonam, Teacher
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="training-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Desciption</th>
                                            <th>Qualification</th>
                                            <th>Course Mode/Type</th>  
                                            <th>Course Title</th>
                                            <th>First Subject</th> 
                                            <th>Second subject</th>    
                                            <th>Country</th>    
                                            <th>Start Date</th> 
                                            <th>End Date</th>                     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(qua, index) in qualificationlist' :key="index">
                                            
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.description" id="description">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Initial Professional Qualification</option>
                                                    <option value="2">Heighest Professional Qualification</option>
                                                    <option value="3">Heighest Acadamic Qualification</option>
                                                    <option value="4">Training</option>
                                                    <option value="4">Others Qualification</option>
                                                </select>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.qualification" id="qualification">
                                                    <option value="">--Select--</option>
                                                    <option value="1">PTC</option>
                                                    <option value="2">ZTC</option>
                                                    <option value="3">B.Ed Primary</option>
                                                    <option value="4">B.Ed Secondary</option>
                                                    <option value="5">PGCE</option>
                                                    <option value="6">PGDE</option>
                                                    <option value="7">B.Ed Secondary</option>  
                                                    <option value="1">B. COM</option>
                                                    <option value="2">M. COM</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.coursemode" id="coursemode">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Mix Mode</option>
                                                    <option value="2">Full Mode</option>
                                                    <option value="3">Part Time</option>
                                                    <option value="4">Distance Education</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" v-model="qua.coursetitle" id="coursetitle" class="form-control h-50">
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.firstsub" id="firstsub">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Biological Science</option>
                                                    <option value="2">Buddhist Studies</option>
                                                    <option value="3">Business Administration</option>
                                                    <option value="4">Community</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.secondsub" id="secondsub">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Biological Science</option>
                                                    <option value="2">Buddhist Studies</option>
                                                    <option value="3">Business Administration</option>
                                                    <option value="4">Community</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control h-50 select2bs4" v-model="qua.country" id="country">
                                                    <option value="">--Select--</option>
                                                    <option value="1">Bhutan</option>
                                                    <option value="2">AFGHANISTAN</option>
                                                    <option value="3">ANGOLA</option>
                                                    <option value="4">CHINA</option> 
                                                    <option value="5">INDIA</option> 
                                                </select>
                                            </td>
                                            <td>
                                                <input type="date" v-model="qua.startdate" id="startdate" class="form-control h-50">
                                            </td>
                                            <td>
                                                <input type="date" v-model="qua.enddate" id="enddate" class="form-control h-50">
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td colspan="9"> 
                                                <button type="button" class="btn btn-xs btn-primary" id="addMore" 
                                                @click="addMore('qua')"><i class="fa fa-plus"></i> Add More</button>
                                                <button type="button" class="btn btn-xs btn-danger" id="addMore" 
                                                @click="remove('qua')"><i class="fa fa-trash"></i> Remove</button>
                                            </td>
                                        </tr>  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="row form-group fa-pull-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-success" @click="shownexttab('','personal-details-tabs')"><i class="fa fa-arrow-left"></i>Previous </button>
                                <button v-if="modalfinalactionedit" class="btn btn-primary" @click="shownexttab('qualification-tab','finalsubmit')">Upate <i class="fa fa-arrow-right"></i></button>
                                <button v-if="!modalfinalactionedit" class="btn btn-primary" @click="shownexttab('qualification-tab','finalsubmit')">Save & Submit <i class="fa fa-arrow-right"></i></button>
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
            page_type:'',
            modalfinalactionedit:false, 
            totle:0,
            qualificationlist:
            [{
                description:'',qualification:'',coursemode:'',coursetitle:'',firstsub:'',secondsub:'',country:'',startdate:'',enddate:''
            }],
            nominies:
            [{
                cid:'',name:'',desig:'',address:'',contact:'',email:'',relation:'',percentage:''
            }],
        }
    },
    methods: {
        addMore: function(type){
            if(type=="qua"){
                this.qualificationlist.push({description:'',qualification:'',coursemode:'',coursetitle:'',firstsub:'',secondsub:'',country:'',startdate:'',enddate:''})
            }
            else{
                this.nominies.push({cid:'',name:'',desig:'',address:'',contact:'',email:'',relation:'',percentage:''})
            }
        }, 
        remove(type,index){ 
            if(type=="qua"){
                this.qualificationlist.splice(index,1); 
            } 
            else{
                this.nominies.splice(index,1); 
            }            
        },
        getpersonaldetails(data){
            data.name='Full Name'+data.cid;
            data.desig='MR';
            data.address='Permanent Address '+data.cid;
        },
        calcualtetotla(data){
            this.totle+=parseInt(data.percentage);
            if(this.totle>100){
                this.totle-=parseInt(data.percentage);
                Swal.fire(
                    'error!',
                    'Your total percentage cannot be more the 100.',
                    'error',
                )
                data.percentage=0;
            }
            $('#percentagetotla').val(this.totle);
        },
        showfiend(fieldId,repvalue,targetId){
            if($('#'+fieldId).val()==repvalue){
                $('#'+targetId).show();
            }
            else{
                $('#'+targetId).hide();
            }
        },
        shownexttab(presentclass,nextclass){  
            if(this.validatetabs(presentclass)){
                $('#tabhead >li >a').removeClass('active');
                $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').addClass('active');
                $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
                $('.'+nextclass+' >a').removeClass('disabled');
                //body
                $('.tab-content-details').hide();
                $('#'+nextclass).show().removeClass('fade');
                if(nextclass=="finalsubmit"){ 
                    Swal.fire({
                        text: "Are you sure you wish to take this action ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Success!',
                                'Staff details is added successfully.',
                                'success',
                            )
                            this.$router.push("/eccd_staff_details");
                        }
                    });
                }
            }
        },
        validatetabs(presentcalss){
            let returntype=true;
            if(presentcalss=="personal-details-tabs"){
                if($('#nationality').val()==""){
                    $('#nationality_error').html('Please select Nationality');
                    $('#nationality').focus();
                    $('#nationality').addClass('is-invalid');
                    returntype=false;
                }
                if($('#cid').val()==""){
                    $('#cid_error').html('Please provide cid');
                    $('#cid').focus();
                    $('#cid').addClass('is-invalid');
                    returntype=false;
                }
                if($('#fullname').val()==""){
                    $('#fullname_error').html('Please mention name');
                    $('#fullname').focus();
                    $('#fullname').addClass('is-invalid');
                    returntype=false;
                }
                 if($('#contactno').val()==""){
                    $('#contactno_error').html('Please mention contact number');
                    $('#contactno').focus();
                    $('#contactno').addClass('is-invalid');
                    returntype=false;
                }
                
            }
            return returntype;
        },
        remove_err(fieldId,errorId){
            if($('#'+fieldId).val()!=""){
                $('#'+errorId).html('');
                $('#'+fieldId).removeClass('is-invalid');
            }
        }
    },
     mounted() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    },
    
}
</script>