<template>
    <div>
        <table id="stream-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Stream</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in streamList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.stream}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewStreamList(item)"><i class="fas fa-edit"></i ></a>
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
            streamList:[]
        }
    },
    methods:{
        loadStreamList(uri = 'masters/loadStream'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.streamList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#stream-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewStreamList(data){
            data.action='edit';
            this.$router.push({name:'StreamEdit',params: {data:data}});
        },
    },
     mounted(){
        this.loadStreamList();
    },
}
</script>