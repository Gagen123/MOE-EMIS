<template>
<div>
    <div v-if="roleName.includes('ECCD')">
        <detailed-information-eccd></detailed-information-eccd>
    </div>
    <div v-else>
        <detailed-information-school></detailed-information-school>
    </div>
    
</div>
</template>
<script>
import DetailedInformationEccd from './detailed_information_eccd.vue'
import DetailedInformationSchool from './detailed_information_school.vue'

    export default {
        components: {
            DetailedInformationEccd,
            DetailedInformationSchool
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
                        this.roleName+=data['roles'][i].roleName;
                    }
                    else{
                        this.roleName+=data['roles'][i].roleName+', ';
                    }
                }
                this.access_level = data['acess_level'];
            }) ;
        }
    }
</script>
