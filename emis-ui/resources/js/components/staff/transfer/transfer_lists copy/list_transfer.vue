<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Applicant Name</th>
                            <th>From Dzongkhag/Thromde</th>
                            <th>From School</th>
                            <th>To Dzongkhag/Thromde</th>
                            <th>To School</th>
                            <th>Transfer Type</th>
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
                            <td>{{ dzoArray[item.user_dzo_id]}}</td>
                            <td>Yangchenphu Higher Secondary School</td>
                            <td>{{ dzoArray[item.dzongkhagApproved]}}</td>
                            <td>Khangkhu Middle Secondary School</td>
                            <td>{{ item.transferType}}</td>
                            <td>Master</td>
                            <td>English</td>
                            <td>{{ item.effective_date}}</td>
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
            dzoArray:{},
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
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data
                for(let i=0;i<data.length;i++){
                 this.dzoArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error:"+error)
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
        this.loadactivedzongkhagList();
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


