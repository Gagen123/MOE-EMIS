<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="nominaiton-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Position for</th>
                            <th>Position title</th>
                            <th>Apply From Date</th>
                            <th>Apply To Date</th>
                            <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.leadership_for }}</td>
                            <td>{{ item.position_title_name }}</td>
                            <td>{{ reverseDate1(item.from_date) }}</td>
                            <td>{{ reverseDate1(item.to_date)}}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadviewpage(item)"> <span class="fa fa-eye"></span> View</a>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-edit"></span> Edit</a>
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
        }
    },
    methods: {
        loadDataList(){
            axios.get('/staff/staffLeadershipSerivcesController/loadAllPosts')
            .then((response) =>{
                let data=response.data.data;
                this.data_list=data;
            })
            .catch((error) =>{
                console.log("Error: "+error);
            });
        },
        loadeditpage(itme){
            this.$router.push({name:"edit_announcement",params:{id:itme.id}});
        },

        loadviewpage(itme){
            this.$router.push({name:"view_announcement",params:{id:itme.id}});
        },
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });

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
