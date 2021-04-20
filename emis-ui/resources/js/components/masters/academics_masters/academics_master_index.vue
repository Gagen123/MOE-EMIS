<template>
    <div> 
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Acadamics Masters</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <!-- <router-link :to="item.route" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       {{ item.screen_name}}
                    </router-link> -->
                    <!-- <a href="#" @click="populate_pate(item.route,item.actions)" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                         {{ item.screen_name}}
                    </a> -->
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/subject-group-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       Subject Group
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/subject-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       Subject 
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/assessment-area-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                      Assessment Area
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
		getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar = data.data.data;  
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

