<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-1 pb-1">
                ECCD Children
            </div>
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="dzosection">
                        <label class="mb-0">Dzongkhag: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="dzongkhag_id">
                            <option value="ALL"> ALL</option>
                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="dzongkhag_id_err"></span>
                    </div>
                    <!-- <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="mb-0">Organization Category: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="category_id">
                            <option value="ALL"> ALL</option>
                            <option value="Public"> Public</option>
                            <option value="Private"> Private</option>
                            <option value="NGO"> NGO</option>
                            <option value="Coorporate"> Coorporate</option>
                        </select>
                        <span class="text-danger" id="org_id_err"></span>
                    </div> -->
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                        <button class="btn btn-primary btn-sm btn-lg mb-lg-n4" @click="generatesdetail()" type="button"> <span class="fa fa-download"></span> Load Details</button>
                    </div>
                </div>
                <hr>
                <!-- <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label> Summary Report for: </label>
                    </div>
                </div> -->
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                    <td>Coorporate</td>
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
                            <div class="card-header pb-0 pt-2">
                                <h3 class="card-title"><i class="fa fa-users"></i> ECCD Children</h3>
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
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dzongkhagList:[],
            orgList:[],
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
        loadpage:function(type){
            this.$router.push({name:type});
        },
        async generatesdetail(){
            let dzoId=$('#dzongkhag_id').val();
            let category_id=$('#category_id').val();
            let response_data= await this.loadEccdChildrens(category_id,dzoId);
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
                        'Coorporate',
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
    async mounted() {
        this.dzongkhagList= await this.loadactivedzongkhags();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
    },

}
</script>

