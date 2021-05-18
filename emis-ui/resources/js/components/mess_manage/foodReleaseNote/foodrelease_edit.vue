<template>
    <div>
        <form class="bootbox-form" id="foodreleaseId">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Issue:<span class="text-danger">*</span></label> 
                        <input class="form-control editable_fields" name="date" id="date" type="date" 
                        v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }" @change="remove_err('date')">
                        <has-error :form="form" field="date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">School Name:<span class="text-danger">*</span></label> 
                        <select name="school" id="school" class="form-control editable_fields" v-model="form.school" :class="{ 'is-invalid': form.errors.has('school') }" @change="remove_err('school')">
                            <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{ item.schoolName }}</option>
                        </select>
                        <has-error :form="form" field="school"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Term(quater):<span class="text-danger">*</span></label> 
                        <select name="term" id="term" class="form-control editable_fields" v-model="form.school" :class="{ 'is-invalid': form.errors.has('school') }" @change="remove_err('school')">
                            <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.termName }}</option>
                        </select>
                        <has-error :form="form" field="term"></has-error>
                    </div>
                </div>
            
                <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Item</th>
                                  <th>Quantity</th>
                                  <th>Unit</th>
                                  <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr id="record1" v-for='(user, index) in form.users' :key="index">
                                  <td>
                                      <select name="item" id="item" class="form-control editable_fields" v-model="user.item">
                                         <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                      </select>
                                  </td>
                                  <td>                                
                                     <input type="number" name="quantity" class="form-control" v-model="user.quantity"/>
                                 </td>
                                 <td>
                                     <select name="unit" id="unit" class="form-control editable_fields" v-model="user.unit">
                                         <option v-for="(item, index) in unitList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                     </select>
                                  </td>
                                  <td>                                
                                      <input type="text" name="remarks" class="form-control" v-model="user.remarks"/>
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
        return{
            count:1,
            schoolList:[],
            termList:[],
            itemList:[],
            unitList:[],
            users: [],
            form: new form({
                id: '', date: '', school: '',term: '',
                users:
                [{
                    item:'',quantity:'',unit:''
                }],
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.date= '';
            this.form.school= '';
            this.form.term= '';
            let formReset =this.form.users;
            formReset.splice(0, formReset.length);
            this.form.users.push({item:'',quantity:'',unit:'',remark:''})
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/mess_manage/saveFoodRelease',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Food Release Note is added successfully'
                    })
                    this.$router.push('/foodrelease_list');
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
         * method to get school in dropdown
         */
        getSchoolDropdown(uri = '/organization/getSchoolInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.schoolList = data;
            });
        },

        /**
         * method to get term in dropdown
         */
        getTermDropdown(uri = '/student/getTermInDropdown/'+this.form.category){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.termList = data;
            });
        },

        /**
         * method to get facility in dropdown
         */
        getUnitInDropdown(uri = '/student/getUnitInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilityList = data;
            });
        },

        /**
         * method to get category in dropdown
         */
        getItemDropdown(uri = '/student/getItemInDropdown'){
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
    getFoodReleaseDetails(foodreleaseId){
            axios.get('mess_manage/getFoodReleaseDetails/'+foodreleaseId)
            .then((response) => {  
                let data=response.data.data;

                this.form.school                =    data.schoolId;
                this.getSubCategoryDropdown();
                this.form.term                  =    data.termId;
                this.form.item                  =    data.itemId;
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
    
     mounted() { 
        this.getUnitInDropdown();
        this.getSchoolInDropdown();
        this.getItemInDropdown();
        this.getTermInDropdown();
    }
}
</script>