<template>
    <div class="card-body">
        <table id="dzongkhag-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Degree</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in degreeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
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
            degreeList:[],
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_degree',params: {data:data}});
        },
    },
    async mounted(){
        this.degreeList =  await this.loadstaffMasters('all','hr_development_masters___Degree');
        this.dt =  $("#dzongkhag-table").DataTable();
    },
    watch:{
        degreeList(){
            this.applydatatable('dzongkhag-table');
        }
    },
}
</script>
