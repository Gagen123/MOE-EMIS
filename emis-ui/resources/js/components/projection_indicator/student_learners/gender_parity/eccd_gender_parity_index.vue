<template>
    <div>
        <div class="form-group row mb-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label> <u>Gender Parity in ECCD</u></label>
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
                            <td><b>Gender parity</b></td>
                        </tr>
                        <tr v-if="public_childrenList!={}">
                            <td>Public</td>
                            <td>{{public_childrenList.malecount}}</td>
                            <td>{{public_childrenList.femalecount}}</td>
                            <td>{{(parseInt(public_childrenList.malecount)/parseInt(public_childrenList.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="private_childrenList!={}">
                            <td>Private</td>
                            <td>{{private_childrenList.malecount}}</td>
                            <td>{{private_childrenList.femalecount}}</td>
                            <td>{{(parseInt(private_childrenList.malecount)/parseInt(private_childrenList.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="ngo_childrenList!={}">
                            <td>NGO</td>
                            <td>{{ngo_childrenList.malecount}}</td>
                            <td>{{ngo_childrenList.femalecount}}</td>
                            <td>{{(parseInt(ngo_childrenList.malecount)/parseInt(ngo_childrenList.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr v-if="coor_childrenList!={}">
                            <td>Corporate</td>
                            <td>{{coor_childrenList.malecount}}</td>
                            <td>{{coor_childrenList.femalecount}}</td>
                            <td>{{(parseInt(coor_childrenList.malecount)/parseInt(coor_childrenList.femalecount)).toFixed(2)}}</td>
                        </tr>
                        <tr>
                            <td><b>Total </b></td>
                            <td><b>{{totalmale}}</b></td>
                            <td><b>{{totalfemale}}</b></td>
                            <td><b>{{(totalmale/totalfemale).toFixed(2)}}</b></td>
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

