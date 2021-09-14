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
                            <th>Date of Apply</th>
                            <th>Status</th>
                            <th class="pl-4 pr-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in transfer_list" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{item.applicant_name}}</td>
                            <td>{{ item.aplication_number}}</td>
                            <td>{{ item.created_at}}</td>
                            <td><span class="badge badge-success">{{ item.status}}</span></td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> Open</a>
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
            staffArray:{},
            transfer_list:[],
            loaddetails:[],
            staffName:[],
            action:false,
            form: new form({
                applicant_name: '',
                status:'',

            })
        }
    },
    methods: {
        showedit(staff){
            this.$router.push({name:"edit_transfer_window",params:{data:staff}});
		},
        loadtransferDetails(){
            axios.get('staff/transfer/loadtransferDetails/inter_transfer')
            .then((response) => {
                this.transfer_list =  response.data;
                this.form.applicant_name = response.data[0].applicant_name;
                this.form.status = response.data[0].status;
             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
            });
        },
        loadstaff(){
            let uri ='loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                 this.staffArray[data[i].id] = data[i].name;

                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadeditpage(item){
            this.$router.push({name:"edit_inter_transfer",params:{data:item}});
        }
    },
        mounted() {
            this.loadtransferDetails();
            this.loadstaff();
        },
        watch: {
            transfer_list(){
                this.$nextTick(() => {
                    this.dt =  $("#training-table").DataTable()
                });
            }
        },

}
</script>


