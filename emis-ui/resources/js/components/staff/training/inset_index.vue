<template>
    <div> 
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">
                Training (HR Development) Programme
            </h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       <span :class="item.screen_icon"></span>
                       {{ item.screen_name}}
                    </router-link>
                </li> 
                <li class="nav-item active pr-1">
                    <router-link id="service" to="/programme_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Programme
                    </router-link>
                </li>
                 <li class="nav-item active pr-1">
                    <router-link id="service" to="/" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Transfer Apply
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
            let uri = 'get_screens_on_submodules/module/'+sub_mod_id
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
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
}
</script>

