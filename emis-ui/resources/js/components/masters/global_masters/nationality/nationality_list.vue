<template>
    <div class="card-body">
        <table id="nationality-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Country Name</th>
                    <th>Nationality</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Created Date Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in countryList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.country_name}}</td>
                    <td>{{ item.nationality}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{reverseDateTime(item.created_at)}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                            <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
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
            countryList:[],
            dt:'',
        }
    },
    methods:{
        loadcountryList(uri = 'masters/loadGlobalMasters/all_country'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.countryList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_nationality',params: {data:data}});
        },
    },
    mounted(){
        this.loadcountryList();
        this.dt =  $("#nationality-table").DataTable();
    },
    watch: {
        countryList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#nationality-table").DataTable()
            });
        }
    },
}
</script>
