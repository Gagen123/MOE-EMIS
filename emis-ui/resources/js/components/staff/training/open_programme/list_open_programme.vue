<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Name</th>
                            <th>EID</th>
                            <th>Position Title</th>
                            <th>Position Level</th>
                            <th>Working Address</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in hr_programme_calander_list" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.staff_name}}</td>
                            <td>{{ item.emp_id}}</td>
                            <td>{{ item.position_title_name}}</td>
                            <td>{{ item.positionlevel}}</td>
                            <td>{{ item.working_agency_name}}</td>
                            <td>{{ reverseDate1(item.start_date)}}</td>
                            <td>{{ reverseDate1(item.end_date)}}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            totle:0,
            hr_programme_calander_list:[],
            dt:''
        }
    },
    methods: {
        showedit(staff){
            this.$router.push({name:"edit_open_programme",params:{data:staff}});
		},
        getprogramOpenDetail(){
            axios.get('staff/hrdevelopment/getprogramOpenDetail')
            .then((response) => {
                this.hr_programme_calander_list =  response.data.data;
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },
    },
    mounted() {
        this.getprogramOpenDetail();
        this.dt =  $("#training-table").DataTable()
    },
    watch: {
        hr_programme_calander_list(){
            this.applydatatable('training-table');
        }
    },
}
</script>


