<template>
       <div>
        <div class="form-group row mt-2">
            <div class="mx-3">
                <strong>Year:</strong>
                {{year}}
            </div>
            <div class="mr-3">
                <strong>Dzongkhag:</strong> {{dzongkhag}}
            </div>
            <div class="mr-3">
                <strong>School performance Status:</strong>
                <span v-if="status == 0">Not Assessed</span>
                <span v-if="status == 1">In Progress</span>
                <span v-if="status == 2">Completed</span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="evaluation-list-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>School</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in schoolLists" :key="index">
                            <td class="text-right">{{ index + 1}}</td>
                            <td>{{item.school}}</td>
                             <td>
                                <div v-if="status==0 && access_level=='Dzongkhag'" class="ml-2 mt-1 btn-group  btn-flat btn-group-sm">
                                    <router-link :to="{name:'create_school_performance', params: {data:item,year:year}}" class="btn btn-info btn-sm text-white"><i class="fa fa-plus"></i > Add Assessment</router-link>
                                </div>
                                <div v-else-if="status==1 && access_level=='Dzongkhag'" class="ml-2 mt-1 btn-group  btn-flat btn-group-sm">
                                    <router-link :to="{name:'edit_school_performance', params: {data:item,year:year}}" class="btn btn-info btn-sm text-white"><i class="fa fa-edit"></i > Edit Assessment</router-link>
                                </div>
                                <div v-else class="ml-2 mt-1 btn-group  btn-flat btn-group-sm">
                                    <router-link :to="{name:'view_school_performance', params: {data:item,year:year}}" class="btn btn-info btn-sm text-white"><i class="fa fa-eye"></i > View Assessment</router-link>
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
            dzon_id:'',
            dzongkhag:'',
            status:0,
            schoolLists:[],
            access_level:'',
            dt:'',
        }
    },
    methods:{
        getSchoolPerformaceList(){
            axios.get('spms/getSchoolPerformaceList/'+this.year+'/'+this.dzon_id+'/' +this.status)
            .then(response => { 
                this.schoolLists = response.data
            })
        },
    },
    mounted(){
         axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                this.access_level=data['acess_level'];
            })
            .catch(errors => {
                console.log(errors)
            });
        this.getSchoolPerformaceList()
        this.dt = $("#evaluation-list-table").DataTable({
             columnDefs: [
                { width: 50, targets: 0},
            ],
        })
    },
    created(){
        this.status=this.$route.params.status;
        this.dzon_id=this.$route.params.data.dzon_id;
        this.dzongkhag=this.$route.params.data.dzongkhag;
        this.year=this.$route.params.data.year;
    },
    watch: {
        schoolLists(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#evaluation-list-table").DataTable({
                    columnDefs: [
                        { width: 50, targets: 0},
                    ],
                })
            });
        }
    }
}
</script>