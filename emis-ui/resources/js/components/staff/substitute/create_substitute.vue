<template>
    <div>
        <form class="bootbox-form">
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">CID:<i class="text-danger">*</i></label>
                    <input @keyup.enter="getDetailsbyCID()" @blur="getDetailsbyCID"  v-model="form.cid" :class="{ 'is-invalid': form.errors.has('cid') }" type="text" id="cid" class="form-control" @change="remove_err('cid')">
                    <has-error :form="form" field="cid"></has-error>
                    <span class="text-danger" id="cid_err"></span>
                </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5"> Full Name:<i class="text-danger">*</i></label>
                    <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" id="name" class="form-control" @change="remove_err('name')">
                    <has-error :form="form" field="name"></has-error>
                    <span class="text-danger" id="name_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Gender:<i class="text-danger">*</i></label>
                    <select v-model="form.gender" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('gender') }" class="form-control select2" name="gender" id="gender">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="gender"></has-error>
                    <span class="text-danger" id="gender_err"></span>
                </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5"> DOB:<i class="text-danger">*</i></label>
                    <input v-model="form.dob" :class="{ 'is-invalid': form.errors.has('dob') }" type="text" id="dob" class="form-control" @change="remove_err('dob')">
                    <has-error :form="form" field="dob"></has-error>
                    <span class="text-danger" id="dob_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Dzongkhag:<i class="text-danger">*</i></label>
                    <select v-model="form.dzongkhag" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                        <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="dzongkhag"></has-error>
                    <span class="text-danger" id="dzongkhag_err"></span>
                </div>
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Designation:<i class="text-danger">*</i></label>
                    <input v-model="form.qualification" :class="{ 'is-invalid': form.errors.has('qualification') }" type="text" id="qualification" class="form-control" @change="remove_err('qualification')">
                    <has-error :form="form" field="qualification"></has-error>
                    <span class="text-danger" id="designation_err"></span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5">Contact Number:<i class="text-danger">*</i></label>
                    <input v-model="form.contact" :class="{ 'is-invalid': form.errors.has('contact') }" type="text" id="contact" class="form-control" @change="remove_err('contact')">
                    <has-error :form="form" field="contact"></has-error>
                    <span class="text-danger" id="contact_err"></span>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="mb-0.5"> Email:<i class="text-danger">*</i></label>
                    <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" type="text" id="email" class="form-control" @change="remove_err('email')">
                    <has-error :form="form" field="email"></has-error>
                    <span class="text-danger" id="email_err"></span>
                </div>
            </div>
            <div class="row form-group fa-pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary" @click="submitDetails()"> <i class="fa fa-save"></i>Save </button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            sex_idList:[],
            dzongkhagList:[],
            form: new form({
                id:'',
                cid:'',
                name:'',
                dob:'',
                gender:'',
                dzongkhag:'',
                contact:'',
                email:'',
                qualification:'',
                action_type:'',
            }),
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },


        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="gender"){
                this.form.gender=$('#gender').val();
            }
            if(id=="dzongkhag"){
                this.form.dzongkhag=$('#dzongkhag').val();
            }
        },

        getDetailsbyCID(){
            if (this.form.cid.length == 11){
                axios.get('getpersonbycid/'+ this.form.cid)
                .then(response => {
                    this.ciderror = '';
                    let personal_detail = response.data;
                    if (personal_detail!=""){
                        let fullname=personal_detail.firstName;
                        if(personal_detail.middleName!=null && personal_detail.middleName!="null" && personal_detail.middleName!=""){
                            fullname=fullname+' '+personal_detail.middleName;
                        }
                        if(personal_detail.lastName!=null && personal_detail.lastName!="null" && personal_detail.lastName!=""){
                            fullname=fullname+' '+personal_detail.lastName;
                        }
                        $('#cid').prop('disabled',true);
                        this.form.name = fullname;
                        $('#name').prop('disabled',true);
                        this.form.dob =personal_detail.dob;
                        $('#dob').prop('disabled',true);

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
                                $('#gender').val(this.sex_idList[i].id).trigger('change');
                                this.form.gender = this.sex_idList[i].id;
                            }
                        }
                        $('#gender').prop('disabled',true);
                        this.form.dzongkhag = personal_detail.dzongkhagId;
                        $('#dzongkhag').val(personal_detail.dzongkhagId).trigger('change');
                        $('#dzongkhag').prop('disabled',true);
                        this.form.contact = personal_detail.mobileNumber;
                    }else{
                        this.ciderror = 'Invalid CID.';
                        Swal.fire({
                            html: "No data found for matching CID",
                            icon: 'info'
                        });
                    }
                })
                .catch((e) => {
                    this.ciderror = 'Invalid CID / service down.';
                    Swal.fire({
                        html: "No data found for matching CID/service down"+e,
                        icon: 'error'
                    });
                });
            }
        },
        submitDetails(){
            if(this.validateform()){
                Swal.fire({
                    text: "Are you sure you wish to save this staff details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('staff/substitution/savestaff')
                        .then((response)=> {
                            Swal.fire(
                                'Success!',
                                'Details has been saved successfully.',
                                'success',
                            )
                            this.$router.push('/list_substitute');
                        })
                        .catch((error) => {
                            console.log("Error shownexttab:"+error)
                        });
                    }
                });
            }
        },
        validateform(){
            let returntype=true;
            if($('#cid').val()==""){
                $('#cid_err').html('Please provide CID');
                returntype=false;
            }
            if($('#name').val()==""){
                $('#name_err').html('Please provide name of the person');
                returntype=false;
            }
            if($('#contact').val()==""){
                $('#contact_err').html('Please provide contact number');
                returntype=false;
            }
            return returntype;
        }
    },
    async mounted(){
        this.sex_idList =  await this.loadactiveGlobalList('all_active_gender');
        this.dzongkhagList =await this.loadactivedzongkhags();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=>{
            this.changefunction(id);
        });
    },
}
</script>
