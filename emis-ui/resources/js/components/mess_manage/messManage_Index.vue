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
                <li class="nav-item pr-1" @click="activatelink('foodreleasenote')">
                    <router-link to="/foodrelease_index" id="foodrelease" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fas fa-receipt"></span>
                        Food Release Note
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('stockreceived')">
                    <router-link id="stockreceived" to="/stockreceived_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-receipt"></span>
                        Centrally Procured
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('localprocurement')">
                    <router-link to ="/localprocure_index" id="localprocure" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fas fa-shopping-cart"></span>
                        Local Procurement
                    </router-link>
                </li>
                 <li class="nav-item pr-1"  @click="activatelink('stockissued')">
                    <router-link id="stockissued" to="/stockissued_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fas fa-receipt"></span>
                        Stock Issue
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('schoolInventory')">
                    <router-link to ="/stockInventory_list" id="schoolInventory" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fas fa-shopping-cart"></span>
                        School Inventory
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