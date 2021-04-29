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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
                <tr v-for="(training, index) in staffList" :key="index">
                    <td>{{ index + 1 }} </td>
                    <td>{{ training.course_title }}</td>
                    <td>{{ training.vanue }}</td>
                    <td>{{ training.start_date }}</td>
                    <td>{{ training.end_date }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(training.id,'view')"><span class="fa fa-eye"></span>Veiw</a>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(training.id,'edit')"><span class="fa fa-edit"></span>Edit</a>
                    </td>
                </tr>
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
        loadeditpage(id,type){
            this.$router.push({name:'edit_training_programme',params: {data:id,type:type}});
        },
        loadStaffList(){
            let uri='/staff/hrdevelopment/loadprogramDetails';
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