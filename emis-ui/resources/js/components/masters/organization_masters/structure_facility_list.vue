<template>
    <div>
        <table id="structureFacility-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Structure Facility</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in structureFacilityList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewLStructureFacilityList(item)"><i class="fas fa-edit"></i ></a>
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
            structureFacilityList:[],
        }
    },
    methods:{
        loadstructureFacilityList(uri = 'masters/loadStructureFacility'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.structureFacilityList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#structureFacility-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewLStructureFacilityList(data){
            data.action='edit';
            this.$router.push({name:'StructureFacilityEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadstructureFacilityList();
    },
}
</script>