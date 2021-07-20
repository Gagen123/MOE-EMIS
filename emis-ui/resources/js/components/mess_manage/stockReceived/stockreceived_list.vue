<template>
    <div>
        <table id="stockreceived-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Date of Stock Received</th>
                    <th>Quarter</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in stockReceivedList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.dateOfreceived}}</td>
                    <td>{{ quarterList[item.quarter_id]}} </td>
                    <td>{{ item.remarks}}</td>
                    <td>{{ item.status}}</td>
                    <td>
                        <div class="btn-group btn-group-sm" v-if="showmess">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewitemreceived(item,'view')"><i class="fas fa-eye"></i ></a>
                        </div>
                        <div class="btn-group btn-group-sm" v-if="showprincipaltask">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewitemreceived(item,'open')"><i class="fa fa-file-signature"></i > Open</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
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
                                  <span class="text-indigo-600">{{quarterList[displayItem.quarter_id]}}</span>
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
            dt:'',
            showmess:false,
            showprincipaltask:false,
        }
    },

    methods:{
        loadFoodReleaseListing(type){
            let uri = 'mess_manage/stockReceivedListing/'+type;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.stockReceivedList =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        viewitemreceived:function(item,type){
            if(type=="view"){
                this.displayItem="";
                this.displayItem=item;
                axios.get('mess_manage/viewitemreceived/' + this.displayItem.id)
                .then(response => {
                    let data = response;
                    this.itemreceived_list =  data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
                $('#viewitemreceived').modal('show');
            }
            if(type=="open"){
                this.$router.push({name:'stockreceived_view',query: {id:item.id,type:type}});
            }
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
                    this.unitList[data.data.data[i].id] = data.data.data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item_central"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.length;i++){
                    this.itemList[data.data[i].id] = data.data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

    },

    mounted(){
        this.loadActiveQuarterList();
        this.loadActiveUnitList();
        this.loadActiveItemList();
        this.dt =  $("#stockreceived-table").DataTable();
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            let roleName="";
            for(let i=0;i<data['roles'].length;i++){
                if(i==data['roles'].length-1){
                    roleName+=data['roles'][i].roleName;
                }
                else{
                    roleName+=data['roles'][i].roleName+', ';
                }
            }
            if(roleName.toLowerCase().includes('mess')){
                this.showmess=true;
                this.loadFoodReleaseListing('Creater');
            }
            if(roleName.toLowerCase().includes('principal') && !roleName.toLowerCase().includes('assistant') && !roleName.toLowerCase().includes('vice')){
                this.showprincipaltask=true;
                this.loadFoodReleaseListing('OrgWise');
            }
        })
        .catch(errors =>{
            console.log(errors)
        });

    },
    watch: {
        stockReceivedList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#stockreceived-table").DataTable()
            });
        }
    },
}
</script>
