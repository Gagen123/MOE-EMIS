<template>
    <div class="">
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT</h6>&nbsp;<h5>P</h5><h6 class="pt-1">ROGRAMS</h6><h5> & C</h5><h6 class="pt-1">LUBS</h6></li>
        </ol>
        <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
            <li class="nav-item pr-1" @click="activatelink('programs')">
                <router-link to ="/student_programs" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-edit"></span>
                    Programs & Clubs
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('programs_members')">
                <router-link to ="/student_programs_members" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-edit"></span>
                    Programs & Clubs Members
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('projects')">
                <router-link to="/student_projects" id="projects" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-check"></span>
                    Projects
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('project_members')">
                <router-link to ="/student_projects_members" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-edit"></span>
                    Project Members
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('program_inventory')">
                <router-link to ="/program_inventory_index" id="programs" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-edit"></span>
                    Inventory & Fund Management
                </router-link>
            </li>
        </ul>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    methods: {
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        }
    }
}
</script>