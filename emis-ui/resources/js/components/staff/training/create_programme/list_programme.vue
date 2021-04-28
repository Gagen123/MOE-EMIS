<template>
    <div>
        <table id="staff-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Training Name</th>
                    <th>Institute/Vanue</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>      
</template>
<script>
export default {
    data() {
        return {
            staffList:[],
        }
    },
    methods: {
        loadeditpage(id){
            this.$router.push({name:'ddddd',params: {data:id}});
        },
        loadStaffList(){
            uri='/staff/hrdevelopment/loadprogramDetails';
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.staffList = data.data;
            });
        },
    },
    mounted(){
        this.loadStaffList();
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        $("#staff-table").DataTable({
            "responsive": true,
            "autoWidth": false,
        }); 
    },
}
</script>