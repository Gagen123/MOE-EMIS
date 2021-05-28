<template>
    <div>
        <table id="feedingChange-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>School Name</th>
                    <th>Feeding School</th>
                    <th>Applicattion ID</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="schoolNamechange">
                <tr v-for="(item, index) in nameChangeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.organizationName}} </td>
                    <td>{{ item.feedingdetial }}</td>
                    <td>{{ item.applicationID  }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewfeedingChangeList(item)"><i class="fas fa-edit"></i ></a>
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
            feedingChangeList:[],
            orgList:{},
            dt:'',
        }
    },

    methods:{
        /**
         * method to load sport facility 
         */
        loadfeedingChangeList(uri = '/'){ 
            axios.get(uri)
            .then(response => {
                let data = response;
                this.feedingChangeList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#schoolFeedingchange').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#feedingChange-table").DataTable({
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
            this.$router.push({name:'FeedingChangeEdit',params: {data:data}});
        },
    },
    mounted(){
      
        this.loadnameChangeList();
        this.dt =  $("#feedingChange-table").DataTable();
    },
    watch: {
        nameChangeList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#feedingChange-table").DataTable()
            });
        }
    },
}
</script>