<template>
    <div>
        <staffdet>
            <div class="callout callout-success">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Name:</label><br>
                        <span class="text-blue text-bold">{{ staffdet.name}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Emp Id:</label><br>
                        <span class="text-blue text-bold">{{staffdet.emp_id}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Position Title:</label><br>
                        <span class="text-blue text-bold">{{ staffdet.position_title_name}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Position Level:</label><br>
                        <span class="text-blue text-bold">{{staffdet.positionlevel}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Working Agency</label><br>
                        <span class="text-blue text-bold">{{staffdet.working_agency}}</span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Case Categoty:</label><br>
                        <span class="text-blue text-bold">{{ staffdet.case_category_name}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Case Type:</label><br>
                        <span class="text-blue text-bold">{{staffdet.case_type_name}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Offence Type</label><br>
                        <span class="text-blue text-bold">{{staffdet.offence_type}}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Offence Date:</label><br>
                        <span class="text-blue text-bold">{{ staffdet.offence_date}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Description of the Offence:</label><br>
                        <span class="text-blue text-bold">{{staffdet.offence_description}}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0">Reamrks</label><br>
                        <span class="text-blue text-bold">{{staffdet.description_on_action}}</span>
                    </div>
                </div>
            </div>
        </staffdet>
    </div>
</template>
<script>
export default {
    data(){
        return {
            staffdet:'',
        }
    },
    mounted(){
        let uri = 'staff/staffServices/loadStaffdisaplinaryByIsd/'+this.$route.params.data.id;
        axios.get(uri)
        .then(response => {
            let data = response.data.data;
            this.staffdet = data;
        })
        .catch(function (error){
            console.log('Error: '+error);
        });
    },
}
</script>
