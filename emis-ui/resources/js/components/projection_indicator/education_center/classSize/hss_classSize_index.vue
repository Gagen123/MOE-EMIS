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
                       <tr v-for="(item, index) in HssclassSize" :key="index">
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
            HssclassSize:[],
           
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            this.HssclassSize = await this.loadClassSize("HSS",dzo_id);
            //Ploating Graph

            var areaChartData = {
            labels  : ['Public', 'Private', 'NGO', 'Coorporate'],
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

