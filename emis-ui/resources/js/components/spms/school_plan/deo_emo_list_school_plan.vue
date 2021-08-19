<template>
       <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                <table id="deo-emo-school-plan-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Dzongkhags</th>
                            <th>School</th>
                            <th>School Plan Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in dzongkhagWithSchools" :key="index">
                            <td><strong>{{item.dzongkhag}} </strong></td>
                            <td>{{item.school}}</td>
                            <td>
                                <span v-if="item.hasPlan==1">
                                    Prepared
                                </span>
                                <span v-else>
                                     Not Prepared
                                </span>
                            </td>
                            <td>
                                <div v-if="item.hasPlan==1" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-eye"></i > View</div>
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
            dzongkhagWithSchools:[],
            dt:'',
        }
    },
    methods:{
        getSchoolPlans(){
            axios.get('spms/loadOrgList')
            .then(response => { 
               this.dzongkhagWithSchools = response.data
            }).catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'list_annual_school_plan',params: {data:data}});
        },
    },
    mounted(){
        this.getSchoolPlans()
        this.dt = $("#deo-emo-school-plan-table").DataTable({
            rowGroup: {
                    dataSrc: 0 
            },
            columnDefs: [{
                targets:  0,
                visible: false
            }],
            destroy: true,
            })
    },
    watch: {
        dzongkhagWithSchools(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#deo-emo-school-plan-table").DataTable({
                    rowGroup: {
                        dataSrc: 0 
                    },
                    columnDefs: [{
                        targets:  0,
                        visible: false
                    }],
                    destroy: true,
                })
            });
        }
    }
}
</script>