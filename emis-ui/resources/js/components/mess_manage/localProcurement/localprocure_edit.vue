<template>
    <div>
        <form class="bootbox-form" id="localprocureId"> 
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Procurement:<span class="text-danger">*</span></label>
                        <input class="form-control editable_fields" name="dateOfprocure" id="dateOfprocure" type="date"
                        v-model="form.data.dateOfprocure" :class="{ 'is-invalid': form.errors.has('dateOfprocure') }" @change="remove_err('dateOfprocure')">
                        <has-error :form="form" field="dateOfprocure"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Item</th>
                                  <th>Unit</th>
                                  <th>Quantity Purchased</th>
                                  <th>Amount</th>
                                  <th>Source of Food</th>
                                  <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody>
                               <tr>
                              <!-- <tr id="record1" v-for='(item, index) in form.local_item' :key="index"> -->
                                  <td>
                                    <span>{{itemList[form.data.item_id]}}</span>
                                  </td>
                                 <td>
                                    <span>{{unitArray[form.data.unit_id]}}</span>
                                  </td>
                                  <td>
                                     <input type="text" name="quantity" class="form-control" v-model="form.data.quantity">
                                 </td>
                                  <td>
                                     <input type="text" name="amount" class="form-control" v-model="form.data.amount">
                                 </td>
                                 <td>
                                     <select name="source" id="source" class="form-control" v-model="form.data.source">
                                          <option v-for="(item, index) in foodSourceList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                     </select> 
                                  </td>
                                  <td>
                                      <input type="text" name="remark" class="form-control" v-model="form.data.remark">
                                  </td>
                              </tr>
                              <!-- <tr>
                                  <td colspan=7>
                                      <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore"
                                      @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                      <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove"
                                      @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                  </td>
                              </tr> -->
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
            itemList:{},
            unitList:[],
            unitArray:{},
            local_item: [],
            foodSourceList:[],
            form: new form({
                id: '', dateOfprocure: '',
                data:'',
                local_item:
                [{
                    item:'',quantity:'',unit:'', amount:'',remark:'', source:''
                }],
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.dateOfprocure= '';
            let formReset =this.form.dateOfprocure;
            formReset.splice(0, formReset.length);
            this.form.local_item.push({item:'',quantity:'',unit:'',amount:'',remark:'', source:''})
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/mess_manage/saveLocalProcure',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Local Procurement detail is added successfully'
                    })
                    this.$router.push('/localprocure_list');
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
                for(let i=0;i<data.data.data.length;i++){
                    this.unitArray[data.data.data[i].id] = data.data.data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get item in dropdown
         */
    //    loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item_local"){
    //         axios.get(uri)
    //         .then(response => {
    //             let data = response;
    //             this.itemList =  data.data;
    //         })
    //         .catch(function (error) {
    //             console.log("Error......"+error)
    //         });
    //     },

        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item_local"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.length;i++){
                    this.itemList[data.data[i].id] = data.data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        localProcureEditList(locId){
            this.form.local_item=[];
            axios.get('mess_manage/localProcureEditList/' +locId)
            .then((response) =>{
                this.form.data=response.data.data;
            //     let data=response.data.data;
            //    // alert(data.length);
            //     for(let i=0; i<data.length;i++){
            //      //   alert(data[i].item_id);
            //         this.form.dateOfprocure         = data[i].dateOfprocure;
            //         this.form.id                    = data[i].id;
            //         this.form.local_item.push({
            //             item:this.itemList[data[i].item_id],
            //          //  item:data[i].item_id,
            //            quantity:data[i].quantity,
            //            unit:this.unitArray[data[i].unit_id],
            //            amount:data[i].amount,
            //            source:data[i].food_source,
            //            remark:data[i].remark
            //         });
                   
            //     }
            //     this.count=data.length;
            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
        },

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.local_item.push({
                item:'',quantity:'',unit:'',amount:'',remark:'', source:''})
        },
        /**
         * method to remove fields
         */
        remove(index){
             if(this.form.local_item.length>1){
                this.count--;
                this.form.local_item.splice(index,1);
            }
        },
         selectunit(type,index){
            let itemval=$('#'+type+index).val();
            $('#measurement_unit'+index).html(this.unitArray[itemval.split('_')[1]]);
        },
        loadActiveFoodSourceMaster(uri = 'masters/loadActiveFoodSourceMaster'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.foodSourceList =  data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
    },
     mounted() {
       $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
         Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
     

    },
    created() {
        this.loadActiveItemList();
        this.loadActiveUnitList();
        this.loadActiveFoodSourceMaster();
        this.localProcureEditList(this.$route.params.data.id);
        
    }
}
</script>
