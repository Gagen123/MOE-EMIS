<template>
<div>
    <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="pl-2 form-inline "><h5>E</h5><h6 class="pt-1">STABLISHMENT</h6></li>
    </ol>
    <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                <router-link id="regularstaff" to="/schoolList1" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class=""></span>
                    School List
                </router-link>
            </li>
            <li class="nav-item pr-1"  @click="activatelink('volunteer')">
                <router-link id="volunteer" to="/establishment" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                   New Application
                </router-link>
            </li> 
            <li class="nav-item pr-1" @click="activatelink('trainingprogram')">
                <router-link to ="/register1" id="trainingprogram" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class=""></span>
                    Register
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('nomination')">
                <router-link to="/headQuaterOffice1" id="nomination" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class=""></span>
                    HQ/Dzongkhag Office
                </router-link>
            </li>
        </ul>
        <router-view></router-view>
</div>
    
</template>

<script>
export default {
    data(){
        return{

        }
    },

    methods:{
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        }
    }
}
</script>