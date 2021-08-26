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
                                <td> 
                                    <template v-for="(item1,index4) in ratings">
                                        <div :key="index4" v-if="item.spm_indicator_id == item1.spm_indicator_id">
                                            <input type="radio" :value="item1.score" v-model="evalaution_details[index].score" :name="'score_'+index">
                                            <strong>{{item1.score}}</strong> -
                                            {{item1.description}}
                                        </div>
                                    </template>
                                </td>
                                <td>{{item.mov}}</td>
                                <td>
                                    <textarea v-model="evalaution_details[index].remarks" rows="4" class="form-control"></textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button @click.prevent="save('draft')" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-save"></i> Save as Draft</button>
                <button @click.prevent="save('completed')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Completed (Closed)</button>
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
            let evalaution_details = this.evalaution_details.filter(item => item.score) 
            if(action == 'draft'){
                this.status = 1
                axios.post('spms/saveEvaluation', {data:evalaution_details,org_id:this.org_id,status:this.status,dzon_id:this.dzon_id,year:this.year})
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
            }else if(action == 'completed'){
                Swal.fire({
                title: 'You cannot edit the assessment after marking it as completed (closed). Are you sure to complete (close)?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        let validated=this.validateRadioButton();
                        if(validated){
                            this.status = 2
                            axios.post('spms/saveEvaluation', {data:evalaution_details,org_id:this.org_id,status:this.status,dzon_id:this.dzon_id,year:this.year})
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
                                text: 'You must give rating for all the indicators to complete.',
                            })
                        }
                    }
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
        console.log(this.$route.params.data)
        this.org_id =this.$route.params.data.school_id
        this.school =this.$route.params.data.school
        this.year =this.$route.params.year,
        this.dzon_id =this.$route.params.data.dzon_id
    },
    mounted(){
        
        this.getEvaluation()
        this.dt = $("#create-evaluation-table").DataTable({
            rowGroup: {
                dataSrc: [0,1] 
            },
            columnDefs: [
                {targets:  [0,1],visible: false},
                {targets: 0, className: 'font-weight-bold'},
                {targets: 2,width: 50},
                {targets: 3,width: 75},
                {targets: 5,width: 75},
                {targets: 6,width: 50},
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
                        {targets: 0, className: 'font-weight-bold'},
                        {targets: 2,width: 50},
                        {targets: 3,width: 75},
                        {targets: 5,width: 75},
                        {targets: 6,width: 50},
                    ],
                    destroy: true,
                })
            });
        }
    }
}
</script>