<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="private-staff-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>CID</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.cid}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ genderArray[item.gender]}}</td>
                            <td>{{ item.email}}</td>
                            <td>{{ item.contact}}</td>
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
            genderArray:{},
            dt:''
        }
    },
    methods: {
        loadeditpage(staff){
            this.$router.push({name:"edit_substitute",params:{data:staff}});
		},
        loadstff(type){
            axios.get('staff/substitution/loadStaff/'+type)
            .then((response) => {
                this.dataList =  response.data;
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },
    },
    async mounted() {
        this.dt =  $("#private-staff-table").DataTable();
        let sex_idList =  await this.loadactiveGlobalList('all_active_gender');
        for(let i=0; i<sex_idList.length;i++){
            this.genderArray[sex_idList[i].id] = sex_idList[i].name;
        }
        this.loadstff('all/SubstitutionModel');
    },
    watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#private-staff-table").DataTable()
            });
        }
    },

}
</script>


