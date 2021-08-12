<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-1 pb-1">
                School Students
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
                        </select>
                        <span class="text-danger" id="org_id_err"></span>
                    </div> -->
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                        <button class="btn btn-primary btn-sm btn-lg mb-lg-n4" @click="generatesdetail()" type="button"> <span class="fa fa-download"></span> Load Details</button>
                    </div>
                </div>
                <hr>
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
                                <!-- <tr>
                                    <td><b>Total </b></td>
                                    <td><b>{{totalmale}}</b></td>
                                    <td><b>{{totalfemale}}</b></td>
                                    <td><b>{{grandtotal}}</b></td>
                                </tr> -->
                            </tbody>
                        </table>
                        <div class="form-group row mb-0">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label> Total Number of Students in Public School: </label>
                            </div>
                        </div>
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <tbody>
                                <tr>
                                    <td><b>Level</b></td>
                                    <td><b>Total Boys</b></td>
                                    <td><b>Total Girls</b></td>
                                    <td><b>Total</b></td>
                                </tr>
                                <tr v-if="public_higher_data!={}">
                                    <td>HSS</td>
                                    <td>{{public_higher_data.malecount}}</td>
                                    <td>{{public_higher_data.femalecount}}</td>
                                    <td>{{public_higher_data.totalstd}}</td>
                                </tr>
                                <tr v-if="public_middle_data!={}">
                                    <td>MSS</td>
                                    <td>{{public_middle_data.malecount}}</td>
                                    <td>{{public_middle_data.femalecount}}</td>
                                    <td>{{public_middle_data.totalstd}}</td>
                                </tr>
                                <tr v-if="public_lower_data!={}">
                                    <td>LSS</td>
                                    <td>{{public_lower_data.malecount}}</td>
                                    <td>{{public_lower_data.femalecount}}</td>
                                    <td>{{public_lower_data.totalstd}}</td>
                                </tr>
                                <!-- <tr>
                                    <td><b>Total </b></td>
                                    <td><b>{{totalmale}}</b></td>
                                    <td><b>{{totalfemale}}</b></td>
                                    <td><b>{{grandtotal}}</b></td>
                                </tr> -->
                            </tbody>
                        </table>
                        <div class="form-group row mb-0">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label> Total Number of Students in Private School: </label>
                            </div>
                        </div>
                        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <tbody>
                                <tr>
                                    <td><b>Level</b></td>
                                    <td><b>Total Boys</b></td>
                                    <td><b>Total Girls</b></td>
                                    <td><b>Total</b></td>
                                </tr>
                                <tr v-if="private_higher_data!={}">
                                    <td>HSS</td>
                                    <td>{{private_higher_data.malecount}}</td>
                                    <td>{{private_higher_data.femalecount}}</td>
                                    <td>{{private_higher_data.totalstd}}</td>
                                </tr>
                                <tr v-if="private_middle_data!={}">
                                    <td>MSS</td>
                                    <td>{{private_middle_data.malecount}}</td>
                                    <td>{{private_middle_data.femalecount}}</td>
                                    <td>{{private_middle_data.totalstd}}</td>
                                </tr>
                                <tr v-if="private_lower_data!={}">
                                    <td>LSS</td>
                                    <td>{{private_lower_data.malecount}}</td>
                                    <td>{{private_lower_data.femalecount}}</td>
                                    <td>{{private_lower_data.totalstd}}</td>
                                </tr>
                                <!-- <tr>
                                    <td><b>Total </b></td>
                                    <td><b>{{totalmale}}</b></td>
                                    <td><b>{{totalfemale}}</b></td>
                                    <td><b>{{grandtotal}}</b></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="card card-warning">
                            <div class="card-header pb-0 pt-2">
                                <h3 class="card-title"><i class="fa fa-users"></i> Students</h3>
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
            studentList:[],
            public_childrenList:[],
            private_childrenList:[],

            public_higher_data:[],
            public_lower_data:[],
            public_middle_data:[],

            private_higher_data:[],
            private_lower_data:[],
            private_middle_data:[],
        }
    },
    methods:{
        loadpage:function(type){
            this.$router.push({name:type});
        },
        async generatesdetail(){
            let dzoId=$('#dzongkhag_id').val();
            let response_data=  await this.loadStudents(dzoId);
            this.public_childrenList=response_data.public_data[0];
            this.private_childrenList=response_data.private_data[0];
            this.public_higher_data=response_data.public_higher_data[0];
            this.public_lower_data=response_data.public_lower_data[0];
            this.public_middle_data=response_data.public_middle_data[0];

            this.private_higher_data=response_data.private_higher_data[0];
            this.private_lower_data=response_data.private_lower_data[0];
            this.private_middle_data=response_data.private_middle_data[0];
            //Ploating Graph
            if(response_data!=""){
                var peiData        = {
                    labels: [
                        'Public',
                        'Private',
                    ],
                    datasets: [
                        {
                            data: [this.public_childrenList.totalstd,this.private_childrenList.totalstd],
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

