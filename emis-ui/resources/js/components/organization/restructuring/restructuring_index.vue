<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5>R</h5><h6 class="pt-1">ESTRUCTURING</h6></li>
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
                    <router-link to="/name_change_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Change In Name
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/level_change_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Upgrade/Downgrade
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/sen_details_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Change SEN Details
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/feeding_details_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Change Feeding School Details
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/proprietor_details_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Proprietor Change
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link to="/autonomus_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Autonomy
                    </router-link>
                </li>
                <!-- <li class="nav-item active pr-1">
                    <router-link id="location_change_index" to="/location_change_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Location Type Change
                    </router-link>
                </li> -->
                <li class="nav-item active pr-1">
                    <router-link id="fee_structure_change_index" to="/fee_structure_change_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Change in Fee Structure
                    </router-link>
                </li>
                <li class="nav-item active pr-1">
                    <router-link id="bording_change_index" to="/bording_change_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Change to Boadring School
                    </router-link>
                </li>
                <!-- <li class="nav-item active pr-1">
                    <router-link id="stream_change_index" to="/stream_change_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Change in Stream
                    </router-link>
                </li> -->
              
                <li class="nav-item active pr-1">
                    <router-link id="expension_index" to="/expension_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Expansion
                    </router-link>
                </li>
                
                <li class="nav-item pr-1"  @click="activatelink('volunteer')">
                    <router-link id="volunteer" to="/bifurcation_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Bifurcation
                    </router-link>
                </li> 
                <li class="nav-item pr-1" @click="activatelink('merger_index')">
                    <router-link to ="/merger_index" id="merger_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Merger
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('closure_index')">
                    <router-link to="/closure_index" id="closure_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Closure
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('reopening_index')">
                    <router-link to="/reopening_index" id="reopening" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Re-Opening
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