<template>
    <div>
        <form class="bootbox-form" >
            <div class="form-group row mt-2">
                <div class="ml-3">
                    <strong>Year: </strong> {{year}}
                </div>
                 <div class="ml-3">
                    <strong>School: </strong> {{ school }} 
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
                    <table id="create-evaluation-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Domain</th>
                                <th>Area</th>
                                <th>Parameter</th>
                                <th>Output Indicator</th> 
                                <th>Rating</th> 
                                <th>MoV</th> 
                                <th>Remarks</th> 
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item,index) in evalaution_details" :key="index">
                                <td>{{item.domain}}</td>
                                <td>{{item.area}}</td>
                                <td>{{item.parameter}}</td>
                                <td>{{item.indicator}}</td>
                                <td> <strong>{{item.score}}:</strong> {{item.score_description}}</td>
                                <td>{{item.mov}}</td>
                                <td>{{item.remarks}}</td>
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
            dzon_id:'',
            org_id:'',
            school:'',
            year:'',
            sub_category_name:'',
            domains:[],
            areas:[],
            parameters:[],
            evaluation:[],
            evalaution_details:[],
            status:0,
            ratings:[],
            evaluation_id:'',
            currentRoute:this.$route.name
        }
    },
    methods:{
        async getEvaluation(){
            let uri = 'spms/getEvaluation/'+this.org_id+'/'+this.year
            let data = await axios.get(uri).then(response => {return response.data.data})
            this.evaluation = data.evaluation
            this.evalaution_details = data.evaluationDetails
            this.ratings = await axios.get('masters/loadSpmMasters/all_active_ratings').then(response => { return response.data.data })
        },
        save(action=""){
           let validated=true;
            let evalaution_details = this.evalaution_details.filter(item => item.score) 
            if(action == 'draft'){
                this.status = 1 
            }else if(action == 'completed'){
                validated=this.validateRadioButton();
                this.status = 2
            }
            if(validated == true){
                axios.post('spms/saveEvaluation', {data:evalaution_details,evaluation_id:this.evaluation_id,org_id:this.org_id,status:this.status,dzon_id:this.dzon_id,year:this.year})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/school-performance-dashboard');
                }).catch(function(errors){
                    if(errors.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'All the fields are required!',
                        })
                    }
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Give all the rating to submit',
                })
            }
        },
        validateRadioButton(){
            let returntype = true;
            for(let i=0;this.evalaution_details.length>i;i++){
                let selected = $("input[name='score_"+i+"']:checked").val();
                if(selected == undefined){
                    returntype = false;
                    break;
                }
            }
            return returntype;
        }

    },
    created(){
        this.org_id =this.$route.params.data.school_id
        this.school =this.$route.params.data.school
        this.year =this.$route.params.year,
        this.dzon_id =this.$route.params.data.dzon_id
        this.evaluation_id = this.$route.params.data.evaluation_id
    },
    mounted(){
        
        this.getEvaluation()
        this.dt = $("#create-evaluation-table").DataTable({
            rowGroup: {
                dataSrc: [0,1] 
            },
            columnDefs: [
                {targets:  [0,1],visible: false},
            ],
            destroy: true,
        });
        
    },
    watch: {
        evalaution_details(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#create-evaluation-table").DataTable({
                    rowGroup: {
                        dataSrc: [0,1] 
                    },
                    columnDefs: [
                        {targets:  [0,1],visible: false},
                    ],
                    destroy: true,
                })
            });
        }
    }
}
</script>