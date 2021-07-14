<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Created Date</th>
                    <th>Average Scores</th>
                    <th>Prepared By</th>
                    <th>Endrosed By</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(itm, index) in dietaryList" :key="index">
                    <td> {{index + 1}}</td>
                    <td> {{itm.created_at}}</td>
                    <td> {{itm.average_score}}</td>
                    <td> {{itm.prepared_by}}</td>
                    <td> {{itm.endrosed_by}}</td>
                    <td> {{itm.remarks}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadpage(itm.id,'view')"><i class="fas fa-eye"></i > View</a>
                        </div>
                        <!-- <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadpage(itm.id,'edit')"><i class="fas fa-edit"></i > Edit</a>
                        </div> -->
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
            dietaryList:[],
        }
    },
    methods:{
        loadDietaryList(org_id){
            let uri="diatery/getdiatery/"+org_id;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dietaryList=data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadpage(id,type){
            if(type=="edit"){
                this.$router.push({name:'edit_dietary_records',query: {id:id}});
            }
            else{
                this.$router.push({name:'view_dietary_records',query: {id:id}});
            }
        },
    },
    mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.loadDietaryList(data['Agency_Code']);
        })
        .catch(errors => {
            console.log(errors)
        });
    },
}
</script>
