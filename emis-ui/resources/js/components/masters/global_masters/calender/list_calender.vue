<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in transfer_window_list" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.year}}</td>
                            <td>{{ item.type}}</td>
                            <td>{{ item.from_date}}</td>
                            <td>{{ item.to_date}}</td>
                            <!-- <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td> -->
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
            transfer_window_list:[],
            dt:''
        }
    },
    methods: {
        showedit(staff){
            this.$router.push({name:"edit_calender",params:{data:staff}});
		},
        loadtransferwindow(){
            axios.get('masters/loadGlobalMasters/all_calender')
            .then((response) => {
                this.transfer_window_list =  response.data.data;
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },

    },
    mounted() {
        this.loadtransferwindow();
        this.dt =  $("#training-table").DataTable()
    },
    watch: {
        transfer_window_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#training-table").DataTable()
            });
        }
    },
}
</script>


