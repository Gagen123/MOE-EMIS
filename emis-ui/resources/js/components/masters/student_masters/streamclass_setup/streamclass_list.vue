<template>
    <div>
        <table id="streamclass-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Stream</th>
                    <th >Subject</th>
                    <th >Min. Marks Required</th>
                    <th >Min. Grade Required</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in streamclass" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{StreamName[item.streamId]}}</td>
                    <td >{{SubjectDropdown[item.aca_sub_id]}} </td>
                    <td >{{item.marks}} </td>
                    <td >{{item.grade}} </td>
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
            streamclass:[],
            SubjectDropdown:{},
            StreamName:{},
        }
    },
    methods:{
        loadsubjectList(){
            axios.get('masters/loadClassSubject/' +this.class_id)
            .then(response => {
                let data = response.data.data;
                 for(let i=0;i<data.length;i++){
                    this.SubjectDropdown[data[i].aca_sub_id] =data[i].subject;
                }
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadstreammarks(uri = '/masters/loadstreamMarks'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.streamclass =  data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="5" class="text-center text-danger text-bold">Seems this server is down. Please try later</td></tr>');
                }
            });
        },
        loadStreamList(uri = 'masters/loadStream'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                for(let i=0;i<data.length;i++){
                    this.StreamName[data[i].id] =data[i].stream;
                }
                this.getSubjectlist(data[0].id);
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'streamclass_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadStreamList();
        this.loadsubjectList();
        this.loadstreammarks();
        
        this.dt =  $("#streamclass-table").DataTable()
     
    },
    watch: {
        streamclass(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#streamclass-table").DataTable()
            });
        }
    },
}
</script>
