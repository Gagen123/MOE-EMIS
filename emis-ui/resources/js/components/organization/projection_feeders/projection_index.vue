<template>
    <div>
         <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5 class="pt-1">Projections and Feeders School</h5></li>
        </ol>
        <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                    <span :class="item.screen_icon"></span>
                    {{ item.screen_name}}
                </router-link>
            </li>
        </ul>
        <ul class="nav nav-pills mb-3 developemntEnv" id="mainmenu" role="tablist">
            <li class="nav-item pr-1">
                <router-link to="/projections" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Projections
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/feeder_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Feeder School
                </router-link>
            </li>
            <li class="nav-item pr-1">
                <router-link to="/feeder_student_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                    Student List for Parent School
                </router-link>
            </li>
        </ul>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
  components: {
    },
    data() {
        return {
            menubar:[],
            menu_id:'',
        }
    },
    methods:{
		manageclasses(currid){
            $('#selected').html(' Managing '+currid);
		},
        getmenus(){
            let uri = 'get_screens_on_submodules/submodule/'+this.menu_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
    },
    async mounted() {
        let routeparam=this.$route.query.data;
        this.menu_id=routeparam;
        this.getmenus();
        let env=await this.getEnvValues('VUE_APP_ENV_TYPE');
        if(env=="Production"){
            $('.developemntEnv').hide();
        }
    },
}
</script>

