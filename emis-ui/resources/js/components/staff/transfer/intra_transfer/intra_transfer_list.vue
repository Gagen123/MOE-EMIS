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
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in transfer_list" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.staff_id}}</td>
                            <td><span class="badge badge-success">{{ item.aplication_number}}</span></td>
                            <td>{{ item.created_at}}</td>
                           <td><span class="badge badge-success">{{ item.status}}</span></td>
                            <!-- <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td> -->
                            
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

              form: new form({
                staff_id: '',
            })
            
        }
        
    },
    methods: {
        showedit(staff){
            this.$router.push({name:"edit_transfer_window",params:{data:staff}});
		},
        loadtransferDetails(){
            axios.get('staff/transfer/loadtransferDetails/intra_transfer')
            .then((response) => {
                let data = response.data
                this.transfer_list = data;
                if(data!=null){
                    this.staff_id=data.staff_id;
                    $('#staff_id').val(data.staff_id).trigger('change');
                }
             })
            .catch((error) => {
                console.log("Error in retrieving ."+error);
            });
        },
        getStaffNameWithId(){
            let uri ='staff/transfer/getStaffNameWithId/' +$('#staff_id').val();
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.staffList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        applyselect2(){
            if(!$('#staff_id').attr('class').includes('select2-hidden-accessible')){
                $('#staff_id').addClass('select2-hidden-accessible');
            }
        },
    },
    mounted() {
        this.loadtransferDetails();
        this.getStaffNameWithId();
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


