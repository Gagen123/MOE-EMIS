<template>
    <div> 
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="localprocure-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Date of Procurement</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in localprocure_list" :key="index">
                            <td> {{index + 1}}</td>
                            <td> {{item.date}}</td>
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
            localprocure_list:[]
        } 
    },
    methods: {
        loadLocalProcureList(uri = 'mess_manage/loadLocalProcureList'){
            axios.get(uri)
            .then(response => { 
                let data = response;
                this.localprocure_list =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#localprocure-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewLocalProcureList(data){
            data.action='edit';
            this.$router.push({name:'LocalProcureEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadLocalProcureList();
    },
    
}
</script>


