<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
                <table id="responsible-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Name</th>
                            <th>EID</th>
                            <th>Position Title</th>
                            <th>Position Level</th>
                            <th>Working Address</th>
                            <th>Case Type</th>
                            <th>Case Category</th>
                            <th>Offence Type</th>
                            <th>Case Received Date</th>
                            <th class="pl-5 ml-5 pr-5 ml-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ item.emp_id}}</td>
                            <td>{{ item.position_title_name}}</td>
                            <td>{{ item.working_agency}}</td>
                            <td>{{ item.positionlevel}}</td>
                            <td>{{ item.case_type_name}}</td>
                            <td>{{ item.case_category_name}}</td>
                            <td>{{ item.offence_type}}</td>
                            <td>{{ reverseDate1(item.offence_date)}}</td>
                            <td>
                                <!-- <span v-if="item.record_type=='MOE'"> -->
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)">View</a>
                                <!-- </span> -->
                                <!-- <a href="#" class="btn btn-danger btn-sm btn-flat text-white" @click="deleteitem(item.id)">Delete</a> -->
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
        loadgenderList(uri = 'staff/staffServices/loadStaffdisaplinary'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.data_list = data;
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        // deleteitem(id) {
        //     Swal.fire({
        //         text: "Are you sure you wish to delete this ?",
        //         icon: 'info',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes!',
        //         }).then((result) => {
        //         if (result.isConfirmed) {
        //             axios.get('staff/staffServices/deleteStaffServices/responsibility/'+id)
        //             .then((response) => {
        //                 if(response!=""){
        //                     Toast.fire({
        //                         icon: 'success',
        //                         title: 'record has been deleted.'
        //                     });
        //                     this.loadgenderList();
        //                 }
        //             })
        //             .catch((err) => {
        //                 Swal.fire(
        //                     'error!',
        //                     'Not able to delete. Please contact system administrator.Error: '+err,
        //                     'error',
        //                 );
        //                 console.log("Error:"+err)
        //             })
        //         }
        //     });
        // },

        loadeditpage(itme){
            this.$router.push({name:"view_staff_disciplinary",params:{data:itme}});
        }
    },
    created(){
        this.dt =  $("#responsible-table").DataTable();
        this.loadgenderList();
    },
    watch: {
        data_list() {
            this.applydatatable('responsible-table');
        }
    },
}
</script>
