<template>
    <div>
        <table id="studentaboard-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Student Name</th>
                    <th>Student Code</th>
                    <th>Class</th>
                    <th>School</th>
                    <th>Present Dzongkhag</th>
                    <th>Transfer to Dzongkhag</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="aboardtbody">
                <tr v-for="(item, index) in transferRequestList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.student_code }}</td>
                    <td></td>
                    <td>{{ item.organization_name }}</td>
                    <td>{{ dzongkhagArray[item.organization_dzo]}}</td>
                    <td>{{ dzongkhagArray[item.dzongkhag]}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewTransferRequest(item.student_code)"><i class="fas fa-edit"></i ></a>
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
            transferRequestList:[],
            countryList:{},
            dzongkhagArray:{}
        }
    },

    methods:{
        /**
         * method to load sport facility 
         */
        loadStudentList(uri = 'students/loadAdmissionRequest/0'){ 
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.transferRequestList =  data;
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

        getdzongkhagList(uri ='masters/loadGlobalMasters/all_active_dzongkhag'){
			axios.get(uri)
			.then(Response =>{
			let data = Response.data.data;
			for(let i=0;i<data.length;i++){
                    this.dzongkhagArray[data[i].id] = data[i].name;
                }
                $('#dzongkhag').prop('disabled',false);  
            }).catch(error => console.log(error));

		},

        /**
         * method to view sport list
         */
        viewTransferRequest(data){
            this.$router.push({name:'request_admission_view',params: {data:data}});
        },
    },
    mounted(){
        this.getdzongkhagList();
        this.loadStudentList();
    },
}
</script>