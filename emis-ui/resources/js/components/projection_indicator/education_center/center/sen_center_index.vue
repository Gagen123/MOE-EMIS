<template>
    <div>
       <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <td><b>Category</b></td>
                            <td><b>Lower Secondary</b></td>
                            <td><b>Primary</b></td>
                            <td><b>Middle Secondary</b></td>
                            <td><b>Higher Secondary</b></td>
                            <td><b>Total</b></td>
                        </tr>
                       <tr v-for="(item, index) in sencenter" :key="index">
                            <td><b>{{item.category}}</b></td>
                            <td><b>{{item.Lower_Secondary_School}}</b></td>
                            <td><b>{{item.primary_School}}</b></td>
                            <td><b>{{item.Middle_secondary_school}}</b></td>
                            <td><b>{{item.Higher_Secondary_School}}</b></td> 
                            <td><b>{{item.Total}}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-warning">
                    <div class="card-header pb-0 pt-2">
                        <h3 class="card-title"><i class="fa fa-users"></i> Private & Public School</h3>
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
            sencenter:[],
           
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            this.sencenter = await this.loadeducationCenter("SEN",dzo_id);
            
            //Ploating Graph
            if(this.sencenter!=""){
                var peiData   = {
                    labels: [
                        'Lower Secondary',
                        'Primary',
                        'Middle Secondary',
                        'Higher Secondary',
                    ],
                    datasets: [
                        {
                            data: [this.sencenter[0].Lower_Secondary_School+this.sencenter[1].Lower_Secondary_School,
                            this.sencenter[0].primary_School+this.sencenter[1].primary_School,
                            this.sencenter[0].Middle_secondary_school+this.sencenter[1].Middle_secondary_school,
                            this.sencenter[0].Higher_Secondary_School+this.sencenter[1].Higher_Secondary_School],
                            backgroundColor : ['#f56954', '#00a65a','#f39c12', '#3c8dbc'],
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

