<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Visitor Name</th>
                    <th> Designation</th>
                    <th>Ministry/Agency</th>
                    <th>Department/Division</th>
                    <th>Date of Visit</th>
                    <th >Purpose of Visit</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.visitorname}}</td>
                    <td>{{ item.designation}}</td>
                    <td>{{ item.minitsryOrAgency}}</td>
                    <td>{{ item.deptOrdivision}}</td>
                    <td>{{ item.dateOfVisit}}</td>
                    <td>{{ item.purposeOfvisit}}</td>
                   
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
            org_id:'2',
            dataList:[],  
            visitorArray:{},
        }
    },
    methods:{
        loadDataList(uri='organization/loadVisitorInformation'){
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
            this.$router.push({name:'edit_visitors_information',params: {data:data}});
        },

        getVisitorTypeDropdown(uri = '/organization/getVisitorTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.visitorArray[data.data.data[i].id] = data.data.data[i].name; 
                }
            });
        },
    },
    mounted(){
        this.getVisitorTypeDropdown();
        this.loadDataList();
    },
}
</script>
