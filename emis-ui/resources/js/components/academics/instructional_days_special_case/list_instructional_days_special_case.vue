<template>
    <div>
        <form class="bootbox-form" id="subjectTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="list-instructional-days-special-case-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Class</th>
                                <th>Student</th>
                                <th>Term</th>
                                <th>Instructional Days for the Student</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in instrictionalDaysForSpecialCase" :key="index">
                                <td>{{ index+1 }}</td>
                                <td> {{ item.class_stream_section}}</td>
                                <td> {{ item.attendance_date}}</td>
                                <td>
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                </td>                                                                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            instrictionalDaysForSpecialCase: [],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
       async getInstructionalDays(){
            // let instructional_days = await axios.get('academics/getInstrunctionalDays').then(response => response.data.data)
            // let student = await axios.get()
            // this.instrictionalDaysForSpecialCase = 
                

        },
        showedit(data){
            this.$router.push({name:'edit_instructional_days_special_case',params: {data:data}});
        },
	 
    },
    mounted(){ 
        this.getInstructionalDays();
        this.dt = $("#list-instructional-days-special-case-table").DataTable({
               columnDefs: [
                { width: 2, targets: 0},
            ],
        })
    },
    watch: {
        instrictionalDaysForSpecialCase(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#list-instructional-days-special-case-table").DataTable()
            });
        }
    }
    
}
</script>