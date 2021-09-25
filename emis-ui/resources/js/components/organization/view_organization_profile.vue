<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">Organization Profile</h6></li>
    </ol>
    <div v-if="access_level === 'Org'">
        <view-school-profile></view-school-profile>
    
    </div>
    <div v-if="access_level === 'Ministry'">
        <view-department-profile></view-department-profile>
        <department-profile-update></department-profile-update>
    </div>
    <div v-if="access_level === 'Dzongkhag'">
        <view-dzongkhag-profile></view-dzongkhag-profile>
    </div>
</div>
</template>
<script>
import ViewSchoolProfile from './view_school_profile.vue'
import ViewDepartmentProfile from './view_department_profile.vue'
import ViewDzongkhagProfile from './view_dzongkhag_profile.vue'
import DepartmentProfileUpdate from './department_profile_update.vue'


    export default {
        components: {
            ViewSchoolProfile,
            ViewDepartmentProfile,
            ViewDzongkhagProfile,
            DepartmentProfileUpdate,
            
        },
        data(){
            return{
                access_level:'',
                roleName:''
            }
        },
        methods:{
            
           
        },
        mounted(){
            axios.get('common/getSessionDetail')
            .then(response =>{
                let data = response.data.data;
                let roleName="";
                for(let i=0;i<data['roles'].length;i++){
                    if(i==data['roles'].length-1){
                        roleName+=data['roles'][i].roleName;
                    }
                    else{
                        roleName+=data['roles'][i].roleName+', ';
                    }
                }
                this.access_level = data['acess_level'];
            }) ;
        }
    }
</script>
