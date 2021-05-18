<template>
    <div>
        <table id="attachment-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Attachment Name</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in attachmentList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewAttachmentList(item)"><i class="fas fa-edit"></i ></a>
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
            attachmentList:[],
            dt:'',
        }
    },

    methods:{
        loadAttachmentList(uri = 'masters/loadAttachment'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.attachmentList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#attachment-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewAttachmentList(data){
            data.action='edit';
            this.$router.push({name:'AttachmentEdit',params: {data:data}});
        },

    },
    mounted(){
        this.loadAttachmentList();
        this.dt =  $("#transfer-table").DataTable()
    },
    
    watch: {
        attachmentList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#transfer-table").DataTable()
            });
        }
    },
}
</script>