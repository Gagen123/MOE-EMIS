<template>
    <div>
       <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <th>Class Size</th>
                        </tr>
                       <tr>
                            <td>PP</td>
                            <td>{{this.pp_gpi}}</td>
                        </tr>
                        <tr>
                            <td>I</td>
                            <td>{{this.i_gpi}}</td>
                        </tr>
                        <tr>
                            <td>II</td>
                            <td>{{this.ii_gpi}}</td>
                        </tr>
                        <tr>
                            <td>III</td>
                            <td>{{this.iii_gpi}}</td>
                        </tr>
                        <tr>
                            <td>IV</td>
                            <td>{{this.iv_gpi}}</td>
                        </tr>
                        <tr>
                            <td>V</td>
                            <td>{{this.v_gpi}}</td>
                        </tr>
                        <tr>
                            <td>VI</td>
                            <td>{{this.vi_gpi}}</td>
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
    </div>
</template>
<script>
export default {
    data(){
        return{
            studentData:[],
            pp_gpi:'',
            i_gpi:'',
            ii_gpi:'',
            iii_gpi:'',
            iv_gpi:'',
            v_gpi:'',
            vi_gpi:''       
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            let type = "Primary";
            let uri = 'projections/quality/loadClassSize/'+type+'/'+dzo_id;

            try{
                axios.get(uri).then(response => { 
                    this.studentData = response.data.data;

                    //Plotting Graph
                    if(this.studentData!=""){
                        this.pp_gpi = this.studentData['PP'];
                        this.i_gpi = this.studentData['I'];
                        this.ii_gpi = this.studentData['II'];
                        this.iii_gpi = this.studentData['III'];
                        this.iv_gpi = this.studentData['IV'];
                        this.v_gpi = this.studentData['V'];
                        this.vi_gpi = this.studentData['VI'];
                        
                        var areaChartData = {
                            labels  : ['PP', 'I', 'II', 'III', 'IV', 'V', 'VI'],
                            datasets: [
                                {
                                    label               : 'Class Size',
                                    backgroundColor     : 'rgba(60,141,188,0.9)',
                                    borderColor         : 'rgba(60,141,188,0.8)',
                                    pointRadius          : false,
                                    pointColor          : '#3b8bba',
                                    pointStrokeColor    : 'rgba(60,141,188,1)',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(60,141,188,1)',
                                    data                : [this.pp_gpi, this.i_gpi, this.ii_gpi, this.iii_gpi, this.iv_gpi, this.v_gpi, this.vi_gpi]
                                },
                                {
                                    backgroundColor     : 'rgba(136, 22, 236)',
                                    borderColor         : 'rgba(136, 22, 236)',
                                    pointRadius         : false,
                                    pointColor          : 'rgba(136, 22, 236)',
                                    pointStrokeColor    : '#c1c7d1',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data                : []
                                },
                                {
                                    backgroundColor     : 'rgba(136, 22, 1)',
                                    borderColor         : 'rgba(136, 22, 1)',
                                    pointRadius         : false,
                                    pointColor          : 'rgba(136, 22, 1)',
                                    pointStrokeColor    : '#c1c7d1',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data                : []
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

