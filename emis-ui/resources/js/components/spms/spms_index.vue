<template>
    <div> 
        <ol class="mb-1 ml-xl-n4 mr-xl-n3" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">SPMS</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span> 
                        {{ item.screen_name}}
                    </router-link>
                </li>
             
                <li class="nav-item active pr-1" @click="activatelink('annual_school_plan')">
                    <router-link id="annual_school_plan" to="/annual-school-plan" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Annual School Plan
                    </router-link>
                </li>
               <li class="nav-item active pr-1" @click="activatelink('agency_input_form')">
                    <router-link id="agency_input_form" to="/agency-input-form" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Dzongkhag/Thromde/Agency Input
                    </router-link>
               </li>
                <li class="nav-item active pr-1" @click="activatelink('school_performance')">
                    <router-link id="school_performance" to="/school-performance" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       School Performance (Non-Academic)
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('school_performance_academic')">
                    <router-link id="school_performance_academic" to="/school-performance-academic" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       School Performance (Academic)
                    </router-link>
                </li>
            </ul>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            menubar:[],
            sub_mod_id:'',
        }
    },
    methods: {
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        },
		getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar = data.data;  
            })
            .catch(function (error) { 
                console.log("Error:"+error)
            });
        },
    },
    async mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
        let env=await this.getEnvValues('VUE_APP_ENV_TYPE');
        if(env=="Production"){
            $('.developemntEnv').hide();
        }
    },
    
}
</script>

