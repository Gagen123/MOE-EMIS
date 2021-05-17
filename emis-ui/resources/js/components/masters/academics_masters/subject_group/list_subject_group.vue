<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="subject-group-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Display Order</th>
                            <th>Subject Group Name</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in subjectgroupList" :key="index">
                            <td class="text-right">{{ item.display_order }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
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
    data(){
        return{
            subjectgroupList:[],
        }
    },
    methods:{
        loadsubjectgroupList(uri = 'masters/loadAcademicMasters/all_subject_group'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.subjectgroupList =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#subject-group-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                    columnDefs: [
                        { width: 50, targets: 0},
                    ],

                }); 
            }, 3000);
        },
        showedit(data){
            this.$router.push({name:'edit_subject_group',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadsubjectgroupList();
    },
}
</script>
