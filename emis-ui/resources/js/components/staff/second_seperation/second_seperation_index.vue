<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Seperation & Secondment</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.screen_id } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span> {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item pr-1">
                    <router-link to="/secondment" id="secondment" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Secondment
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/Seperation" id="relative_details" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Relative Details
                    </router-link>
                </li>
            </ul>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default{
    components:{
    },
    data(){
        return{
            menubar:[],
            menu_id:'',
        }
    },
    methods:{
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
    mounted(){
        let routeparam=this.$route.query.data;
        this.menu_id=routeparam;
        this.getmenus();
    },
}
</script>
