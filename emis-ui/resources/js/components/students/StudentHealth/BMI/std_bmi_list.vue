<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="bmi-list-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Term </th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Stream</th>
                            <th>Date of Measurement</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ item.project_type}}</td>
                            <td>{{ item.program_name}}</td>
                            <td>{{ item.FromDate}} - {{ item.ToDate}}</td>
                            <td>{{ item.place}}</td>
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
    components: {
    },
    data() {
        return {
            id:'2',
            dataList:[], 
        }
    },
    methods:{
        loadDataList(uri='students/loadBmiSummary/'+this.id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#bmi-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'std_bmi_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDataList();
    },
}
</script>


