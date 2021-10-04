<template>
    <div class="card-body overflow-auto">
        <table id="class-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Class</th>
                    <th style="width:10%">Code</th>
                    <th style="width:25%">Description</th>
                    <th style="width:10%">Status</th>
                    <th style="width:20%">Created At</th>
                    <th style="width:10%">Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in classList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.class}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewClassList(item)"><i class="fas fa-edit"></i ></a>
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
            classList:[],
            dt:'',

        }
    },
    methods:{
        loadClassList(uri = 'masters/loadClass'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#class-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewClassList(data){
            data.action='edit';
            this.$router.push({name:'ClassEdit',params: {data:data}});
        },
    },

    mounted(){
        this.loadClassList();
        this.dt =  $("#class-table").DataTable();
    },
    watch: {
        classList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#class-table").DataTable()
            });
        }
    },
}
</script>