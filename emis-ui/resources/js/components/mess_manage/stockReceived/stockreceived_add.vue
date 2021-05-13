<template>
    <div>
        <form class="bootbox-form" id="stockreceivedId">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Stock Received:<span class="text-danger">*</span></label> 
                        <input class="form-control editable_fields" name="dateOfreceived" id="dateOfreceived" type="date" 
                        v-model="form.dateOfreceived" :class="{ 'is-invalid': form.errors.has('dateOfreceived') }" @change="remove_err('dateOfreceived')">
                        <has-error :form="form" field="dateOfreceived"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Term(quater):<span class="text-danger">*</span></label> 
                        <select name="quarter" id="quarter" class="form-control editable_fields" v-model="form.quarter" :class="{ 'is-invalid': form.errors.has('quarter') }" @change="remove_err('quarter'),getFoodRelease()">
                            <!-- <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.termName }}</option> -->
                            <option value="1st quarter">1st quarter</option>
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
                                  <th>Released Quantity</th>
                                  <th>Quantity Received</th>
                                  <th>Pending</th>
                                  <th>Unit</th>
                                  <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr id="record1" v-for='(item, index) in form.foodrelease_list' :key="index">
                                  <td>
                                      {{item.item}}
                                  </td>
                                  <td>                          
                                     {{item.quantity}}
                                  </td>
                                  <td>                                
                                     <input type="number" name="receivedquantity" :id="'receivedquantity'+index" class="form-control" v-model="item.receivedquantity" @change='calculatepending(item.quantity,"receivedquantity"+index,"pending"+index)'/>
                                  </td>
                                  <td>      
                                     <input type="number" :id="'pending'+index" :name="'pending'+index" class="form-control" :v-model="item.pending"/>                          
                                  
                                  </td>
                                  <td>
                                 <!--    <input type="text" name="unit" class="form-control" v-model="item.unit"/>-->
                                  <select class="form-control editable_fields" id="unit"  v-model="item.unit">
                                        <option value="">---Please Select---</option> 
                                        <option value="kg">kg</option>
                                        <option value="litre">litre</option>
                                        <option value="packet">packet</option>
                                    </select>
                                  </td>
                                  <td>                                
                                       <input type="text" name="remarks" class="form-control" v-model="item.remarks"/>
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
            termList:[],
            itemList:[],
            unitList:[],
            itemreleasedList:[],

            users: [],
            form: new form({
                id: '', dateOfreceived: '', quarter: '', 
                foodrelease_list:[],
                
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.dateOfreceived= '';
            this.form.term= '';
            let formReset =this.form.users;
            formReset.splice(0, formReset.length);
            this.form.users.push({item:'',releasedquantity:'',receivedquantity:'',pendingquantity:'', unit:'',remark:''})
        },

        calculatepending(qty,receiveId,targetId){
            let recqty=$('#'+receiveId).val();
            let result=qty-recqty;
            $('#'+targetId).val(result);
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
         * 
         */
        getFoodRelease(foodreleaseId){
            let uri = 'mess_manage/getFoodRelease/' +foodreleaseId
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.form.foodrelease_list=[];
                for(let i=0;i<data.length;i++){
                    this.form.foodrelease_list.push({item:data[i].item,quantity:data[i].quantity,receivedquantity:'',pending:'',unit:'',remarks:''});
                }
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },

        
    },
     mounted() { 
         this.loadActiveUnitList(); 
         this.getTermInDropdown();
         this.getFoodRelease();
    }
}
</script>