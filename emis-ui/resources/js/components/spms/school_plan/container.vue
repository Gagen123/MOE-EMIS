<template>
    <div>
        <list-school-plan v-if="acess_level == 'Org'"></list-school-plan>
        <deo-emo-school-plan v-else></deo-emo-school-plan>
    </div>
</template>
<script>
import DeoEmoSchoolPlan  from "./deo_emo_list_school_plan.vue";
import ListSchoolPlan from "./list_school_plan.vue";
export default {
    components:{
        'deo-emo-school-plan': DeoEmoSchoolPlan,
        'list-school-plan': ListSchoolPlan
    },
    data(){
        return {
            acess_level:''
        }
    },
    mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.acess_level = data['acess_level']
        })
        .catch(errors =>{
            console.log(errors)
        });
    }
}
</script>