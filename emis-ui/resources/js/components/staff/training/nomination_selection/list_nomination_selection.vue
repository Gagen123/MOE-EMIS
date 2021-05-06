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
                
                <tr v-for="(training, index) in staffList" :key="index" >
                    <td>{{ index + 1 }} </td>
                    <td>{{ training.with_program.course_title }}</td>
                    <td>{{ training.with_program.start_date }}</td>
                    <td>{{ training.with_program.end_date }}</td>
                    <td>{{ training.with_program.nomination_start_date }}</td>
                    <td>{{ training.with_program.nomination_end_date }}</td>
                    <td><b>{{ training.sequence== 1 ? "Nominating" : training.sequence== 2 ?  'Shortlisting' :'Selecting'}}</b></td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(training.with_program.id,'view')">Veiw</a>
                        <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(training.with_program.id,training.sequence)">Open</a>
                        <!-- <span v-if="training.actiontype== 'Shortlisting & Selection'">
                            <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(training.with_program.id,'verify')">Open</a>
                        </span> -->
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
            if(type=="view"){
                this.$router.push({name:'edit_nomination_selection',params: {data:id,type:type}});
            }
            else if(type!=1){
                this.$router.push({name:'verify_nomination_selection',params: {data:id,statusId:type}});
            }
            else{
                this.$router.push({name:'create_nomination_selection',params: {data:id,statusId:type}});
            }
        },
        loadStaffList(){
            let uri='/staff/hrdevelopment/loadProgramDetailsForNomination';
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