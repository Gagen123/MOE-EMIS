<template>
    <div class="card-body overflow-auto">
        <table id="org-masters-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Dzongkhag</th>
                    <th style="width:20%">Department</th>
                    <th style="width:10%">Code</th>
                    <th style="width:25%">Description</th>
                    <th style="width:20%">Type</th>
                    <th style="width:20%">Status</th>
                    <th style="width:20%">Created At</th>
                    <th style="width:10%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in data_list" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ dzoArray[item.dzo_id]}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.type}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at}}</td>
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
            data_list:[],
            dzoArray:{},
            dt:'',
        }
    },

    methods:{
        loadContactList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/DepartmentMaster'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.data_list =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
            this.$router.push({name:'edit_department',params: {data:data}});
        },
        loaddzolist(uri = 'masters/loadGlobalMasters/all_active_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.dzoArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
    },
    mounted(){
        this.loaddzolist();
        this.loadContactList();
        this.dt =  $("#org-masters-table").DataTable();
    },
    watch: {
        data_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#org-masters-table").DataTable()
            });
        }
    },
}
</script>
