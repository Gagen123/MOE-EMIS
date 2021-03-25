<template>
    <div> 
         <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>O</h5><h6 class="pt-1">RGANIZATION MASTER</h6></li>
        </ol>
     <div class="container-fluid">   
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/location_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Location Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/disaster_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Disaster Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/level_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Level Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_category_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Category
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_facility_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Facility
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/equipment_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Equipment Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/equipment_usage_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Equipment Usage Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/sport_facility_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Sport Facility Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/sport_supporter_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Sport Supporter
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/str_sub_category_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Sub Category
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/equipment_item_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Equipment Item
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/class_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Class
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/stream_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Stream
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
}
</script>

