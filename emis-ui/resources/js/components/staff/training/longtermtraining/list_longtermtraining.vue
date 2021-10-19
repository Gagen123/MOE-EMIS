<template>
    <div>
        <search />
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                <table id="training-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Dzongkhag/Thromde</th>
                            <th>Working Agency</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>StartDate</th>
                            <th>EndDate</th>
                            <th>Funding</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(training, index) in staffList" :key="index">
                            <td>{{ index + 1 }} </td>
                            <td>{{ training.dzongkhag }}</td>
                            <td>{{ training.working_agency }}</td>
                            <td>{{ training.staff_name }}</td>
                            <td>{{ training.Course }}</td>
                            <td>{{ training.StartDate }}</td>
                            <td>{{ training.EndDate }}</td>
                            <td>{{ training.funding }}</td>
                            <td>{{ training.training_status }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadviewpage(training)">Veiw</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import search from "../../searchpage.vue";
export default {
    components: {
        search,
    },
    data() {
        return {
            staffList:[],
            dt:'',
        }
    },
    methods: {
        loadviewpage(data){
            this.$router.push({name:'view_longtermtraining',query: {data:data}});
        },
        async loadRespectiveDataData(org_id){
            this.staffList = [];
            let uri='/staff/zest/loadLongTermTraining/byOrdId__'+org_id;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.staffList = data.data;
            });
        },
    },
    mounted(){
        let uri='/staff/zest/loadLongTermTraining/Limit__20';
        axios.get(uri)
        .then(response => {
            let data = response.data;
            this.staffList = data.data;
        });
        this.dt =  $("#training-table").DataTable();
        Fire.$on('loadRespectiveDataData',(id)=>{
            this.loadRespectiveDataData(id);
        });
    },
    watch: {
        staffList(){
            this.applydatatable('training-table');
        }
    },
}
</script>
