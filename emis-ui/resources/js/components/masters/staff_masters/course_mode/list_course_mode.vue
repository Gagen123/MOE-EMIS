<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Course Mode</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Description</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in coursemodeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.Status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            coursemodeList:[],
        }
    },
    methods:{
        async loadcoursemodeList(){
            this.coursemodeList =  await this.loadstaffMasters('all','CourseMode');
        },
        showedit(data){
            this.$router.push({name:'edit_course_mode',params: {data:data}});
        },
    },
    mounted(){
        this.loadcoursemodeList();
        this.dt =  $("#working-agency-table").DataTable();
    },
    watch: {
        coursemodeList() {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
