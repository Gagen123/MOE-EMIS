<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="nominaiton-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Selection For</th>
                            <th>Position</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ selectionList[item.selection_type] }}</td>
                            <td>{{ item.position_title }}</td>
                            <td>{{ item.from_date }}</td>
                            <td>{{ item.to_date }}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View</a>
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
        getfeedbackdetails(){
            let uri = '/staff/staffLeadershipSerivcesController/checkforfeedbackLink'
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.data_list=data;
            })
            .catch(function (error) { 
                console.log(error);
            });
        },
        getSelectionList(uri = 'questionAnswers/loadQuestionaries/loadServices_Leadership_Service'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.selectionList[data.data.data[i].id] = data.data.data[i].name; 
                }
            })
            .catch(function (error){
                console.log('err: '+error);
            });
        },
        loadeditpage(itme){ 
            this.$router.push({name:"open_feedback",params:{data:itme.id}});
        },
    },
    mounted(){
        this.getSelectionList();
        this.getfeedbackdetails();
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