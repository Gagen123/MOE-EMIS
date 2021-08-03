<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="rating-data-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Domain</th>
                            <th>Area</th>
                            <th>Parameter</th>
                            <th>Indicator</th>
                            <th>Score</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in ratings" :key="index">
                            <td class="text-right">{{ index + 1 }}</td>
                            <td>{{ item.domain }} </td>
                            <td>{{ item.area }} </td>
                            <td>{{ item.parameter }} </td>
                            <td>{{ item.indicator }} </td>
                            <td class="text-right">{{ item.score }} </td>
                            <td>{{ item.description }}</td>
                            <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>

                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
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
            ratings:[],
            dt:''
        }
    },
    methods:{
        getRatings(uri = 'masters/loadSpmMasters/all_ratings'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.ratings =  data.data.data
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_rating',params: {data:data}})
        },
    },
    mounted(){ 
        this.getRatings();
        this.dt =  $("#rating-data-table").DataTable({
            columnDefs: [
                { width: 10, targets: 0},
                { width: 100, targets: 2},
                { width: 500, targets: 4},
                { width: 50, targets: 2},
                { width: 10, targets: 5},
                { width: 300, targets: 6},
                { width: 20, targets: 7},
                { width: 20, targets: 8},




            ],
        })
    },
    watch: {
        ratings(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#rating-data-table").DataTable()
            });
        }
    }
}
</script>
