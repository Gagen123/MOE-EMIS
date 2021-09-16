<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5 class="pt-1">Equipment and Furniture</h5></li>
        </ol>
        <div class="container-fluid">
           <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span>
                        {{ item.screen_name}}
                    </router-link>
                </li>
            </ul>
            <ul class="nav nav-pills mb-3 developemntEnv" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('equipment_index')">
                    <router-link id="equipment_index" to="/equipment_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Equipment
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('furniture_index')">
                    <router-link id="furniture_index" to="/furniture_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Furniture
                    </router-link>
                </li>
                <!-- <li class="nav-item active pr-1" @click="activatelink('projections')">
                    <router-link id="projections" to="/projections" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Projections
                    </router-link>
                </li>
                  <li class="nav-item active pr-1" @click="activatelink('projections')">
                    <router-link id="projections" to="/projections" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Kitchen Utensil
                    </router-link>
                </li> -->
            </ul>
        <router-view></router-view>
        </div>

    </div>
</template>

<script>
export default {
    data(){
        return{
              menubar:[],
        }
    },

    methods:{
        getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar =  data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
    },
    async mounted(){
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
