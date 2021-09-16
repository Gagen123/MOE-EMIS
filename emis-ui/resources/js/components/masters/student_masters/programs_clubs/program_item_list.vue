<template>
    <div>
        <table id="item-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Item Name</th>
                    <th >Unit</th>
                    <th >Code</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Created At</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in itemList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ measurementList[item.Unit_id]}}</td>
                    <td>{{ item.Code}}</td>
                    <td>{{ item.Description}}</td>
                    <td>{{ item.Status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
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
            measurementList:{},
            itemList:[],
        }
    },
    methods:{
        loadProgramItemList(uri = 'masters/loadStudentMasters/CeaProgramItem'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.itemList =  data.data.data;
            })
            .catch(function (error) {
               console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'ProgramItemEdit',params: {data:data}});
        },
        loadMeasurementList(uri = 'masters/loadStudentMasters/CeaProgramMeasurement'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.measurementList[data.data.data[i].id] = data.data.data[i].Name;
                }
                // this.measurementList =  data.data.data;
            })
            .catch(function (error) {
               console.log(error);
            });
        },
    },
    mounted(){
        this.loadMeasurementList();
        this.loadProgramItemList();
    },
}
</script>
