<template>
    <div class="card-body">
        <table id="dzongkhag-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Nature of participation</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in natureOfParticipantList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ reverseDateTime(item.created_at) }}</td>
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
            natureOfParticipantList:[],
            dt:[],
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_nature_of_participation',params: {data:data}});
        },
    },
    async mounted(){
        this.natureOfParticipantList =  await this.loadstaffMasters('all','hr_development_masters___NatureOfParticipant');
        this.dt =  $("#data-table").DataTable();
    },
    watch: {
        dataList() {
            this.applydatatable('dzongkhag-table');
        }
    },
}
</script>
