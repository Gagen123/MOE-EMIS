<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Student:<i class="text-danger">*</i></label>
                    <select v-model="student_form.student" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('student') }" class="form-control select2" name="student" id="student">
                        <option v-for="(item, index) in studentList" :key="index" v-bind:value="item.id">{{ item.Name }} ({{item.student_code}})</option>
                    </select>
                    <has-error :form="student_form" field="student"></has-error>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" @change="remove_error('date')" class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" name="date" id="date">
                    </div>
                </div>
            </div>
            <hr>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label> Guardian Nationality:<span class="text-danger">*</span></label><br>
                    <input type="radio" name="snationality" v-model="student_form.snationality" value="Bhutanese" id="s-bhutanese" @click="showstdidentity('Student-Bhutanese')" checked> Bhutanese
                    <input type="radio" name="snationality" v-model="student_form.snationality" value="Bhutanese Under Process" id="s-bhutanese-underprocess" @click="showstdidentity('Student-Bhutanese-underprocess')" checked> Bhutanese (under process)
                    <input type="radio" name="snationality" v-model="student_form.snationality" value="Foreign" id="s-foreign" @click="showstdidentity('Student-Non-Bhutanese')"> Non-Bhutanese
                    <span class="text-danger" id="snationality_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label id="level_name">Guardian CID/Other Identification</label>
                    <input type="text" class="form-control" @keyup.enter="getDetailsbyCID('cid_passport','std')" @change="removeerror('cid_passport')" :class="{ 'is-invalid': student_form.errors.has('cid_passport') }" id="cid_passport" v-model="student_form.cid_passport" placeholder="Identification No">
                    <has-error :form="student_form" field="cid_passport"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label >First Name:<span class="text-danger">*</span> </label>
                    <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': student_form.errors.has('first_name') }" id="first_name" v-model="student_form.first_name" placeholder="First Name">
                    <has-error :form="student_form" field="first_name"></has-error>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label > Middle Name: </label>
                    <input type="text" class="form-control" @change="removeerror('middle_name')" :class="{ 'is-invalid': student_form.errors.has('middle_name') }" id="middle_name" v-model="student_form.middle_name" placeholder="Middle Name">
                    <has-error :form="student_form" field="middle_name"></has-error>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label >Last Name: </label>
                    <input type="text" class="form-control" @change="removeerror('last_name')" :class="{ 'is-invalid': student_form.errors.has('last_name') }" id="last_name" v-model="student_form.last_name" placeholder="Last Name">
                    <has-error :form="student_form" field="last_name"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Date of Birth:<span class="text-danger">*</span></label>
                    <input type="date" class="form-control" @change="removeerror('dob')" :class="{ 'is-invalid': student_form.errors.has('dob') }" id="dob" v-model="student_form.dob" placeholder="Date of Birth">
                    <has-error :form="student_form" field="dob"></has-error>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Gender:<span class="text-danger">*</span></label>
                    <select v-model="student_form.sex_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('sex_id') }" class="form-control select2" name="sex_id" id="sex_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="student_form" field="sex_id"></has-error>
                </div>
            </div>
            <div class="row form-group" id="dzo_gewog_village">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Dzongkhag/Thromde: </label>
                    <select v-model="student_form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="student_form" field="dzongkhag"></has-error>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label> Gewog:</label>
                    <select v-model="student_form.gewog" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('gewog') }" class="form-control select2" name="gewog" id="gewog">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in std_gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="student_form" field="gewog"></has-error>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label>Village: </label>
                    <select v-model="student_form.village_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('village_id') }" class="form-control select2" name="village_id" id="village_id">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in std_villageList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="student_form" field="village_id"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <label >Working Address: </label>
                    <textarea class="form-control" rows="3" @change="removeerror('fulladdress')" :class="{ 'is-invalid': student_form.errors.has('fulladdress') }" id="fulladdress" v-model="student_form.fulladdress" placeholder="Permanent Address"></textarea>
                    <has-error :form="student_form" field="fulladdress"></has-error>
                </div>
            </div>
            <div class="row">
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            studentList:[],
            sex_idList:[],
            dzongkhagList:[],
            std_gewog_list:[],
            std_villageList:[],
            offenceTypeList:[],
            actionTakenList:[],
            severityList:[],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                id:'',
                student:'',
                snationality:'',
                cid_passport:'',
                first_name:'',
                middle_name:'',
                last_name:'',
                dob:'',
                dzongkhag:'',
                gewog:'',
                village_id:'',
                record_type:'update_guardian',
                action_type:'add'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        getDetailsbyCID(cid,type){
            let selectedVal="";
            let selected ="";
            if(type=="std"){
                selected = $("input[type='radio'][name='snationality']:checked");
                if(selected.length > 0) {
                    selectedVal=selected.val();
                }
                else{
                    Swal.fire({
                        html: "Please select nationality",
                        icon: 'error'
                    });
                }
            }
            if(selectedVal.includes('Bhutan')){
                if ($('#'+cid).val().length != 11){
                    Swal.fire({
                        html: "Please enter 11 digit CID",
                        icon: 'error'
                    });
                }
                else{
                    this.getPersonalDetailsbyCID($('#'+cid).val(),type);
                    let fatherCid="";
                    let motherCid="";
                    if(type=='std'){
                        axios.get('getchildDetailsOncid/'+ $('#'+cid).val())
                        .then(response => {
                            let data=response.data.data;
                        });
                    }
                }
            }            
        },
        getPersonalDetailsbyCID(cidNo,type){
            // if(type=="father"){
            //     selected = $("input[type='radio'][name='father_nationality']:checked");
            // }
            // if(type=="mother"){
            //     selected = $("input[type='radio'][name='mother_nationality']:checked");
            // }
            // if(type=="gardain"){
            //     selected = $("input[type='radio'][name='gardain_nationality']:checked");
            // }
            
            axios.get('getpersonbycid/'+ cidNo)
            .then(response => {
                if (response.data) {
                    let personal_detail = response.data;
                    if(type=="std"){
                        this.student_form.first_name = personal_detail.firstName;
                        $('#first_name').prop('readonly',true);
                        this.student_form.middle_name=personal_detail.middleName;
                        $('#middle_name').prop('readonly',true);
                        this.student_form.last_name=personal_detail.lastName;
                        $('#last_name').prop('readonly',true);
                        let dob=personal_detail.dob;
                        if(dob.includes('-')){
                            dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                        }
                        if(dob.includes('/')){
                            dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                        }
                        this.student_form.dob = dob;

                        $('#dob').prop('readonly',true);
                        if(personal_detail.gender=="M"){
                            personal_detail.gender="male";
                        }
                        else if(personal_detail.gender=="F"){
                            personal_detail.gender="female";
                        }
                        else{
                            personal_detail.gender="others";
                        }
                        for(let i=0; i<this.sex_idList.length;i++){
                            if(this.sex_idList[i].name.toLowerCase()==personal_detail.gender){
                                $('#sex_id').val(this.sex_idList[i].id).trigger('change');
                                this.student_form.sex_id =  this.sex_idList[i].id;
                                $('#sex_id').prop('disabled',true);
                            }
                        }
                        this.student_form.dzongkhag =personal_detail.dzongkhagId;
                        $('#dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                        $('#dzongkhag').prop('disabled',true);
                        this.getgewoglist(personal_detail.dzongkhagId,'std');
                        this.student_form.gewog = personal_detail.gewogId;
                        $('#gewog').prop('disabled',true);
                        this.getvillagelist(personal_detail.gewogId,'std');
                        $('#village_id').val(personal_detail.villageSerialNo).trigger('change');
                        this.student_form.village_id = personal_detail.villageSerialNo;
                        $('#village_id').prop('disabled',true);
                    }
                }else{
                    this.ciderror = 'Invalid CID.';
                    Swal.fire({
                        html: "No data found for matching CID",
                        icon: 'info'
                    });
                }

            })
            .catch((exception) => {
                Swal.fire({
                    html: "No data found for matching CID/service down"+exception,
                    icon: 'error'
                });
            });
        },
        getgewoglist(id,type){
            let dzoId=$('#dzongkhag').val();
            if(id!=""){
                dzoId=id;
            }
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            if(type=="std"){
                this.std_gewog_list =[];
            }
            if(type=="p_father"){
                this.p_father_gewog_list=[];
            }
            if(type=="father"){
                this.father_gewog_list=[];
            }
            if(type=="p_mother"){
                this.p_mother_gewog_list=[];
            }
            if(type=="mother"){
                this.mother_gewog_list=[];
            }
            if(type=="p_gardain"){
                this.p_gardain_gewog_list=[];
            }
            if(type=="gardain"){
                this.gardain_gewog_list=[];
            }
            axios.get(uri)
            .then(response =>{
                let data = response;
                if(type=="std"){
                    this.std_gewog_list = data.data.data;
                }
                if(type=="p_father"){
                    this.p_father_gewog_list=data.data.data;
                }
                if(type=="father"){
                    this.father_gewog_list=data.data.data;
                }
                if(type=="p_mother"){
                    this.p_mother_gewog_list=data.data.data;
                }
                if(type=="mother"){
                    this.mother_gewog_list=data.data.data;
                }
                if(type=="p_gardain"){
                    this.p_gardain_gewog_list=data.data.data;
                }
                if(type=="gardain"){
                    this.gardain_gewog_list=data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getvillagelist(id,type){
            let gewogId=$('#gewog').val();
            if(id!=""){
                gewogId=id;
            }
            let uri = 'masters/all_active_dropdowns/gewog/'+gewogId;
            if(type=="std"){
                this.std_villageList =[];
            }
            if(type=="p_father"){
                this.p_father_villageList=[];
            }
            if(type=="father"){
                this.father_villageList=[];
            }
            if(type=="p_mother"){
                this.p_mother_villageList=[];
            }
            if(type=="mother"){
                this.mother_villageList=[];
            }
            if(type=="p_gardain"){
                this.p_gardain_villageList=[];
            }
            if(type=="gardain"){
                this.gardain_villageList=[];
            }
            axios.get(uri)
            .then(response =>{
                let data = response;
                if(type=="std"){
                    this.std_villageList = data.data.data;
                }
                if(type=="p_father"){
                    this.p_father_villageList=data.data.data;
                }
                if(type=="father"){
                    this.father_villageList=data.data.data;
                }
                if(type=="p_mother"){
                    this.p_mother_villageList=data.data.data;
                }
                if(type=="mother"){
                    this.mother_villageList=data.data.data;
                }
                if(type=="p_gardain"){
                    this.p_gardain_villageList=data.data.data;
                }
                if(type=="gardain"){
                    this.gardain_villageList=data.data.data;
                }

            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadAllActiveMasters(type){
            axios.get('masters/loadGlobalMasters/'+type)
            .then(response =>{
                let data = response;
                if(type=="active_mother_tongue"){
                    this.motherTongueList = data.data.data;
                }
                if(type=="all_active_dzongkhag"){
                    this.dzongkhagList = data.data.data;
                }
                if(type=="all_active_gender"){
                    this.sex_idList = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        
        loadStudentList(uri='students/loadStudentList/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.studentList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.student= '';
                this.student_form.remarks='';
                this.student_form.status= 1;
            }
            if(type=="save"){
                this.student_form.post('/students/saveStudentUpdates',this.student_form)
                .then((response) =>{
                    if(response.data.data==null){
                         Swal.fire({
                        text: "Sorry! Your Guardian details is not mapped to you",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Okay!',
                        })  
                    }
                    else{
                        Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    }
                     this.$router.push('/update_std_guardian');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="student"){
                this.student_form.student=$('#student').val();
            }
            if(id=="dzongkhag"){
                this.student_form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist($('#dzongkhag').val(),'std');
            }
            if(id=="gewog"){
                this.student_form.gewog=$('#gewog').val();
                this.getvillagelist($('#gewog').val(),'std');
            }
            if(id=="village_id"){
                this.student_form.village_id=$('#village_id').val();
            }
        },
    },
     mounted() {
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

        this.loadStudentList();
        this.loadAllActiveMasters('all_active_dzongkhag');
        this.loadAllActiveMasters('all_active_gender');
    },
    
}
</script>