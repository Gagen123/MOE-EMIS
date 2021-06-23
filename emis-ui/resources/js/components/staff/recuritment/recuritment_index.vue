<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5> Private School Recuritment Approval</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span>
                        {{ item.screen_name}}
                    </router-link>
                </li>

                <li class="nav-item active pr-1">
                    <router-link to="/pricipal_recuritment_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Principal Recuritment
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/expert_recuritment_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Expatriate Recuritment
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
            menubar:[],
        }
    },
    methods:{
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        },
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
    mounted(){
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
}
</script>
