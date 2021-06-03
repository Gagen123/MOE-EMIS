<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">List of Students</h6></li>
        </ol>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">
                    <div class="card-header pt-0 mt-0 pb-0"> 
                        <div>
                            <table id="award-list-table" class="table table-bordered text-sm table-striped">
                                <thead>
                                    <tr>
                                        <th >SL#</th>
                                        <th >Student Name</th>
                                        <th >Student Code</th>
                                        <th >Class</th>
                                        <th >Section</th>
                                        <th >Action</th> 
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <tr v-for="(item, index) in dataList" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ item.Name}}</td>
                                        <td>{{ item.student_code}}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-eye"></i > View</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>  
    </div>     
</template>
<script>
export default {
    data(){
        return{
            org_id:'2',
            dataList:[], 
        }
    },
    methods:{
        loadDataList(uri='students/loadBasicStudentList/'+this.org_id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#award-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'student_profile',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>
