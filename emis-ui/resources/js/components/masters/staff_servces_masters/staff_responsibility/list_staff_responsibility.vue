<template>
    <div>
        <div class="card-body">
            <table id="working-agency-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th >SL#</th>
                        <th >Responsibility</th>
                        <th >Code</th>
                        <th >Status</th>
                        <th >Created Date</th>
                        <th >Action</th> 
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.code}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ item.created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>      
</template>
<script>
export default {
    data(){
        return{
            dataList:[],
        }
    },
    methods:{
       loadsubjectList(uri = 'masters/loadStaffMasters/all_staff_responsibility_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_staff_responsibility',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadsubjectList();
    }, 
}
</script>
