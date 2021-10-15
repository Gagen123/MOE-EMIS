<template>
<div>
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header p-0 border-bottom-0">
                <div class="callout callout-success">
                  <h5 class="bg-gradient-lightblue">Notification Message</h5>
                  <div v-html="message">
                  </div>
                </div>
            </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            workflow_detail_list:[],
        };
    },

    methods:{
        getworkflow(appNo){
            axios.get('common/getApplicationDetials/'+appNo)
            .then(response => {
                let data = response;
                this.workflow_detail_list = data.data;
            });
        }
    },
    created(){
        this.getworkflow(this.$route.params.data.application_number);
    }
}
</script>
