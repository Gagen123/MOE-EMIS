<template>
    <div class="">
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT</h6>&nbsp;&nbsp;<h5>S</h5><h6 class="pt-1">ERVICES</h6></li>
        </ol>
        <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1" @click="activatelink('admission')">
                <router-link to="/student_admission" id="admission" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-clock"></span>
                    Admission
                </router-link>
            </li>
            <li class="nav-item pr-1"  @click="activatelink('reporting')">
                <router-link id="reporting" to="/student_reporting" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class="fa fa-user-clock"></span>
                   Reporting
                </router-link>
            </li> 
            <li class="nav-item pr-1" @click="activatelink('transfer')">
                <router-link to ="/student_leaving" id="transfer" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-edit"></span>
                    Transfer/Leave
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('updates')">
                <router-link to="/student_updates" id="updates" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-check"></span>
                    Updates
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('houses')">
                <router-link to="/student_houses" id="houses" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-check"></span>
                    Houses
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('disciplinary')">
                <router-link to="/student_disciplinary_record" id="disciplinary" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-check"></span>
                    Disciplinary Record
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