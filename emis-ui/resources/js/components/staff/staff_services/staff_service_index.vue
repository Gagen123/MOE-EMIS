<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">Staff Services</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.screen_id } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       {{ item.screen_name}}
                    </router-link>
                </li>
                <!-- <li class="nav-item pr-1">
                    <router-link to="/staff_awards" id="awards" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-clock"></span>
                    Staff Awards
                    </router-link>
                </li> 
                <li class="nav-item active pr-1">
                    <router-link to="/staff_responsibilities" id="responsibilities" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Roles & Responsibilities
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/staff_disciplinary" id="responsibilities" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Disciplanary Record
                    </router-link>
                </li> -->
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
		getmenus(){
            let uri = 'get_screens_on_submodules/module/'+this.menu_id
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
        // populate_pate(data,action){
        //     this.$router.push({name:data,query: {data:action}});
        // },
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.menu_id=routeparam;
        this.getmenus();
    },
}
</script>