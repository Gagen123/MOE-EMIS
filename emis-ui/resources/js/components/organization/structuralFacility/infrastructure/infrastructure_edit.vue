<template>
    <div>
        <form class="bootbox-form" id="infrastructureId">
            <div class="card-body">
                <div class="form-group row">
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <input type="hidden" class="form-control" v-model="form.organizationId"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Category:<span class="text-danger">*</span></label> 
                        <select name="category" id="category" class="form-control editable_fields" v-model="form.category" @change="getSubCategoryDropdown()">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in categoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Sub Category:<span class="text-danger">*</span></label> 
                        <select name="subCategory" id="subCategory" class="form-control editable_fields" v-model="form.subCategory">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in subCategortList" :key="index" v-bind:value="item.id">{{ item.subCategoryName }}</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Structure No:</label> 
                        <input class="form-control editable_fields " id="structureNo" type="text" v-model="form.structureNo">
                    </div>
                </div>
                                    
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Year of Construction:<span class="text-danger">*</span></label> 
                        <input class="form-control editable_fields " id="yearOfConst" type="text" v-model="form.yearOfConstruction">
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
                        <select name="presentCondition" id="presentCondition" class="form-control editable_fields" v-model="form.presentCondition" >
                            <option value="">--- Please Select ---</option>
                            <option value="1">Usable</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Designed by</label>
                        <select name="design" id="design" class="form-control editable_fields" v-model="form.design">
                            <option value="">--- Please Select ---</option>
                            <option value="1">SPPD</option>
                            <option value="2">Dzongkhag</option>
                            <option value="3">Thromde</option>
                            <option value="4">Others</option>
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
        formaction: function(type){
            if(type=="reset"){
                this.form.category= '';
                this.form.subCategory= '';
                this.form.structureNo= '';
                this.form.yearOfConstruction= '';
                this.form.plintchArea= '';
                this.form.noOfFloor='';
                this.form.totalCapacity='';
                this.form.rampAccess='1';
                this.form.presentCondition='';
                this.form.design='';
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
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.users.push({facility:'',type:'',facilityNo:'',capacity:'',noOfFacility:'',accessibleDisabled:'',internetConnection:''})    
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

    created(){
        this.getCategoryDropdown();
        this.getFacilityDropdown();
    },

     mounted() { 
        this.form.category=this.$route.params.data.categoryId;
        this.form.subCategory=this.$route.params.data.subCategoryId;
        this.form.structureNo=this.$route.params.data.structureNo;
        this.form.organizationId=this.$route.params.data.organizationId;
        this.form.yearOfConstruction=this.$route.params.data.yearOfConstruction;
        this.form.plintchArea=this.$route.params.data.plintchArea;
        this.form.noOfFloor=this.$route.params.data.noOfFloor;
        this.form.totalCapacity=this.$route.params.data.totalCapacity;
        this.form.rampAccess=this.$route.params.data.rampAccess;
        this.form.presentCondition=this.$route.params.data.presentCondition;
        this.form.design=this.$route.params.data.design;
        this.form.id=this.$route.params.data.id;
        this.form.action_type=this.$route.params.data.action;
    }
}
</script>