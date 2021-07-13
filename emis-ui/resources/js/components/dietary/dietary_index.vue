<template>
    <div>
         <ol class="mb-1 ml-xl-n3 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="pl-2 form-inline "><h5>D</h5><h6 class="pt-1">ietary</h6></li>
        </ol>
        <ul class="nav nav-pills mb-2" role="tablist">
            <li class="nav-item active pr-1">
                <router-link to="dietary_records" class="btn btn-outline-primary btn-sm pb-0 pl-1 pr-1 pt-0">
                    Dietary Records
                </router-link>
            </li>
        </ul>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    components: {
    },
    data(){
        return{
        }
    },
    methods:{
		manageclasses(currid){
            $('#selected').html(' Managing '+currid);
		},
    },
    mounted(){
    },
}
</script>

