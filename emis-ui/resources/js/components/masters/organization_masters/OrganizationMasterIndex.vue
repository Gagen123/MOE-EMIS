<template>
    <div>
         <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>O</h5><h6 class="pt-1">RGANIZATION MASTER</h6></li>
        </ol>
     <div class="container-fluid">
            <ul class="nav nav-pills mb-2" role="tablist">
                <li class="nav-item active pr-1"  v-for="(item, index) in menubar" :key="index">
                    <router-link :to="{name: item.route, query: {data: item.actions } }" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0"  onclick="afterclick()">
                       {{ item.screen_name}}
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/org_service_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Services
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/department_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Department
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/proposed_by_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Proposed By
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/document_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Document Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/financial_information_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Financial Information
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/income_facility_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Income Facility Type
                    </router-link>
                </li>
                <!-- <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/income_facility_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Income Facility Type
                    </router-link>
                </li> -->


                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/location_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Location Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/fencing_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Fencing Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/climate_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Climate Type
                    </router-link>
                </li>


                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/level_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Level Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_category_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Category
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/str_sub_category_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Sub Category
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_facility_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Facility
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/equipment_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Equipment Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/equipment_usage_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Equipment Usage Type
                    </router-link>
                </li>
                <!-- <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/furniture_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Furniture Type
                    </router-link>
                </li> -->
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/furniture_item_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Furniture
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/furniture_usage_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Furniture Usage Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/sport_facility_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Sport Facility Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/sport_facility_subtype_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Sport Facility Subtype
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/sport_supporter_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Sport Supporter
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/equipment_item_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Equipment Item
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/class_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Class
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/stream_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Stream
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('classs_stream')">
                    <router-link to="/class_stream_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Class Stream Mapping
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/contact_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Contact Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/electricity_source_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Electricity Source
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/electricity_supply_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Electricity Supply
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/road_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Road Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/service_provider_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Service Provider
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/structure_designer_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Structure Designer
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/attachment_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Attachment
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/disastercommittee_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Disaster Committee
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/internet_accessible_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Internet Accessible
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/internetconn_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Internet Connection Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/visitor_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Visitor Type
                        </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/accessible_sen_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Accessible Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/furnitureType_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                        Furniture Type
                    </router-link>
                </li>
                 <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/internet_accessible_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Internet Accessible Type
                    </router-link>
                </li>
                 <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/construction_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                       Construction Type
                    </router-link>
                </li>
                 <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/eccdStructure_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      ECCD Structure Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/eccdfacility_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      ECCD Facility Type
                    </router-link>
                </li>
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/program_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      Program Type
                     </router-link>
                </li>   
                <li class="nav-item active pr-1" @click="activatelink('regularstaff')">
                    <router-link to="/gate_type_index" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                      Gate Type
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
             menubar:[],
        }
    },
    methods: {
		getmenus(sub_mod_id){
            let uri = 'get_screens_on_submodules/submodule/'+sub_mod_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.menubar =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        activatelink(btnid){
            $('#mainmenu >li >router-link >a').removeClass('btn-primary text-white');
            $('#'+btnid).addClass('btn-primary text-white');
        }
    },
    mounted() {
        let routeparam=this.$route.query.data;
        this.sub_mod_id=routeparam;
        this.getmenus(routeparam);
    },
}
</script>

