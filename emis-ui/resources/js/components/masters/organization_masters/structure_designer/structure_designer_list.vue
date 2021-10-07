<template>
   <div class="card-body overflow-auto">
        <table id="designer-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th style="width:5%">SL#</th>
                    <th style="width:20%">Designer Name</th>
                     <th style="width:10%">Code</th>
                    <th style="width:25%">Description</th>
                    <th style="width:10%">Status</th>
                    <th style="width:25%">Created At </th>
                    <th style="width:10%"> Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in designerList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{ item.created_at}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="editmasters(item)"><i class="fas fa-edit"></i ></a>
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
        // loadDesignerList(uri = 'masters/loadStructureDesigner'){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         this.designerList =  data.data;
        //     })
        //     .catch(function (error) {
        //         if(error.toString().includes("500")){
        //             $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
        //         }
        //     });
        //     setTimeout(function(){
        //         $("#designer-table").DataTable({
        //             "responsive": true,
        //             "autoWidth": true,
        //         }); 
        //     }, 300);  
        // },
        // viewDesignerList(data){
        //     data.action='edit';
        //     this.$router.push({name:'StructureDesignerEdit',params: {data:data}});
        // },
        loadDesignerList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/all/StructureDesigner'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.designerList =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        editmasters(data){
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