<template>
<div>
    <table id="term-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Term Type</th>
                    <th>Status</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in termList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewTermList(item)"><i class="fas fa-edit"></i ></a>
                            <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
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
            termList:[],
        }
    },

    methods:{
        loadTermList(uri = 'masters/loadTerm'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.termList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#term-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        viewTermList(data){
            data.action='edit';
            this.$router.push({name:'TermEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadTermList();
    },
}
</script>