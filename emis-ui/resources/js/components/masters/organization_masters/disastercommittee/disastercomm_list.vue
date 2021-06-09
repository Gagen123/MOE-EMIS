<template>
<div>
    <table id="disasterComm-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Disaster Committee Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in disasterCommList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewDisasterCommList(item)"><i class="fas fa-edit"></i ></a>
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
            disasterCommList:[], 
            dt:'',
        }
    },

    methods:{
        loadDisasterCommList(uri = 'masters/loadDisasterComm'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.disasterCommList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#disasterComm-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewDisasterCommList(data){
            data.action='edit';
            this.$router.push({name:'DisasterCommitteeEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDisasterCommList();
        this.dt =  $("#disasterComm-table").DataTable();
    },
    watch: {
        disasterList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#disasterComm-table").DataTable()
            });
        }
    },
}
</script>