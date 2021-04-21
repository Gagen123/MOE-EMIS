<template>
    <div>
        <table id="subCategory-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in strSubCategoryList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.structureCategory}}</td>
                    <td>{{ item.subCategoryName}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewStrSubCategoryList(item)"><i class="fas fa-edit"></i ></a>
                            <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
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
            strSubCategoryList:[],
        }
    },

    methods:{
        loadStrSubCategoryList(uri = 'masters/loadStrSubCategory'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.strSubCategoryList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $('#subCategory-table').DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewStrSubCategoryList(data){
            data.action='edit';
            this.$router.push({name:'StrSubCategoryEdit',params: {data:data}});
        },
    },

    mounted(){
        this.loadStrSubCategoryList();
    },
}
</script>