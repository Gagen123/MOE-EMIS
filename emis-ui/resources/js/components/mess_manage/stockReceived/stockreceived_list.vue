<template>
    <div>
        <table id="stockreceived-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Date of Stock Received</th>
                    <th>Term</th>
                    <th>Remarks</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in stockReceivedList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.dateOfreceived}}</td>
                    <td>{{ termList[item.term]}} </td>
                    <td>{{ item.remarks}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewStockReceivedList(item)"><i class="fas fa-edit"></i ></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return{
            stockReceivedList:[],
            termList:{},
        }
    },

    methods:{
        loadFoodReleaseListing(uri = 'mess_manage/loadFoodReleaseListing/null'){
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
        viewStockReceivedList(data){
            data.action='edit';
            this.$router.push({name:'StockReceivedEdit',params: {data:data}});
        },
        loadActiveTermList(uri="masters/loadActiveStudentMasters/term_type"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.termList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
       
    },
    
    mounted(){
        this.loadActiveTermList();
        this.loadFoodReleaseListing();
        
    },
}
</script>