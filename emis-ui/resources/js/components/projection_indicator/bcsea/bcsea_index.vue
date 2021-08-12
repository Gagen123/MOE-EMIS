<template>
    <div>
        <section class="content ml-n4 mr-n3">
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-1 text-right">
                                <label class="fa-pull-left">Quality Indicators Based on BCSEA Results</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="card card-success card-outline " >
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="dzosection">
                        <label class="mb-0">Quality Indicator Type: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="dzongkhag_id" v-model="dzo_id">
                            <option v-for="(item, index) in indicatorList" :key="index" v-bind:value="item.id">{{ item.indicator }}</option>
                        </select>
                        <span class="text-danger" id="dzongkhag_id_err"></span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                        <button class="btn btn-primary btn-sm btn-lg mb-lg-n4" @click="generatesdetail()" type="button"> <span class="fa fa-download"></span> Load Details</button>
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
            indicatorList:[
                {'indicator':'BCSE'},
                {'indicator':'BHSEC'}
            ]
        }
    },
    methods:{
         
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

