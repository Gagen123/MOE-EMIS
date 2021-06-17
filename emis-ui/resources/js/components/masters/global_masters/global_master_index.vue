<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Global Masters</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/nationality_master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Nationality/Country
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/dzongkhag_master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Dzongkhag/Thromde
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/gewog_master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Gewog
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/village_master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Village/Chewog
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/gender_master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Sex/gender
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/mother_tongue_master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Mother Tongue
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/guidelines" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Guidelines
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
		getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        populate_pate(data,action){
            this.$router.push({name:data,query: {data:action}});
        },
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },

}
</script>

