<template>
    <div> 
         <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>M</h5><h6 class="pt-1">ESS MANAGEMENT MASTER</h6></li>
        </ol>
     <div class="container-fluid">   
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('quater_type')">
                    <router-link to="/quater_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Quater Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('unit_type')">
                    <router-link to="/unit_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Unit Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('item_type')">
                    <router-link to="/item_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Item Type 
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_category_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Category
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

