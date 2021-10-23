<template>
    <div class="card-body">
        <table id="village-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Dzongkhag</th>
                    <th >Gewog</th>
                    <th >Village Name</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in villageList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.dzothroughgewog.name}}</td>
                    <td>{{ item.gewog.name}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{reverseDateTime(item.created_at)}}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        <!-- <a v-if="item.status==  1" href="#" @click="changestatus(item.id,'0')" class="btn btn-danger btn-sm btn-flat text-white"><i class="fas fa-times"></i> Deactivate</a>
                        <a v-if="item.status==  0" href="#" @click="changestatus(item.id,'1')" class="btn btn-primary btn-sm btn-flat text-white"><i class="fas fa-check"></i> Activate</a> -->
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
            villageList:[],
            dt:'',
        }
    },
    methods:{
       loadvillageList(uri = 'masters/loadGlobalMasters/all_village_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.villageList =  data.data.data;
            })
            .catch(function (error) {
               console.log('error: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'edit_village',params: {data:data}});
        },

    },
    mounted(){
        this.loadvillageList();
        this.dt =  $("#village-table").DataTable()
    },
    watch: {
        villageList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#village-table").DataTable()
            });
        }
    },
}
</script>
