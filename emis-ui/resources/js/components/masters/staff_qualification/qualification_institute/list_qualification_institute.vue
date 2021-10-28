<template>
    <div class="card-body">
        <table id="working-agency-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th >SL#</th>
                    <th >Country</th>
                    <th >Institute</th>
                    <th >Description</th>
                    <th >Code</th>
                    <th >Status</th>
                    <th >Created Date</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in qualificationTypeList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ countryArray[item.country_id]}}</td>
                    <td>{{ item.name}}</td>
                    <td>{{ item.description}}</td>
                    <td>{{ item.code}}</td>
                    <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                    <td>{{reverseDateTime(item.created_at)}}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
            countryArray:{},
            qualificationTypeList:[],
            dt:'',
        }
    },
    methods:{
        async loadqualificationtype(){
            this.qualificationTypeList =  await this.loadstaffMasters('all','Institute');
        },
        showedit(data){
            this.$router.push({name:'edit_qualification_institute',params: {data:data}});
        },
    },
    mounted(){
        let uri = 'masters/loadGlobalMasters/all_country';
        axios.get(uri)
        .then(response => {
            let data = response;
            // this.countryList =  data.data.data;
            for(let i=0;i<data.data.data.length;i++){
                this.countryArray[data.data.data[i].id] = data.data.data[i].country_name;
            }
            this.loadqualificationtype();
        })
        .catch(function (error) {
            console.log('error: '+error);
        });
        this.dt =  $("#working-agency-table").DataTable()
    },
    watch: {
        qualificationTypeList(val) {
            this.applydatatable('working-agency-table');
        }
    },
}
</script>
