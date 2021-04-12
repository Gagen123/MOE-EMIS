<template> 
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT HEALTH MASTER</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('health_screening_index')">
                    <router-link to="health_screening_index" id="health_screening_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Health Screening  
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('screening_position_index')">
                    <router-link to="screening_position_index" id="screening_position_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Health Screening Position
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('screening_endorser_index')">
                    <router-link to="screening_endorser_index" id="screening_endorser_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Health Screening Endorsed By
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('vaccination_index')">
                    <router-link to="/vaccination_index" id="vaccination_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Vaccination  
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('term_index')">
                    <router-link to="/term_index" id="term_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Term 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('award_type_list')">
                    <router-link to="/award_type_list" id="award_type_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Award Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('student_award_list')">
                    <router-link to="/student_award_list" id="student_award_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Award 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('offence_type_list')">
                    <router-link to="/offence_type_list" id="offence_type_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Offence Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('offence_severity_list')">
                    <router-link to="/offence_severity_list" id="offence_severity_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Offence Severity 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('action_taken_list')">
                    <router-link to="/action_taken_list" id="action_taken_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Action Taken 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('roles_responsibilities_list')">
                    <router-link to="/roles_responsibilities_list" id="roles_responsibilities_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Roles & Responsibilities 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('program_name_list')">
                    <router-link to="/program_name_list" id="program_name_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Program Name 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('program_support_list')">
                    <router-link to="/program_support_list" id="program_support_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Program Support 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('program_roles_list')">
                    <router-link to="/program_roles_list" id="program_roles_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Program Roles 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('project_type_list')">
                    <router-link to="/project_type_list" id="project_type_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Project Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('training_type_list')">
                    <router-link to="/training_type_list" id="project_type_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Training/Workshop Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('training_list')">
                    <router-link to="/training_list" id="project_type_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Training/Workshop 
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

