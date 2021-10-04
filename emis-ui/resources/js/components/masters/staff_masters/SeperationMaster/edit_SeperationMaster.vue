<template>
    <edit :model="this.$route.query.model" :data="this.$route.query.data"/>
</template>
<script>
import edit from "../created_edit_list/edit.vue";
export default {
    components: {
        edit,
    },
}
</script>
