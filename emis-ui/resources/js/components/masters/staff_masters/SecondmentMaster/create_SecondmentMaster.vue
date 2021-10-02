<template>
    <create :model="this.$route.query.model"/>
</template>
<script>
import create from "../created_edit_list/create.vue";
export default {
    components: {
        create,
    },
}
</script>
