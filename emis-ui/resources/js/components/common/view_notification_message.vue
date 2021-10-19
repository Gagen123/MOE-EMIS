<template>
<div>
    <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="pl-2 form-inline "><h6 class="pt-1">Notification Message</h6></li>
    </ol>
    <div class="card card-primary card-outline">
        <div class="card-body">
           <div class="callout callout-success">
                <div id="__message">
                    <label>Notification for {{response_data.notification_for}}</label>
                    <label>Details: {{response_data.notification_message}}</label>
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
            response_data:[],
        };
    },
    mounted(){
        axios.get('common/getNotificationDetials/'+this.$route.query.data)
        .then(response => {
            let data = response;
            this.response_data = data.data;
        });
    }
}
</script>
