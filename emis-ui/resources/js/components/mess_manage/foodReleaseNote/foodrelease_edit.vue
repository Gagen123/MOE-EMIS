<template>
    <div>
        <form class="bootbox-form" id="foodreleaseId">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Food Release:<span class="text-danger">*</span></label> 
                        <input class="form-control editable_fields" name="dateOfrelease" id="dateOfrelease" type="date" 
                        v-model="form.dateOfrelease" :class="{ 'is-invalid': form.errors.has('dateOfrelease') }" @change="remove_err('dateOfrelease')">
                        <has-error :form="form" field="dateOfrelease"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Dzongkhag:<span class="text-danger">*</span></label> 
                     <!--   <select name="dzongkhag" id="dzongkhag" class="form-control editable_fields" v-model="form.dzongkhag" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" @change="remove_err('dzongkhag')">
                            <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.termName }}</option>
                        </select>
                        <has-error :form="form" field="term"></has-error> -->
                        
                        <select name="dzongkhag" class="form-control editable_fields" id="dzongkhag"  v-model="form.dzongkhag" >
                            <option value="">---Please Select---</option> 
                            <option value="Samtse">Samtse</option>
                            <option value="Thimphu">Thimphu</option>
                            <option value="Haa">Haa</option>
                            <option value="Paro">Paro</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">School Name:<span class="text-danger">*</span></label> 
                    <!--    <select name="school" id="school" class="form-control editable_fields" v-model="form.school" :class="{ 'is-invalid': form.errors.has('school') }" @change="remove_err('school')">
                            <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.termName }}</option>
                        </select>
                        <has-error :form="form" field="school"></has-error> -->
                        <select class="form-control editable_fields" id="school"  v-model="form.school" >
                            <option value="">---Please Select---</option> 
                            <option value="SHSS">SHSS</option>
                            <option value="YHSS">YHSS</option>
                            <option value="DHSS">DHSS</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Term(quater):<span class="text-danger">*</span></label> 
                     <!--   <select name="term" id="term" class="form-control editable_fields" v-model="form.school" :class="{ 'is-invalid': form.errors.has('school') }" @change="remove_err('school'),getreleaseddetial()">
                            <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.termName }}</option>
                        </select>
                        <has-error :form="form" field="term"></has-error> -->
                       <select class="form-control editable_fields" id="quarter"  v-model="form.quarter" >
                            <option value="">---Please Select---</option> 
                            <option value="1st quarter">1st quarter</option>
                            <option value="2nd quarter">2nd quarter</option>
                            <option value="3rd quarter">3rd quarter</option>
                        </select>     

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
                              <tr id="record1" v-for='(item, index) in form.items_released' :key="index">
                                  <td>
                                <!--     <select name="item" id="item" class="form-control editable_fields" v-model="user.item">
                                         <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                      </select>-->
                                    <select class="form-control editable_fields" id="item"  v-model="item.item">
                                        <option value="">---Please Select---</option> 
                                        <option value="rice">rice</option>
                                        <option value="potatoes">potatoes</option>
                                        <option value="onion">onion</option>
                                    </select>
                                  </td>
                                  <td>                          
                                    <input type="number" name="quantity" class="form-control" v-model="item.quantity">
                                  </td>
                                  <td>                                
                                 <!--    <select name="unit" id="unit" class="form-control editable_fields" v-model="user.unit">
                                         <option v-for="(item, index) in unitList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                     </select> -->
                                    <select class="form-control editable_fields" id="unit"  v-model="item.unit">
                                        <option value="">---Please Select---</option> 
                                        <option value="kg">kg</option>
                                        <option value="litre">litre</option>
                                        <option value="packet">packet</option>
                                    </select>

                                  </td>
                                  <td>                                
                                       <input type="text" name="remarks" class="form-control" v-model="item.remarks">
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
           // schoolList:[],
          //  termList:[],
          //  itemList:[],
          //  unitList:[],
           // itemrelease:[],
         //   items_released: [],
            form: new form({
                 id: '', dateOfrelease: '', dzongkhag: '', school: '',quarter: '',
                 items_released:
                [{
                    item:'',quantity:'',unit:'', remarks:'',
                }], 
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.dateOfrelease= '';
            this.form.dzongkhag= '';
            this.form.school= '';
            this.form.quarter= '';
            let formReset =this.form.items_released;
            formReset.splice(0, formReset.length);
            this.form.items_released.push({item:'',quantity:'',unit:'',remarks:''})
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
                        title: 'Food release detail is added successfully'
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
         * method to get term in dropdown
         */
      //  getTermDropdown(uri = '/student/getTermInDropdown/'+this.form.category){
      //      axios.get(uri)
      //      .then(response => {
      //          let data = response.data;
      //          this.termList = data;
      //      });
     //   },

        /**
         * method to get unit in dropdown
         */
       //  loadActiveUnitList(uri="masters/loadActiveStudentMasters/program_measurement"){
       //     axios.get(uri)
       //     .then(response => {
       //         let data = response;
       //         this.unitList =  data.data.data;
       //     })
       //     .catch(function (error) {
       //         console.log("Error......"+error)
       //     });
      //  },

        /**
         * method to get item in dropdown
         */
       loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(leti=0;i<data.data.data.length;i++){
                this.itemList[data.data.data[i].id] =  data.data.data[i].name;
                }
                
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
            this.form.items_released.push({
                item:'',quantity:'',unit:'',remarks:''})    
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.form.items_released.length>1){
                this.count--;
                this.form.items_released.splice(index,1); 
            }
        },
       
       
    },
     mounted() { 
        this.form.dateOfrelease=this.$route.params.data.dateOfrelease;
        this.form.dzongkhag=this.$route.params.data.dzongkhag;
        this.form.school=this.$route.params.data.school;
        this.form.quarter=this.$route.params.data.quarter;
        this.form.id=this.$route.params.data.id;
        
    }
}
</script>