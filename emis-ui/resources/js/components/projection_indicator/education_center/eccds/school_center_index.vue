<template>
    <div>
        <div class="card card-success card-outline">
            <div class="card-header" >
                SCHOOL
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
                            <option value="Others"> Others</option>
                        </select>
                        <span class="text-danger" id="org_id_err"></span>
                    </div> -->
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
                                    <td><b>Category</b></td>
                                    <td><b>Lower Secondary</b></td>
                                    <td><b>Primary</b></td>
                                    <td><b>Middle Secondary</b></td>
                                    <td><b>Higher Secondary</b></td>
                                    <td><b>Total</b></td>
                                </tr>
                                <tr v-for="(item, index) in schooleducationCenter" :key="index">
                                    <td><b>{{item.category}}</b></td>
                                    <td><b>{{item.Lower_Secondary_School}}</b></td>
                                    <td><b>{{item.primary_School}}</b></td>
                                    <td><b>{{item.Middle_secondary_school}}</b></td>
                                    <td><b>{{item.Higher_Secondary_School}}</b></td> 
                                    <td><b>{{item.Total}}</b></td>
                                </tr>
                            </tbody> 
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card card-warning">
                            <div class="card-header pb-0 pt-2">
                                <h3 class="card-title"><i class="fa fa-users"></i> Private & Public School</h3>
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
            schooleducationCenter:[],
          //  orgList:[],
        }
    },
    methods:{
        loadpage:function(type){
            this.$router.push({name:type});
        },
        async generatesdetail(){
            let dzoId=$('#dzongkhag_id'). val();
            this.schooleducationCenter = await this.loadeducationCenter("School",dzoId);
            if(this.schooleducationCenter!=""){
                var peiData        = {
                    labels: [
                        'Lower Secondary',
                        'Primary',
                        'Middle Secondary',
                        'Higher Secondary',
                    ],
                    datasets: [
                        {
                            data: [this.schooleducationCenter[0].Lower_Secondary_School,this.schooleducationCenter[0].primary_School,
                            this.schooleducationCenter[0].Middle_secondary_school, this.schooleducationCenter[0].Higher_Secondary_School],
                            backgroundColor : ['#f56954', '#00a65a','#000066','#FFFF99'],
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
        },

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

