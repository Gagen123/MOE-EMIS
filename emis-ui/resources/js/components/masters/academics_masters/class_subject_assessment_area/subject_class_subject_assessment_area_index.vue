<template>
    <div>
        <section class="content ml-n4 mr-n3">
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-1 text-right">
                                <span class="card-title pt-2 mb-0">
                                    <b>Class Subject Assessment Area</b>
                                </span>
                                <span class="fa-pull-right pt-1">
                                    <button type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('list_subject_assessment_area')"><i class="fa fa-list"></i> List</button>
                                </span>
                            </div>
                            <div class="card-body pb-1 mb-0 pt-1 mt-0">  
                                <router-view></router-view> 
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
    methods:{
         loadpage(type){
            this.$router.push({name:type});
        },
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
    },
   
}
</script>

