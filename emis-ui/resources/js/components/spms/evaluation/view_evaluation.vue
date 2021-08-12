<template>
    <div>
        <form class="bootbox-form" >
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                    <table id="view-evaluation-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Domain</th>
                                <th>Area</th>
                                <th>Parameter</th>
                                <th>Output Indicator</th> 
                                <th>Score</th> 
                                <th>Score Description</th> 
                                <th>Remarks</th> 
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item,index) in evalaution_details" :key="index">
                                <td class="text-right">{{index + 1}}</td>
                                <td>{{item.domain}}</td>
                                <td>{{item.area}}</td>
                                <td>{{item.parameter}}</td>
                                <td>{{item.indicator}}</td>
                                <td class="text-right">{{item.score }} </td>
                                <td>{{item.score_description}}</td>
                                <td>{{item.deo_remarks}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>  
</template>
<script>
export default {
    data(){
        return {
            domains:[],
            areas:[],
            parameters:[],
            evaluation:[],
            evalaution_details:[],
            status:[],
            ratings:[]
        }
    },
    methods:{
        async getEvaluation(){
            let uri = 'spms/getEvaluation/'+this.org_id+'/'+this.spm_domain_subcat_id
            let data = await axios.get(uri).then(response => {return response.data.data})
            this.evaluation = data.evaluation
            this.evalaution_details = data.evaluationDetails
        },
    },
    created(){
        this.org_id =this.$route.params.data.org_id
        this.spm_domain_subcat_id =this.$route.params.data.spm_domain_subcat_id

    },
    mounted(){
        
        this.getEvaluation()
        this.dt = $("#view-evaluation-table").DataTable({
             columnDefs: [
                { width: 20, targets: 0},
                { width: 10, targets: 1},
                { width: 50, targets: 2},
                { width: 150, targets: 3},
                { width: 300, targets: 4},
                { width: 20, targets: 5},
                { width: 300, targets: 6},
                { width: 200, targets: 7},
            ],
        });
        
    },
    watch: {
        evalaution_details(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#view-evaluation-table").DataTable()
            });
        }
    }
}
</script>