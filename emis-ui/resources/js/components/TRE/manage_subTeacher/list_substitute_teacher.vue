<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="substitute-staff-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>CID</th>
                            <th>Name</th>
                            <th>Subtituted By</th>
                            <th>CID</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Teaching Subject</th>
                            <th>Contract Extended</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.empId}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ item.subtituted_by}}</td>
                            <td>{{ item.cid}}</td>
                            <td>{{ item.from_date}}</td>
                            <td>{{ item.to_date}}</td>
                            <td>{{ teachingSubjList[item.teaching_subject]}}</td>
                            <td>{{ item.contact_extended}}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dataList:[],
            dt:'',
            teachingSubjList:{},
            teachingSubjList:[]
        }
    },
    methods:{
        loadSubstaff(uri = 'staff/substitution/loadSubstaff'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        loadeditpage(staff){
            this.$router.push({name:"edit_substitute_teacher",params:{data:staff}});
		},
        LoadTeachingSubject(uri = 'masters/loadAcademicMasters/all_teaching_subject'){
            axios.get(uri)
            .then(response =>{
                let data = response;
            // alert(JSON.stringify(response.data.data));

                for(let i=0;i<data.data.data.length;i++){
                    this.teachingSubjList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        },
    },
    
   
    mounted() {
        this.LoadTeachingSubject();
        this.dt =  $("#substitute-staff-table").DataTable();
        this.loadSubstaff();
        
    },
    watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#substitute-staff-table").DataTable()
            });
        }
    },

}
</script>


