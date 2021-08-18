<template>
    <div>
        <div class="form-group row mb-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label> <u>Total Number of Children by Gender in ECCD</u></label>
            </div>
        </div>
       <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table id="waterTable" class="mt-5 table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <td><b>Category</b></td>
                            <td><b>Total Boys</b></td>
                            <td><b>Total Girls</b></td>
                            <td><b>Total</b></td>
                        </tr>
                        <tr v-if="public_childrenList!={}">
                            <td>Public</td>
                            <td>{{public_childrenList.malecount}}</td>
                            <td>{{public_childrenList.femalecount}}</td>
                            <td>{{public_childrenList.totalstd}}</td>
                        </tr>
                        <tr v-if="private_childrenList!={}">
                            <td>Private</td>
                            <td>{{private_childrenList.malecount}}</td>
                            <td>{{private_childrenList.femalecount}}</td>
                            <td>{{private_childrenList.totalstd}}</td>
                        </tr>
                        <tr v-if="ngo_childrenList!={}">
                            <td>NGO</td>
                            <td>{{ngo_childrenList.malecount}}</td>
                            <td>{{ngo_childrenList.femalecount}}</td>
                            <td>{{ngo_childrenList.totalstd}}</td>
                        </tr>
                        <tr v-if="coor_childrenList!={}">
                            <td>Corporate</td>
                            <td>{{coor_childrenList.malecount}}</td>
                            <td>{{coor_childrenList.femalecount}}</td>
                            <td>{{coor_childrenList.totalstd}}</td>
                        </tr>
                        <tr>
                            <td><b>Total </b></td>
                            <td><b>{{totalmale}}</b></td>
                            <td><b>{{totalfemale}}</b></td>
                            <td><b>{{grandtotal}}</b></td>
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
        <div class="form-group row mb-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label> <u>Total Number of Children by Age group</u> </label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <td><b>Category</b></td>
                            <td colspan="2"><b>Less than 3 Years</b></td>
                            <td colspan="2"><b>3-5 Years</b></td>
                            <td colspan="2"><b>Above 5 Years</b></td>
                            <td><b>Grand Total</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>Boys</b></td>
                            <td><b>Girls</b></td>
                            <td><b>Boys</b></td>
                            <td><b>Girls</b></td>
                            <td><b>Boys</b></td>
                            <td><b>Girls</b></td>
                            <td></td>
                        </tr>
                        <tr v-if="public_childrenList!={}">
                            <td>Public</td>
                            <td>{{public_childrenList.lessthen3male}}</td>
                            <td>{{public_childrenList.lessthen3female}}</td>
                            <td>{{public_childrenList.rightagemale}}</td>
                            <td>{{public_childrenList.rightagefemale}}</td>
                            <td>{{public_childrenList.abovemale}}</td>
                            <td>{{public_childrenList.abovefemale}}</td>
                            <td>{{public_childrenList.totalstd}}</td>
                        </tr>
                        <tr v-if="private_childrenList!={}">
                            <td>Private</td>
                            <td>{{private_childrenList.lessthen3male }}</td>
                            <td>{{private_childrenList.lessthen3female}}</td>
                            <td>{{private_childrenList.rightagemale}}</td>
                            <td>{{private_childrenList.rightagefemale}}</td>
                            <td>{{private_childrenList.abovemale}}</td>
                            <td>{{private_childrenList.abovefemale}}</td>
                            <td>{{private_childrenList.totalstd}}</td>
                        </tr>
                        <tr v-if="ngo_childrenList!={}">
                            <td>NGO</td>
                            <td>{{ngo_childrenList.lessthen3male}}</td>
                            <td>{{ngo_childrenList.lessthen3female}}</td>
                            <td>{{ngo_childrenList.rightagemale}}</td>
                            <td>{{ngo_childrenList.rightagefemale}}</td>
                            <td>{{ngo_childrenList.abovemale}}</td>
                            <td>{{ngo_childrenList.abovefemale}}</td>
                            <td>{{ngo_childrenList.totalstd}}</td>
                        </tr>
                        <tr v-if="coor_childrenList!={}">
                            <td>Corporate</td>
                            <td>{{coor_childrenList.lessthen3male }}</td>
                            <td>{{coor_childrenList.lessthen3female}}</td>
                            <td>{{coor_childrenList.rightagemale}}</td>
                            <td>{{coor_childrenList.rightagefemale}}</td>
                            <td>{{coor_childrenList.abovemale}}</td>
                            <td>{{coor_childrenList.abovefemale}}</td>
                            <td>{{coor_childrenList.totalstd}}</td>
                        </tr>
                        <tr>
                            <td><b>Total </b></td>
                            <td><b>{{coor_childrenList.lessthen3male + ngo_childrenList.lessthen3male+private_childrenList.lessthen3male + public_childrenList.lessthen3male}}</b></td>
                            <td><b>{{coor_childrenList.lessthen3female + ngo_childrenList.lessthen3female + private_childrenList.lessthen3male + public_childrenList.lessthen3female}}</b></td>
                            <td><b>{{coor_childrenList.rightagemale + ngo_childrenList.rightagemale + private_childrenList.rightagemale + public_childrenList.rightagemale}}</b></td>
                            <td><b>{{coor_childrenList.rightagefemale+ngo_childrenList.rightagefemale+private_childrenList.rightagefemale+public_childrenList.rightagefemale}}</b></td>
                            <td><b>{{coor_childrenList.abovemale+ngo_childrenList.abovemale+private_childrenList.abovemale+public_childrenList.abovemale}}</b></td>
                            <td><b>{{coor_childrenList.abovefemale+ngo_childrenList.abovefemale+private_childrenList.abovefemale+public_childrenList.abovefemale}}</b></td>
                            <td><b>{{coor_childrenList.totalstd+ngo_childrenList.totalstd+private_childrenList.totalstd+public_childrenList.totalstd}}</b></td>
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
</template>
<script>
export default {
    data(){
        return{
            public_childrenList:[],
            private_childrenList:[],
            ngo_childrenList:[],
            coor_childrenList:[],
            totalmale:0,
            totalfemale:0,
            grandtotal:0,
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            let response_data= await this.loadEccdChildrens('ALL',dzo_id);
            this.public_childrenList=response_data.public_data[0];
            this.private_childrenList=response_data.private_data[0];
            this.ngo_childrenList=response_data.ngo_data[0];
            this.coor_childrenList=response_data.coorporate_data[0];
            this.totalmale=this.public_childrenList.malecount+this.private_childrenList.malecount+this.ngo_childrenList.malecount+this.coor_childrenList.malecount;
            this.totalfemale=this.public_childrenList.femalecount+this.private_childrenList.femalecount+this.ngo_childrenList.femalecount+this.coor_childrenList.femalecount;
            this.grandtotal=this.public_childrenList.totalstd+this.private_childrenList.totalstd+this.ngo_childrenList.totalstd+this.coor_childrenList.totalstd;
            //Ploating Graph
            if(response_data!=""){
                var peiData   = {
                    labels: [
                        'Public',
                        'Private',
                        'Corporate',
                        'NGO',
                    ],
                    datasets: [
                        {
                            data: [this.public_childrenList.totalstd,this.private_childrenList.totalstd,this.coor_childrenList.totalstd,this.ngo_childrenList.totalstd],
                            backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#3c8dbc'],
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

                //ploating bar chart
                var areaChartData = {
                    labels  : ['Public', 'Private', 'NGO', 'Corporate'],
                    datasets: [
                        {
                            label               : 'Less than 3 Years Male',
                            backgroundColor     : 'rgba(60,141,188,0.9)',
                            borderColor         : 'rgba(60,141,188,0.8)',
                            pointRadius          : false,
                            pointColor          : '#3b8bba',
                            pointStrokeColor    : 'rgba(60,141,188,1)',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data                : [this.public_childrenList.lessthen3male,this.private_childrenList.lessthen3male,this.coor_childrenList.lessthen3male,this.ngo_childrenList.lessthen3male]
                        },
                        {
                            label               : 'Less than 3 Years  Female',
                            backgroundColor     : 'rgba(136, 22, 236)',
                            borderColor         : 'rgba(136, 22, 236)',
                            pointRadius         : false,
                            pointColor          : 'rgba(136, 22, 236)',
                            pointStrokeColor    : '#c1c7d1',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [this.public_childrenList.lessthen3female,this.private_childrenList.lessthen3female,this.coor_childrenList.lessthen3female,this.ngo_childrenList.lessthen3female]
                        },
                        {
                            label               : '3-5 Years Male',
                            backgroundColor     : 'rgba(31, 100, 224)',
                            borderColor         : 'rgba(31, 100, 224)',
                            pointRadius         : false,
                            pointColor          : 'rgba(31, 100, 224)',
                            pointStrokeColor    : '#00a65a',
                            pointHighlightFill  : '#00a65a',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [this.public_childrenList.rightagemale,this.private_childrenList.rightagemale,this.coor_childrenList.rightagemale,this.ngo_childrenList.rightagemale]
                        },
                        {
                            label               : '3-5 Years Female',
                            backgroundColor     : 'rgba(70, 224, 31)',
                            borderColor         : 'rgba(70, 224, 31)',
                            pointRadius         : false,
                            pointColor          : 'rgba(70, 224, 31)',
                            pointStrokeColor    : '#f39c12',
                            pointHighlightFill  : '#f39c12',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [this.public_childrenList.rightagefemale,this.private_childrenList.rightagefemale,this.coor_childrenList.rightagefemale,this.ngo_childrenList.rightagefemale]
                        },
                        {
                            label               : 'Above 5 Years Male',
                            backgroundColor     : 'rgba(31, 222, 224)',
                            borderColor         : 'rgba(31, 222, 224)',
                            pointRadius         : false,
                            pointColor          : 'rgba(31, 222, 224)',
                            pointStrokeColor    : '#3c8dbc',
                            pointHighlightFill  : '#3c8dbc',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [this.public_childrenList.abovemale,this.private_childrenList.abovemale,this.coor_childrenList.abovemale,this.ngo_childrenList.abovemale]
                        },
                        {
                            label               : 'Above 5 Years Female',
                            backgroundColor     : 'rgba(49, 31, 224)',
                            borderColor         : 'rgba(49, 31, 224)',
                            pointRadius         : false,
                            pointColor          : 'rgba(49, 31, 224)',
                            pointStrokeColor    : '#3c8dbc',
                            pointHighlightFill  : '#3c8dbc',
                            pointHighlightStroke: 'rgba(220,220,220,1)',
                            data                : [this.public_childrenList.abovefemale,this.private_childrenList.abovefemale,this.coor_childrenList.abovefemale,this.ngo_childrenList.abovefemale]
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

