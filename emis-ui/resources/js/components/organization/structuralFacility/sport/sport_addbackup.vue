<template>
    <div>
        <form class="bootbox-form" id="infrastructureId">
            <div class="card-body">
                <form class="form-horizontal">
                <div class="row invoice-info">
                    <div class="col-sm-2 invoice-col">
                        <label class="mb-0"><i><u>Sports Facilities</u></i></label>
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                        <p>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Facility:<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select name="facility" id="facility" class="form-control editable_fields" v-model="form.facility" :class="{ 'is-invalid': form.errors.has('facility') }" @change="getSubFacilityDropdown(),remove_err('facility')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in facilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="facility"></has-error>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">No. of Facilities :<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input class="form-control editable_fields " id="facilityno" type="text" v-model="form.facilityno" @change="getfields('facilityno')">
                            </div>
                           
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.yearofconstructinNo' :key="index">
                                 <label>Year of Construction for Facility {{index+1}}:<span class="text-danger">*</span></label>
                                <input class="form-control editable_fields" name="consYear" id="consYear" type="text"
                                v-model="yr.consYear" >
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.facilitytype' :key="index">
                                <label>Type of facilities for Facility {{index+1}}:<span class="text-danger">*</span></label>
                                <select name="facilityname" id="facilityname" class="form-control editable_fields"  :class="{ 'is-invalid': form.errors.has('facilityname') }" @change="remove_err('type')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in facilitySubList" :key="index" v-bind:value="item.id">{{ item.typeName }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.SupportType' :key="index">
                                <label>Supported by for Facility {{index+1}}:<span class="text-danger">*</span></label>
                                <select name="support" id="support" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('support') }" >
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in supportList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.sizeareatype' :key="index">
                                 <label>Size/Area of Facility {{index+1}}:<span class="text-danger">*</span></label>
                                <input class="form-control editable_fields" name="sizearea" id="sizearea" type="text"
                                v-model="yr.sizearea" >
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.yearofconstructinNo' :key="index">
                                 <label>Size/Area {{index+1}}:<span class="text-danger">*</span></label>
                                <input class="form-control editable_fields" name="consYear" id="consYear" type="text"
                                v-model="yr.consYear" >
                            </div>
                        </div> -->
                    </div>
                </div>
                
                </form>
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
            count:1,
            supportList:[],
            facilityList:[],
            designerList:[],
            facilitySubList:[],
             sportslist:[],
            form: new form({
                id: '',
                facility:'',
                // facilityname:'',
                facilityno: '',
              
                    yearofconstructinNo:[],
                    facilitytype:[],
                    SupportType:[],
                    sizeareatype:[],
              
               
                
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.facility= '';
           
        },

        /**
         * method to save data
         */
        formaction: function(type){ 
            if(type=="reset"){
                this.restForm();
            }
            // if(type=="save"){
            //          this.form.post('/organization/saveSport',this.form)
            //         .then(() => {
            //         Toast.fire({
            //             icon: 'success',
            //             title: 'Sports added successfully'
            //         })
            //         this.$router.push('/sport_list');
            //     })
            //     .catch(() => {
            //         console.log("Error......")
            //     })
            // }
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        
                        for(let i=0;i<this.form.facilitytype.length;i++){
                             this.form.facilitytype[i]=$('#facilityname').val();
                            // this.form.facilitytype=$('#facilityname').val();
                        }
                        for(let i=0;i<this.form.SupportType.length;i++){
                             this.form.SupportType[i]=$('#support').val();
                            // this.form.facilitytype=$('#facilityname').val();
                        }
                        // this.form.facilitytype=$('#facilityname').val();
                        // this.form.
                        this.form.post('/organization/saveSport',this.form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/sport_list');
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured. Try again.'
                            });
                            console.log("Error:"+error);
                        })
                    }
                })
            }
		},

        getSubFacilityDropdown(uri = '/organization/getSubFacilityDropdown/' +this.form.facility){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilitySubList = data;
            });
        },
        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="facilityname"){
                this.form.facilitytype=[];
                this.form.facilitytype=$('#facilityname').val();
                alert (this.form.facilitytype);
            }
        },

        /**
         * method to get category in dropdown
         */
        getSupportDropdown(uri = '/organization/getSupportInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.supportList = data;

            });
        },
        /**
         * method to get sub category in dropdown
         */
        getSubFacilityDropdown(uri = '/organization/getSubFacilityDropdown/' +this.form.facility){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilitySubList = data;
            });
        },

        /**
         * method to get facility in dropdown
         */
        getFacilityDropdown(uri ='/organization/getFacilityInDropdown/'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilityList = data;
            });
        },

        /**
         * method to get category in dropdown
         */
        getDesignerDropdown(uri = '/organization/getDesignerDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.designerList = data;
            });
        },
        loadconstructionTypeList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ConstructionType'){
            axios.get(uri)
            .then(response => {
                 let data = response.data.data;
                this.contructionTypeList =  data;
            })
            .catch(function (error) {
                    console.log('error: '+error);
            });
        },

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.users.push({
                facility:'',type:'',remarks:'',capacity:'',noOfFacility:'',
                accessibleDisabled:'',internetConnection:''})
        },
        /**
         * method to remove fields
         */
        remove(index){
             if(this.form.users.length>1){
                this.count--;
                this.form.users.splice(index,1);
            }
        },
        getfields(id){
            this.form.yearofconstructinNo=[];
            this.form.facilitytype=[];
            this.form.SupportType=[];
            this.form.sizeareatype=[];
            for(let i=0;i<$('#'+id).val();i++){
                this.form.yearofconstructinNo.push({consYear:''});
                this.form.facilitytype.push({facilityname:''});
                this.form.SupportType.push({support:''});
                this.form.sizeareatype.push({sizearea:''})
            }
        }
    },
    mounted() {
        
        this.getFacilityDropdown();
        this.getSupportDropdown();
        this.getSubFacilityDropdown();
    }
}
</script>
