<template>
    <div>
        <table id="levelChange-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>School Name</th>
                    <th>Former Level Name</th>
                    <th>New Proposed Level</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="schoolNamechange">
                <tr v-for="(item, index) in nameChangeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.organizationName}} </td>
                    <td>{{ item.formerlevel }}</td>
                    <td>{{ item.newlevel }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewlevelChangeList(item)"><i class="fas fa-edit"></i ></a>
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
            levelChangeList:[],
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
        this.dt =  $("#levelChange-table").DataTable();
    },
    watch: {
        levelChangeList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#levelChange-table").DataTable()
            });
        }
    },
}
</script>