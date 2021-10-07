<template>
    <list :model="this.$route.query.model"/>
</template>
<script>
import list from "../created_edit_list/list.vue";
export default {
    components: {
        list,
    },
}
</script>
