<template>
    <div class="">
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5>Student Programs & Clubs</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span>
                        {{ item.screen_name}}
                    </router-link>
                </li>
            </ul>
            <ul class="nav nav-pills mb-2 developemntEnv" id="mainmenu" role="tablist">
                 <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.screen_id } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                        <span :class="item.screen_icon"></span> {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('programs')">
                    <router-link to ="/student_programs" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Programs
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('programs_members')">
                    <router-link to ="/student_programs_members" id="programs_members" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Programs Members
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('clubs')">
                    <router-link to ="/student_clubs" id="clubs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Clubs
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('clubs_members')">
                    <router-link to ="/student_clubs_members" id="clubs_members" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Club Members
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('projects')">
                    <router-link to="/student_projects" id="projects" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Projects
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('project_members')">
                    <router-link to ="/student_projects_members" id="project_members" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Project Members
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('program_action_plan')">
                    <router-link to ="/program_action_plan" id="program_action_plan" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Action Plan
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('program_inventory')">
                    <router-link to ="/program_inventory_index" id="program_inventory" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-edit"></span>
                        Inventory & Fund Management
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
    async mounted(){
        let uri = 'get_screens_on_submodules/submodule/'+this.$route.query.data;
        axios.get(uri)
        .then(response => {
            let data = response;
            this.menubar =  data.data;
        })
        .catch(function (error) {
            console.log(error);
        });
        
        let env=await this.getEnvValues('VUE_APP_ENV_TYPE');
        if(env=="Production"){
         $('.developemntEnv').hide();
        }
    },
}
</script>
