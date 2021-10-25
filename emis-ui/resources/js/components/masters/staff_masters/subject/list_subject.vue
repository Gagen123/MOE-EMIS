<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Subject Area</th>
                    <th >Subject</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in subjectList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.subject_area.name}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{reverseDateTime(item.created_at)}}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        <!-- <a v-if="item.status==  1" href="#" @click="changestatus(item.id,'0')" class="btn btn-danger btn-sm btn-flat text-white"><i class="fas fa-times"></i> Deactivate</a>
                        <a v-if="item.status==  0" href="#" @click="changestatus(item.id,'1')" class="btn btn-primary btn-sm btn-flat text-white"><i class="fas fa-check"></i> Activate</a> -->
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
            subjectList:[],
            dt:'',
        }
    },
    methods:{
       loadsubjectList(uri = 'masters/loadStaffMasters/all_subject_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.subjectList =  data.data.data;
            })
            .catch(function (error) {
                condole.log('error: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_subject',params: {data:data}});
        },

    },
    mounted(){
        this.loadsubjectList();
        this.dt =  $("#working-agency-table").DataTable();
    },
    watch: {
        subjectList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#working-agency-table").DataTable()
            });
        }
    },
}
</script>
