<template>
    <div>
        <form class="bootbox-form" id="infrastructureId">
            <div class="card-body">
                <form class="form-horizontal">
                <div class="row invoice-info">
                    <div class="col-sm-2 invoice-col">
                        <label class="mb-0"><i><u>Structure Type</u></i></label>
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                        <p>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Facility:<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select name="category" id="category" class="form-control editable_fields" v-model="form.category" :class="{ 'is-invalid': form.errors.has('category') }" @change="getSubFacilityDropdown(),remove_err('category')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in facilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="category"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">No. of Facilities :<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input class="form-control editable_fields " id="structureNo" type="text" v-model="form.structureNo" @change="getfields('structureNo')">
                            </div>
                           
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.yearofconstructinNo' :key="index">
                                 <label>Year of Construction for structure {{index+1}}:<span class="text-danger">*</span></label>
                                <input class="form-control editable_fields" name="consYear" id="consYear" type="text"
                                v-model="yr.consYear" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.facilitytype' :key="index">
                                 <label>type of facilities {{index+1}}:<span class="text-danger">*</span></label>
                                   <select name="facilityname" id="facilityname" class="form-control editable_fields" v-model="form.facilityname " :class="{ 'is-invalid': form.errors.has('type') }" @change="remove_err('type'), showfield('type')">
                                         <option v-for="(item, index) in facilitySubList" :key="index" v-bind:value="item.id">{{ item.typeName }}</option>
                                      </select>
                                <!-- <input class="form-control editable_fields" name="facilityname" id="facilityname" type="text"
                                v-model="yr.facilityname" > -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.yearofconstructinNo' :key="index">
                                 <label>Supported by {{index+1}}:<span class="text-danger">*</span></label>
                                <input class="form-control editable_fields" name="consYear" id="consYear" type="text"
                                v-model="yr.consYear" >
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.yearofconstructinNo' :key="index">
                                 <label>Size/Area {{index+1}}:<span class="text-danger">*</span></label>
                                <input class="form-control editable_fields" name="consYear" id="consYear" type="text"
                                v-model="yr.consYear" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" v-for='(yr, index) in form.yearofconstructinNo' :key="index">
                                 <label>Size/Area {{index+1}}:<span class="text-danger">*</span></label>
                                <input class="form-control editable_fields" name="consYear" id="consYear" type="text"
                                v-model="yr.consYear" >
                            </div>
                        </div>
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
            categoryList:[],
            subCategortList:[],
            facilityList:[],
            designerList:[],
            contructionTypeList:[],
            users: [],
            form: new form({
                id: '',
                organizationId:'',
                category: '',
                subCategory: '',
                constructionType:'',
                structureNo: '',
               // yearOfConstruction: '',
                plintchArea: '',
                noOfFloor: '',
                totalCapacity: '',
                rampAccess: '1',
                presentCondition: '1',
                design: '',
                yearofconstructinNo:[],
                users:
                [{
                    facility:'',remarks:'',capacity:'',noOfFacility:'',accessibleDisabled:'',internetConnection:''
                }],
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.category= '';
            this.form.subCategory= '';
            this.form.structureNo= '';
            this.form.constructionType = '';
            this.form.yearOfConstruction= '';
            this.form.plintchArea= '';
            this.form.noOfFloor='';
            this.form.totalCapacity='';
            this.form.rampAccess='1';
            this.form.presentCondition='1';
            this.form.design='';
            let formReset =this.form.users;
            formReset.splice(0, formReset.length);
            this.form.users.push({facility:'',type:'',remarks:'',capacity:'',noOfFacility:'',accessibleDisabled:'',internetConnection:''})
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/organization/saveInfrastructure',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Infrastructure is added successfully'
                    })
                    this.$router.push('/infrastructure_list');
                })
                .catch(() => {
                    console.log("Error......")
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

        /**
         * method to get category in dropdown
         */
        getCategoryDropdown(uri = '/organization/getCategoryInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.categoryList = data;
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
            for(let i=0;i<$('#'+id).val();i++){
                this.form.yearofconstructinNo.push({consYear:''});
                this.form.facilitytype.push({facilityname:''})
            }
        }
    },
    mounted() {
        this.getCategoryDropdown();
        this.getFacilityDropdown();
        this.getDesignerDropdown();
        this.loadconstructionTypeList();
        this.getSubCategoryDropdown();
    }
}
</script>
