<template>
    <div> 
         <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT HEALTH</h6></li>
        </ol>
        <ul class="nav nav-pills mb-2" role="tablist">
            
            <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                <router-link to="healthScreening_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Health Screening 
                </router-link>
            </li>
            <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                <router-link to="/deworming_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Deworming
                </router-link>
            </li>
            <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                <router-link to="/supplementation_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Supplementation
                </router-link>
            </li>
            <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                <router-link to="/vaccination_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Vaccination
                </router-link>
            </li>
            <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                <router-link to="/bmi_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Student BMI
                </router-link>
            </li>
            
        </ul>
        <router-view></router-view>
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
		manageclasses(currid){
            $('#selected').html(' Managing '+currid);
		},
    },
    mounted() {
        $('#studenthealthlink').addClass('menu-open');
        $('#roganizationmaster').addClass('navbar-cyan active');
        $('#roganizationmasterpara').addClass('text-white');
        
    },
    
}
</script>

