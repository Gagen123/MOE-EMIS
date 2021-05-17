<template>
    <div> 
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h6 class="pt-1">Acadamics Masters</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span> 
                        {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('sub_group')">
                    <router-link id="sub_group" to="/subject-group-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Subject Group
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('sub')">
                    <router-link id="sub" to="/subject-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Subject 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('assmt_area')">
                    <router-link id="assmt_area" to="/assessment-area-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      Assessment Area
                    </router-link>
                </li>
                 <li class="nav-item active pr-1" @click="activatelink('assmt_frequency')">
                    <router-link id="assmt_frequency" to="/assessment-frequency-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                     Assessment Frequency
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('sub_assmt_type')">
                    <router-link id="sub_assmt_type" to="/subject-assessment-type-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      Class Subject
                    </router-link>
                </li>
               
                <li class="nav-item active pr-1" @click="activatelink('sub_assmt_area')">
                    <router-link id="sub_assmt_area" to="/subject-assessment-area-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Class Subject Assessment Area 
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
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        },
		getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar = data.data.data;  
            })
            .catch(function (error) { 
                console.log("Error:"+error)
            });
        },
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
    
}
</script>

