<template>
    <div>
        <div class="card ">
            <div class="card-body">
                <div class="card-header pb-1 mb-0 pt-0 mt-0">
                     <span class="card-title">
                    <b>Stock Inventory</b>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <label class="">School Inventory Record Type:<span class="text-danger">*</span></label>
                    </div>
                       <!-- <select name="reordtype" id="reordtype" class="form-control select2"  @click="generatereport()" >
                            <option value="">---Please Select---</option> 
                            <option value="Centrally_Supplied" id= "Centrally_Supplied">Centrally Supplied Record</option>
                            <option value="Locally_Procured" id="Locally_Procured" >Locally Procured Record</option>
                        </select> -->
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label><input  type="radio" name="record_type" value="1" tabindex="" autofocus="true" @click="generatereport('Centrally_Supplied')"/> Centrally Supplied Record</label>
                            <label><input  type="radio" name="record_type" value="0" tabindex="" autofocus="true" @click="generatereport('Locally_Procured')"/>Locally Procured Record</label>
                        </div>
                        
                    
                    <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt-4 pt-2">
                        <button class="btn btn-primary btn-sm btn-flat" @click="generatereport()" type="button"> <span class="fa fa-download"></span> Load Report</button>
                    </div> -->
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row" id="stockReceived"   style="display:none">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="training-table" class="table w-100 table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Item</th>
                                    <th>Item Received</th>
                                    <!-- <th>Locally Procured</th> -->
                                    <th>Stock Issued</th>
                                    <th>Stock Damage</th>
                                    <th>Available Quantity</th>
                                    <th>Unit</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockInventoryCentral" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ itemList[item.item_id]}}</td>
                                    <td>{{ item.stock_received_quantity}}</td>
                                    <!-- <td>{{ item.local_procured_quantity}}</td> -->
                                    <td>{{ item.stock_issed_quantity}}</td>
                                    <td>{{ item.Damage_Qty}}</td>
                                    <td>{{ item.Available_Qty}}</td>
                                    <td>{{unitList[item.unit_id]}} </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group row" style="display:none" id= "localProcure">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="training-table" class="table w-100 table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Item</th>
                                    <!-- <th>Item Received</th> -->
                                    <th>Locally Procured</th>
                                    <th>Stock Issued</th>
                                    <th>Stock Damage</th>
                                    <th>Available Quantity</th>
                                    <th>Unit</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockInventoryLocal" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ itemList[item.item_id]}}</td>
                                    <!-- <td>{{ item.stock_received_quantity}}</td> -->
                                    <td>{{ item.Lcoal_quantity}}</td>
                                    <td>{{ item.stock_issed_quantity}}</td>
                                    <td>{{ item.Damage_Qty}}</td>
                                    <td>{{ item.Available_Qty}}</td>
                                    <td>{{unitList[item.unit_id]}} </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            stockInventoryCentral:[],
            itemList:{},
            unitList:{},
            reordtype:'',
            stockInventoryLocal:[]

        }
    },
    methods:{
        /**
         * method to load organization/school list
         */
        getInventoryListCentral(uri = 'mess_manage/getInventoryList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.stockInventoryCentral = data.data.data;
            });
        },
        getInventoryListLocal(uri = 'mess_manage/getInventoryListLocal'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.stockInventoryLocal = data.data.data;
            });
        },
        // showbasicdetails(id){
        //     this.$router.push({name:'mess_details',query: {data:id}});
        // },
        loadActiveItemList(uri="masters/loadActiveStudentMasters/CeaProgramItem"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.itemList[data.data.data[i].id] = data.data.data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/CeaProgramMeasurement"){
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
       
         generatereport:function(type){
             if(type=="Centrally_Supplied"){
                $('#stockReceived').show();
                $('#localProcure').hide();
            }
            else if(type="Locally_Procured"){
               $('#localProcure').show();
               $('#stockReceived').hide();
            }
            else{
                $('#localProcure').hide();
               $('#stockReceived').hide();

            }
        },
          // showtextbox:function(type){
        //  if(type=="Yes"){
        //      $('#roadtypeyes').show();
        //      $('#roadtypeno').hide(); 
        //     }
        //     else if(type=="No"){
        //      $('#roadtypeno').show();
        //      $('#roadtypeyes').hide();
        //     }
        //     else{
        //      $('#roadtypeyes').hide();
        //      $('roadtypeno').show();
        //     }
        // },


    },
    mounted(){
        this.loadActiveItemList();
        this.loadActiveUnitList();
        this.getInventoryListCentral();
        this.getInventoryListLocal();
    }
}
</script>
