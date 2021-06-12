<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Vaccine Type</th>
                            <th>Date of Vaccination</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ item.amountGenerated}}</td>
                            <td>{{ item.date}}</td>
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
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{ 
            totle:0,
        } 
    },
    methods: {
       loadIncomeList(uri='organization/loadIncomeInformation/'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_income_information',params: {data:data}});
        },
    },
    mounted() {
        $("#training-table").DataTable({
            "responsive": true,
            "autoWidth": true,
        }); 
    },
    
}
</script>


