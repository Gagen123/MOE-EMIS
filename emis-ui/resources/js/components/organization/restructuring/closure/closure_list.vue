<template>
    <div>
        <table id="closure-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>School Name</th>
                    <th>Category</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in closureList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.category  == 1 ? "Public" :  "Private & Others"}}</td>
                    <td>{{ item.level}}</td>
                    <td>{{ item.status == 1 ? "Active" : "Inactive"}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewClosureList(item.id)"><i class="fas fa-edit"></i ></a>
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
            closureList:[],
        }
    },
    methods:{
        loadClosureList(dzo_id){
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.closureList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },

         viewClosureList(data){
            this.$router.push({name:'ClosureAdd',query: {data:data}});
        },
    },

    mounted(){
         axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.loadClosureList(data['Dzo_Id']);
        })    
        .catch(errors => { 
            console.log(errors)
        });
    },
}
</script>