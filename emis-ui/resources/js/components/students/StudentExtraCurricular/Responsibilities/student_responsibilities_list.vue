<template>
    <div>
        <table id="roles-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Student Name</th>
                    <th >Student Code</th>
                    <th >Role/Responsibility</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.StdStudentId}}</td>
                    <td>{{ item.role_name}}</td>
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
            dataList:[],
        }
    },
    methods:{
        loadDataList(org_id){
            let uri='students/loadStudentResponsibilities/'+org_id
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
               console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_student_responsibilities',params: {data:data}});
        },
    },
    mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.loadDataList(data['Agency_Code']);
        })
        .catch(errors => {
            console.log(errors)
        });

    },
}
</script>
