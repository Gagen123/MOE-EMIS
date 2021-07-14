<template>
    <div class="">
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h5>Student Health</h5></li>
        </ol>
        <ul class="nav nav-pills mb-2" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1" @click="activatelink('healthscreen')">
                <router-link id="healthscreen" to="/std_health_screening" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fa fa-heartbeat"></span>
                   Health Screening
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('supplementation_link')">
                <router-link to ="/std_supplementation" id="supplementation_link" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fas fa-tablets"></span>
                    Supplementation 
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('vaccination_link')">
                <router-link to="/std_vaccination" id="vaccination_link" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fas fa-syringe"></span>
                    Vaccination
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('bmi_link')">
                <router-link to="/std_bmi" id="bmi_link" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    <span class="fas fa-notes-medical"></span>
                    Student BMI
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


















<!--<template>
    <div>
        <ol class="bg-primary mb-2">
            <li class="pl-2 text-white"><b><h5>Mess Management</h5></b></li>
        </ol>
        <ul class="nav nav-pills mb-3" id="mainmenu" role="tablist">
            <li class="nav-item active pr-1" @click="activatelink('stockreceipt')">
                <router-link id="stockreceipt" to="/stockreceipt">

                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fa fa-user-friends"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Stock Receipt</span>
                            <div class="progress"> 
                                <div class="progress-bar" style="width: 1000%"></div>
                            </div>
                            <span class="progress-description">
                                Open Link
                            </span>
                        </div>
                    </div> 
                </router-link>
            </li> 
            <li class="nav-item pr-1"  @click="activatelink('programme')">
                <router-link id="programme" to="/programme">
                    <div class="info-box bg-gradient-teal">
                        <span class="info-box-icon"><i class="fa fa-user-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Stock Issue</span>
                            <div class="progress"> 
                                <div class="progress-bar" style="width: 1000%"></div>
                            </div>
                            <span class="progress-description">
                                Open Link
                            </span>
                        </div>
                    </div> 
                </router-link>
            </li> 
            <li class="nav-item pr-1" @click="activatelink('localprocurement')">
               <router-link to="/localprocurement" id="localprocurement">
                    <div class="info-box bg-secondary">
                        <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Local Procurement</span>
                            <div class="progress"> 
                                <div class="progress-bar" style="width: 1000%"></div>
                            </div>
                            <span class="progress-description">
                                Open Link
                            </span>
                        </div>
                    </div> 
                </router-link>
            </li>
            <li class="nav-item pr-1" @click="activatelink('foodreleasenote')">
               <router-link to="/foodreleasenote" id="foodreleasenote">
                    <div class="info-box bg-secondary">
                        <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Food Release Note</span>
                            <div class="progress"> 
                                <div class="progress-bar" style="width: 1000%"></div>
                            </div>
                            <span class="progress-description">
                                Open Link
                            </span>
                        </div>
                    </div> 
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
</script>-->