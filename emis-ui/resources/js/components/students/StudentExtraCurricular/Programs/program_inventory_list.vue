<template>
    <div>
        <table id="list-programs-inventory" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>

                     <th >No.</th>
                     <th >Program</th>
                     <th >For Month</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.program_name}}</td>
                    <td>{{ item.ForMonth}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="showview(item)"><i class="fas fa-search"></i > View</a>
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
            dt:'',
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
                console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'program_inventory_edit',params: {data:data}});
        },
        showview(data){
            this.$router.push({name:'program_inventory_view',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
        this.dt =  $("#list-programs-inventory").DataTable();
    },
    watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#list-programs-inventory").DataTable()
            });
        }
    },
}
</script>
