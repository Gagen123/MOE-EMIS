<template>
    <div>
        <table id="infrastructure-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Eccd Category Type</th>
                    <th>Type of Structure</th>
                    <th>Year of Construction</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in infrastructureList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.structuretype}}</td>
                    <td>{{ item.constructionType}}</td>
                    <td>{{ item.yearOfConstruction}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewInfrastructureList(item)"><i class="fas fa-edit"></i ></a>
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
            infrastructureList:[],
            // structureType:{},
            // eccdfacilityList:{}
        } 
    },

    methods:{
        loadEccdInfrastructureList(uri = 'organization/loadEccdInfrastructureList/null'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.infrastructureList = data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#infrastructure-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewInfrastructureList(data){
            data.action='edit';
            this.$router.push({name:'EccdInfrastructureEdit',params: {data:data}});
        },
    },
    getStructureTypeInDropdown(uri = '/organization/getStructureTypeInDropdown'){
        axios.get(uri)
        .then(response => {
            // let data = response.data;
            // this.structureType = data;
            for(let i=0;i<data.data.data.length;i++){
                this.structureType[data.data.data[i].id] = data.data.data[i].name;
            }
        });
    },
    geteccdFacilityDropdown(uri = '/organization/geteccdStructureFacilityInDropdown/'+this.form.structuretype){
            axios.get(uri)
            .then(response => {
              //  alert(JSON.stringify(response));
              for(let i=0;i<data.data.data.length;i++){
                this.eccdfacilityList[data.data.data[i].id] = data.data.data[i].name;
            }
               
            });
        },
    mounted(){
        this.loadEccdInfrastructureList();
        this.getStructureTypeInDropdown();
        this.geteccdFacilityDropdown();
    },
}
</script>