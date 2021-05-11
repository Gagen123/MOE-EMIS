<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Emp Id</th>
                            <th>Name</th>
                            <th>Sex</th> 
                            <th>Position Title</th>    
                            <th>Working Agency</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Action</th>                     
                        </tr>
                    </thead> 
                    <tbody>
                        <tr v-for="(item, index) in substaffList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.emp_type_id}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ genderArray[item.sex_id]}}</td>
                            <!-- <td>{{ item.position_title.name}}</td> -->
                            <td>{{ positiontitleList[item.position_title_id]}}</td>
                            <td>{{ item.working_agency_id}}</td>
                            <td>{{ item.email}}</td>
                            <td>{{ item.contact_no}}</td>
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
            substaffList:[],
            genderArray:{},
            positiontitleList:{},
        } 
    },
    methods: {
        loadeditpage(staff){
            this.$router.push({name:"edit_private_staff",params:{data:staff}});
		},
        loadstff(){
            axios.get('loadCommons/loadStaffList/emptype/Private')
            .then((response) => {  
                this.substaffList =  response.data.data;
             })
            .catch((error) => {  
                console.log("Error."+error);
            });
        },
        loadgenderList(uri = 'masters/loadGlobalMasters/all_active_gender'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        loadpositionTitleList(uri = 'masters/loadStaffMasters/all_active_position_title'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.positiontitleList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        },
    },
    mounted() {
        this.loadgenderList();
        this.loadpositionTitleList();
        this.loadstff();
        $("#training-table").DataTable({
            "responsive": true,
            "autoWidth": true,
        }); 
    },
    
}
</script>


