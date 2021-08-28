<template>
    <div>
        <div>
            <div class="card-body" >
                <div class="form-group row mb-0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label> <u>Quality Indicators (BCSEA Results)</u> </label>
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>PCA %</th>
                                    <th>PCNA %</th>
                                    <th>Total Appeared</th>
                                    <th>Grand Total</th>
                                </tr>
                                <tr>
                                    <td>Male</td>
                                    <td>{{this.male_pca}}</td>
                                    <td>{{this.male_pcna}}</td>
                                    <td></td>
                                    <td>{{this.total_male}}</td>
                                </tr>
                                <tr>
                                    <td>Female</td>
                                    <td>{{this.female_pca}}</td>
                                    <td>{{this.female_pcna}}</td>
                                    <td></td>
                                    <td>{{this.total_female}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-warning">
                            <div class="card-body">
                                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
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
            indicator:'',
            female_pca:'',
            female_pcna:'',
            male_pca:'',
            male_pcna:'',
            total: '',
            total_female:'',
            total_male: ''
        }
    },
    methods:{
        loadpage:function(type){
            this.$router.push({name:type});
        },
        async generatesdetail(){
            let indicatorType='bcse';
            
            let uri = 'projections/quality/loadIndicatorResult/'+indicatorType;
            try{
                axios.get(uri).then(response => { 
                    this.female_pca= response.data.data.female_pca;
                    this.female_pcna= response.data.data.female_pcna;
                    this.male_pca= response.data.data.male_pca;
                    this.male_pcna= response.data.data.male_pcna;
                    this.total= response.data.data.total;
                    this.total_female= response.data.data.total_female;
                    this.total_male= response.data.data.total_male;

                    //Plotting Bar Graph
                    if(response!=""){
                        var areaChartData = {
                            labels  : ['Male', 'Female', 'Total'],
                            datasets: [
                                {
                                    label               : 'PCA',
                                    backgroundColor     : 'rgba(60,141,188,0.9)',
                                    borderColor         : 'rgba(60,141,188,0.8)',
                                    pointRadius          : false,
                                    pointColor          : '#3b8bba',
                                    pointStrokeColor    : 'rgba(60,141,188,1)',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(60,141,188,1)',
                                    data                : [this.male_pca, this.female_pca, this.male_pca+this.female_pca]
                                },
                                {
                                    label               : 'PCNA',
                                    backgroundColor     : 'rgba(136, 22, 236)',
                                    borderColor         : 'rgba(136, 22, 236)',
                                    pointRadius         : false,
                                    pointColor          : 'rgba(136, 22, 236)',
                                    pointStrokeColor    : '#c1c7d1',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data                : [this.male_pcna, this.female_pcna, this.male_pcna+this.female_pcna]
                                },
                                {
                                    label               : 'Total',
                                    backgroundColor     : 'rgba(31, 100, 224)',
                                    borderColor         : 'rgba(31, 100, 224)',
                                    pointRadius         : false,
                                    pointColor          : 'rgba(31, 100, 224)',
                                    pointStrokeColor    : '#00a65a',
                                    pointHighlightFill  : '#00a65a',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data                : []
                                }
                            ]
                        }

                        var barChartCanvas = $('#barChart').get(0).getContext('2d')
                        var barChartData = jQuery.extend(true, {}, areaChartData)
                        var temp0 = areaChartData.datasets[0]
                        var temp1 = areaChartData.datasets[1]
                        barChartData.datasets[0] = temp1
                        barChartData.datasets[1] = temp0

                        var barChartOptions = {
                        responsive              : true,
                        maintainAspectRatio     : false,
                        datasetFill             : false
                        }

                        var barChart = new Chart(barChartCanvas, {
                            type: 'bar',
                            data: barChartData,
                            options: barChartOptions
                        })
                    }
                });
            }catch(e){
                console.log('error loadIndicatorResult '+e);
            }
        }         
    },
    mounted() {
        this.generatesdetail();
    },
   
}
</script>

