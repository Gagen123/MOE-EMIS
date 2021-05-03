<template>
    <div> 
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="foodrelease-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Date of Food Release</th>
                            <th>Dzongkhag</th>
                            <th>School Name</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in foodrelease_list" :key="index">
                            <td> {{index + 1}}</td>
                             <td> {{item.dzongkhag}}</td>
                            <td> {{item.date}}</td>
                            <td>{{item.school}}</td>
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
            foodrelease_list:[]
        } 
    },
    methods: {
        loadFoodReleaseList(uri = 'mess_manage/loadFoodReleaseList'){
            axios.get(uri)
            .then(response => { 
                let data = response;
                this.foodrelease_list =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#foodrelease-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewFoodReleaseList(data){
            data.action='edit';
            this.$router.push({name:'FoodReleaseEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadFoodReleaseList();
    },
    
}
</script>


