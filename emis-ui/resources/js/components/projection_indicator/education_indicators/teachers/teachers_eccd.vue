<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Facilitators in ECCD</label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <tbody>
                        <tr>
                            <th colspan="3">Public</th>
                            <th colspan="3">Private</th>
                            <th colspan="3">NGO</th>
                            <th colspan="3">Corporate</th>
                        </tr>
                        <tr>
                            <th>M</th>
                            <th>F</th>
                            <th>T</th>
                            <th>M</th>
                            <th>F</th>
                            <th>T</th>
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
                            <td>{{this.ngo_male}}</td>
                            <td>{{this.ngo_female}}</td>
                            <td>{{this.ngo_male + this.ngo_female}}</td>
                            <td>{{this.corp_male}}</td>
                            <td>{{this.corp_female}}</td>
                            <td>{{this.corp_male + this.corp_female}}</td>
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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Facilitators By Nationality</label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <tbody>
                        <tr>
                            <th colspan="3">Public</th>
                            <th colspan="3">Private</th>
                            <th colspan="3">NGO</th>
                            <th colspan="3">Corporate</th>
                        </tr>
                        <tr>
                            <th>B</th>
                            <th>N-B</th>
                            <th>T</th>
                            <th>B</th>
                            <th>N-B</th>
                            <th>T</th>
                            <th>B</th>
                            <th>N-B</th>
                            <th>T</th>
                            <th>B</th>
                            <th>N-B</th>
                            <th>T</th>
                        </tr>
                        <tr>
                            <td>{{this.public_bht}}</td>
                            <td>{{this.public_nonbht}}</td>
                            <td>{{this.public_bht + this.public_nonbht}}</td>
                            <td>{{this.private_bht}}</td>
                            <td>{{this.private_nonbht}}</td>
                            <td>{{this.private_bht + this.private_nonbht}}</td>
                            <td>{{this.ngo_bht}}</td>
                            <td>{{this.ngo_nonbht}}</td>
                            <td>{{this.ngo_bht + this.ngo_nonbht}}</td>
                            <td>{{this.corp_bht}}</td>
                            <td>{{this.corp_nonbht}}</td>
                            <td>{{this.corp_bht + this.corp_nonbht}}</td>
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
            teacherData:[],
            teacherNationality:[],
            private_male:'',
            private_female:'',
            public_male:'',
            public_female:'',
            ngo_male:'',
            ngo_female:'', 
            corp_male:'',
            corp_female:'',
            private_bht:'',
            private_nonbht:'',
            public_bht:'',
            public_nonbht:'',
            ngo_bht:'',
            ngo_nonbht:'', 
            corp_bht:'',
            corp_nonbht:''
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            let type = "ECCD";
            let uri = 'projections/education/loadTeacherNumbers/'+type+'/'+dzo_id;

            try{
                axios.get(uri).then(response => { 
                    this.teacherData = response.data.data;

                    //Plotting Graph
                    if(this.teacherData!=""){
                        if(this.teacherData.hasOwnProperty('private_eccd')){
                            this.private_male = this.teacherData['private_eccd'].male;
                            this.private_female = this.teacherData['private_eccd'].female;
                        } else {
                            this.private_male = 0;
                            this.private_female = 0;
                        }
                        if(this.teacherData.hasOwnProperty('public_eccd')){
                            this.public_male = this.teacherData['public_eccd'].male;
                            this.public_female = this.teacherData['public_eccd'].female;
                        } else {
                            this.public_male = 0;
                            this.public_female = 0;
                        }
                        if(this.teacherData.hasOwnProperty('ngo_eccd')){
                            this.ngo_male = this.teacherData['ngo_eccd'].male;
                            this.ngo_female = this.teacherData['ngo_eccd'].female;
                        } else {
                            this.ngo_male = 0;
                            this.ngo_female = 0;
                        }
                        if(this.teacherData.hasOwnProperty('corporate_eccd')){
                            this.corp_male = this.teacherData['corporate_eccd'].male;
                            this.corp_female = this.teacherData['corporate_eccd'].female;
                        } else {
                            this.corp_male = 0;
                            this.corp_female = 0;
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
                    if(this.teacherNationality.hasOwnProperty('private_eccd')){
                        this.private_bht = this.teacherNationality['private_eccd'].bht_male + this.teacherNationality['private_eccd'].bht_female;
                        this.private_nonbht = this.teacherNationality['private_eccd'].non_bht_male + this.teacherNationality['private_eccd'].non_bht_female;
                    } else {
                        this.private_bht = 0;
                        this.private_nonbht = 0;
                    }
                    if(this.teacherNationality.hasOwnProperty('public_eccd')){
                        this.public_bht = this.teacherNationality['public_eccd'].bht_male + this.teacherNationality['public_eccd'].bht_female;
                        this.public_nonbht = this.teacherNationality['public_eccd'].non_bht_male + this.teacherNationality['public_eccd'].non_bht_female;
                    } else {
                        this.public_bht = 0;
                        this.public_nonbht = 0;
                    }
                    if(this.teacherNationality.hasOwnProperty('ngo_eccd')){
                        this.ngo_bht = this.teacherNationality['ngo_eccd'].bht_male + this.teacherNationality['ngo_eccd'].bht_female;
                        this.ngo_nonbht = this.teacherNationality['ngo_eccd'].non_bht_male + this.teacherNationality['ngo_eccd'].non_bht_female;
                    } else {
                        this.ngo_bht = 0;
                        this.ngo_nonbht = 0;
                    }
                    if(this.teacherNationality.hasOwnProperty('corporate_eccd')){
                        this.corp_bht = this.teacherNationality['corporate_eccd'].bht_male + this.teacherNationality['corporate_eccd'].bht_female;
                        this.corp_nonbht = this.teacherNationality['corporate_eccd'].non_bht_male + this.teacherNationality['corporate_eccd'].non_bht_female;
                    } else {
                        this.corp_bht = 0;
                        this.corp_nonbht = 0;
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

