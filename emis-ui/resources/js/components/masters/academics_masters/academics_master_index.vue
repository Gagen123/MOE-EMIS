<template>
    <div> 
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">ACADEMICS MASTERS</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span> 
                        {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('main_subject')">
                    <router-link id="main_subject" to="/main-subject-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      Main Subject
                    </router-link>
                </li>
                 <!-- <li class="nav-item active pr-1" @click="activatelink('sub_group')">
                    <router-link id="teaching_subject" to="/teaching_subject" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                      Teaching Subject
                    </router-link>
                </li> -->
                <li class="nav-item active pr-1" @click="activatelink('sub_group')">
                    <router-link id="sub_group" to="/subject-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0" >
                       Subject
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('sub')">
                    <router-link id="sub" to="/sub-subject-master" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Sub-Subject (Paper)
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
               
                <li class="nav-item active pr-1" @click="activatelink('sub_mapping_for_tre')">
                    <router-link id="sub_mapping_for_tre" to="/subject-mapping-for-tre" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                         Subject Mapping for TRE 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('promotion_rule')">
                    <router-link id="promotion_rule" to="/promotion-rule" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Promotion Rule
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('reason_for_absent')">
                    <router-link id="reason_for_absent" to="/reasons-for-absent" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Reason for Absence
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
                this.menubar = data.data;  
            })
            .catch(function (error) { 
                console.log("Error:"+error)
            });
        },
    },
    async mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
        let env=await this.getEnvValues('VUE_APP_ENV_TYPE');
        if(env=="Production"){
            $('.developemntEnv').hide();
        }
    },
    
}
</script>

