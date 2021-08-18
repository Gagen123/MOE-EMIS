<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6>Mess Management</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.screen_id } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span> {{ item.screen_name}}
                    </router-link>
                </li>
                
                <li class="nav-item active pr-1">
                    <router-link id="service" to="/create_management_body_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Composition
                    </router-link>
                </li>
               <li class="nav-item active pr-1">
                    <router-link id="service" to="/management_meeting" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Meeting
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
            menu_id:'',
        }
    },
    methods: {
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
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
    mounted() {
        let routeparam=this.$route.query.data;
        this.menu_id=routeparam;
        this.getmenus();
    },
}
</script>