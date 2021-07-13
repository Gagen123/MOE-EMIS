<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline pt-2"><h5>Update Student Details</h5></li>
        </ol>
        <div class="container-fluid">
            <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
                <li class="nav-item active pr-1" @click="activatelink('update_std_cid')">
                    <router-link to="/update_std_cid" id="update_std_cid" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        CID
                    </router-link>
                </li>
                <li class="nav-item pr-1"  @click="activatelink('update_std_contact')">
                    <router-link to="/update_std_contact" id="update_std_contact" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-clock"></span>
                        Parent's Contact
                    </router-link>
                </li> 
                <li class="nav-item pr-1" @click="activatelink('update_std_feeding')">
                    <router-link to="/update_std_feeding" id="update_std_feeding" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Feeding Modality
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('update_std_guardian')">
                    <router-link to="/update_std_guardian" id="update_std_guardian" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Guardian Detail
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('update_std_needy')">
                    <router-link to="/update_std_needy" id="update_std_needy" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Needy Status
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('update_std_scholarship')">
                    <router-link to="/update_std_scholarship" id="update_std_scholarship" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        Scholarship Details
                    </router-link>
                </li>
                <li class="nav-item pr-1" @click="activatelink('update_std_sen')">
                    <router-link to="/update_std_sen" id="update_std_sen" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        <span class="fa fa-user-check"></span>
                        SEN Detail
                    </router-link>
                </li>
            </ul>
            <router-view></router-view>
        </div>
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