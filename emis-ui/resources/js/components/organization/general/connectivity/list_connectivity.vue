<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n4" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">Connectivity Detail</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card card-success card-outline">
                        <div class="card-body">
                            <div class="tab-pane">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Road Connectivity: {{display.connectedtoroad =='1'? 'yes':'No'}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Distance from Headquarter: {{display.hqdistance}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Internet Connectivity: {{display.connectedtointernet =='1'? 'yes':'No'}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Type of Internet Connection: {{display.connectiontype =='1'? 'yes':'No'}}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Electricity Connection: {{display.electricity =='1'? 'yes':'No'}}</label>
                                        </div>
                                    </div>
                                   
                                    <hr>
                                   
                                </form>
                            </div>
                            <div class="card-footer text-right">
                                 <button type="button" class="btn btn-dark text-white btn-sm" @click="showedit('edit_connectivity')"><i class="fa fa-edit"></i> Edit Connectivity Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
</div>
</template>
<script>
    export default {
        data(){
            return{
               display:'',
              //  display:[],
               
                
            }
        },
        methods:{
        loadDataList(uri='organization/loadConnectivityInformation'){
            axios.get(uri)
            .then(response => {
                // let data = response;
                // this.display =  data.data;
                 this.display=response.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            
        },
        showedit(type){
            if(type=="edit_connectivity"){
                this.$router.push("/"+type);
            }
		},
    },
    mounted(){
        this.loadDataList();
    },
    }
</script>
