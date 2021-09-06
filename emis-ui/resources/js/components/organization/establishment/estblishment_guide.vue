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
                <tr v-for='(role, index) in eccdworkflow' :key="'eccd'+index">
                    <td>ECCD Workflow</td>
                    <td>
                        <span v-html="role.AuthorityType"></span>
                    </td>
                </tr>
                <tr v-for='(role, index) in privateworkflow' :key="'private'+index">
                    <td>Private School Workflow</td>
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
            privateworkflow:[],
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
        async loadworkflowList(type){
            let returtype='';
            let uri = 'getworkflows/'+type;
            await axios.get(uri)
            .then(response => {
                returtype= response.data;
            });
            return returtype;
        },
    },
    async mounted(){
        this.loadguidelieList();
        this.eccdworkflow = await this.loadworkflowList('workflow_eccd_centre/ECCD_School');
        this.privateworkflow = await this.loadworkflowList('workflow_private_school/Private_School');
    },
}
</script>
