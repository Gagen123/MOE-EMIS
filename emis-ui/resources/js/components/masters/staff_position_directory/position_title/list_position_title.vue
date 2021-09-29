<template>
    <div class="card-body">
        <table id="position_title_table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <!-- <th >Group Name</th>
                    <th >Sub Group Name</th> -->
                    <th >Position Level</th>
                    <th >Position Title</th>
                    <th >Description</th>
                    <th >Status</th>
                    <th >Code</th>
                    <th >Created Date</th>
                    <th class="pl-4 pr-5">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in positiontitleList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <!-- <td>{{ item.majorgroup}}</td>
                    <td>{{ item.submajorgroup.name}}</td> -->
                    <td>{{ item.p_level ? item.p_level : "" }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            positiontitleList:[],
            dt:'',
        }
    },
    methods:{
        loadpositionTitleList(uri = 'staff/loadStaffMasters/PositionTitle/PositionTitle'){
        // loadpositionTitleList(uri = 'masters/loadStaffMasters/all_position_title_List'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.positiontitleList =  data.data.data;
            })
        },
        showedit(data){
            this.$router.push({name:'edit_position_title',params: {data:data}});
        },
    },

    mounted(){
        this.loadpositionTitleList();
        this.dt =  $("#position_title_table").DataTable()
    },
    watch: {
        positiontitleList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#position_title_table").DataTable()
            });
        }
    },
}
</script>
