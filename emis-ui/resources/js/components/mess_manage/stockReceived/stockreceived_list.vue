<template>
    <div> 
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="stockreceived-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Date of Stock Received</th>
                            <th>Quater</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in stockreceived_list" :key="index">
                            <td> {{index + 1}}</td>
                            <td> {{item.date}}</td>
                            <td>{{item.term}}</td>
                            <td> 
                              <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)">Edit</a>
                               </div>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{ 
            totle:0,
            stockreceived_list:[]
        } 
    },
    methods: {
        loadStockReceivedList(uri = 'mess_manage/loadStockReceivedList'){
            axios.get(uri)
            .then(response => { 
                let data = response;
                this.stockreceived_list =  data.data;
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
    },
    mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.access_level=data['acess_level'];
            if(data['acess_level']=="Org"){
                this.loadDataList(data['Agency_Code']);
                $('#org_section').hide();
            }
            if(data['acess_level']=="Dzongkhag"){
                this.allOrgList(data['Dzo_Id']);
            }
            if(data['acess_level']=="Ministry"){
                $('#dzongkhag_id').show();
                this.loadactivedzongkhagList();
            }
        })    
        .catch(errors => { 
            console.log(errors)
        });

        this.loadStockReceivedList();
    },
    
}
</script>


