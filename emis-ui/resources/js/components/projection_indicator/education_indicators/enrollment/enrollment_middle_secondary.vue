<template>
    <div>
       <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>IX</td>
                            <td>{{this.ix_male}}</td>
                            <td>{{this.ix_female}}</td>
                            <td>{{this.ix_male + this.ix_female}}</td>
                        </tr>
                        <tr>
                            <td>X</td>
                            <td>{{this.x_male}}</td>
                            <td>{{this.x_female}}</td>
                            <td>{{this.x_male + this.x_female}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card card-warning">
                    <div class="card-body">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label>Enrollment in By Age</label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <th rowspan="2">Class</th>
                            <th rowspan="2">Right Age (Years)</th>
                            <th colspan="5">Right Age Enrollment</th>
                            <th colspan="5">Overage Enrollment</th>
                            <th colspan="5">Underage Enrollment</th>
                        </tr>
                        <tr>
                            <th>2017</th>
                            <th>2018</th>
                            <th>2019</th>
                            <th>2020</th>
                            <th>2021</th>
                            <th>2017</th>
                            <th>2018</th>
                            <th>2019</th>
                            <th>2020</th>
                            <th>2021</th>
                            <th>2017</th>
                            <th>2018</th>
                            <th>2019</th>
                            <th>2020</th>
                            <th>2021</th>
                        </tr>
                       <tr>
                            <td>IX</td>
                            <td>14</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>X</td>
                            <td>15</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
            studentData:[],
            ix_male:'',
            ix_female:'',
            x_male:'',
            x_female:''
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            let type = "Middle";
            let uri = 'projections/education/loadEnrollment/'+type+'/'+dzo_id;

            try{
                axios.get(uri).then(response => { 
                    this.studentData = response.data.data;

                    //Plotting Graph
                    if(this.studentData!=""){
                        this.ix_male = this.studentData['IX'].male;
                        this.ix_female = this.studentData['IX'].female;
                        this.x_male = this.studentData['X'].male;
                        this.x_female = this.studentData['X'].female;
                        
                        var areaChartData = {
                            labels  : ['IX', 'X'],
                            datasets: [
                                {
                                    label               : 'Male',
                                    backgroundColor     : 'rgba(60,141,188,0.9)',
                                    borderColor         : 'rgba(60,141,188,0.8)',
                                    pointRadius          : false,
                                    pointColor          : '#3b8bba',
                                    pointStrokeColor    : 'rgba(60,141,188,1)',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(60,141,188,1)',
                                    data                : [this.ix_male, this.x_male]
                                },
                                {
                                    label               : 'Female',
                                    backgroundColor     : 'rgba(136, 22, 236)',
                                    borderColor         : 'rgba(136, 22, 236)',
                                    pointRadius         : false,
                                    pointColor          : 'rgba(136, 22, 236)',
                                    pointStrokeColor    : '#c1c7d1',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data                : [this.ix_female, this.x_female]
                                },
                                {
                                    label               : 'Total',
                                    backgroundColor     : 'rgba(136, 22, 1)',
                                    borderColor         : 'rgba(136, 22, 1)',
                                    pointRadius         : false,
                                    pointColor          : 'rgba(136, 22, 1)',
                                    pointStrokeColor    : '#c1c7d1',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data                : [this.ix_male + this.ix_female, this.x_male + this.x_female]
                                },
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
            //Get the enrollment by age
            let uri2 = 'projections/education/loadEnrollmentByAge/'+type+'/'+dzo_id;

            try{
                axios.get(uri2).then(response => { 
                    this.studentAgeData = response.data.data;
                });
            }catch(e){
                console.log('error loadIndicatorResult '+e);
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

