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
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dataList:[],
        }
    },
    methods:{
        loadguidelieList(uri = 'masters/all_active_dropdowns/guidelines/Data_Import'){
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
    },
    mounted(){
        this.loadguidelieList();
    },
}
</script>
