<template> 
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT SERVICES MASTER</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
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
                <li class="nav-item active pr-1" @click="activatelink('counselling_type_list')">
                    <router-link to="/counselling_type_index" id="counselling_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Counselling Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('counselling_age_index')">
                    <router-link to="/counselling_age_index" id="counselling_age_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Counselling Age Range
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('counselling_class_index')">
                    <router-link to="/counselling_class_index" id="counselling_class_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Counselling Class Range
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

