<template> 
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT NON-ACADEMICS MASTER</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('program_type_list')">
                    <router-link to="/program_type_list" id="program_type_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Program Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('program_name_list')">
                    <router-link to="/program_name_list" id="program_name_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Program Name 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('club_name_list')">
                    <router-link to="/club_name_list" id="club_name_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Club Name 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('program_support_list')">
                    <router-link to="/program_support_list" id="program_support_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Program Support 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('program_roles_list')">
                    <router-link to="/program_roles_list" id="program_roles_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Program/Club Roles 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('project_type_list')">
                    <router-link to="/project_type_list" id="project_type_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Project Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('scout_section_list')">
                    <router-link to="/scout_section_list" id="scout_section_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Scout Section
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('scout_section_level_list')">
                    <router-link to="/scout_section_level_list" id="scout_section_level_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Scout Section Level
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('scout_badge_list')">
                    <router-link to="/scout_badge_list" id="scout_badge_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Scout Proficiency Badge
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('scout_leader_list')">
                    <router-link to="/scout_leader_list" id="scout_leader_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Scout Leader
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('training_type_list')">
                    <router-link to="/training_type_list" id="project_type_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Training/Workshop Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('training_list')">
                    <router-link to="/training_list" id="training_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Training/Workshop 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('quarter_name_index')">
                    <router-link to="/quarter_name_index" id="quarter_name_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Quarter 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('program_item_index')">
                    <router-link to="/program_item_index" id="program_item_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Program Items 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('program_measurement_index')">
                    <router-link to="/program_measurement_index" id="program_measurement_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Measurement 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('foodSource_type_index')">
                    <router-link to="/foodSource_type_index" id="foodSource_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Food Source Type
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
        }
    },
    methods: {
	 activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        }
    },
   /* mounted() {
        $('#studenthealthlink').addClass('menu-open');
        $('#roganizationmaster').addClass('navbar-cyan active');
        $('#roganizationmasterpara').addClass('text-white');
        
    },
     */
}
</script>

