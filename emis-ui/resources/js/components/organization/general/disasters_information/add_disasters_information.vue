<template>
    <div>
        <form class="bootbox-form" id="disastercomm-detial">
            <div class="card-body">
                <div class="form-group row">
                    <input type="hidden" class="form-control" v-model="form.organizationId"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label class="mb-0.5">Disaster Type:<i class="text-danger">*</i></label>
                      <select v-model="form.diastertype" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('diastertype') }" class="form-control select2" name="diastertype" id="diastertype">
                         <option v-for="(item, index) in Disaster_Committee_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                     </select> 
                  <!--<input type="text" class="form-control" @change="removeerror('diastertype')" :class="{ 'is-invalid': form.errors.has('diastertype') }" id="diastertype" v-model="form.diastertype">-->
                     <has-error :form="form" field="diastertype"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <label class="mb-0.5">Disaster Committe:<i class="text-danger">*</i></label>
                       <select v-model="form.diastercomm" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('diastercomm') }" class="form-control select2" name="diastercomm" id="diastercomm">
                         <option v-for="(item, index) in Disaster_Committee_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                       </select> 
                    <!--    <input type="text" class="form-control" @change="removeerror('diastercomm')" :class="{ 'is-invalid': form.errors.has('diastercomm') }" id="fullname" v-model="form.diastercomm"> -->
                      <has-error :form="form" field="diastercomm"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">CID:<span class="text-danger">*</span></label> 
                        <input type="text" class="form-control" @keyup.enter="getDetailsbyCID('cid_passport','std')" @blur="getDetailsbyCID('cid_passport','std')" @change="removeerror('cid_passport')" :class="{ 'is-invalid': form.errors.has('cid_passport') }" id="cid_passport" v-model="form.cid_passport" placeholder="Identification No">
                        <has-error :form="form" field="cid_passport"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label > Full Name: </label>
                         <input type="text" class="form-control" @change="removeerror('fullname')" :class="{ 'is-invalid': form.errors.has('fullname') }" id="fullname" v-model="form.fullname" placeholder="Full Name">
                        <has-error :form="form" field="fullname"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Gender:<span class="text-danger">*</span></label>
                        <select v-model="form.sex_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('sex_id') }" class="form-control select2" name="sex_id" id="sex_id">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in sex_idList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="sex_id"></has-error>
                    </div>
                </div> 
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-1">Email:<i class="text-danger">*</i></label>
                        <input pattern="^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$" type="email" required  @change="remove_error('email')" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" name="email" id="email">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-1">Contact No:<i class="text-danger">*</i></label>
                        <input name="contactno"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" maxlength = "8"
                         @change="remove_error('contactno')" v-model="form.contactno" :class="{ 'is-invalid': form.errors.has('contactno') }" class="form-control"  id="contactno" >
                        <has-error :form="form" field="contactno"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-1">Serving As:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('servining_as')" v-model="form.servining_as" :class="{ 'is-invalid': form.errors.has('servining_as') }" class="form-control" name="servining_as" id="servining_as" >
                        <has-error :form="form" field="servining_as"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <label >Place of Work and Address: </label>
                        <textarea class="form-control" rows="3" @change="removeerror('fulladdress')" :class="{ 'is-invalid': form.errors.has('fulladdress') }" id="fulladdress" v-model="form.fulladdress" placeholder="Permanent Address"></textarea>
                        <has-error :form="form" field="fulladdress"></has-error>
                    </div>
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
            
            sex_idList:[],
            Disaster_Committee_list:[],
            disasterList:[],
           
            form: new form({
                id: '', 
                diastertype:'',
                diastercomm:'', 
                cid_passport: '',
                fullname:'',
                sex_id: '',
                email: '',
                contactno:'',
                servining_as:'',
                fulladdress: '',
               
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
            this.form.id= '';
            this.form.diastertype ='';
            this.form.diastercomm = '';
            this.form.cid_passport = '';
            this.form.fullname= '';
            this.form.sex_id= '';
            this.form.email= '';
            this.form.contactno = '';
            this.form.servining_as= '';
            this.form.fulladdress='';
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/organization/saveDisasterInformation',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: ' Detail is added successfully'
                    })
                    this.$router.push('/list_disasters_information');
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
        applyselect(type){
            if(type=="std"){
                if(!$('#sex_id').attr('class').includes('select2-hidden-accessible')){
                    $('#sex_id').addClass('select2-hidden-accessible');
                }
               
            }
            
        },
        loadlDisasterCommitteeList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/DisasterCommittee'){
            axios.get(uri)
            .then(response => {
             let data = response.data.data;
             this.Disaster_Committee_list =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        loadDisasterList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/Disaster'){
            axios.get(uri)
             .then(response => {
                let data = response.data.data;
                 this.disasterList =  data;
            })
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
                        this.form.fullname = personal_detail.firstName + " " + personal_detail.lastName;
                        // this.form.middle_name = personal_detail.middleName;
                        // this.form.last_name = personal_detail.lastName;
                        
                        // this.personal_form.name = personal_detail.firstName + " " + personal_detail.lastName;
                        //             let date_of_birth = new Date(personal_detail.dob);

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
                     //   this.form.dob = month+ "-"+day + "-" + year;
                     //    $('#dob').val(month+ "-"+day + "-" + year);
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
        loadDisasterList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/Disaster'){
             axios.get(uri)
            .then(response => {
                 let data = response.data.data;
                 this.disasterList =  data;
            })
        },
    },
     mounted() { 
        this.loadlDisasterCommitteeList();
        this.loadDisasterList();
        this.loadAllActiveMasters('all_active_gender');
           $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
    }
}
</script>