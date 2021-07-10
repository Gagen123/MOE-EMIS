<template>
    <div>
        <form class="bootbox-form" id="stockissueId">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Stock Issued:<span class="text-danger">*</span></label> 
                        <input class="form-control editable_fields" name="dateOfissue" id="dateOfissue" type="date" 
                        v-model="form.dateOfissue" :class="{ 'is-invalid': form.errors.has('dateOfissue') }" @change="remove_err('dateOfissue')">
                        <has-error :form="form" field="dateOfissue"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Item</th>
                                  <th>Quantity Issued</th>
                                  <th>Unit</th>
                                  <th>Damage/Loss Quantity(kg)</th>
                                  <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr id="record1" v-for='(item, index) in form.item_issue' :key="index">
                                  <td>
                                     <select name="item" id="item" class="form-control editable_fields" v-model="item.item" @onchange="getquantity()">
                                         <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                      </select>
                                  </td>
                                   <td>                                
                                     <input type="number" name="quantity" class="form-control" v-model="item.quantity"/>
                                 </td>
                                 <td>
                                    <select name="unit" id="unit" class="form-control editable_fields" v-model="item.unit">
                                        <option v-for="(item, index) in unitList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                    </select> 
                                  </td>
                                  <td>                                
                                     <input type="number" name="damagequantity" class="form-control" v-model="item.damagequantity"/>
                                 </td>
                                  <td>                                
                                      <input type="text" name="remarks" class="form-control" v-model="item.remarks"/>
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
            itemList:[],
            unitList:[],
            item_issue: [],
            form: new form({
                id: '', dateOfissue: '', 
                item_issue:
                [{
                    item:'', quantity:'',unit:'', damagequantity:'',remarks:'',
                }],
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.dateOfissue= '';
            let formReset =this.form.item_issue;
            formReset.splice(0, formReset.length);
            this.form.item_issue.push({item:'',quantity:'',unit:'',damagequantity:'',remarks:''})
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/mess_manage/saveStockIssued',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Stock Issued detail is added successfully'
                    })
                    this.$router.push('/stockissued_list');
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

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.item_issue.push({
                item:'',quantity:'',unit:'',damagequantity:'',remarks:''})    
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.form.item_issue.length>1){
                this.count--;
                this.form.item_issue.splice(index,1); 
            }
        },
        StockIssueEditList(lssId){
            this.form.item_issue=[];
            axios.get('mess_manage/StockIssueEditList/' +lssId)
            .then((response) =>{
                let data=response.data.data;
               // alert(data.length);
                for(let i=0; i<data.length;i++){
                    this.form.dateOfissue           = data[i].dateOfissue;
                    this.form.id                    = data[i].id;
                    this.form.item_issue.push({
                       item:data[i].item,
                       quantity:data[i].quantity,
                       unit:data[i].unit,
                       damagequantity:data[i].damagequantity,
                       remarks:data[i].remarks
                    });
                }
                this.count=data.length;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        }
    },
     mounted() { 
        this.loadActiveUnitList(); 
        this.loadActiveItemList();
    },
    created() {
        this.StockIssueEditList(this.$route.params.data.id);
        // this.loadActiveItemList(); 
        // this.loadActiveUnitList();
    }
}
</script>