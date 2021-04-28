<template>
    <div class="">
        <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>M</h5><h6 class="pt-1">ess Management</h6></li>
        </ol>
        <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1" @click="activatelink('stockreceived')">
                <router-link id="stockreceived" to="/stock_received_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-receipt"></span>
                   Stock Received 
                </router-link>
            </li>
            <li class="nav-item pr-1"  @click="activatelink('stockissued')">
                <router-link id="stockissued" to="/stock_issued_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                   <span class="fas fa-receipt"></span>
                   Stock Issue
                </router-link>
            </li> 
            <li class="nav-item pr-1" @click="activatelink('localprocurement')">
                <router-link to ="/std_supplementation" id="std_supplementation" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fas fa-tablets"></span>
                    Local Procurement
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('foodreleasenote')">
                <router-link to="/foodrelease_index" id="foodrelease" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fas fa-receipt"></span>
                    Food Release Note 
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


















