<template>
    <div>
        <form class="bootbox-form" id="aboradstudent-detial">
            <div class="card-body">
                <div class="form-group row">
                    <input type="hidden" class="form-control" v-model="form.organizationId"/>
                      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                        <label class="">CID:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @keyup.enter="getDetailsbyCID('cid_passport','std')" @blur="getDetailsbyCID('cid_passport','std')" @change="removeerror('cid_passport')" :class="{ 'is-invalid': form.errors.has('cid_passport') }" id="cid_passport" v-model="form.cid_passport" placeholder="Identification No">
                        <has-error :form="form" field="cid_passport"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >First Name:<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" @change="removeerror('first_name')" :class="{ 'is-invalid': form.errors.has('first_name') }" id="first_name" v-model="form.first_name" placeholder="First Name">
                            <has-error :form="form" field="first_name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label > Middle Name: </label>
                         <input type="text" class="form-control" @change="removeerror('middle_name')" :class="{ 'is-invalid': form.errors.has('middle_name') }" id="middle_name" v-model="form.middle_name" placeholder="Middle Name">
                        <has-error :form="form" field="middle_name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Last Name: </label>
                        <input type="text" class="form-control" @change="removeerror('last_name')" :class="{ 'is-invalid': form.errors.has('last_name') }" id="last_name" v-model="form.last_name" placeholder="Last Name">
                        <has-error :form="form" field="last_name"></has-error>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <label>Date of Birth:<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" @change="removeerror('dob')" :class="{ 'is-invalid': form.errors.has('dob') }" id="dob" v-model="form.dob" placeholder="Date of Birth">
                        <has-error :form="form" field="dob"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Gender:<span class="text-danger">*</span></label>
                        <select v-model="form.sex_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('sex_id') }" class="form-control select2" name="sex_id" id="sex_id">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="sex_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Mother Tongue:<span class="text-danger">*</span></label>
                        <select v-model="form.mother_tongue" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('mother_tongue') }" class="form-control select2" name="mother_tongue" id="mother_tongue">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in motherTongueList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="mother_tongue"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Is the child currently  studying?:<span class="text-danger">*</span></label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1"/> Yes</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> No</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Present Address: </label>
                        <textarea class="form-control" rows="3" @change="removeerror('fulladdress')" :class="{ 'is-invalid': form.errors.has('fulladdress') }" id="fulladdress" v-model="form.fulladdress" placeholder="Present Address"></textarea>
                        <has-error :form="form" field="fulladdress"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Country : </label>
                         <select v-model="form.country" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('country') }" class="form-control select2" name="country" id="country">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in countryList" :key="index" v-bind:value="item.id">{{ item.country_name }}</option>
                        </select>
                        <has-error :form="form" field="country"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>City:</label>
                        <input type="text" v-model="form.city" class="form-control editable_fields" id="city" />
                    </div>
                </div>
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Contact No:</label>
                    <input class="form-control editable_fields" name="phone" id="phone" type="number" 
                    v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" @change="remove_err('phone')">
                    <has-error :form="form" field="phone"></has-error>
                        <!-- <input type="text" v-model="form.phone" class="form-control editable_fields" id="phone" /> -->
                </div>
            </div>

            <div class="card-footer text-right">
                 <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                 <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>

</template>

<script>
export default {
    data(){
        return{
            countryList:[],
            sex_idList:[],
            dzongkhagList:[],
            std_gewog_list:[],
            std_villageList:[],
            motherTongueList:[],
            form: new form({
                id: '',
                organizationId:'',
                cid_passport: '',
                first_name: '',
                middle_name:'',
                last_name:'',
                dob: '',
                sex_id: '',
                mother_tongue: '',
                status: '1',
                fulladdress: '',
                country:'',
                city: '',
                phone:'',
            })
        }
    },

    methods:{

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        /**
         * method to reset form
         */
        restForm(){
            this.form.cid_passport= '';
            this.form.first_name = '';
            this.form.middle_name = '';
            this.form.last_name= '';
            this.form.dob= '';
            this.form.sex_id= '';
            this.form.mother_tongue= '';
            this.form.status= '';
            this.form.fulladdress='';
            this.form.country = '';
            this.form.city = '';
            this.form.phone = '';
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/students/saveStudentAboard',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: ' Detail is added successfully'
                    })
                    this.$router.push('/studentaboard_list');
                })
                .catch(() => {
                    console.log("Error......");
                    this.applyselect();
                })
            }
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
                if(type=="all_country"){
                    this.countryList = data.data.data;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        applyselect(type){
            if(type=="std"){
                if(!$('#sex_id').attr('class').includes('select2-hidden-accessible')){
                    $('#sex_id').addClass('select2-hidden-accessible');
                }
                if(!$('#mother_tongue').attr('class').includes('select2-hidden-accessible')){
                    $('#mother_tongue').addClass('select2-hidden-accessible');
                }
            }

        },
        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html('');
            }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="sex_id"){
                this.form.sex_id=$('#sex_id').val();
            }
            if(id=="mother_tongue"){
                this.form.mother_tongue=$('#mother_tongue').val();
            }
            if(id=="country"){
                this.form.country=$('#country').val();
            }
        },
        getDetailsbyCID(fieldId){
            if ($('#'+fieldId).val().length != 11){
                Swal.fire({
                    html: "Please ender 11 digit CID",
                    icon: 'error'
                });
            }



            else{
                axios.get('getpersonbycid/'+ $('#'+fieldId).val())
                .then(response => {
                    if (JSON.stringify(response.data)!='{}'){
                        let personal_detail = response.data.citizenDetail[0];
                        this.form.first_name = personal_detail.firstName;
                        this.form.middle_name = personal_detail.middleName;
                        this.form.last_name = personal_detail.lastName;
                        let date_of_birth = new Date(personal_detail.dob);
                        let month =(date_of_birth .getMonth() + 1);
                        let day = date_of_birth .getDate();
                         if(day<10){
                            day='0'+day;
                        }
                        if(month<10){
                            month='0'+month;
                        }
                        let year =date_of_birth .getFullYear();
                        this.form.dob = year+ "-"+month + "-" + day;
                         $('#dob').val(year+ "-"+month + "-" + day);
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
                                this.form.sex_id =  this.sex_idList[i].id;
                            }
                        }
                        // this.form.dzongkhag =personal_detail.dzongkhagId;
                        //  $('#dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                        // this.getgewoglist(personal_detail.dzongkhagId);
                        // this.form.gewog = personal_detail.gewogId;
                        // this.getvillagelist(personal_detail.gewogId);
                        // $('#village_id').val(personal_detail.villageSerialNo).trigger('change');
                        // this.form.village_id = personal_detail.villageSerialNo;
                    }else{
                        Swal.fire({
                            html: "No data found for this CID",
                            icon: 'error'
                        });
                    }
                })
                .catch((exception) => {
                    Swal.fire({
                         html: "No data found for matching CID/service down"+exception,
                        icon: 'error'
                    });
                });
            }

        },
    },
    mounted() {
        this.loadAllActiveMasters('all_country');
        this.loadAllActiveMasters('all_active_gender');
        this.loadAllActiveMasters('active_mother_tongue');

           $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.form.id=this.$route.params.data.id;
        this.form.cid_passport=this.$route.params.data.cid_passport;
        this.form.first_name=this.$route.params.data.first_name;
        this.form.middle_name=this.$route.params.data.middle_name;
        this.form.last_name=this.$route.params.data.last_name;
        this.form.sex_id=this.$route.params.data.sex_id;  dob
        this.form.dob=this.$route.params.data.dob;
        this.form.mother_tongue=this.$route.params.data.mother_tongue;
        this.form.status=this.$route.params.data.status;
        this.form.fulladdress=this.$route.params.data.fulladdress;
        this.form.country=this.$route.params.data.country;
        this.form.city=this.$route.params.data.city;
        this.form.phone=this.$route.params.data.phone;
        this.form.organizationId=this.$route.params.data.organizationId;
    }
}
</script>
