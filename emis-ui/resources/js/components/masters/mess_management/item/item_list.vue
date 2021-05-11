<template>
<div>
    <table id="item-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Item Type</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in itemList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewItemList(item)"><i class="fas fa-edit"></i ></a>
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
            itemList:[],
        }
    },

    methods:{
        loadItemList(uri = 'masters/loadItem'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.itemList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#item-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewItemList(data){
            data.action='edit';
            this.$router.push({name:'ItemEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadItemList();
    },
}
</script>