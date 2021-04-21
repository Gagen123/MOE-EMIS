<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Dashboard</h6></li>
        </ol>
        <div class="container-fluid">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-info">
                            <div class="inner">
                                <h3>609</h3>
                                <p>Organizations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-home"></i>
                            </div>
                            <a href="#" @click="showOrgDetails('bg-info')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-success">
                            <div class="inner">
                                <h3>10106</h3>
                                <p>Teachers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-contact"></i>
                            </div>
                            <a href="#" @click="showOrgDetails('bg-success')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>170725</h3>
                                <p>Students</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-ios-people"></i>
                            </div>
                            <a href="#" @click="showOrgDetails('bg-warning')"  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>
                                <p>External Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" @click="showOrgDetails('bg-danger')" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-cyan">
                                <div class="card-header pb-0 pt-2">
                                    <h3 class="card-title"><i class="fa fa-home"></i> Organization Details</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            <div class="card card-warning"> 
                                <div class="card-header pb-0 pt-2">
                                    <h3 class="card-title"><i class="fa fa-users"></i> Student Details</h3>
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


                        <div class="col-md-6">
                            <div class="card card-success">
                            <div class="card-header pb-0 pt-2">
                                <h3 class="card-title"><i class="ion ion-android-person"></i> Teachers Details</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            </div>
                            <div class="card card-success">
                            <div class="card-header pb-0 pt-2">
                                <h3 class="card-title">External Users</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="modal fade" id="dashboardmodal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="mcontent">
                        <div class="modal-header">
                            <h4 class="modal-title"><i class="ion-android-alert pr-1.5"></i>Information</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered" id="bg-info" style="display:none;overflow-x: auto;">
                                <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Organization Name</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Dzongkhag</th>
                                        <th>Gewog</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Jakar HSS</td>
                                        <td> <span class="badge bg-warning">Public Schools</span> </td>
                                        <td><span class="badge bg-success">Opened</span></td>
                                        <td>Bumthang</td>
                                        <td>Chokhor</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Chhumey Central School</td>
                                        <td> <span class="badge bg-warning">Public Schools</span> </td>
                                        <td><span class="badge bg-success">Opened</span></td>
                                        <td>Bumthang</td>
                                        <td>Chumey</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Ura Central School</td>
                                        <td> <span class="badge bg-warning">Public Schools</span> </td>
                                        <td><span class="badge bg-success">Opened</span></td>
                                        <td>Bumthang</td>
                                        <td>Ura</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Tang Central School</td>
                                        <td> <span class="badge bg-warning">Public Schools</span> </td>
                                        <td><span class="badge bg-success">Opened</span></td>
                                        <td>Bumthang</td>
                                        <td>Tang</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Shingkhar PS</td>
                                        <td> <span class="badge bg-warning">Public Schools</span> </td>
                                        <td><span class="badge bg-danger">Closed</span></td>
                                        <td>Bumthang</td>
                                        <td>Ura</td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Yonten Kuenjung Academy HSS</td>
                                        <td> <span class="badge bg-primary">Private Schools</span> </td>
                                        <td><span class="badge bg-success">Opened</span></td>
                                        <td>Chukha</td>
                                        <td>Phuntsholing Thromde</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered" id="bg-success" style="display:none">
                                <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>School Name</th>
                                        <th>Total</th>
                                        <th>Total Male Teacher</th>
                                        <th>Total Female Teacher</th>
                                        <th>Total Supporting Staff</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Jakar HSS</td>
                                        <td> 43 </td>
                                        <td>30</td>
                                        <td>10</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Chhumey Central School</td>
                                        <td> 27 </td>
                                        <td>15</td>
                                        <td>10</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Ura Central School</td>
                                        <td>19</td>
                                        <td>7</td>
                                        <td>10</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Tang Central School</td>
                                        <td> 21 </td>
                                        <td>17</td>
                                        <td>3</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Shingkhar PS</td>
                                        <td>0 </td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Yonten Kuenjung Academy HSS</td>
                                        <td>13</td>
                                        <td>6</td>
                                        <td>6</td>
                                        <td>1</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered" id="bg-warning" style="display:none">
                                <thead>                  
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>School Name</th>
                                        <th>Total Students</th>
                                        <th>Total Male Student</th>
                                        <th>Total Female Student</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Jakar HSS</td>
                                        <td> 312 </td>
                                        <td>250</td>
                                        <td>62</td>
                                    </tr>
                                    <tr>
                                        <td>2.</td>
                                        <td>Chhumey Central School</td>
                                        <td> 590 </td>
                                        <td>300</td>
                                        <td>290</td>
                                    </tr>
                                    <tr>
                                        <td>3.</td>
                                        <td>Ura Central School</td>
                                        <td>340</td>
                                        <td>200</td>
                                        <td>140</td>
                                    </tr>
                                    <tr>
                                        <td>4.</td>
                                        <td>Tang Central School</td>
                                        <td> 238</td>
                                        <td>100</td>
                                        <td>138</td>
                                    </tr>
                                    <tr>
                                        <td>5.</td>
                                        <td>Shingkhar PS</td>
                                        <td>0 </td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td>6.</td>
                                        <td>Yonten Kuenjung Academy HSS</td>
                                        <td>645</td>
                                        <td>395</td>
                                        <td>250</td>
                                    </tr>
                                </tbody>
                            </table>
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
            return {
                showingNavigationDropdown: false,
            }
        },
        methods:{
            showOrgDetails(type) {
                $('#bg-info').hide();
                $('#bg-success').hide();
                $('#bg-warning').hide();
                $('#bg-danger').hide();
                $('#'+type).show();
                $('#mcontent').removeClass('bg-info bg-success bg-warning bg-danger');
                $('#mcontent').addClass(type);
                $('#dashboardmodal').modal('show');
            },
        },
        mounted() {
            $(function () {
                var areaChartData = {
                    labels  : ['Public Teachers', 'Private Teachers', 'Teacher with Disability', 'ECCD & ECR Teachers'],
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
                            data                : [5106, 10000, 400, 300]
                        },
                        {
                            label               : 'Female',
                            backgroundColor     : 'rgba(210, 214, 222, 1)',
                            borderColor         : 'rgba(210, 214, 222, 1)',
                            pointRadius         : false,
                            pointColor          : 'rgba(210, 214, 222, 1)',
                            pointStrokeColor    : '#c1c7d1',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [5000, 2438, 200, 100]
                        },
                    ]
                }

                var areaChartOptions = {
                    maintainAspectRatio : false,
                    responsive : true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines : {
                                display : false,
                            }
                        }],
                        yAxes: [{
                            gridLines : {
                                display : false,
                            }
                        }]
                    }
                }


                //-------------
                //- DONUT CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
                var donutData        = {
                labels: [
                    'Public School', 
                    'Private School',
                    'ECCD Centers', 
                    'Other Organizations', 
                ],
                datasets: [
                    {
                    data: [570,39,23,43],
                    backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }
                ]
                }
                var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
                }

                var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions      
                })

                //-------------
                //- PIE CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var peiData        = {
                    labels: [
                        'Regular Students', 
                        'Private Students',
                        'Student with Disability', 
                        'ECCD & ECR Students', 
                    ],
                    datasets: [
                        {
                        data: [158287,12438,6000,40000],
                        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                }

                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                var pieData        = peiData;
                var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions      
                })

                //-------------
                //- BAR CHART -
                //-------------
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

                //---------------------
                //- STACKED BAR CHART -
                //---------------------
                var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
                var stackedBarChartData = jQuery.extend(true, {}, barChartData)

                var stackedBarChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                scales: {
                    xAxes: [{
                    stacked: true,
                    }],
                    yAxes: [{
                    stacked: true
                    }]
                }
                }

                var stackedBarChart = new Chart(stackedBarChartCanvas, {
                type: 'bar', 
                data: stackedBarChartData,
                options: stackedBarChartOptions
                })
            })
        }  
    }
</script>
