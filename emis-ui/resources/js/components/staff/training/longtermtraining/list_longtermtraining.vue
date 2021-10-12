<template>
    <div>
        <table id="training-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>StartDate</th>
                    <th>EndDate</th>
                    <th>FundingID</th>
                    <th>StudyModeID</th>
                    <th>HRCNo</th>
                    <th>HRCDate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(promotion, index) in staffList" :key="index">
                   <td>{{ index + 1 }} </td>
                    <td>{{ promotion.staff_name }}</td>
                    <td>{{ promotion.PromotionTypeID }}</td>
                    <td>{{ promotion.superstructure }}</td>
                    <td>{{ promotion.position_title_name }}</td>
                    <td>{{ promotion.positionlevel }}</td>
                    <td>{{ promotion.EffectiveDate }}</td>
                    <td>{{ promotion.JoiningOrderDate }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadviewpage(training)">Veiw</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            staffList:[],
            dt:'',
        }
    },
    methods: {
        loadviewpage(data){
            this.$router.push({name:'view_promotion',query: {data:data}});
        },
    },
    mounted(){
        let uri='/staff/zest/loadLongTermTraining/Limit__20';
        axios.get(uri)
        .then(response => {
            let data = response.data;
            this.staffList = data.data;
        });
        this.dt =  $("#training-table").DataTable()
    },
    watch: {
        staffList(){
            this.applydatatable('training-table');
        }
    },
}
</script>
