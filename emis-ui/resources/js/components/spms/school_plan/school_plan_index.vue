<template>
    <div>
        <section class="content ml-n4 mr-n3">
            <div class="container-fluid">
                <div class="row"> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header bg-white pt-2 pb-1 text-right">
                                <label class="fa-pull-left">Annual School Plan </label>
                                <span class="fa-pull-right pt-1">
                                    <button v-if="acess_level =='Org'"  type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('list_annual_school_plan')"><i class="fa fa-list"></i> List</button>
                                    <button v-else type="button" class="btn btn-flat bg-secondary btn-sm"  @click="loadpage('lists_annual_school_plan')"><i class="fa fa-list"></i> List</button>
                                    <button v-if="acess_level =='Org'" type="button" class="btn btn-flat bg-blue btn-sm" @click="loadpage('create_annual_school_plan')"><i class="fa fa-plus"></i> Add New</button>
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
    data(){
        return {
            acess_level:''
        }
    },
    methods:{
         loadpage(type){
            this.$router.push({name:type});
        },
    },
    mounted() {
         axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.acess_level = data['acess_level']
        })
        .catch(errors =>{
            console.log(errors)
        });
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
    },
   
}
</script>

