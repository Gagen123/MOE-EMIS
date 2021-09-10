<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Teachers in Middle Secondary Schools</label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <tbody>
                        <tr>
                            <th  colspan="3">Public</th>
                            <th  colspan="3">Private</th>
                        </tr>
                        <tr>
                            <th>M</th>
                            <th>F</th>
                            <th>T</th>
                            <th>M</th>
                            <th>F</th>
                            <th>T</th>
                        </tr>
                        <tr>
                            <td>{{this.public_male}}</td>
                            <td>{{this.public_female}}</td>
                            <td>{{this.public_male + this.public_female}}</td>
                            <td>{{this.private_male}}</td>
                            <td>{{this.private_female}}</td>
                            <td>{{this.private_male + this.private_female}}</td>
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
                <label>Teachers by Nationality in Middle Secondary Schools</label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <tbody>
                        <tr>
                            <th colspan="5" >Public</th>
                            <th colspan="5" >Private</th>
                        </tr>
                        <tr>
                            <th>M (Bht)</th>
                            <th>F (Bht)</th>
                            <th>M (Non Bht)</th>
                            <th>F (Non Bht)</th>
                            <th>T</th>
                            <th>M (Bht)</th>
                            <th>F (Bht)</th>
                            <th>M (Non Bht)</th>
                            <th>F (Non Bht)</th>
                            <th>T</th>
                        </tr>
                        <tr>
                            <td>{{this.public_bht_male}}</td>
                            <td>{{this.public_bht_female}}</td>
                            <td>{{this.public_nonbht_male}}</td>
                            <td>{{this.public_nonbht_female}}</td>
                            <td>{{this.public_bht_male+this.public_bht_female+this.public_nonbht_male+this.public_nonbht_female}}</td>
                            <td>{{this.private_bht_male}}</td>
                            <td>{{this.private_bht_female}}</td>
                            <td>{{this.private_nonbht_male}}</td>
                            <td>{{this.private_nonbht_female}}</td>
                            <td>{{this.private_bht_male+this.private_bht_female+this.private_nonbht_male+this.private_nonbht_female}}</td>
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
            teacherData:[],
            studentAgeData:[],
            private_male:'',
            private_female:'',
            public_male:'',
            public_female:'',  
            private_bht_male:'',
            private_bht_female:'',
            private_nonbht_male:'',
            private_nonbht_female:'',
            public_bht_male:'',
            public_bht_female:'',
            public_nonbht_male:'',
            public_nonbht_female:''
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            let type = "Middle";
            let uri = 'projections/education/loadTeacherNumbers/'+type+'/'+dzo_id;

            try{
                axios.get(uri).then(response => { 
                    this.teacherData = response.data.data;

                    //Plotting Graph
                    if(this.teacherData!=""){
                        if(this.teacherData.hasOwnProperty('private_school')){
                            this.private_male = this.teacherData['private_school'].male;
                            this.private_female = this.teacherData['private_school'].female;
                        } else {
                            this.private_male = 0;
                            this.private_female = 0;
                        }
                        if(this.teacherData.hasOwnProperty('public_school')){
                            this.public_male = this.teacherData['public_school'].male;
                            this.public_female = this.teacherData['public_school'].female;
                        } else {
                            this.public_male = 0;
                            this.public_female = 0;
                        }
                        
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
                    this.teacherNationality = response.data.data;
                    if(this.teacherNationality.hasOwnProperty('private_school')){
                        this.private_bht_male = this.teacherNationality['private_school'].bht_male;
                        this.private_bht_female = this.teacherNationality['private_school'].bht_female;
                        this.private_nonbht_male = this.teacherNationality['private_school'].non_bht_male;
                        this.private_nonbht_female =  this.teacherNationality['private_school'].non_bht_female;
                    } else {
                        this.private_bht_male = 0;
                        this.private_bht_female = 0;
                        this.private_nonbht_male = 0;
                        this.private_nonbht_female =  0;
                    }
                    if(this.teacherNationality.hasOwnProperty('public_school')){
                        this.public_bht_male = this.teacherNationality['public_school'].bht_male;
                        this.public_bht_female = this.teacherNationality['public_school'].bht_female;
                        this.public_nonbht_male = this.teacherNationality['public_school'].non_bht_male;
                        this.public_nonbht_female = this.teacherNationality['public_school'].non_bht_female;
                    } else {
                        this.public_bht_male = 0;
                        this.public_bht_female = 0;
                        this.public_nonbht_male = 0;
                        this.public_nonbht_female = 0;
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

