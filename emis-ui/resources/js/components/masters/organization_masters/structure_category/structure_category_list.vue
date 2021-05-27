<template>
    <div>
        <table id="structureCategory-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Structure</th>
                    <th>Description</th> 
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in structureCategoryList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewStructureCategoryList(item)"><i class="fas fa-edit"></i ></a>
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
            structureCategoryList:[],
            cat:'',
        }
    },

    methods:{
       loadStructureCategoryList(uri = 'masters/loadStructureCategory'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.structureCategoryList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#structureCategory-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewStructureCategoryList(data){
            data.action='edit';
            this.$router.push({name:'StructureCategoryEdit',params: {data:data}});
        }, 
    },
    mounted(){
        this.loadStructureCategoryList();
        this.cat =  $("#structureCategory-table").DataTable();
    },
    watch: {
        structureCategoryList(){
            this.cat.destroy();
            this.$nextTick(() => {
                this.cat =  $("#structureCategory-table").DataTable()
            });
        }
    },
}
</script>