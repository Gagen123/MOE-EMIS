<template>
    <div>
        <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <tbody>
                <tr class="bg-cyan">
                    <td colspan="2"><b>Guidelines</b></td>
                </tr>
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index+1}})  </td>
                    <td>{{ item.guideline}}</td>
                </tr>
                <tr v-for='(role, index) in eccdworkflow' :key="'work'+index">
                    <td>ECCD Workflow</td>
                    <td>
                        <span v-html="role.AuthorityType"></span>
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
            dataList:[],
            eccdworkflow:[],
        }
    },
    methods:{
        loadguidelieList(uri = 'masters/all_active_dropdowns/guidelines/Organization_Establishment'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        showedit(data){
            this.$router.push({name:'student_type_edit',params: {data:data}});
        },
        loadworkflowList(uri = 'getworkflows/workflow_eccd_centre/ECCD_School'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.eccdworkflow = data;
            });
        },
    },
    mounted(){
        this.loadguidelieList();
        this.loadworkflowList();
    },
}
</script>
