<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="award-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Name</th>
                            <th>Award Type</th>
                            <th>Year</th>
                            <th>Date</th>
                            <th class="pl-5 ml-5 pr-5 ml-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in staffaward_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.name}} </td>
                            <td>{{ item.awardtype}}</td>
                            <td>{{ item.year}}</td>
                            <td>{{ item.awarddate}}</td>
                            <td>
                                <a v-if="item.type=='MOE'" href="#" class="btn btn-success btn-sm btn-flat text-white editbtn"  @click="loadeditpage(item,'edit_staff_awards')">Edit</a>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white deletebtn" @click="loadeditpage(item,'view_staff_awards')">View</a>
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
            staffaward_list:[],
        }
    },
    methods: {
        loadgenderList(uri = 'staff/staffServices/loadStaffAward'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.staffaward_list = data;
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        deleteitem(id) {
            Swal.fire({
                text: "Are you sure you wish to delete this ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.get('staff/staffServices/deleteStaffServices/award/'+id)
                    .then((response) => {
                        if(response!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'record has been deleted.'
                            });
                            this.loadgenderList();
                        }
                    })
                    .catch((err) => {
                        Swal.fire(
                            'error!',
                            'Not able to delete. Please contact system administrator.Error: '+err,
                            'error',
                        );
                        console.log("Error:"+err)
                    })
                }
            });
        },
        loadeditpage(itme,route){
            this.$router.push({name:route,params:{data:itme}});
        }

    },
    created(){
        // if(this.$route.query.deleteopt==1){
        //     $('.deletebtn').show();
        // }
        // if(this.$route.query.editopt==1){
        //     $('.editbtn').show();
        // }
        this.dt =  $("#award-table").DataTable();
        this.loadgenderList();

    },
    watch: {
        staffaward_list(val) {
            this.applydatatable('award-table');
        }
    },
}
</script>
