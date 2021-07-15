<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Counselling Type</th>
                    <th >Total Male Students</th>
                    <th >Total Female Students</th>
                    <th >Age Range</th>
                    <th >Class Range</th>
                    <th >Remarks</th>
                    <th >Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.counselling_name}}</td>
                    <td>{{ item.male}}</td>
                    <td>{{ item.female}}</td>
                    <td>{{ item.AgeRange}}</td>
                    <td>{{ item.ClassRange}}</td>
                    <td>{{ item.remarks}}</td>
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
            counsellingTypeList:{},
        }
    },
    methods:{
        loadDataList(uri='students/loadCounsellingInformation'){
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
            this.$router.push({name:'edit_counselling_records',params: {data:data}});
        },

        getCounsellingTypeDropdown(uri = '/students/getCounsellingTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.counsellingTypeList[data.data.data[i].id] = data.data.data[i].name; 
                }
            });
        },
    },
    mounted(){
        this.getCounsellingTypeDropdown();
        this.loadDataList();
    },
}
</script>
