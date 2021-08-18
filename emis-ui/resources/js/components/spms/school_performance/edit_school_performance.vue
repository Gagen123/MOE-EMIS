<template>
    <div>
        <form class="bootbox-form" >
            <div class="form-group row">
                <div class="ml-3">
                    <strong>School: </strong> {{ school }} 
                </div>
                <div class="ml-3">
                    <strong>Domain Category: </strong> {{sub_category_name}} 
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
                                <td>
                                    <textarea class="form-control" v-model="evalaution_details[index].deo_remarks"> 
                                    </textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button @click.prevent="save('draft')" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-save"></i> Save</button>
                <button @click.prevent="save('completed')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-paper-plane"></i> Submit to School</button>
            </div>
        </form>
    </div>  
</template>
<script>
export default {
    data(){
        return {
            school:'',
            sub_category_name:'',
            domains:[],
            areas:[],
            parameters:[],
            evaluation:[],
            evalaution_details:[],
            status:[],
            ratings:[],
            currentRoute:this.$route.name
        }
    },
    methods:{
        async getEvaluation(){
            let uri = 'spms/getEvaluation/'+this.org_id+'/'+this.spm_domain_subcat_id
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
                axios.post('spms/saveEvaluation',{data:evalaution_details,evaluation_id:this.evaluation_id,status:this.status})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/deo-evaluation-dashboard');
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
        this.org_id =this.$route.params.data.org_id
        this.spm_domain_subcat_id =this.$route.params.data.spm_domain_subcat_id
        this.evaluation_id =this.$route.params.data.evaluation_id
        this.school =this.$route.params.data.school
        this.sub_category_name =this.$route.params.data.sub_category_name

    },
    mounted(){
        
        this.getEvaluation()
        this.dt = $("#create-evaluation-table").DataTable({
             columnDefs: [
                { width: 20, targets: 0},
                { width: 10, targets: 1},
                { width: 50, targets: 2},
                { width: 150, targets: 3},
                { width: 300, targets: 4},
                { width: 300, targets: 5},


            ],
        });
        
    },
    watch: {
        evalaution_details(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#create-evaluation-table").DataTable()
            });
        }
    }
}
</script>