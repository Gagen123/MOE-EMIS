<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="responsible-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Remarks</th>
                            <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.year}}</td>
                            <td>{{ months[item.month]}}</td>
                            <td>{{ item.remarks}}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)">View/Edit</a>
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
            data_list:[],
            months:{1:'January',2:'Febuary',3:'March',4:'April',5:'May',6:'June',
            7:'July',8:'August',9:'September',10:'October',11:'November',12:'December'}
        } 
    },
    methods: {
        loadDataList(uri = 'staff/staffServices/loadStaffattendance'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.data_list = data; 
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        loadeditpage(itme){
            this.$router.push({name:"edit_attendance",params:{data:itme.id}});
        }
    },
    created(){
        this.dt =  $("#award-table").DataTable();
        this.loadDataList();
    },
    watch: {
        data_list(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#responsible-table").DataTable()
            });
        }
    },
}
</script>