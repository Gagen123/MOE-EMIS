<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Applicant Name</th>
                            <th>Application Number</th>
                            <th>Dzongkhag/Thromde</th>
                            <th>School Name</th>
                            <th>Qualification</th>
                            <th>Competent Subject</th>
                            <th>Last Transfer Date</th>
                            <th>Status</th>
                            <th class="pl-4 pr-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in transfer_list" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.applicant_name}}</td>
                            <td>{{ item.aplication_number}}</td>
                            <td>Thimphu Thromde</td>
                            <td>Yangchenphu Higher Secondary School</td>
                            <td>Master</td>
                            <td>English</td>
                            <td>2018</td>
                            <td><span class="badge badge-success">{{ item.status}}</span></td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadviewpage(item)"> <span class="fa fa-eye"></span> View</a>
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
            transfer_list:[],
            form: new form({
                id:'',
                access_level:'',
                })
        }
    },
    methods: {
        loadviewpage(item){
            this.$router.push({name:"view_transfer",params:{data:item}});
        },
        loadtransferDetails(access_level){
            axios.get('staff/transfer/loadtransferDetails/'+access_level)
            .then((response) => {
                let data = response.data
                this.transfer_list = data;

             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
            });
        },
        profile_details(){
            axios.get('common/getSessionDetail')
            .then(response => {
                this.loadtransferDetails(response.data.data.acess_level)
            })
            .catch(errors =>{
                console.log(errors)
            });
        },
        applyselect2(){
        },
    },
    mounted() {
        this.profile_details();

        this.dt =  $("#training-table").DataTable()
    },
    watch: {
        transfer_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#training-table").DataTable()
            });
        }
    },

}
</script>


