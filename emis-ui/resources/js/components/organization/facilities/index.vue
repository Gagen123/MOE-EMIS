<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5 class="pt-1">All the Missing Links/Menus</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <!-- <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span> 
                        {{ item.screen_name}}
                    </router-link>
                </li> -->
                <li class="nav-item active pr-1" @click="activatelink('financial_information')">
                    <router-link id="financial_information" to="/financial_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Financial Information
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('income_facilities')">
                    <router-link id="income_facilities" to="/income_facilities" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Income Facilities
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff2')">
                    <router-link id="regularstaff2" to="/equipment_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Equipment & Furniture
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff4')">
                    <router-link id="regularstaff4" to="/section_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Sections
                    </router-link>
                </li> 
                 
                <li class="nav-item active pr-1" @click="activatelink('regularstaff3')">
                    <router-link id="regularstaff3" to="/org_class_mapping" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Class Mapping
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
        // activatelink(btnid){
        //     $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
        //     $('#'+btnid).addClass('btn-primary text-white');
        // }
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