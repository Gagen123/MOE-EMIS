<template>
    <div>
        <table id="staff-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Training Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Nomination Start Date</th>
                    <th>Nomination End Date</th>
                    <th>Status</th>
                    <th class="pl-5 pr-5">Action</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="(training, index) in staffList" :key="index">
                   <td>{{ index + 1 }} </td>
                    <td>{{ training.course_title }}</td>
                    <td>{{ training.start_date }}</td>
                    <td>{{ training.end_date }}</td>
                    <td>{{ training.nomination_start_date }}</td>
                    <td>{{ training.nomination_end_date }}</td>
                    <td>{{ training.status }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(training.id,'view')">Veiw</a>
                        <a href="#" v-if="training.status=='Created'" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(training.id,'edit')">Edit</a>
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
            dt:'',
        }
    },
    methods: {
        loadeditpage(id,type){
            if(type=="view"){
                this.$router.push({name:'view_training_programme',params: {data:id,type:type}});
            }else{
                this.$router.push({name:'edit_training_programme',params: {data:id,type:type}});
            }
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
        this.dt =  $("#staff-table").DataTable()
    },
    watch: {
        staffList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#staff-table").DataTable()
            });
        }
    },
}
</script>
