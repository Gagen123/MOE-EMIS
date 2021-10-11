<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="data-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Emp Id</th>
                            <th>Name</th>
                            <th>Position Title</th>
                            <th>Working Agency</th>
                            <th>Appointment Year</th>
                            <th>Appointment Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in substaffList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.EmpID}}</td>
                            <td>{{ item.FirstName}} {{ item.MiddleName}} {{ item.LastName}}</td>
                            <td>{{ item.Position }}</td>
                            <td>{{ item.FullWorkingAgency}}</td>
                            <td>{{ item.Year}}</td>
                            <td>{{ item.ApointmentDate}}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadviewpage(item)">View</a>
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
            accesslevel:'',
            dzo_id:'',
            substaffList:[],
            genderArray:{},
            dt:''
        }
    },
    methods: {
        loadviewpage(item){
            this.$router.push({name:"view_staff_appointment",query:{data:item}});
        },
    },

    mounted() {
        axios.get('staff/zest/loadappointment')
        .then((response) => {
            this.substaffList =  response.data.data;
            })
        .catch((error) =>{
            console.log("Error."+error);
        });
    },
    watch: {
        substaffList(){
            this.applydatatable('data-table');
        }
    },
}
</script>


