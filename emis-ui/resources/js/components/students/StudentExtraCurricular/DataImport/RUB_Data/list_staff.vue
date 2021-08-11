<template>
    <div>
        <table id="stafflist_table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Institutes Name</th>
                     <th >Male Staffs</th>
                     <th >Female Staffs</th>
                     <th >Total Staffs</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in staff" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ InstitutesName[item.institute_id]}}</td>
                    <td>{{ item.staffMale}}</td>
                    <td>{{ item.staffFemale}}</td>
                    <td>{{ item.staffTotal}}</td>
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
            staff:[], 
            InstitutesName:{}
        }
    },
    methods:{
        LoadStaffDetails(uri="students/ExternalDataImport/loadInstitues/staff"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.staff =  data;
            })
            
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        LoadInstitutesName(uri="students/ExternalDataImport/loadInstitues/all_institutes"){
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
            this.$router.push({name:'edit_staff',params: {data:data}});
        },
    },
    mounted(){
        this.LoadInstitutesName();
        this.LoadStaffDetails();
        this.dt=$("#stafflist_table").DataTable()
    },
      watch: {
        staff(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#stafflist_table").DataTable()
            });
            }
    },
}
</script>