<template>
    <div>
        <form class="bootbox-form" id="localprocureId">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Procurement:<span class="text-danger">*</span></label>
                        <input class="form-control editable_fields" name="dateOfprocure" id="dateOfprocure" type="date"
                        v-model="form.dateOfprocure" :class="{ 'is-invalid': form.errors.has('dateOfprocure') }" @change="remove_err('dateOfprocure')">
                        <has-error :form="form" field="dateOfprocure"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Item</th>
                                  <th>Quantity Purchased</th>
                                  <th>Unit</th>
                                  <th>Amount</th>
                                  <th>Source of Food</th>
                                  <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr id="record1" v-for='(item, index) in form.local_item' :key="index">
                                  <td>
                                    <select name="item" :id="'itemid'+index" class="form-control" v-model="item.item" @change="selectunit('itemid',index)">
                                         <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id+'_'+item.Unit_id">{{ item.Name }}</option>
                                      </select>
                                  </td>
                                  <td>
                                     <input type="text" name="quantity" class="form-control" v-model="item.quantity">
                                 </td>
                                 <td>
                                <!-- <select name="unit" id="unit" class="form-control" v-model="item.unit">
                                         <option v-for="(item, index) in unitList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                     </select> -->
                                    <span :id="'measurement_unit'+index"></span>
                                  </td>
                                  <td>
                                     <input type="text" name="amount" class="form-control" v-model="item.amount">
                                 </td>
                                  <td>
                                        <select name="source" id="source" class="form-control" v-model="item.source">
                                          <option v-for="(item, index) in foodSourceList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                       </select> 
                                  </td>
                                  <td>
                                      <input type="text" name="remark" class="form-control" v-model="item.remark">
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
            unitArray:{},
            foodSourceList:[],
            local_item: [],
            form: new form({
                id: '', dateOfprocure: '',
                local_item:
                [{
                    item:'',quantity:'',unit:'', amount:'',remark:'', source:'',
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
        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item_local"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.itemList =  data.data;
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
            this.form.local_item.push({
                item:'',quantity:'',unit:'',amount:'',remark:''})
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
      this.loadActiveItemList();
      this.loadActiveUnitList();
      this.loadActiveFoodSourceMaster();

    }
}
</script>
