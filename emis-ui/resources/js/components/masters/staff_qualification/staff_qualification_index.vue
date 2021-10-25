<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Staff Qualification Masters</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/qualification_category" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Category
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'qualification_type'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'qualification_level'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       Level
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link :to="{name: 'staff_qualification'}" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       Subject
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/qualification_institute" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Institute
                    </router-link>
                </li>
                <!-- <li class="nav-item active pr-1"> Its there in staff qualification master
                    <router-link to="/doner_agency" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Doner Agency
                    </router-link>
                </li> -->
                <!-- <li class="nav-item active pr-1"> Its there in staff qualification master
                    <router-link to="/project_doner_agency" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Project Doner Agency
                    </router-link>
                </li> -->
                <li class="nav-item active pr-1">
                    <router-link to="/qualification_status" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Qualification Stutus
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
                this.menubar =  data.data;
            })
            .catch(function (error) {
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

