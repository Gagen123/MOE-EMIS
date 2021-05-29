<template>
    <div>
        <table id="studentaboard-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Student Name</th>
                    <th>Date of Birth</th>
                    <!-- <th>Gender</th> -->
                    <th>Country</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="aboardtbody">
                <tr v-for="(item, index) in aboradList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.first_name}} {{ item.middle_name}} {{item.last_name}}</td>
                    <td>{{ item.dob }}</td>
                    <!-- <td>{{ item.sex_id}}</td> -->
                    <td>{{ countryList[item.country]}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewAboardList(item)"><i class="fas fa-edit"></i ></a>
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
            aboradList:[],
            countryList:{},
        }
    },

    methods:{
        /**
         * method to load sport facility 
         */
        loadAboardList(uri = 'students/loadAboardList/null'){ 
            axios.get(uri)
            .then(response => {
                let data = response;
                this.aboradList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#aboardtbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#studentaboard-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        loadactivecountryList(uri="masters/loadGlobalMasters/all_country"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.countryList[data.data.data[i].id] = data.data.data[i].country_name; 
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to view sport list
         */
        viewAboardList(data){
            data.action='edit';
            this.$router.push({name:'StudentAboardEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadactivecountryList();
        this.loadAboardList();
        

    },
}
</script>