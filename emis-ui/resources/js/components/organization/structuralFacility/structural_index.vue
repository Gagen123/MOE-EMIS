<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5 class="pt-1"> Facilities</h5></li>
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
                <template v-if="roleName.includes('ECCD')">
                    <li class="nav-item active pr-1">
                        <router-link id="eccd" to="/eccdfacilities" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                            <span class=""></span>
                            ECCD Facilities
                        </router-link>
                    </li>
                    <li class="nav-item active pr-1" >
                        <router-link id="regularstaff" to="/eccdinfrastructure_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                            <span class=""></span>
                            ECCD Infrastructure
                        </router-link>
                    </li>
                </template>
                <template v-else>
                    <li class="nav-item active pr-1">
                        <router-link id="volunteer" to="/sport_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                            <span class=""></span>
                            Sports
                        </router-link>
                    </li>
                    <li class="nav-item active pr-1">
                        <router-link id="nomination" to="/school_feeding" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                            <span class=""></span>
                            School Feeding
                        </router-link>
                    </li>
                    <li class="nav-item active pr-1" >
                        <router-link id="regularstaff" to="/infrastructure_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                            <span class=""></span>
                            Infrastructure
                        </router-link>
                    </li>

                    <li class="nav-item active pr-1">
                        <router-link id="financial_information" to="/financial_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                            <span class=""></span>
                            Financial Information
                        </router-link>
                    </li>
                    <li class="nav-item active pr-1" >
                        <router-link id="income_information" to="/income_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                            <span class=""></span>
                            Income Facilities
                        </router-link>
                    </li>
                </template>


                <li class="nav-item active pr-1">
                    <router-link id="disasters_information" to="/disasters_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Disaster Information
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link id="trainingprogram" to="/wash" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Water
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link id="compound_information" to="/compound_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Compound Details
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link id="connectivity_details" to="/connectivity_details" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Connectivity
                    </router-link>
                </li>
            </ul>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            roleName: '',
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
    created(){
        axios.get('common/getSessionDetail')
        .then(response =>{
            let data = response.data.data;
            for(let i=0;i<data['roles'].length;i++){
                if(i==data['roles'].length-1){
                    this.roleName+=data['roles'][i].roleName;
                }
                else{
                    this.roleName+=data['roles'][i].roleName+', ';
                }
            }
        }) ;
    }
}
</script>
