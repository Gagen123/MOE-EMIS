<template>
    <div> 
        <ol class="mb-1 ml-xl-n4 mr-xl-n3" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">SPMS MASTERS</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span> 
                        {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('domain')">
                    <router-link id="domain" to="/domain-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Domain
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('area')">
                    <router-link id="area" to="/area-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Area
                    </router-link>
                </li>
                 <li class="nav-item active pr-1" @click="activatelink('paramter')">
                    <router-link id="paramter" to="/parameter-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Parameter
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('indicator')">
                    <router-link id="indicator" to="/indicator-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Output Indicator
                    </router-link>
                </li>
                 <li class="nav-item active pr-1" @click="activatelink('rubrics')">
                    <router-link id="rubrics" to="/rubrics-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Rubrics
                    </router-link>
                </li>
                  <li class="nav-item active pr-1" @click="activatelink('dzo_emo')">
                    <router-link id="dzo_emo" to="/dzo-emo-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                      EMO-Dzongkhag Mapping
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

