<template>
    <div>
        <table id="senChange-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>School Name</th>
                    <th>Sen Detial</th>
                    <th>Application ID</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="schoolNamechange">
                <tr v-for="(item, index) in senChangeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.organizationName}} </td>
                    <td>{{ item.senDetail }}</td>
                    <td>{{ item.applicationID }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewsenChangeList(item)"><i class="fas fa-edit"></i ></a>
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
            senChangeList:[],
            orgList:{},
            dt:'',
        }
    },

    methods:{
        /**
         * method to load sport facility 
         */
        loadnameChangeList(uri = '/'){ 
            axios.get(uri)
            .then(response => {
                let data = response;
                this.nameChangeList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#schoolNamechange').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#nameChange-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },

        /**
         * method to view sport list
         */
        loadnameChangeList(data){
            data.action='edit';
            this.$router.push({name:'NameChangeEdit',params: {data:data}});
        },
    },
    mounted(){
      
        this.loadnameChangeList();
        this.dt =  $("#senChange-table").DataTable();
    },
    watch: {
        senChangeList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#senChange-table").DataTable()
            });
        }
    },
}
</script>