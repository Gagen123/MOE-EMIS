<template>
    <div>
        <section class="content ml-n4 mr-n3">
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-1 text-right">
                                <label class="fa-pull-left">Approved Transfer Lists</label>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary btn-sm" v-on:click="reloadPage">
                                        <i class="fas fa-redo"></i>
                                    </button>
                                </div>
                                 <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary btn-sm" v-on:click="printInstructorRegistration">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-flat bg-blue btn-sm"  @click="loadpage('transfer_list')"><i class="fa fa-list"></i> List</button>
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
    data(){
        return{
            leavetypeList:[],
        }
    },
    methods:{
        loadpage:function(type){
            this.$router.push({name:type});
        },
        reloadPage(){
            window.location.reload()
            },
        printInstructorRegistration(){
            window.print();
        },
    },
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
    },
   
}
</script>

