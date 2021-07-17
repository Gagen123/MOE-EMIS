<template>
    <div>
        <form class="bootbox-form" id="stockReceivedId">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of stock Received:<span class="text-danger">*</span></label>
                        <input class="form-control editable_fields" name="dateOfreceived" id="dateOfreceived" type="date"
                        v-model="form.dateOfreceived" :class="{ 'is-invalid': form.errors.has('dateOfreceived') }" @change="remove_err('dateOfreceived')">
                        <has-error :form="form" field="dateOfreceived"></has-error>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <label class="">Quarter:<span class="text-danger">*</span></label>
                       <select name="quarter" id="quarter" class="form-control select2" v-model="form.quarter" :class="{ 'is-invalid': form.errors.has('quarter') }" @change="remove_err('quarter')">
                            <option v-for="(item, index) in quarterList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
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
                                  <!-- <th>Unit</th> -->
                                  <th>Quantity</th>
                                  <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody>
                                <tr id="record1" v-for='(item, index) in form.items_received' :key="index">
                                    <td>
                                        <select name="item" :id="'item'+index" class="form-control" v-model="item.item">
                                            <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                        </select>
                                    </td>
                                    <!-- <td>
                                        <span :id="'measurement_unit'+index">{{item.unit}}</span>
                                    </td> -->
                                    <td>
                                        <input type="number" name="quantity" class="form-control" v-model="item.quantity"/>
                                    </td>
                                    <!-- <td>
                                        <select name="unit" id="unit" class="form-control editable_fields" v-model="item.unit">
                                            <option v-for="(item, index) in unitList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                                        </select>
                                    </td> -->
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
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
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
            itemList:[],
            unitList:[],
            quarterList:[],
            items_received: [],
            unitArray:{},
            form: new form({
                 id: '', dateOfreceived: '', quarter: '', remarks: '',
                 items_received:
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
            this.form.dateOfreceived= '';
            this.form.quarter= '';
            this.form.remarks= '';
            let formReset =this.form.items_received;
            formReset.splice(0, formReset.length);
            this.form.items_received.push({item:'',quantity:'',unit:'',remarks:''})
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
                        title: 'Food received detail is added successfully'
                    })
                    this.$router.push('/stockreceived_list');
                })
                .catch(() => {
                    console.log("Error......");
                    this.applyselect();
                })
            }
		},
        // just added
        getStockReceivedDetails(stkId){
            axios.get('mess_manage/getStockReceivedDetails/'+stkId)
            .then((response) => {
                let data=response.data.data;
                this.form.dateOfreceived        =    data.dateOfreceived;
                this.form.quarter               =    data.quarter_id;
                $('#quarter').val(data.quarter_id).trigger('change');
                this.loadActiveQuarterList();
                this.form.remarks               =    data.remarks;
                this.form.id                    =    data.id;
                this.form.items_received=[];
                for(let i=0;i<data.stockreceived.length;i++){
                    this.form.items_received.push({
                    item:data.stockreceived[i].item_id,
                    // unit:this.unitArray[data.stockreceived[i].unit_id],
                    quantity:data.stockreceived[i].receivedquantity,
                    // unit:data.stockreceived[i].unit_id,
                    remarks:data.stockreceived[i].remarks});
                }
                this.count=data.length;

            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
        },

        applyselect(){
            if(!$('#quarter').attr('class').includes('select2-hidden-accessible')){
                $('#quarter').addClass('select2-hidden-accessible');
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
        loadActiveQuarterList(uri="masters/loadActiveStudentMasters/quarter_name"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.quarterList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

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

        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item_central"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.itemList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        allOrgList(dzo_id){
            if(dzo_id==""){
                dzo_id=$('#dzongkhag').val();
            }
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
            this.orgList = [];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.orgList = data.data.data;
            })

            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        /**
         *
         */

        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="quarter"){
                this.form.quarter=$('#quarter').val();
            }
        },

        /**f
         * method to get dzongkhag in dropdown
         */

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.items_received.push({
                item:'',quantity:'',unit:'',remarks:''})
        },
        /**
         * method to remove fields
         */
        remove(index){
             if(this.form.items_received.length>1){
                this.count--;
                this.form.items_received.splice(index,1);
            }
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

    },
     mounted() {
        this.loadActiveItemList();
        this.loadActiveUnitList();
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
        this.loadActiveUnitList();
        this.allOrgList();
        this.loadActiveItemList();
        this.loadActiveQuarterList();
        this.loadactivedzongkhagList();
        this.getStockReceivedDetails(this.$route.params.data.id);
    }
}
</script>
