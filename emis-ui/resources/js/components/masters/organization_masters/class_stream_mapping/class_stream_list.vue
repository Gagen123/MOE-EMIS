<template>
    <div>
        <table id="class-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Class</th>
                    <th>Streams</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in classList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.class}}</td>
                    <td>{{ item.stream}}</td>
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
            classList:[]
        }
    },
    methods:{
        loadClassList(uri = 'masters/loadClassStreamMapping/NA'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data.data;
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
    },
}
</script>