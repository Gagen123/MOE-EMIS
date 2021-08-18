<template>
    <div>
       <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                           <td><b>Class </b></td>
                            <td><b>No. of Section</b></td>
                            <!-- <td><b>Total</b></td> -->
                        </tr>
                       <tr v-for="(item, index) in LssclassSize" :key="index">
                            <!-- <td>{{ index + 1 }}</td> -->
                            <td>{{ item.Class}}</td>
                            <td>{{ item.No_of_Section}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-warning">
                    <div class="card-header pb-0 pt-2">
                        <h3 class="card-title"><i class="fa fa-users"></i> No of Section</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
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
            LssclassSize:[],
           
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            this.LssclassSize = await this.loadClassSize("LSS",dzo_id);
           
            
            //Ploating Graph

            // if(this.eccdeducationCenter!=""){
            //     var peiData   = {
            //         labels: [
            //             'Public',
            //             'Private',
            //             'Coorporate',
            //             'NGO',
            //         ],
            //         datasets: [
            //             {
            //                 data: [this.eccdeducationCenter[0].Public_ECCD,this.eccdeducationCenter[0].Private_ECCD],
            //                 backgroundColor : ['#f56954', '#00a65a'],
            //             }
            //         ]
            //     }
            //     var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            //         var pieData        = peiData;
            //         var pieOptions     = {
            //             maintainAspectRatio : false,
            //             responsive : true,
            //         }
            //         var pieChart = new Chart(pieChartCanvas, {
            //         type: 'pie',
            //         data: pieData,
            //         options: pieOptions
            //     });
            // }
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

