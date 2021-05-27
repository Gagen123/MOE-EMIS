<template>
    <div>
        <table id="designer-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Designer Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in designerList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewDesignerList(item)"><i class="fas fa-edit"></i ></a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

,<script>
export default {
    data(){
        return{
            designerList:[],
            des: '',
        }
    },

    methods:{
        loadDesignerList(uri = 'masters/loadStructureDesigner'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.designerList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#designer-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewDesignerList(data){
            data.action='edit';
            this.$router.push({name:'StructureDesignerEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadDesignerList();
        this.des =  $("#designer-table").DataTable();

    },
    watch: {
        designerList(){
            this.des.destroy();
            this.$nextTick(() => {
                this.des =  $("#designer-table").DataTable()
            });
        }
    },
}
</script>