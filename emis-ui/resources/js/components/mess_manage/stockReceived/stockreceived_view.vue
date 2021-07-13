<template>
    <div>
        <form class="bootbox-form" id="stockReceivedId">
            <div class="card-body">
                <div class="form-group row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of stock Received:<span class="text-danger">*</span></label> 
                         <span class="text-blue text-bold">{{form.dateOfreceived}}</span>
                    </div>
                  
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <label class="">Quarter:<span class="text-danger">*</span></label> 
                       <span class="text-blue text-bold">{{form.quarter}}</span>
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
                              <tr id="record1" v-for='(item, count) in form.items_received' :key="count+1">
                                  <td>
                                    {{ item.item }}
                                  </td>
                                  <td>                          
                                    {{ item.quantity }}
                                  </td>
                                  <td>                                
                                    {{ item.unit }}
                                  </td>
                                  <td>                                
                                    {{ item.remarks }}
                                  </td>
                              </tr> 
                          </tbody>
                     </table>
                  </div>
              </div>
              
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {{ item.remarks }}
                </div>
            </div>
           
            </div>
            
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
         
            items_received: [],
            form: new form({
                 id: '', dateOfreceived: '', quarter: '', remarks: '', StockReceivedID: '',
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
        
        /**
         * method to save data
         */
        

       

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        /**
         * method to get quarter in dropdown
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
        loadStockReceiveView(StockReceivedID){
            axios.get('mess_manage/loadStockReceiveView/' +StockReceivedID)
            .then((response) => {
                let data=response.data.data
                this.form.id=data.id;
                this.form.dateOfreceived=data.dateOfreceived;
                this.form.quarter=data.quarter;
                this.form.remarks=data.remarks;
                this.form.id=data.id;
                this.items_received=data.items_received;
            })
            .catch((error) => {
                console.log("Error......"+error);
            });

        },
       
       
    },
     mounted() { 
        this.loadStockReceiveView(this.$route.params.data.id);
       
        this.loadActiveQuarterList();
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
        this.loadActiveUnitList(); 
        this.loadActiveItemList();
       // this.loadActiveTermList();
      
       
    }
}
</script>