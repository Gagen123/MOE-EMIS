<template>
    <div>
        <form class="bootbox-form" id="foodreleaseId">
            <div class="card-body">
                <div class="form-group row">
                     <input type="hidden" class="form-control" v-model="form.organizationId"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Issue:<span class="text-danger">*</span></label> 
                        <input class="form-control editable_fields" name="date" id="date" type="date" 
                        v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }" @change="remove_err('date')">
                        <has-error :form="form" field="date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Dzongkahg:<span class="text-danger">*</span></label> 
                        <select v-model="form.dzongkhag" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" class="form-control select2" name="dzongkhag" id="dzongkhag">
                         <option value="">--- Please Select ---</option>
                         <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="dzongkhag"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">School Name:<span class="text-danger">*</span></label> 
                        <select name="school" id="school" class="form-control editable_fields" v-model="form.school" :class="{ 'is-invalid': form.errors.has('school') }" @change="remove_err('school')">
                            <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{ item.schoolName }}</option>
                        </select>
                        <has-error :form="form" field="school"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Quarter:<span class="text-danger">*</span></label> 
                        <select name="quarter" id="quarter" class="form-control editable_fields" v-model="form.quarter" :class="{ 'is-invalid': form.errors.has('quarter') }" @change="remove_err('quarter')">
                            <option v-for="(item, index) in quarterList" :key="index" v-bind:value="item.id">{{ item.quarterName }}</option>
                        </select>
                        <has-error :form="form" field="quarter"></has-error>
                    </div>
                </div>
             <div class="card">
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
            dzongkhagList:[],
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
        loadSchool(){
            axios.get('organization/getschoolDetials')
            .then(response => {
                let data = response;
                this.schoolList = data.data.data;
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
         * method to get unit in dropdown
         */
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/program_measurement"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.unitList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get item in dropdown
         */
       loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.itemList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.users.push({
                item:'',quantity:'',unit:'',remark:''})    
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
        this.loadActiveUnitList(); 
        this.loadSchool();
        this.loadActiveItemList();
        this.getTermInDropdown();
        this.loadactivedzongkhagList();
    }
}
</script>