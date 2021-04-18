<template>
    <div>
        <form class="bootbox-form" id="infrastructureId">
            <div class="card-body">
                <div class="form-group row">
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <input type="hidden" class="form-control" v-model="form.organizationId"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Category:<span class="text-danger">*</span></label> 
                        <select name="category" id="category" class="form-control editable_fields" v-model="form.category" :class="{ 'is-invalid': form.errors.has('category') }" @change="getSubCategoryDropdown(),remove_err('category')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in categoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="category"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Sub Category:<span class="text-danger">*</span></label> 
                        <select name="subCategory" id="subCategory" class="form-control editable_fields" v-model="form.subCategory" :class="{ 'is-invalid': form.errors.has('subCategory') }" @change="remove_err('subCategory')">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in subCategortList" :key="index" v-bind:value="item.id">{{ item.subCategoryName }}</option>
                        </select>
                        <has-error :form="form" field="subCategory"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Structure No:</label> 
                        <input class="form-control editable_fields " id="structureNo" type="text" v-model="form.structureNo">
                    </div>
                </div>
                                    
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Year of Construction:<span class="text-danger">*</span></label> 
                        <input class="form-control editable_fields" name="yearOfConstruction" id="yearOfConstruction" type="text" 
                        v-model="form.yearOfConstruction" :class="{ 'is-invalid': form.errors.has('yearOfConstruction') }" @change="remove_err('yearOfConstruction')">
                        <has-error :form="form" field="yearOfConstruction"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Plinth Area (sq. m):</label>
                        <input class="form-control editable_fields " id="plintchArea" type="text" v-model="form.plintchArea">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">No. of Floors:</label> 
                        <input class="form-control editable_fields " id="noOfFloor" type="number" v-model="form.noOfFloor">
                    </div>
                </div>
                                    
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Total Capacity</label> 
                        <input class="form-control editable_fields " id="totalCapacity" type="number" v-model="form.totalCapacity">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Present Condition of Structure<span class="text-danger">*</span> </label> 
                        <br>
                        <label><input v-model="form.presentCondition"  type="radio" value="1"/> Usable</label>
                        <label><input v-model="form.presentCondition"  type="radio" value="0" /> Not Usable</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Designed by</label>
                        <select name="design" id="design" class="form-control" v-model="form.design">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in designerList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="">Ramp Access in Ground Floor</label>
                        <br>
                        <label><input v-model="form.rampAccess"  type="radio" value="1"/> Yes</label>
                        <label><input v-model="form.rampAccess"  type="radio" value="0" /> No</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>&nbsp;&nbsp; Facility</b><br>
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Facility</th>
                                    <!-- <th>Type</th> -->
                                    <th>Facility No./Name</th>
                                    <th>Capacity</th>
                                    <th>Total number of Facility</th>
                                    <th>Facility accessible to disabled</th>
                                    <th>Facility with internet connection</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1" v-for='(user, index) in form.users' :key="index">
                                    <td>
                                        <select name="facility" id="facility" class="form-control editable_fields" v-model="user.facility">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in facilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                    </td>
                                    <!-- <td>                                
                                        <select name="type" id="type" class="form-control editable_fields" v-model="user.type">
                                            <option value="">--- Please Select ---</option>
                                            <option value="1">Type 1</option>
                                        </select>
                                    </td> -->
                                    <td>                                
                                        <input type="text" name="facilityNo" class="form-control" v-model="user.facilityNo"/>
                                    </td>
                                    <td>                                
                                        <input type="text" name="capacity" class="form-control" v-model="user.capacity"/>
                                    </td>
                                    <td>                                
                                        <input type="number" name="noOfFacility" class="form-control" v-model="user.noOfFacility"/>
                                    </td>
                                    <td>
                                        <input type="number" name="accessibleDisabled" class="form-control" v-model="user.accessibleDisabled"/>
                                    </td>
                                    <td>
                                        <input type="number" name="internetConnection" class="form-control" v-model="user.internetConnection"/>
                                    </td>
                                </tr> 
                                <tr>
                                    <td colspan=7> 
                                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                        @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove" 
                                        @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                    </td>
                                </tr>                                          
                            </tbody>
                        </table>
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
            count:1,
            categoryList:[],
            subCategortList:[],
            facilityList:[],
            designerList:[],
            users: [],
            form: new form({
                id: '',organizationId:'1', category: '',subCategory: '',structureNo: '',yearOfConstruction: '',
                plintchArea: '',noOfFloor: '',totalCapacity: '',rampAccess: '1',presentCondition: '',design: '',
                users:
                [{
                    facility:'',type:'',facilityNo:'',capacity:'',noOfFacility:'',accessibleDisabled:'',internetConnection:''
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
            this.form.yearOfConstruction= '';
            this.form.plintchArea= '';
            this.form.noOfFloor='';
            this.form.totalCapacity='';
            this.form.rampAccess='1';
            this.form.presentCondition='1';
            this.form.design='';
            let formReset =this.form.users;
            formReset.splice(0, formReset.length);
            this.form.users.push({facility:'',type:'',facilityNo:'',capacity:'',noOfFacility:'',accessibleDisabled:'',internetConnection:''})
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
                        title: 'Infrastructure details is updated successfully'
                    })
                    this.$router.push('/infrastructure_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
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
        getSubCategoryDropdown(uri = '/organization/getSubCategoryDropdown/'+this.form.category){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.subCategortList = data;
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

        /**
         * method to get facility in dropdown
         */
        getFacilityDropdown(uri = '/organization/getStructureFacilityInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilityList = data;
            });
        },

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.users.push({facility:'',facilityNo:'',capacity:'',noOfFacility:'',accessibleDisabled:'',internetConnection:''})    
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

        /**
         * method to get infrasture details
         */
        getInfrastructureDetails(infraId){
            axios.get('organization/getInfrastructureDetails/'+infraId)
            .then((response) => {  
                let data=response.data.data;

                this.form.category              =    data.categoryId;
                this.getSubCategoryDropdown();
                this.form.subCategory           =    data.subCategoryId;
                this.form.structureNo           =    data.structureNo;
                this.form.organizationId        =    data.organizationId;
                this.form.yearOfConstruction    =    data.yearOfConstruction;
                this.form.plintchArea           =    data.plintchArea;
                this.form.noOfFloor             =    data.noOfFloor;
                this.form.totalCapacity         =    data.totalCapacity;
                this.form.rampAccess            =    data.rampAccess;
                this.form.presentCondition      =    data.presentCondition;
                this.form.design                =    data.design;
                this.form.id                    =    data.id;

                let prop=data.facility;
                let facilityDetails=[];
                for(let i=0;i<prop.length;i++){
                    facilityDetails.push({facility:prop[i].facilityTypeId,facilityNo:prop[i].facilityName,
                    capacity:prop[i].capacity,noOfFacility:prop[i].noOfFacility,
                    accessibleDisabled:prop[i].noAccessibleToDisabled,
                    internetConnection:prop[i].noWithInternetConnection});
                }
                this.count=data.length;
                this.form.users=facilityDetails;
                
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },
    },

    created(){
        this.getCategoryDropdown();
        this.getFacilityDropdown();
        this.getDesignerDropdown();
        this.getInfrastructureDetails(this.$route.params.data.id);
    },

     mounted() { 

    }
}
</script>