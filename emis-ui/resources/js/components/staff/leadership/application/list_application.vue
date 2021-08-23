<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="nominaiton-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Application Number</th>
                            <th>Position for</th>
                            <th>Position title</th>
                            <th>Applied On</th>
                            <th>Status</th>
                            <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.application_number }}</td>
                            <td>{{ item.LeadershipType }}</td>
                            <td>{{ item.Positiontitle }}</td>
                            <td>{{ item.created_at }}</td>
                            <td>{{ item.status }}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadviewpage(item)"> <span class="fa fa-eye"></span> View</a>
                                <a href="#" v-if="item.status=='Submitted'" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-edit"></span> Edit</a>
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
            selectionList:{},
            data_list:[],
        }
    },
    methods: {
        loadDataList(){
            axios.get('/staff/staffLeadershipSerivcesController/loadAllApplication')
            .then((response) =>{
                let data=response.data.data;
                this.data_list=data;
            })
            .catch((error) =>{
                console.log("Error loadDataList: "+error);
            });
        },
        getSelectionList(uri = 'staff/staffLeadershipSerivcesController/loadData/allData_LeadershipType'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.selectionList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log('err getSelectionList: '+error);
            });
        },

        loadeditpage(itme){
            this.$router.push({name:"edit_application",params:{id:itme.id}});
        },

        loadviewpage(itme){
            this.$router.push({name:"view_application",params:{id:itme.id}});
        },
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        this.getSelectionList();
        this.loadpositionTitleList();

        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.loadDataList();
        this.dt =  $("#nominaiton-table").DataTable();

    },
    watch: {
        data_list(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#nominaiton-table").DataTable()
            });
        }
    },
}
</script>
