<template>
    <div>
        <form  class="bootbox-form">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="list-student-trainings" class="table table-bordered table-striped table-head-fixed">
                        <thead>
                            <tr>
                                <th >No.</th>
                                <th >Training/Exchange Program</th>
                                <th >Type</th>
                                <th >Under Program</th>
                                <th >Place</th>
                                <th >Country</th>
                                <th >From Date</th>
                                <th >To Date</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in dataList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.Name}}</td>
                                <td>{{ item.TrainingTypeName}}</td>
                                <td>{{ item.Program}}</td>
                                <td>{{ item.Place}}</td>
                                <td>{{item.country_name}} </td>
                                <td>{{ item.FromDate}}</td>
                                <td>{{ item.ToDate}}</td>
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
        </form>
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
            dt:''
        }
    },
    methods:{
        async loadDataList(){
            try{
                let stduentTrainings = await axios.get('students/listStudentTrainings/'+this.id)
                    .then(response => {return response.data.data})
                let country = await axios.get('masters/loadGlobalMasters/all_country')
                    .then(response => {return response.data.data})
                stduentTrainings.forEach((training,index) => {
                    country.forEach(coun =>{
                        if(training.CmnCountryId ==coun.id){
                            stduentTrainings[index]["country_name"] = coun.country_name
                        }
                    })
                });
                this.dataList = stduentTrainings
            }catch(error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            };
         
        },
        showedit(data){
            this.$router.push({name:'edit_student_trainings',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
        this.dt = $("#list-student-trainings").DataTable()
    },
    watch: {
        dataList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#list-student-trainings").DataTable()
            });
        }
    }
}
</script>