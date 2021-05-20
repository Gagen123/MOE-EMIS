<template>
    <div>
        <div class="card ">
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
                                    <th>Other</th>    
                                    <th>Stock Issued</th> 
                                    <th>Stock Available</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in stockInventory" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.item }}</td>
                                    <td>{{ item.itemreceived}}</td>
                                    <td>{{ item.localproduce}}</td>
                                    <td>{{ item.othersource}}
                                    <td>{{ item.itenissued}}
                                    <td>{{ item.itemavailable }}</td>
                                   
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
           stockInventory :[],
        }
    },
    methods:{
        /**
         * method to load organization/school list
         */
        
    },
    created(){
       
    }
}
</script>