<template>
    <div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5>S</h5><h6 class="pt-1">TRUCTURAL</h6>&nbsp;&nbsp;<h5>F</h5><h6 class="pt-1">ACILITIES</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link id="regularstaff" to="/infrastructure_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Infrastructure
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('volunteer')">
                    <router-link id="volunteer" to="/sport_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Sports
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('trainingprogram')">
                    <router-link id="trainingprogram" to="/wash" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        Wash
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('nomination')">
                    <router-link id="nomination" to="/school_feeding" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class=""></span>
                        School Feeding
                    </router-link>
                </li>
            </ul>
        <router-view></router-view>
        </div>
        
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