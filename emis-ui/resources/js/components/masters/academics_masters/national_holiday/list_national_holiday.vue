<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="national_" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                         <th>SL#</th>
                            <th >Date</th>
                            <th >Description</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in nationalHolidayList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{item.holiday_date}}</td>
                            <td>{{item.description}}</td>
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
            nationalHolidayList:[],
            dt:''
        }
    },
    methods:{
        loadSubjectList(uri = 'masters/loadAcademicMasters/all_national_holiday'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.nationalHolidayList =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#subject-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                   
                 
                }); 
            }, 3000);
        },
        showedit(data){
            this.$router.push({name:'edit_national_holiday',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadSubjectList();
        this.dt =  $("#class_subject_assessment_area-table").DataTable({
            columnDefs: [
                { width: 60, targets: 0 },
            ],
        })
    },
    watch: {
        nationalHolidayList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#class_subject_assessment_area-table").DataTable()
            });
        }
    }
}
</script>
