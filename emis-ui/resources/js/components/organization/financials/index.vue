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
                
                <!-- <li class="nav-item active pr-1" @click="activatelink('visitors_information')">
                    <router-link id="visitors_information" to="/visitors_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Visitor's Information
                    </router-link>
                </li> -->
                <li class="nav-item active pr-1" @click="activatelink('financial_information')">
                    <router-link id="financial_information" to="/financial_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Financial Information
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('income_information')">
                    <router-link id="income_information" to="/income_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Income Facilities
                    </router-link>
                </li>
                <!-- <li class="nav-item active pr-1" @click="activatelink('projections')">
                    <router-link id="projections" to="/projections" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Projections
                    </router-link>
                </li> 
                <li class="nav-item active pr-1" @click="activatelink('disasters_information')">
                    <router-link id="disasters_information" to="/disasters_information" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Disasters Information
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('compound_details')">
                    <router-link id="compound_details" to="/compound_details" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Compound Details
                    </router-link>
                </li> -->
                <!-- <li class="nav-item active pr-1" @click="activatelink('location_details')">
                    <router-link id="location_details" to="/location_details" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Location Details
                    </router-link>
                </li> -->
               
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