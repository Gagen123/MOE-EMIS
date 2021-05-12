<template>
    <div>
        <ul class="bg-primary mb-2">
            <li class="pl-2 text-white">
                <b><h5>Meeting</h5></b>
            </li>
        </ul>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white">
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="showadprocess('create_management_meeting')"><i class="fa fa-plus"></i> Add New</button>
                </span>
            </div>
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        methods: {
            showadprocess(type){
                this.$router.push("/"+type);
            },
        },
    }
</script>
