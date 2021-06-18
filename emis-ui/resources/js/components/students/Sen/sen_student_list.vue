<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">List of SEN Students</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header pt-0 mt-0 pb-0">
                    <div>
                        <table id="sen-student-list-table" class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th >SL#</th>
                                    <th >Student Name</th>
                                    <th >Student Code</th>
                                    <th >Class</th>
                                    <th >Section</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                    <tr v-for="(item, index) in studentList" :key="index">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ item.Name}}</td>
                                        <td>{{ item.student_code}}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showQuestionnaire(item)"><i class="fas fa-edit"></i ></a>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>
<script>
export default {
    data(){
        return{
            dt:'',
            studentList:[]
        }
    },
    methods:{
        getSenStudentList(uri = 'students/sen/getSenStudentList'){
            axios.get(uri)
            .then(response =>{
                this.studentList = response.data;
            }).catch(function (error){console.log('Error: '+error);});
        },
        showQuestionnaire(data){
            this.$router.push(
                {
                    name:'sen_questions',
                    params: data
                }
            );

        }
    },
    mounted(){
        this.dt =  $("#sen-student-list-table").DataTable();
        this.getSenStudentList();
    },
    watch: {
        studentList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#sen-student-list-table").DataTable();
            });
        }
    }

}

</script>
