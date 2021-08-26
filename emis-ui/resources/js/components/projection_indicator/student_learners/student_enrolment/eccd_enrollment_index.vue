<template>
    <div>
        <div class="form-group row mb-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label> <u>Total Number of Children by Gender in ECCD</u></label>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tbody>
                        <tr>
                            <td></td>
                            <td colspan="3"><b>3-5 Years</b></td>
                            <td colspan="3"><b>3-5 Years of NSB</b></td>
                            <td colspan="3"><b>3-5 Years of Population</b></td>
                            <td colspan="3"><b>Enrollment Rate by Population</b></td>
                        </tr>
                        <tr>
                            <td><b>Category</b></td>
                            <td><b>Boys</b></td>
                            <td><b>Girls</b></td>
                            <td><b>Total</b></td>
                            <td><b>Boys</b></td>
                            <td><b>Girls</b></td>
                            <td><b>Total</b></td>
                            <td><b>Boys</b></td>
                            <td><b>Girls</b></td>
                            <td><b>Total</b></td>
                            <td><b>Boys</b></td>
                            <td><b>Girls</b></td>
                            <td><b>Total</b></td>
                        </tr>
                        <tr v-if="public_childrenList!={}">
                            <td>Public</td>
                            <td>{{public_childrenList.rightagemale}}</td>
                            <td>{{public_childrenList.rightagefemale}}</td>
                            <td>{{parseInt(public_childrenList.rightagemale)+parseInt(public_childrenList.rightagefemale)}}</td>
                            <td>{{nsb_data.male}}</td>
                            <td>{{nsb_data.female}}</td>
                            <td>{{parseInt(nsb_data.male)+parseInt(nsb_data.female)}}</td>
                            <td>{{population_male}}</td>
                            <td>{{population_female}}</td>
                            <td>{{population_male+population_female}}</td>

                            <td>{{((parseInt(public_childrenList.rightagemale)/population_male)*100).toFixed(2)}}</td>
                            <td>{{((parseInt(public_childrenList.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                            <td>{{(((parseInt(public_childrenList.rightagemale)+parseInt(public_childrenList.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="private_childrenList!={}">
                            <td>Private</td>
                            <td>{{private_childrenList.rightagemale}}</td>
                            <td>{{private_childrenList.rightagefemale}}</td>
                            <td>{{parseInt(private_childrenList.rightagemale)+parseInt(private_childrenList.rightagefemale)}}</td>
                            <td>{{nsb_data.male}}</td>
                            <td>{{nsb_data.female}}</td>
                            <td>{{parseInt(nsb_data.male)+parseInt(nsb_data.female)}}</td>
                            <td>{{population_male}}</td>
                            <td>{{population_female}}</td>
                            <td>{{population_male+population_female}}</td>

                            <td>{{((parseInt(private_childrenList.rightagemale)/population_male)*100).toFixed(2)}}</td>
                            <td>{{((parseInt(private_childrenList.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                            <td>{{(((parseInt(private_childrenList.rightagemale)+parseInt(private_childrenList.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="ngo_childrenList!={}">
                            <td>NGO</td>
                            <td>{{ngo_childrenList.rightagemale}}</td>
                            <td>{{ngo_childrenList.rightagefemale}}</td>
                            <td>{{parseInt(ngo_childrenList.rightagemale)+parseInt(ngo_childrenList.rightagefemale)}}</td>
                            <td>{{nsb_data.male}}</td>
                            <td>{{nsb_data.female}}</td>
                            <td>{{parseInt(nsb_data.male)+parseInt(nsb_data.female)}}</td>
                            <td>{{population_male}}</td>
                            <td>{{population_female}}</td>
                            <td>{{population_male+population_female}}</td>

                            <td>{{((parseInt(ngo_childrenList.rightagemale)/population_male)*100).toFixed(2)}}</td>
                            <td>{{((parseInt(ngo_childrenList.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                            <td>{{(((parseInt(ngo_childrenList.rightagemale)+parseInt(ngo_childrenList.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="coor_childrenList!={}">
                            <td>Corporate</td>
                            <td>{{coor_childrenList.rightagemale}}</td>
                            <td>{{coor_childrenList.rightagefemale}}</td>
                            <td>{{parseInt(coor_childrenList.rightagemale)+parseInt(coor_childrenList.rightagefemale)}}</td>
                            <td>{{nsb_data.male}}</td>
                            <td>{{nsb_data.female}}</td>
                            <td>{{parseInt(nsb_data.male)+parseInt(nsb_data.female)}}</td>
                            <td>{{population_male}}</td>
                            <td>{{population_female}}</td>
                            <td>{{population_male+population_female}}</td>

                            <td>{{((parseInt(coor_childrenList.rightagemale)/population_male)*100).toFixed(2)}}</td>
                            <td>{{((parseInt(coor_childrenList.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                            <td>{{(((parseInt(coor_childrenList.rightagemale)+parseInt(coor_childrenList.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card card-warning">
                    <div class="card-body">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div> -->
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
            population_male:0,
            population_female:0,
            nsb_data:0,
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            axios.get('students/ExternalDataImport/loadInstitues/nsbData_'+new Date().getFullYear()+'_3-5/NsbModel')
            .then(response => {
                this.nsb_data = response.data.data;
            });

            axios.get('students/ExternalDataImport/loadInstitues/censusData_'+new Date().getFullYear()+'_3,4,5/CensusModel')
            .then(response => {
                let population_data = response.data.data;
                population_data.forEach(data => {
                    this.population_male=this.population_male+parseInt(data.male);
                    this.population_female=this.population_female+parseInt(data.female);
                });
            });

            let response_data= await this.loadEccdChildrens('ALL',dzo_id);
            this.public_childrenList=response_data.public_data[0];
            this.private_childrenList=response_data.private_data[0];
            this.ngo_childrenList=response_data.ngo_data[0];
            this.coor_childrenList=response_data.coorporate_data[0];
            //Ploating Graph
            // if(response_data!=""){
            //     //ploating bar chart
            //     var areaChartData = {
            //         labels  : ['Public', 'Private', 'NGO', 'Corporate'],
            //         datasets: [
            //             {
            //                 label               : 'Less than 3 Years Male',
            //                 backgroundColor     : 'rgba(60,141,188,0.9)',
            //                 borderColor         : 'rgba(60,141,188,0.8)',
            //                 pointRadius          : false,
            //                 pointColor          : '#3b8bba',
            //                 pointStrokeColor    : 'rgba(60,141,188,1)',
            //                 pointHighlightFill  : '#fff',
            //                 pointHighlightStroke: 'rgba(60,141,188,1)',
            //                 data                : [this.public_childrenList.lessthen3male,this.private_childrenList.lessthen3male,this.coor_childrenList.lessthen3male,this.ngo_childrenList.lessthen3male]
            //             },
            //             {
            //                 label               : 'Less than 3 Years  Female',
            //                 backgroundColor     : 'rgba(136, 22, 236)',
            //                 borderColor         : 'rgba(136, 22, 236)',
            //                 pointRadius         : false,
            //                 pointColor          : 'rgba(136, 22, 236)',
            //                 pointStrokeColor    : '#c1c7d1',
            //                 pointHighlightFill  : '#fff',
            //                 pointHighlightStroke: 'rgba(220,220,220,1)',
            //                 data                : [this.public_childrenList.lessthen3female,this.private_childrenList.lessthen3female,this.coor_childrenList.lessthen3female,this.ngo_childrenList.lessthen3female]
            //             },
            //             {
            //                 label               : '3-5 Years Male',
            //                 backgroundColor     : 'rgba(31, 100, 224)',
            //                 borderColor         : 'rgba(31, 100, 224)',
            //                 pointRadius         : false,
            //                 pointColor          : 'rgba(31, 100, 224)',
            //                 pointStrokeColor    : '#00a65a',
            //                 pointHighlightFill  : '#00a65a',
            //                 pointHighlightStroke: 'rgba(220,220,220,1)',
            //                 data                : [this.public_childrenList.rightagemale,this.private_childrenList.rightagemale,this.coor_childrenList.rightagemale,this.ngo_childrenList.rightagemale]
            //             },
            //             {
            //                 label               : '3-5 Years Female',
            //                 backgroundColor     : 'rgba(70, 224, 31)',
            //                 borderColor         : 'rgba(70, 224, 31)',
            //                 pointRadius         : false,
            //                 pointColor          : 'rgba(70, 224, 31)',
            //                 pointStrokeColor    : '#f39c12',
            //                 pointHighlightFill  : '#f39c12',
            //                 pointHighlightStroke: 'rgba(220,220,220,1)',
            //                 data                : [this.public_childrenList.rightagefemale,this.private_childrenList.rightagefemale,this.coor_childrenList.rightagefemale,this.ngo_childrenList.rightagefemale]
            //             },
            //             {
            //                 label               : 'Above 5 Years Male',
            //                 backgroundColor     : 'rgba(31, 222, 224)',
            //                 borderColor         : 'rgba(31, 222, 224)',
            //                 pointRadius         : false,
            //                 pointColor          : 'rgba(31, 222, 224)',
            //                 pointStrokeColor    : '#3c8dbc',
            //                 pointHighlightFill  : '#3c8dbc',
            //                 pointHighlightStroke: 'rgba(220,220,220,1)',
            //                 data                : [this.public_childrenList.abovemale,this.private_childrenList.abovemale,this.coor_childrenList.abovemale,this.ngo_childrenList.abovemale]
            //             },
            //             {
            //                 label               : 'Above 5 Years Female',
            //                 backgroundColor     : 'rgba(49, 31, 224)',
            //                 borderColor         : 'rgba(49, 31, 224)',
            //                 pointRadius         : false,
            //                 pointColor          : 'rgba(49, 31, 224)',
            //                 pointStrokeColor    : '#3c8dbc',
            //                 pointHighlightFill  : '#3c8dbc',
            //                 pointHighlightStroke: 'rgba(220,220,220,1)',
            //                 data                : [this.public_childrenList.abovefemale,this.private_childrenList.abovefemale,this.coor_childrenList.abovefemale,this.ngo_childrenList.abovefemale]
            //             },
            //         ]
            //     }

            //     var barChartCanvas = $('#barChart').get(0).getContext('2d')
            //     var barChartData = jQuery.extend(true, {}, areaChartData)
            //     var temp0 = areaChartData.datasets[0]
            //     var temp1 = areaChartData.datasets[1]
            //     barChartData.datasets[0] = temp1
            //     barChartData.datasets[1] = temp0

            //     var barChartOptions = {
            //     responsive              : true,
            //     maintainAspectRatio     : false,
            //     datasetFill             : false
            //     }

            //     var barChart = new Chart(barChartCanvas, {
            //         type: 'bar',
            //         data: barChartData,
            //         options: barChartOptions
            //     })
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

