<template>
    <div>
        <table id="studentlist_table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Institutes Name</th>
                     <th >Male Students</th>
                     <th >Female Students</th>
                     <th >Total Students</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in student" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ InstitutesName[item.institute_id]}}</td>
                    <td>{{ item.studentMale}}</td>
                    <td>{{ item.studentFemale}}</td>
                    <td>{{ item.studentTotal}}</td>

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
        LoadStudentDetails(uri="students/ExternalDataImport/loadInstitues/all/RubStudentDetails"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.student =  data;
            })

            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        LoadInstitutesName(uri="students/ExternalDataImport/loadInstitues/all/RubCollegeDetails"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                 for(let i=0;i<data.length;i++){
                    this.InstitutesName[data[i].id] = data[i].collegeName;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        showedit(data){
            this.$router.push({name:'edit_student',params: {data:data}});
        },
    },
    mounted(){
        this.LoadInstitutesName();
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
