<template>
    <div>
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>G</h5><h6 class="pt-1">ENERAL INFORMATION</h6></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/locations" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Location
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/connectivity" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Connectivity
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/equipment_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Equipment & Furniture 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/sections_add" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Sections
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