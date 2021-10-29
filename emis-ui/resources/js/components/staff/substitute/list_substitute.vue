<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="data_table_list" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Name</th>
                            <th>EID</th>
                            <th>Position Title</th>
                            <th>Position Level</th>
                            <th>Working Address</th>
                            <th>Substituted For</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.staff_name}}</td>
                            <td>{{ item.emp_id}}</td>
                            <td>{{ item.position_title_name}}</td>
                            <td>{{ item.positionlevel}}</td>
                            <td>{{ item.working_agency}}</td>
                            <td>{{ item.For_EID}}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)">View</a>
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
    },
    async mounted() {
        axios.get('staff/zest/loadSubstitution/Limit__50')
        .then((response) => {
            this.dataList =  response.data.data;
            })
        .catch((error) => {
            console.log("Error."+error);
        });
        this.dt =  $("#data_table_list").DataTable()
    },
    watch: {
        dataList(){
            this.applydatatable('data_table_list');
        }
    },

}
</script>


