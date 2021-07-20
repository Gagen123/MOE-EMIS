<template>
    <div>
        <table id="infrastructure-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Structure No.</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in infrastructureList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.categorgName}}</td>
                    <td>{{ item.subCategoryName}}</td>
                    <td>{{ item.structureNo}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewInfrastructureList(item)"><i class="fas fa-edit"></i ></a>
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
            infrastructureList:[],
            dt:'',
        }
    },

    methods:{
        loadInfrastructureList(uri = 'organization/loadInfrastructureList/null'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.infrastructureList =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        viewInfrastructureList(data){
            data.action='edit';
            this.$router.push({name:'InfrastructureEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadInfrastructureList();
        this.dt =  $("#infrastructure-table").DataTable();
    },
    watch: {
        infrastructureList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#infrastructure-table").DataTable()
            });
        }
    },
}
</script>
