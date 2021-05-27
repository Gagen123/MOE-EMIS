<template>
    <div>
        <table id="section-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>School Name</th>
                    <th>Level</th>
                    <th>class</th>
                    <th>No. of Section</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="sectiondata">
                <tr v-for="(item, index) in sectionList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.organization}}</td>
                    <td>{{ item.level}}</td>
                    <td>{{ item.class}}</td>
                    <td>{{ item.noOfsection}} </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewSectionList(item.id)"><i class="fas fa-edit"></i ></a>
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
            sectionList:[],
            dt:'',
        }
    },
    methods:{
        loadSectionList(uri = 'organization/getOrgList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sectionList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#sectiondata').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#section-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        viewSectionList(data){
            this.$router.push({name:'SectionAdd',query: {data:data}});
        },
    },
    mounted(){
        this.loadSectionList();
        this.dt =  $("#section-table").DataTable();

    },
    watch: {
        sectionList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#section-table").DataTable()
            });
        }
    },
}
</script>