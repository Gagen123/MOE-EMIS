<template>
    <div class="">
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>S</h5><h6 class="pt-1">TUDENT</h6>&nbsp;&nbsp;<h5>S</h5><h6 class="pt-1">ERVICES</h6></li>
        </ol>
        <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1" @click="activatelink('responsibilities')">
                <router-link to="/student_responsibilities" id="responsibilities" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-user-clock"></span>
                    Roles & Responsibilities
                </router-link>
            </li>
            <li class="nav-item pr-1"  @click="activatelink('awards')">
                <router-link to="/student_awards" id="awards" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class="fa fa-user-clock"></span>
                   Awards
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