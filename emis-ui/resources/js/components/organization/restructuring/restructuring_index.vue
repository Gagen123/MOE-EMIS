<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>R</h5><h6 class="pt-1">ESTRUCTURING</h6></li>
        </ol>
        <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                <router-link id="regularstaff" to="/change_basic_details" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class=""></span>
                    Change Details
                </router-link>
            </li>
            <li class="nav-item pr-1"  @click="activatelink('volunteer')">
                <router-link id="volunteer" to="/bifurcation_list" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class=""></span>
                   Bifurcation
                </router-link>
            </li> 
            <li class="nav-item pr-1" @click="activatelink('trainingprogram')">
                <router-link to ="/merger" id="trainingprogram" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class=""></span>
                    Merger
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('nomination')">
                <router-link to="/closure_list" id="nomination" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class=""></span>
                    Closure
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