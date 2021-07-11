<template>
    <div>
        <table id="stockreceived-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Date of Stock Received</th>
                    <th>Quarter</th>
                    <th>Remarks</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in stockReceivedList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.dateOfreceived}}</td>
                    <td>{{ quarterList[item.quarter]}} </td>
                    <td>{{ item.remarks}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewitemreceived(item)"><i class="fas fa-eye"></i ></a>
                        </div> 
                         <!-- <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="StockReceivedView(item)"><i class="fas fa-eye"></i ></a>
                        </div>  -->
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewStockReceivedList(item)"><i class="fas fa-edit"></i ></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- for display  -->
         <div class="modal fade" id="viewitemreceived" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                     <h4 class="modal-title">Stock Received Detail</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                     </button>
                    </div>
                    <div class="modal-body">
                     <div class="card-body">
                            <div class="form-group row">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="font-weight-normal">Date of Received: </label>
                                 <span class="text-indigo-600">{{displayItem.dateOfreceived}}</span>
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                  <label class="font-weight-normal">Quarter: </label>
                                  <span class="text-indigo-600">{{quarterList[displayItem.quarter]}}</span>
                              </div>
                           </div>
                      </div>
                    <!--   <div class="card-body"> -->
                         <table id="dynamic-table" class="table table-bordered table-striped">
                             <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Unit</th> 
                                        <th>Remarks</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr v-for="(tableitem, index) in itemreceived_list" :key="index">
                                     <td> {{index + 1}}</td>
                                     <td> {{itemList[tableitem.item]}}</td>
                                     <td> {{tableitem.quantity}}</td>
                                     <td> {{unitList[tableitem.unit]}}</td>   
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
            stockReceivedList:[],
            itemreceived_list:[],
            displayItem:'',
            quarterList:{},
            unitList:{},
            itemList:{},
        }
    },

    methods:{
        loadFoodReleaseListing(uri = 'mess_manage/loadFoodReleaseListing'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.stockReceivedList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#stockreceived-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },

        viewitemreceived:function(item){
            this.displayItem="";
            this.displayItem=item;
          //  alert(this.displayItem.stockreceivedId);
            axios.get('mess_manage/viewitemreceived/' + this.displayItem.id)
            .then(response => { 
                let data = response;
                this.itemreceived_list =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            //  
            // this.itemrelease_list="";
          // this.itemrelease_list=tableitem;
            $('#viewitemreceived').modal('show');
		},
        viewStockReceivedList(data){
            data.action='edit';
            this.$router.push({name:'StockReceivedEdit',params: {data:data}});
        },
        StockReceivedView(data){
            data.action='view';
            this.$router.push({name:'StockReceivedView',params: {data:data}});
        },

        loadActiveQuarterList(uri="masters/loadActiveStudentMasters/quarter_name"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.quarterList[data.data.data[i].id] = data.data.data[i].Name; 
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
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        // loadActiveTermList(uri="masters/loadActiveStudentMasters/term_type"){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //        for(let i=0;i<data.data.data.length;i++){
        //             this.termList[data.data.data[i].id] = data.data.data[i].name; 
        //         }
        //     })
        //     .catch(function (error) {
        //         console.log("Error......"+error)
        //     });
        // },
       
    },
    
    mounted(){
        this.loadActiveQuarterList();
        this.loadActiveUnitList();
        this.loadActiveItemList();
        this.loadFoodReleaseListing();
        
    },
}
</script>