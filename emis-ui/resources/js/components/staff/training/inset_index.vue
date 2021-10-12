<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Training (HR Development) Programme</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       <span :class="item.screen_icon"></span>
                       {{ item.screen_name}}
                    </router-link>
                </li>
            </ul>
            <ul class="nav nav-pills mb-2 developemntEnv" role="tablist">
                <li class="nav-item active pr-1">
                    <router-link to="/programme_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Programme
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/participant" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Update Participant
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/promotion" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Promotion
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/longtermtraining" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Long Term Training
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
        }
    },
    methods: {
        populate_pate(data,action){
            this.$router.push({name:data,query: {data:action}});
        },
    },
    async mounted(){
        let uri = 'get_screens_on_submodules/submodule/'+this.$route.query.data;
        axios.get(uri)
        .then(response => {
            let data = response;
            this.menubar =  data.data;
        })
        .catch(function (error) {
            console.log(error);
        });
        let env=await this.getEnvValues('VUE_APP_ENV_TYPE');
        if(env=="Production"){
            $('.developemntEnv').hide();
        }
    },
}
</script>

