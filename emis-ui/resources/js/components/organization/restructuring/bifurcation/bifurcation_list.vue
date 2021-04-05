<template>
    <div>
        <table id="bifurcation-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>School Name</th>
                    <th>Category</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in bifurcationList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.category}}</td>
                    <td>{{ item.levelId}}</td>
                    <td><span class="badge badge-info"> Open</span> </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewBifurcationList(item)"><i class="fas fa-edit"></i ></a>
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
            bifurcationList:[],
        }
    },
    methods:{
        loadBifurcationList(uri = 'organization/loadBifurcation'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.bifurcationList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#bifurcation-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },

        viewBifurcationList(data){
            this.$router.push({name:'BifurcationAdd',params: {data:data}});
        },
    },

    

    mounted(){
        this.loadBifurcationList();
    },
}
</script>