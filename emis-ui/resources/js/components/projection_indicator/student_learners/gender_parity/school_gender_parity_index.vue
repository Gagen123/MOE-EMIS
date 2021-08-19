<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <td><b>Category</b></td>
                            <td><b>Total Boys</b></td>
                            <td><b>Total Girls</b></td>
                            <td><b>Gender parity</b></td>
                        </tr>
                        <tr v-if="public_childrenList!={}">
                            <td>Public</td>
                            <td>{{public_childrenList.malecount}}</td>
                            <td>{{public_childrenList.femalecount}}</td>
                            <td>{{(parseInt(public_childrenList.malecount)/parseInt(public_childrenList.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="private_childrenList!={}">
                            <td>Private</td>
                            <td>{{private_childrenList.malecount}}</td>
                            <td>{{private_childrenList.femalecount}}</td>
                            <td>{{(parseInt(private_childrenList.malecount)/parseInt(private_childrenList.femalecount)).toFixed(2)}}</td>
                        </tr>

                    </tbody>
                </table>
                <div class="form-group row mb-0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label> Total Number of Students in Public School: </label>
                    </div>
                </div>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <td><b>Level</b></td>
                            <td><b>Total Boys</b></td>
                            <td><b>Total Girls</b></td>
                            <td><b>Gender parity</b></td>
                        </tr>
                        <tr v-if="public_higher_data!={}">
                            <td>HSS</td>
                            <td>{{public_higher_data.malecount}}</td>
                            <td>{{public_higher_data.femalecount}}</td>
                            <td>{{(parseInt(public_higher_data.malecount)/parseInt(public_higher_data.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="public_middle_data!={}">
                            <td>MSS</td>
                            <td>{{public_middle_data.malecount}}</td>
                            <td>{{public_middle_data.femalecount}}</td>
                            <td>{{(parseInt(public_middle_data.malecount)/parseInt(public_middle_data.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="public_lower_data!={}">
                            <td>LSS</td>
                            <td>{{public_lower_data.malecount}}</td>
                            <td>{{public_lower_data.femalecount}}</td>
                            <td>{{(parseInt(public_lower_data.malecount)/parseInt(public_lower_data.femalecount)).toFixed(2)}}</td>
                        </tr>

                    </tbody>
                </table>
                <div class="form-group row mb-0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label> Total Number of Students in Private School: </label>
                    </div>
                </div>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <td><b>Level</b></td>
                            <td><b>Total Boys</b></td>
                            <td><b>Total Girls</b></td>
                            <td><b>Gender parity</b></td>
                        </tr>
                        <tr v-if="private_higher_data!={}">
                            <td>HSS</td>
                            <td>{{private_higher_data.malecount}}</td>
                            <td>{{private_higher_data.femalecount}}</td>
                            <td>{{(parseInt(private_higher_data.malecount)/parseInt(private_higher_data.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="private_middle_data!={}">
                            <td>MSS</td>
                            <td>{{private_middle_data.malecount}}</td>
                            <td>{{private_middle_data.femalecount}}</td>
                            <td>{{(parseInt(private_middle_data.malecount)/parseInt(private_middle_data.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="private_lower_data!={}">
                            <td>LSS</td>
                            <td>{{private_lower_data.malecount}}</td>
                            <td>{{private_lower_data.femalecount}}</td>
                            <td>{{(parseInt(private_lower_data.malecount)/parseInt(private_lower_data.femalecount)).toFixed(2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-warning">
                    <div class="card-body">
                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            studentList:[],
            public_childrenList:[],
            private_childrenList:[],

            public_higher_data:[],
            public_lower_data:[],
            public_middle_data:[],

            private_higher_data:[],
            private_lower_data:[],
            private_middle_data:[],
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            let response_data=  await this.loadStudents(dzo_id);
            this.public_childrenList=response_data.public_data[0];
            this.private_childrenList=response_data.private_data[0];
            this.public_higher_data=response_data.public_higher_data[0];
            this.public_lower_data=response_data.public_lower_data[0];
            this.public_middle_data=response_data.public_middle_data[0];

            this.private_higher_data=response_data.private_higher_data[0];
            this.private_lower_data=response_data.private_lower_data[0];
            this.private_middle_data=response_data.private_middle_data[0];
            //Ploating Graph
            if(response_data!=""){
                var peiData        = {
                    labels: [
                        'Public',
                        'Private',
                    ],
                    datasets: [
                        {
                            data: [this.public_childrenList.totalstd,this.private_childrenList.totalstd],
                            backgroundColor : ['#f56954', '#00a65a'],
                        }
                    ]
                }
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                    var pieData        = peiData;
                    var pieOptions     = {
                        maintainAspectRatio : false,
                        responsive : true,
                    }
                    var pieChart = new Chart(pieChartCanvas, {
                    type: 'pie',
                    data: pieData,
                    options: pieOptions
                });
            }
        }
    },
    mounted() {
        this.generatesdetail(this.$route.query.dzo_id);
    },
    watch: {
        '$route.query.dzo_id': {
            handler: function(dzo_id) {
                this.generatesdetail(dzo_id);
            },
        }
    },

}
</script>

