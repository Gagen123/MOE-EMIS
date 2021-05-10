<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Dzongkhag/Thromde</th>
                    <th >Gewog Name</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in gewogList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.dzongkhag.name}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        <!-- <a v-if="item.status==  1" href="#" @click="changestatus(item.id,'0')" class="btn btn-danger btn-sm btn-flat text-white"><i class="fas fa-times"></i> Deactivate</a>
                        <a v-if="item.status==  0" href="#" @click="changestatus(item.id,'1')" class="btn btn-primary btn-sm btn-flat text-white"><i class="fas fa-check"></i> Activate</a> -->
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
            gewogList:[],
        }
    },
    methods:{
       loadgewogList(uri = 'masters/loadGlobalMasters/all_gewog_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.gewogList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_gewog',params: {data:data}});
        },
        
    },
    mounted(){ 
        this.loadgewogList();
    },
}
</script>
