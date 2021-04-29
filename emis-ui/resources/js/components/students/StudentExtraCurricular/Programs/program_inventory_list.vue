<template>
    <div>
        <table id="list-programs-inventory" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>

                     <th >No.</th>
                     <th >Program</th>
                     <th >For Month</th>
                     <th >Increase in Quantity</th>
                     <th >Decrease in Quantity</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.program_name}}</td>
                    <td>{{ item.ForMonth}}</td>
                    <td>{{ item.IncreaseInQuantity}}</td>
                    <td>{{ item.DecreaseInQuantity}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            id:'2',
            dataList:[], 
        }
    },
    methods:{
        loadDataList(uri='students/loadProgramInventory/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#list-programs-inventory").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'student_awards_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>