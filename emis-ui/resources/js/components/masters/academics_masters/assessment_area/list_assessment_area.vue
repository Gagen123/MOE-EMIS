<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="assessment-area-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th >Display Order</th>
                            <th >Subject</th>
                            <th >Assessment Area</th>
                            <th >Assessment Area Code</th>
                            <th >Assessment Type</th>
                            <th >Rating Type</th>
                            <th >Status</th>
                            <th >Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in assessmentAreaList" :key="index">
                            <td class="text-right">{{ item.display_order }}</td>
                            <td>{{item.sub_name}}
                                 <br>
                                <span class="text-center" v-if="item.sub_dzo_name"> {{item.sub_dzo_name}} </span>
                            </td>
                            <td>{{ item.assessment_area_name }}
                                <br>
                                <span v-if="item.area_dzo_name"> {{item.area_dzo_name}}</span>
                            </td>
                            <td>{{ item.code }}</td>
                            <td>{{item.aca_assmnt_type_name}}</td>
                            <td>{{item.rating_type_name}}</td>
                            <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>
                            <td>
                                <!-- <div class="btn-group btn-group-sm"> -->
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                <!-- </div> -->
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
            dt:''
        }
    },
    methods:{
        loadAssessmentAreaList(uri = 'masters/loadAcademicMasters/all_assessment_area'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.assessmentAreaList =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'aca_edit_assessment_area',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadAssessmentAreaList();
        this.dt =  $("#assessment-area-table").DataTable({
            columnDefs: [
                    { width: 2, targets: 0},
                    { width: 150, targets:1},
                    { width: 40, targets:3},
                    { width: 10, targets:5},
                ],
        });
    },
    watch: {
        assessmentAreaList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#assessment-area-table").DataTable()
            });
        }
    }
}
</script>
