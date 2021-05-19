<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="list-student-attendence-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Class</th>
                                <th>stream</th>
                                <th>Section</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classStremSectionList" :key="index">
                                 <td>{{ index+1 }}</td>
                                 <td> {{ item.class }} </td>
                                 <td> {{ item.stream }}  </td>
                                 <td> {{ item.section }} </td>
                                <td>
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                </td>                                                                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            classStremSectionList: [],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        async loadClassStreamSection(){
            axios.get(uri)
            .then(response =>{
                this.classStremSectionList = response.data.data;
            })
            .catch(function (error){
                 if(error.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            })
        },
        showedit(data){
            this.$router.push({name:'edit_student_attendance',params: {data:data}});
        },
	 
    },
    mounted(){ 
        this.loadClassStreamSection();
        this.dt = $("#list-student-attendence-table").DataTable()
    },
    watch: {
        classStremSectionList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#list-student-attendence-table").DataTable()
            });
        }
    }
    
}
</script>