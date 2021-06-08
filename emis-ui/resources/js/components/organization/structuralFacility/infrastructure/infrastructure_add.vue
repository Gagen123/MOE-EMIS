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
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Category:<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select name="category" id="category" class="form-control editable_fields" v-model="form.category" :class="{ 'is-invalid': form.errors.has('category') }" @change="getSubCategoryDropdown(),remove_err('category')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in categoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="category"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Sub Category:<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select name="subCategory" id="subCategory" class="form-control editable_fields" v-model="form.subCategory" :class="{ 'is-invalid': form.errors.has('subCategory') }" @change="remove_err('subCategory')">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in subCategortList" :key="index" v-bind:value="item.id">{{ item.subCategoryName }}</option>
                                </select>
                                <has-error :form="form" field="subCategory"></has-error>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Structure No:<span class="text-danger">*</span></label>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input class="form-control editable_fields " id="structureNo" type="text" v-model="form.structureNo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-sm-2 invoice-col">
                        <label class="mb-0"><i><u>General</u></i></label>
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <input type="hidden" class="form-control" v-model="form.id" id="id"/>
                        <p>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Year of Construction:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input class="form-control editable_fields" name="yearOfConstruction" id="yearOfConstruction" type="text" 
                                v-model="form.yearOfConstruction" :class="{ 'is-invalid': form.errors.has('yearOfConstruction') }" @change="remove_err('yearOfConstruction')">
                                <has-error :form="form" field="yearOfConstruction"></has-error>
                            </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Plinth Area:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input class="form-control editable_fields " id="plintchArea" type="text" v-model="form.plintchArea">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">No of Floors:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input class="form-control editable_fields " id="noOfFloor" type="number" v-model="form.noOfFloor">
                            </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Total Capacity:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <input class="form-control editable_fields " id="totalCapacity" type="number" v-model="form.totalCapacity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Present Condition of Structure:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3 pt-3">
                                <label><input v-model="form.presentCondition"  type="radio" value="1"/> Usable</label>
                                <label><input v-model="form.presentCondition"  type="radio" value="0" /> Not Usable</label>
                            </div>
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Designed By:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <select name="design" id="design" class="form-control" v-model="form.design">
                                    <option value="">--- Please Select ---</option>
                                    <option v-for="(item, index) in designerList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Ramp Access on Ground Floor:<span class="text-danger">*</span></label>
                            <div class="col-lg-3 col-md-3 col-sm-3 pt-3">
                                <label><input v-model="form.rampAccess"  type="radio" value="1" /> Yes</label>
                                <label><input v-model="form.rampAccess"  type="radio" value="0" /> No</label>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><label class="mb-0 pl-4"><i><u>Facility</u></i></label><br>
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 23%">Facility Type</th>
                                    <th style="width: 15%">Facility No./Name</th>
                                    <th style="width: 10%">Capacity</th>
                                    <th style="width: 10%">Total Number</th>
                                    <th style="width: 20%">Is Accessible to Disabled</th>
                                    <th style="width: 22%">With Internet Connection</th>                            
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
                                    
                                    <td>                                
                                        <input type="text" name="facilityNo" class="form-control" v-model="user.facilityNo"/>
                                    </td>
                                    <td>                                
                                        <input type="number" name="capacity" class="form-control" v-model="user.capacity"/>
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
                plintchArea: '',noOfFloor: '',totalCapacity: '',rampAccess: '1',presentCondition: '1',design: '',
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
                        title: 'Infrastructure is added successfully'
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
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.users.push({
                facility:'',type:'',facilityNo:'',capacity:'',noOfFacility:'',
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
    },
     mounted() { 
        this.getCategoryDropdown();
        this.getFacilityDropdown();
        this.getDesignerDropdown();
    }
}
</script>