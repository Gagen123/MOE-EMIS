<template>
    <div>
       <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <th>Category</th>
                            <th>Public</th>
                            <th>Private</th>
                            <th>Total</th>
                        </tr>
                       <tr v-for="(item, index) in schooleducationCenter" :key="index">
                            <td>{{item.name}}</td>
                            <td>{{item.Public_School}}</td>
                            <td>{{item.Private_School}}</td>
                            <td>{{item.Total}}</td>
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
            schooleducationCenter:[],
            // primary_private:'',
            // public_private:'',
            // middle_private:'',
            // middle_private:'',
            // lower_private:'',
            // lower_private:'',
            // higher_private:'',
            // higher_private:'',
           
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            let type = "pre_primary";
            
            let uri = 'projections/education/loadEnrollment/'+type+'/'+dzo_id;
            try{
                axios.get(uri).then(response => { 
                    this.schooleducationCenter = response.data.data;

                    //Plotting Graph
                    if(this.schooleducationCenter!=""){
                        for(let i=0;i<this.schooleducationCenter.length;i++){
                            if(this.schooleducationCenter[i].name == "Primary School"){
                                this.primary_private = this.schooleducationCenter[i].Private_School;
                                this.primary_public = this.schooleducationCenter[i].Public_School;
                            }
                            if(this.schooleducationCenter[i].name == "Middle Secondary School"){
                                this.middle_private = this.schooleducationCenter[i].Private_School;
                                this.middle_public = this.schooleducationCenter[i].Public_School;
                            }
                            if(this.schooleducationCenter[i].name == "Lower Secondary School"){
                                this.lower_private = this.schooleducationCenter[i].Private_School;
                                this.lower_public = this.schooleducationCenter[i].Public_School;
                            }
                            if(this.schooleducationCenter[i].name == "Higher Secondary School"){
                                this.higher_private = this.schooleducationCenter[i].Private_School;
                                this.higher_public = this.schooleducationCenter[i].Public_School;
                            }
                        }
                        var areaChartData = {
                            labels  : ['Primary', 'Middle Secondary', 'Lower Secondary', 'Higher Secondary'],
                            datasets: [
                                {
                                    label               : 'Public',
                                    backgroundColor     : 'rgba(60,141,188,0.9)',
                                    borderColor         : 'rgba(60,141,188,0.8)',
                                    pointRadius          : false,
                                    pointColor          : '#3b8bba',
                                    pointStrokeColor    : 'rgba(60,141,188,1)',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(60,141,188,1)',
                                    data                : [this.primary_public, this.middle_public, this.lower_public, this.higher_public]
                                },
                                {
                                    label               : 'Private',
                                    backgroundColor     : 'rgba(136, 22, 236)',
                                    borderColor         : 'rgba(136, 22, 236)',
                                    pointRadius         : false,
                                    pointColor          : 'rgba(136, 22, 236)',
                                    pointStrokeColor    : '#c1c7d1',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgba(220,220,220,1)',
                                    data                : [this.primary_private, this.middle_private, this.lower_private, this.higher_private]
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
                                    data                : [this.primary_public+this.primary_private, this.middle_public+this.middle_private, 
                                                            this.lower_public+this.lower_private, this.higher_public+this.higher_private]
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

