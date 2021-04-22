<template>
    <div>
        <table id="list-student-table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Student CID</th>
                     <th >Student Code</th>
                     <th >Student Name</th>
                     <th >Class</th>
                     <th >Section</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
        }
    },
    methods: {
    },
    mounted() {
        $("#list-student-table").DataTable({
            "responsive": true,
            "autoWidth": false,
        }); 
    },
}
</script>