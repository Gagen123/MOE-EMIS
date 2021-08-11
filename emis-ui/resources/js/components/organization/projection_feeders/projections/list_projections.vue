<template>
    <div>
        <table id="sport-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Class</th>
                    <th>No of Projection</th>
                    <th>Academic Year</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ classList[item.class]}}</td>
                    <td>{{ item.ProjectionNo}}</td>
                    <td>{{ item.academicYear}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="ProjectionEdit(item)"><i class="fas fa-edit"></i ></a>
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
            dataList:[],
            classList:{},
        }
    },

    methods:{
      loadDataList(uri='organization/loadProjections'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                }
            });
        },

        /**
         * method to view sport list
         */
        ProjectionEdit(data){
            data.action='edit';
            this.$router.push({name:'edit_projections',params: {data:data}});
        },

        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response;
                 for(let i=0;i<data.data.data.length;i++){
                    this.classList[data.data.data[i].id] = data.data.data[i].class; 
                }
               // this.classList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
    },
    mounted(){
        this.loadClassList();
        this.loadDataList();
        this.dt =  $("#sport-table").DataTable()
    },
    watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#sport-table").DataTable()
            });
        }
    },
}
</script>