<template>
    <div>
        <table id="list-training-participant-table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                    <th >No.</th>
                    <th >Student</th>
                    <th >Training/Exchange Program</th>
                    <th >Type</th>
                    <th >Under Program</th>  
                    <th >From Date</th>  
                    <th >To Date</th>  
                    <th >Place</th>
                    <th >Country</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
           <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.student_name}}</td>
                    <td>{{ item.training}}</td>
                    <td>{{ item.training_type}}</td>
                    <td>{{ item.program}}</td>
                    <td>{{item.fromdate}} </td>
                    <td>{{ item.todate}}</td>
                    <td>{{ item.Place}}</td>
                    <td>{{ item.country_name}}</td>
                    <td>
                        <div class="btn-group btn-group-sm my-2">
                            <a href="#" class="btn btn-info btn-sm text-white" @click="showedit(item)"><i class="fas fa-edit fa-sm"></i > Edit</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
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
                let stduentTrainings = await axios.get('students/listTrainingParticipants/'+this.id)
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
            this.$router.push({name:'edit_student_trainings_participants',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
        this.dt = $("#list-training-participant-table").DataTable({
               columnDefs: [
                    { width: 50, targets:9},
                ],
        })

    },
    watch: {
        dataList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#list-training-participant-table").DataTable()
            });
        }
    }
}
</script>