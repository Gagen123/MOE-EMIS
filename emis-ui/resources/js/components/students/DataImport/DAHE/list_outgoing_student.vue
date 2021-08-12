<template>
    <div>
        <table id="studentlist_table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Male Students</th>
                     <th >Female Students</th>
                     <th >Total Students</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in student" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.AbstudentMale}}</td>
                    <td>{{ item.AbstudentFemale}}</td>
                    <td>{{ item.AbstudentTotal}}</td>

                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data(){
        return{
            id:'2',
            student:[],
            InstitutesName:{}
        }
    },
    methods:{
        LoadStudentDetails(uri="students/ExternalDataImport/loadInstitues/all/AbroadStudentDetails"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.student =  data;
            })

            .catch(function (error) {
                console.log("Error:"+error)
            });
        },

        showedit(data){
            this.$router.push({name:'edit_outgoing_student',params: {data:data}});
        },
    },
    mounted(){
        this.LoadStudentDetails();
        this.dt =  $("#studentlist_table").DataTable()
    },
      watch: {
        student(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#studentlist_table").DataTable()
            });
            }
    },
}
</script>
