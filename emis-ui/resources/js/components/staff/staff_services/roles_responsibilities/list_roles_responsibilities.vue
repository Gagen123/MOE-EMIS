<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="responsible-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Name</th>
                            <th>Responsibility</th>
                            <th>year</th>
                            <th>Remarks</th>
                            <th class="pl-5 ml-5 pr-5 ml-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td><span v-if="item.staff!=null">{{ item.staff.emp_id}}:{{ item.staff.name}}</span></td>
                            <td>{{ item.type.name}}</td>
                            <td>{{ item.year}}</td>
                            <td>{{ item.remarks}}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm btn-flat text-white" @click="deleteitem(item.id)">Delete</a>
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
            data_list:[],
        }
    },
    methods: {

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
                    axios.get('staff/staffServices/deleteStaffServices/responsibility/'+id)
                    .then((response) => {
                        if(response!=""){
                            Toast.fire({
                                icon: 'success',
                                title: 'record has been deleted.'
                            });
                            this.loadstaffList();
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
        loadeditpage(itme){
            this.$router.push({name:"edit_roles_responsibilities",params:{data:itme}});
        },
        async loadstaffList(){
            await axios.get('staff/staffServices/loadStaffResponsibility')
            .then(response => {
                let data = response.data.data;
                this.data_list = data;
            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        }
    },
    mounted(){
        this.loadstaffList();
        this.dt =  $("#responsible-table").DataTable();
    },
    watch: {
        data_list() {
            this.applydatatable('responsible-table');
        }
    },
}
</script>
