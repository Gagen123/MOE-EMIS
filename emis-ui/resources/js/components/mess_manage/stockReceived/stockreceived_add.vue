<template>
    <div>
        <form class="bootbox-form" id="foodreleaseId">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Stock Received:<span class="text-danger">*</span></label> 
                        <input class="form-control editable_fields" name="date" id="date" type="date" 
                        v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }" @change="remove_err('date')">
                        <has-error :form="form" field="date"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Term(quater):<span class="text-danger">*</span></label> 
                        <select name="term" id="term" class="form-control editable_fields" v-model="form.school" :class="{ 'is-invalid': form.errors.has('school') }" @change="remove_err('school'),getreleaseddetial()">
                            <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.termName }}</option>
                        </select>
                        <has-error :form="form" field="term"></has-error>
                    </div>
                </div>
            <div class="card">
                <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Item</th>
                                  <th>Released Quantity</th>
                                  <th>Quantity Received</th>
                                  <th>Pending</th>
                                  <th>Unit</th>
                                  <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr id="record1" v-for='(releaseditem, index) in itemreleasedList' :key="index">
                                  <td>
                                      {{itemList[releaseditem.itemId]}}
                                  </td>
                                  <td>                          
                                     {{releaseditem.Quantity}}
                                  </td>
                                  <td>                                
                                     <input type="number" name="receivedquantity" class="form-control" v-model="item_form.receivedquantity[index]"/>
                                  </td>
                                  <td>                                
                                     {{getpending(releaseditem.pending)}}
                                  </td>
                                  <td>
                                     {{releaseditem.Unit}}
                                  </td>
                                  <td>                                
                                       <input type="text" name="remarks" class="form-control" v-model="item_form.remarks[index]"/>
                                  </td>
                              </tr> 
                            <!--  <tr>
                                  <td colspan=7> 
                                      <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                      @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                      <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove" 
                                      @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                  </td>
                              </tr>  -->                                        
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
            termList:[],
            itemList:[],
            unitList:[],
            itemreleasedList:[],

            users: [],
            form: new form({
                id: '', date: '', term: '', item:'',releasedquantity:'',
                receivedquantity:'',pendingquantity:'',unit:'', remarks:'',
                
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.date= '';
            this.form.term= '';
            let formReset =this.form.users;
            formReset.splice(0, formReset.length);
            this.form.users.push({item:'',releasedquantity:'',receivedquantity:'',pendingquantity:'', unit:'',remark:''})
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/mess_manage/saveStockReceived',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Stock Received detail is added successfully'
                    })
                    this.$router.push('/stockreceived_list');
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
       
        getpending(pending){
           
            var difference = function (releasedquantity, receivedquantity) { return Math.abs(releasedquantity - receivedquantity); }
        },
    },
     mounted() { 
        this.loadActiveUnitList(); 
        this.loadActiveItemList();
        this.getTermInDropdown();
    }
}
</script>