<template>
    <div class="card-body overflow-auto">
        <table id="org-masters-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">ECCD Structure Type</th>
                    <th style="width:20%">Facility Type</th>
                    <th style="width:10%">Code</th>
                    <th style="width:25%">Description</th>
                    <th style="width:10%">Status</th>
                    <th style="width:25%">Created At</th>
                    <th style="width:10%">Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in data_list" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ eccdStructureTypeList[item.structuretype]}}</td> 
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at}}<td>
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
            dt:'',
            eccdStructureTypeList:{}
        }
    },

    methods:{
        loadEccdFacilityList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/ECCDFacilities'){
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
            this.$router.push({name:'edit_eccdfacility_type',params: {data:data}});
        },
        
        getEccdStructureType(uri = 'masters/getEccdStructureType'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.length;i++){
                    this.eccdStructureTypeList[data.data[i].id] = data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

    },
    mounted(){
        this.getEccdStructureType();
        this.loadEccdFacilityList();
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