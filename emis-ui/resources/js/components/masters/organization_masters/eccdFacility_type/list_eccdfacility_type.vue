<template>
    <div>
        <table id="eccdfacility-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Facility Type</th>
                    <th>ECCD Structure Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in eccdFacilityList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.faciltytype}}</td>
                    <td>{{ item.structuretype}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewEccdFacilityList(item)"><i class="fas fa-edit"></i ></a>
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
            eccdFacilityList:[],
            dt:'',
        }
    },

    methods:{
        loadEccdFacilityList(uri = 'masters/loadEccdFacilityList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.eccdFacilityList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#equipmentItem-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewEccdFacilityList(data){
            data.action='edit';
            this.$router.push({name:'edit_eccdfacility_type',params: {data:data}});
        },
    },

    mounted(){
        this.loadEccdFacilityList();
        this.dt =  $("#eccdfacility-table").DataTable();
    },
    watch: {
        eccdFacilityList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#eccdfacility-table").DataTable()
            });
        }
    },
}
</script>