<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Enrollment in School</label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <th>Class</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Total</th>
                        </tr>
                       <tr>
                            <td>PP</td>
                            <td>{{this.pp_male}}</td>
                            <td>{{this.pp_female}}</td>
                            <td>{{this.pp_male + this.pp_female}}</td>
                        </tr>
                        <tr>
                            <td>I</td>
                            <td>{{this.i_male}}</td>
                            <td>{{this.i_female}}</td>
                            <td>{{this.i_male + this.i_female}}</td>
                        </tr>
                        <tr>
                            <td>II</td>
                            <td>{{this.ii_male}}</td>
                            <td>{{this.ii_female}}</td>
                            <td>{{this.ii_male + this.ii_female}}</td>
                        </tr>
                        <tr>
                            <td>III</td>
                            <td>{{this.iii_male}}</td>
                            <td>{{this.iii_female}}</td>
                            <td>{{this.iii_male + this.iii_female}}</td>
                        </tr>
                        <tr>
                            <td>IV</td>
                            <td>{{this.iv_male}}</td>
                            <td>{{this.iv_female}}</td>
                            <td>{{this.iv_male + this.iv_female}}</td>
                        </tr>
                        <tr>
                            <td>V</td>
                            <td>{{this.v_male}}</td>
                            <td>{{this.v_female}}</td>
                            <td>{{this.v_male + this.v_female}}</td>
                        </tr>
                        <tr>
                            <td>VI</td>
                            <td>{{this.vi_male}}</td>
                            <td>{{this.vi_female}}</td>
                            <td>{{this.vi_male + this.vi_female}}</td>
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
                            <td>PP</td>
                            <td>5</td>
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
                            <td>I</td>
                            <td>6</td>
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
                            <td>II</td>
                            <td>7</td>
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
                            <td>III</td>
                            <td>8</td>
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
                            <td>IV</td>
                            <td>9</td>
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
                            <td>V</td>
                            <td>10</td>
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
                            <td>VI</td>
                            <td>11</td>
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
            studentAgeData:[],
            private_male:'',
            private_female:'',
            public_male:'',
            public_female:'',         
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            let type = "Middle";
            let uri = 'projections/education/loadTeacherNumbers/'+type+'/'+dzo_id;

            try{
                axios.get(uri).then(response => { 
                    this.studentData = response.data.data;

                    //Plotting Graph
                    if(this.studentData!=""){
                        this.private_male = this.studentData['PP'].male;
                        this.private_female = this.studentData['PP'].female;
                        this.public_male = this.studentData['I'].male;
                        this.public_female = this.studentData['I'].female;
                        
                        var areaChartData = {
                            labels  : ['Private', 'Public', 'Total'],
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
                                    data                : [this.private_male, this.public_male]
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
                                    data                : [this.private_female, this.public_female]
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
                                    data                : [this.private_male + this.private_female, this.public_male + this.public_female]
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
            let uri2 = 'projections/education/loadTeacherNationality/'+type+'/'+dzo_id;

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

