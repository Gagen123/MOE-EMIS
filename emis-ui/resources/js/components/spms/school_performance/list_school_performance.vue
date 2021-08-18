<template>
       <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                <table id="evaluation-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>School</th>
                            <th>Domain Category</th>
                            <th>Status</th>
                            <th>Score</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in schoolsScores" :key="index">
                            <td class="text-right">{{ index + 1}}</td>
                            <td>{{item.school}}</td>
                            <td>{{item.sub_category_name}}</td>
                            <td>{{item.status}}</td>
                            <td class="text-right">{{item.score}}</td>
                             <td>
                                <div v-if="item.spm_indicator_id == null && item.status_id==0" class="ml-2 mt-1 btn-group  btn-flat btn-group-sm">
                                    <router-link :to="{name:'create_school_performance', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-plus"></i > Add</router-link>
                                </div>
                                <div v-else-if="item.status_id == 1" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                
                                <div v-else class="ml-2 mt-1 btn-group  btn-flat btn-group-sm">
                                    <router-link :to="{name:'view_school_performance', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-eye"></i > View</router-link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return {
            total_no_of_schools:'',
            schoolsScores:[],
            currentRoute:this.$route.name,
            dt:'',
        }
    },
    methods:{
        async getSchoolData(){
            let dzo_id = await axios.get('common/getSessionDetail').then(response => {return response.data.data.Dzo_Id})
            let schools = await this.schoolList(dzo_id)
            let uri = 'spms/getSchoolDoeDetails/'+this.spm_domain_subcat_id
            if(this.status != null && this.status != ""){
               uri += '/' +this.status 
            }
            let schools_deo = await axios.get(uri).then(response => { return response.data})
            schools_deo.forEach((item,index) => {
                schools.forEach(item1 => {
                    if(item.org_id == item1.id){
                        schools_deo[index]['school'] = item1.name
                        schools_deo[index]['score'] = schools_deo[index]['score'] === null ? 'NA' : item.score
                    }
            })
         })
         this.schoolsScores = schools_deo
        },
        showedit(data){
            this.$router.push({name:'edit_school_performance',params: {data:data}});
        },
    },
    mounted(){
        this.getSchoolData()
        this.dt = $("#evaluation-table").DataTable({
             columnDefs: [
                { width: 50, targets: 0},
                { width: 100, targets: 1},
                { width: 200, targets: 3},
                { width: 100, targets: 4},


            ],
        })
    },
    created(){
        this.status=this.$route.params.data.status;
        this.spm_domain_subcat_id=this.$route.params.data.spm_domain_subcat_id;

    },
    watch: {
        schoolsScores(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#evaluation-table").DataTable()
            });
        }
    }
}
</script>