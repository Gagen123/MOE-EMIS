<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Date</th>
                    <th>Scores</th>
                    <th>Remarks</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody v-if="showmess">
                <tr v-for="(itm, index) in dietaryList" :key="index">
                    <td> {{index + 1}}</td>
                    <td> {{itm.record_date}}</td>
                    <td> {{itm.total_score}}</td>
                    <td> {{itm.remarks}}</td>
                    <td> {{itm.status}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadpage(itm.id,'view')"><i class="fas fa-eye"></i > View</a>
                        </div>
                        <!-- <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadpage(itm.id,'edit')"><i class="fas fa-edit"></i > Edit</a>
                        </div> -->
                    </td>
                </tr>
            </tbody>

            <tbody v-if="showprincipaltask">
                <tr v-for="(itm, index) in dietaryList" :key="index">
                    <td> {{index + 1}}</td>
                    <td> {{itm.record_date}}</td>
                    <td> {{itm.total_score}}</td>
                    <td> {{itm.remarks}}</td>
                    <td> {{itm.status}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadpage(itm.id,'verify')"><i class="fas fa-edit"></i > Open</a>
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
            showmess:false,
            showprincipaltask:false,
            dietaryList:[],
        }
    },
    methods:{
        loadDietaryList(type){
            let uri="diatery/getdiatery/"+type;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.dietaryList=data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        loadpage(id,type){
            if(type=="edit"){
                this.$router.push({name:'edit_dietary_records',query: {id:id}});
            }
            else{
                this.$router.push({name:'view_dietary_records',query: {id:id,type:type}});
            }
        },
    },
    mounted(){
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            let roleName="";
            for(let i=0;i<data['roles'].length;i++){
                if(i==data['roles'].length-1){
                    roleName+=data['roles'][i].roleName;
                }
                else{
                    roleName+=data['roles'][i].roleName+', ';
                }
            }
            if(roleName.toLowerCase().includes('mess')){
                this.showmess=true;
                this.loadDietaryList('Creater');
            }
            if(roleName.toLowerCase().includes('principal') && !roleName.toLowerCase().includes('assistant') && !roleName.toLowerCase().includes('vice')){
                this.showprincipaltask=true;
                this.loadDietaryList('OrgWise');
            }
        })
        .catch(errors =>{
            console.log(errors)
        });
    },
}
</script>
