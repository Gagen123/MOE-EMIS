<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="subject-group-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                           <th >SL#</th>
                            <th >Subject Name</th>
                            <th >Rating Type</th>
                            <th >Assessment Area</th>
                            <th >Display Order</th>
                            <th >Status</th>
                            <th >Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in subjectgroupList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{item.sub_category_name}}</td>
                            <td>{{item.sub_group_name}}</td>
                            <td>{{ item.sub_name }}</td>
                            <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                    <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
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
            assessmentAreaList:[],
        }
    },
    methods:{
        loadAssessmentAreaList(uri = 'masters/loadAcademicMasters/all_assessment_area'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.assessmentAreaList =  data.data.data;
                console.table(this.assessmentAreaList)
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
                }); 
            }, 3000);
        },
        showedit(data){
            this.$router.push({name:'aca_edit_subject',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadAssessmentAreaList();
    },
}
</script>
