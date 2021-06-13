<template>
    <div>
        <section class="content ml-n4 mr-n3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-1 text-right">
                                <span class="card-title pt-2 mb-0">
                                        <b>Guidelines</b>
                                    </span>
                                <button type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('list_guidelines')"><i class="fa fa-list"></i> List</button>
                                <button type="button" class="btn btn-flat bg-blue btn-sm" @click="loadpage('create_guidelines')"><i class="fa fa-plus"></i> Add New</button>
                            </div>
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
export default {
    methods: {
        loadpage:function(type){
            this.$router.push({name:type});
        },
    },
}
</script>

