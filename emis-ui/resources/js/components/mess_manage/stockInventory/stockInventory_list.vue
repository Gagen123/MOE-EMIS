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
                       <select name="reordtype" id="reordtype" class="form-control select2" @change="getrecordtype()" >
                            <option value="">---Please Select---</option> 
                            <option value="Centrally Supplied">Cntrally Supplied Record</option>
                            <option value="Locally Procured">Locally Procured Record</option>
                            <option value="3rd quarter">3rd quarter</option>                        
                        </select>
                        <has-error :form="form" field="quarter"></has-error>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="training-table" class="table w-100 table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Item</th>
                                    <th>Stock Received</th>
                                    <th>Locally Procured</th>
                                    <th>Stock Issued</th>
                                    <th>Stock Damage</th>
                                    <th>Unit</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockInventory" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ itemList[item.item_id]}}</td>
                                    <td>{{ item.stock_received_quantity}}</td>
                                    <td>{{ item.local_procured_quantity}}</td>
                                    <td>{{ item.stock_issed_quantity}}</td>
                                    <td>{{ item.Damage_Qty}}</td>
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
            stockInventory:[],
            itemList:{},
            unitList:{},

        }
    },
    methods:{
        /**
         * method to load organization/school list
         */
        getInventoryList(uri = 'mess_manage/getInventoryList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.stockInventory = data.data.data;
            });
        },
        // showbasicdetails(id){
        //     this.$router.push({name:'mess_details',query: {data:id}});
        // },
        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item"){
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


    },
    mounted(){
        this.loadActiveItemList();
        this.loadActiveUnitList();
        this.getInventoryList();
    }
}
</script>
