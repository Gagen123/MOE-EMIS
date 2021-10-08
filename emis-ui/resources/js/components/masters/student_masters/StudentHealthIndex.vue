<template> 
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT HEALTH MASTER</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('health_supplementation_index')">
                    <router-link to="health_supplementation_index" id="health_supplementation_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Supplementation  
                    </router-link>
                </li>
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
                <!-- <li class="nav-item active pr-1" @click="activatelink('vaccination_index')">
                    <router-link to="/vaccination_index" id="vaccination_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Vaccination Dosage
                    </router-link>
                </li> -->
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

