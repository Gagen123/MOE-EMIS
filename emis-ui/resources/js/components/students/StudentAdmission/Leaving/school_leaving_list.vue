<template>
    <div>
        <table id="transfer-list-table" class="table table-bordered text-sm table-striped">
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
                    <td>{{ item.class_det.class}}</td>
                    <td>{{ item.class_det.section}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-print"></i > Print TC</a>
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
            org_id:'2',
            dataList:[],
        }
    },
    methods:{
        loadDataList(uri='students/loadStudentTransfers/'+this.org_id){
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
                $("#transfer-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                });
            }, 3000);
        },
        showedit(data){
            this.$router.push({name:'edit_transfer_student',query: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>
