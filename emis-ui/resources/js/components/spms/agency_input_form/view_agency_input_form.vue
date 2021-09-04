<template>
    <div>
        <form class="bootbox-form mt-2" autocomplete="off">
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Division:</label> 
                    <br>
                    {{division}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Year:</label> 
                    <br>
                    {{year}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Input:</label> 
                        <br>
                    {{input}}
                </div>
            </div>
             <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Process/Activities:</label> 
                        <br>
                    {{activity}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label>Output:</label> 
                        <br>
                        {{output}}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Dzongkhag:</label> 
                        <br>
                        {{dzongkhag}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>School:</label> 
                        <br>
                        {{school}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Observation:</label> 
                    <br>
                    {{observation}}
                </div>
            </div>
             <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Recommendation:</label> 
                    <br>
                    {{recommendation}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Recommendation Date:</label> 
                    <br>
                    {{recommendation_date}}
                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Action Taken by Dzongkhag/Thromde/Agency:</label> 
                    <br>
                    {{action}}
                </div>
             </div>
            <div class="row form-group">
               
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date of Action Taken:</label> 
                    <br>
                    {{action_date}}
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Acknowledgement by School: </label> 
                    <br>
                    {{acknowledgement}}
                    
                </div>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            agency_input_id:'',
            school:'',
            division:'',
            year:'',
            input:'',
            activity: '',
            output:'',
            observation:'',
            recommendation:'',
            recommendation_date:'',
            dzongkhag:'',
            action:'',
            action_date:'',
            acknowledgement:'',
        }
    },
    methods: {
        onChange(id){
            if($('#' + id).val()!=""){
               $('#'+id).removeClass('is-invalid select2');
               $('#'+id).addClass('select2');
            }
        },
        getorgName(orgId){
            let type="Headquarterbyid";
            axios.get('loadCommons/loadOrgDetails/'+type+'/'+orgId)
            .then(response => {
                let data = response.data.data;
                this.division=data['name'];
            })
            .catch(errors => {
                console.log(errors)
            });
        },
        async getAgencyInputFormDetail(){
            let dzongkhags = await this.loadactivedzongkhags()
            let agencyInputFormDetails = await axios.get('spms/getAgencyInputFormDetail/'+this.agency_input_id).then(response => { return response.data.data });
            let dzon_id = '';
            agencyInputFormDetails.forEach((item,index)  => {
                dzongkhags.forEach((item1) => {
                    if(item.dzon_id == item1.id){
                        dzon_id=item.dzon_id;
                        agencyInputFormDetails[index]['dzongkhag'] = item1.name;
                    }
                })
            });
            let schools = await this.schoolList(dzon_id);
            agencyInputFormDetails.forEach((item) => {
                schools.forEach(item1 =>{
                    if(item.school_id == item1.id){
                        this.getorgName(item['org_division_id'],'');
                        this.year = item['input_year'];
                        this.input = item['input'];
                        this.activity = item['activity'];
                        this.output = item['output'];
                        this.school = item1['name'];
                        this.dzongkhag = item['dzongkhag'];
                        this.observation = item['observation'];
                        this.recommendation = item['recommendation'];
                        this.recommendation_date = item['recommendation_date'];
                        this.action = item['action_taken'];
                        this.action_date = item['action_taken_date'];
                        this.acknowledgement = item['acknowledgement'];
                    }
                })

            });
        },
    },
     created(){
        this.agency_input_id =this.$route.params.data.id
    },
    mounted(){ 
        this.getAgencyInputFormDetail()
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true });
            e.params.data.element.parentElement.dispatchEvent(event);
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true });
        e.params.data.element.parentElement.dispatchEvent(event);
        });
    },
}
</script>