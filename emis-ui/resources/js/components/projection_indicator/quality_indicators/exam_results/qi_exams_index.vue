<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-1 pb-1">
                Quality Indicator - Examination Results
            </div>
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="dzosection">
                        <label class="mb-0">Quality Indicator Type: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="indicator" v-model="indicator">
                            <option value="bcse"> BCSE</option>
                            <option value="bhsec"> BHSEC</option>
                        </select>
                        <span class="text-danger" id="indicator_err"></span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                        <button class="btn btn-primary btn-sm btn-lg mb-lg-n4" @click="loadpage()" type="button"> <span class="fa fa-download"></span> Load Details</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-outline">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            indicator:'',
        }
    },
    methods:{
        loadpage:function(){
            let type=$('#indicator').val();
            let route = 'qi_bcse';
            if(type=="BCSE"){
                route='qi_bcse';
            }
            if(type=="BHSEC"){
                route='qi_bhsec';
            }
            // this.$router.push({name:route,query: {dzo_id:dzo_id}});
            this.$router.push({path:route}).catch(()=>{});
        },
    },
    async mounted() {
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

