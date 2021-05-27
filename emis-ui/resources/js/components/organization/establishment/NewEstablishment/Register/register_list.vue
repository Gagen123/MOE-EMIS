<template>
    <div>
        <table id="register-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Category</th>
                    <th>Code</th>
                    <th>Dzongkhag</th>
                    <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in data_list" :key="index">
                    <td>{{ index+1}}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ levelArray[item.levelId] }}</td>
                    <td>{{ item.category }}</td>
                    <td>{{ item.code }}</td>
                    <td>{{ dzoArray[item.dzongkhagId] }}</td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View</a>
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
            dt:'',
            data_list:[],
            levelArray:{},
            dzoArray:{},
        } 
    },
    methods: {
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name; 
                }
            });
        },
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzoArray[data[i].id] = data[i].name; 
                }
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        loadeditpage(item){
            this.$router.push({name:"edit_register",query:{org_id:item.id}});
        }
    },
    mounted(){
        this.getLevel();
        this.loaddzongkhagList();
        this.dt =  $("#register-table").DataTable();
        axios.get('loadCommons/loadOrgList/allorganizationList/allData')
        .then((response) => {  
            this.data_list=response.data.data;
        })
        .catch((error) =>{  
            console.log("Error:"+error);
        });
    },
    watch: {
        data_list() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#register-table").DataTable()
            });
        }
    },
}
</script>