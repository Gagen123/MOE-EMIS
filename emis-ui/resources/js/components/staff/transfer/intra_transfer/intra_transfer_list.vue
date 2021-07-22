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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in transfer_list" :key="index">
                            <td>{{ index + 1 }}</td>
                             <td>{{ StaffName[item.staff_id]}}</td>
                            <td><span class="badge badge-success">{{ item.aplication_number}}</span></td>
                            <td>{{ item.created_at}}</td>
                           <td><span class="badge badge-success">{{ item.status}}</span></td>
                           <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View/Edit</a>
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
            transfer_list:[],
            loaddetails:[],
            staff_id:[],
            StaffName:{},

        }
        
    },
    methods: {
        showedit(staff){
            this.$router.push({name:"edit_transfer_window",params:{data:staff}});
		},
        loadtransferDetails(){
            axios.get('staff/transfer/loadtransferDetails/intra_transfer')
            .then((response) => {
                // alert(JSON.stringify(response.data));
                let data = response.data
                this.transfer_list = data;
             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
            });
        },
        loadstaff(){
            let uri ='loadCommons/loadFewDetailsStaffList/userworkingagency/NA';
            axios.get(uri)
            .then(response =>{
                // alert(JSON.stringify(response.data.data[0]));
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.StaffName[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        applyselect2(){
        },
    },
    mounted() {
        this.loadtransferDetails();
        this.loadstaff();
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


