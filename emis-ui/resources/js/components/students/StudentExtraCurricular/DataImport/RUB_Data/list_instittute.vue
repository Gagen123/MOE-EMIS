<template>
    <div>
        <table id="institutes_table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Institutes Name</th>
                     <th >Dzongkhag/Thromde</th>
                     <th >Institutes Type</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in institutes" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.collegeName}}</td>
                    <td>{{ DzongkhagName[item.dzongkhag]}}</td>
                    <td>{{ item.institutes_type}}</td>
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
            institutes:[], 
            DzongkhagName:{}
        }
    },
    methods:{
        LoadInstitutesDetails(uri="students/ExternalDataImport/loadInstitues/all_institutes"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.institutes =  data.data.data;
            })
            
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        showedit(data){
            this.$router.push({name:'edit_student_programs',params: {data:data}});
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.DzongkhagName[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
    },
    mounted(){
        this.loadactivedzongkhagList()
        this.LoadInstitutesDetails();
        this.dt=$("#institutes_table").DataTable()
    },
    watch: {
        institutes(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#institutes_table").DataTable()
            });
            }
    },
}
</script>