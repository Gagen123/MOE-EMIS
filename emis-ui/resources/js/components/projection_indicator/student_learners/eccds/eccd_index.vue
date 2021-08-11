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
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="mb-0">Organization Category: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="category_id">
                            <option value="ALL"> ALL</option>
                            <option value="Public"> Public</option>
                            <option value="Private"> Private</option>
                            <option value="NGO"> NGO</option>
                            <option value="Others"> Others</option>
                        </select>
                        <span class="text-danger" id="org_id_err"></span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                        <button class="btn btn-primary btn-sm btn-lg mb-lg-n4" @click="generatesdetail()" type="button"> <span class="fa fa-download"></span> Load Details</button>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label> Summary Report for: </label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <tbody>
                                <tr>
                                    <td><b>Total Boys</b></td>
                                    <td><b>Total Girls</b></td>
                                    <td><b>Total</b></td>
                                </tr>
                                <tr v-if="childrenList!={}">
                                    <td><b>{{childrenList.malecount}}</b></td>
                                    <td><b>{{childrenList.femalecount}}</b></td>
                                    <td><b>{{childrenList.totalstd}}</b></td>
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
            childrenList:[],
        }
    },
    methods:{
        loadpage:function(type){
            this.$router.push({name:type});
        },
        async generatesdetail(){
            let dzoId=$('#dzongkhag_id').val();
            let category_id=$('#category_id').val();
            this.childrenList= await this.loadEccdChildrens(category_id,dzoId);
            //Ploating Graph
            if(this.childrenList!=""){
                var peiData        = {
                    labels: [
                        'Male',
                        'Female',
                    ],
                    datasets: [
                        {
                            data: [this.childrenList.malecount,this.childrenList.femalecount],
                            backgroundColor : ['#f56954', '#00a65a'],
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

