<template>
    <div>
        <div class="card card-success card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <div class="callout callout-success">
                  <h5 class="bg-gradient-lightblue">Acknowledgement </h5>
                  <div v-html="message"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            message:'',
        }
    },
    mounted(){ 
        this.message=this.$route.params.data;
    },
}
</script>

