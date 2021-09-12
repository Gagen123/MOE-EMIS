<template>
    <div>
        <table id="contactType-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Contact Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in contactList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="editmasters(item)"><i class="fas fa-edit"></i ></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return{
            contactList:[],
            dt:'',
        }
    },

    methods:{

        loadContactList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/ContactType'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.contactList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){ 
            this.$router.push({name:'ContactTypeEdit',params: {data:data}});
        },
        // loadContactList(uri = 'masters/loadContactType'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.contactList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#contactType-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },
        // viewContactList(data){
        //     data.action='edit';
        //     this.$router.push({name:'ContactTypeEdit',params: {data:data}});
        // },
    },
    mounted(){
        this.loadContactList();
        this.dt =  $("#contactType-table").DataTable();
    },
    watch: {
        contactList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#contactType-table").DataTable()
            });
        }
    },
}
</script>