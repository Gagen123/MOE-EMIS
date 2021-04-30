<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="list-supplementation" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Term</th>
                            <th>Date</th>
                            <th>Class</th>
                            <th>Total Issued (Boys)</th>
                            <th>Total Issued (Girls)</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.term}}</td>
                            <td>{{ item.date}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            id:'2',
            dataList:[], 
        }
    },
    methods:{
        loadDataList(uri='students/loadSupplementationRecords/'+this.id){
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
                $("#list-supplementation").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'student_projects_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>
