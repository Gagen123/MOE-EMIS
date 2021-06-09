<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Disaster Committee</th>
                    <th >CID</th>
                    <th >Name</th>
                    <th >Contact No</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ Disaster_Committee_list[item.disastercomm] }}</td>
                    <td>{{ item.cid}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.contactNo}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
           // org_id:'2',
            dataList:[],
            Disaster_Committee_list:{},
        }
    },
    methods:{
        loadDataList(uri='organization/loadDisasterInformation'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#award-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                });
            }, 3000);
        },
        showedit(data){
            this.$router.push({name:'edit_disasters_information',params: {data:data}});
        },
         loadlDisasterCommitteeList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/DisasterCommittee'){
            axios.get(uri)
            .then(response => {
             let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.Disaster_Committee_list[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
    },

    mounted(){
        this.loadDataList();
        this.loadlDisasterCommitteeList();

    },
}
</script>
