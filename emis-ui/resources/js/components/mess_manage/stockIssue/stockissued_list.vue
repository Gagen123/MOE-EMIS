<template>
    <div> 
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="stockissued-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Date of Stock Issued</th>
                            <th>item</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Action</th>                      
                        </tr>
                    </thead> 
                    <tbody>
                         <tr v-for="(item, index) in stockissued_list" :key="index">
                            <td> {{index + 1}}</td>
                            <td> {{item.dateOfissue}}</td>
                            <td> {{itemList[item.item]}}</td>
                            <td> {{item.quantity}}</td>
                            <td> {{unitList[item.unit]}}
                            <td> 
                              <!-- <div class="btn-group btn-group-sm">
                                  <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewstockissue(item)"><i class="fas fa-eye"></i ></a>
                              </div> -->
                              <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewStockIssuedList(item)"><i class="fas fa-edit"></i ></a>
                               </div>
                            </td> 
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
         <div class="modal fade" id="viewstockissue" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                     <h4 class="modal-title">Stock Issue Detail</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                     </button>
                    </div>
                    <div class="modal-body">
                     <div class="card-body">
                            <div class="form-group row">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="font-weight-normal">Date of Issue: </label>
                                 <span class="text-indigo-600">{{displayItem.dateOfissue}}</span>
                                </div> 
                           </div>
                      </div>
                    <!--   <div class="card-body"> -->
                         <table id="dynamic-table" class="table table-bordered table-striped">
                             <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Item</th>
                                        <th>Quantity Issued</th>
                                        <th>Unit</th> 
                                        <th>Damaged Quantity</th>
                                        <th>Remarks</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr v-for="(tableitem, index) in itemissue_list" :key="index">
                                     <td> {{index + 1}}</td>
                                     <td> {{itemList[tableitem.item]}}</td>
                                     <td> {{tableitem.quantity}}</td>
                                     <td> {{unitList[tableitem.unit]}}</td> 
                                     <td> {{tableitem.damageqty}} </td>  
                                     <td> {{tableitem.remarks}}</td>             
                                 </tr>
                             </tbody>
                          </table>
                    <!--  </div>-->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>




    </div>
</template>
<script>
export default {
    data(){
        return{ 
            totle:0,
            stockissued_list:[],
            displayItem:'',
            itemissue_list:'',
            itemList:{},
            unitList:{},
            dt:''
        } 
    },
    methods: {
        loadStockIssuedList(org_Id){
        let uri = 'mess_manage/loadStockIssuedList/'+org_Id;
            axios.get(uri)
            .then(response => { 
                let data = response;
                this.stockissued_list =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#stockissued-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewstockissue:function(item){
            this.displayItem="";
            this.displayItem=item;
           // alert(this.displayItem.foodreleaseId);
            axios.get('mess_manage/getStockIssueItem/' + this.displayItem.id)
            .then(response => { 
                let data = response;
                this.itemrelease_list =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            //  
            // this.itemrelease_list="";
          // this.itemrelease_list=tableitem;
            $('#viewstockissue').modal('show');
		},
        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.itemList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/program_measurement"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.unitList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        viewStockIssuedList(data){
            data.action='edit';
            this.$router.push({name:'StockIssuedEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadActiveItemList();
        this.loadActiveUnitList();
        this.loadStockIssuedList();
        this.dt =  $("#stockissued-table").DataTable();

    },
    watch: {
        stockissued_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#stockissued-table").DataTable()
            });
        }
    },
    
}
</script>


