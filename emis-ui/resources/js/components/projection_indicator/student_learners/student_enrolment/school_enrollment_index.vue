<template>
    <div>
        <div class="form-group row mb-0">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label> Total Number of Student by Age group in Public School: </label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <tbody>
                     <tr>
                        <td><b>Category</b></td>
                        <!-- <td colspan="2"><b>Less than 5 Years</b></td> -->
                        <td colspan="3"><b>5-16 Years</b></td>
                        <!-- <td colspan="2"><b>Above 16 Years</b></td> -->
                        <td colspan="3"><b>5-16 Years of Population</b></td>
                        <td colspan="3"><b>Enrollment Rate by Population</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>Boys</b></td>
                        <td><b>Girls</b></td>
                        <td><b>Total</b></td>
                        <td><b>Boys</b></td>
                        <td><b>Girls</b></td>
                        <td><b>Total</b></td>
                        <td><b>Boys</b></td>
                        <td><b>Girls</b></td>
                        <td><b>Total</b></td>
                    </tr>
                    <tr v-if="public_higher_data!={}">
                        <td>HSS</td>
                        <td>{{public_higher_data.rightagemale}}</td>
                        <td>{{public_higher_data.rightagefemale}}</td>
                        <td>{{parseInt(public_higher_data.rightagemale)+parseInt(public_higher_data.rightagefemale)}}</td>

                        <td>{{population_male}}</td>
                        <td>{{population_female}}</td>
                        <td>{{population_male+population_female}}</td>

                        <td>{{ ((parseInt(public_higher_data.rightagemale)/population_male)*100).toFixed(2) }}</td>
                        <td>{{((parseInt(public_higher_data.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                        <td>{{(((parseInt(public_higher_data.rightagemale)+parseInt(public_higher_data.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                    </tr>
                    <tr v-if="public_middle_data!={}">
                        <td>MSS</td>
                        <td>{{public_middle_data.rightagemale}}</td>
                        <td>{{public_middle_data.rightagefemale}}</td>
                        <td>{{parseInt(public_middle_data.rightagemale)+parseInt(public_middle_data.rightagefemale)}}</td>

                        <td>{{population_male}}</td>
                        <td>{{population_female}}</td>
                        <td>{{population_male+population_female}}</td>

                        <td>{{ ((parseInt(public_middle_data.rightagemale)/population_male)*100).toFixed(2) }}</td>
                        <td>{{((parseInt(public_middle_data.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                        <td>{{(((parseInt(public_middle_data.rightagemale)+parseInt(public_middle_data.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                    </tr>
                    <tr v-if="public_lower_data!={}">
                        <td>LSS</td>
                        <td>{{public_lower_data.rightagemale}}</td>
                        <td>{{public_lower_data.rightagefemale}}</td>
                        <td>{{parseInt(public_lower_data.rightagemale)+parseInt(public_lower_data.rightagefemale)}}</td>

                        <td>{{population_male}}</td>
                        <td>{{population_female}}</td>
                        <td>{{population_male+population_female}}</td>

                        <td>{{ ((parseInt(public_lower_data.rightagemale)/population_male)*100).toFixed(2) }}</td>
                        <td>{{((parseInt(public_lower_data.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                        <td>{{(((parseInt(public_lower_data.rightagemale)+parseInt(public_lower_data.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                    </tr>
                </tbody>
            </table>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label> Total Number of Student by Age group in Private School: </label>
                <table id="waterTable" class="table w-100  table-sm table-bordered table-striped col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <tbody>
                    <tr>
                        <td><b>Category</b></td>
                        <!-- <td colspan="2"><b>Less than 5 Years</b></td> -->
                        <td colspan="3"><b>5-16 Years</b></td>
                        <!-- <td colspan="2"><b>Above 16 Years</b></td> -->
                        <td colspan="3"><b>5-16 Years of Population</b></td>
                        <td colspan="3"><b>Enrollment Rate by Population</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>Boys</b></td>
                        <td><b>Girls</b></td>
                        <td><b>Total</b></td>
                        <td><b>Boys</b></td>
                        <td><b>Girls</b></td>
                        <td><b>Total</b></td>
                        <td><b>Boys</b></td>
                        <td><b>Girls</b></td>
                        <td><b>Total</b></td>
                    </tr>
                    <tr v-if="private_higher_data!={}">
                        <td>HSS</td>
                        <!-- <td>{{private_higher_data.lessthenmale}}</td>
                        <td>{{private_higher_data.lessthenfemale}}</td> -->
                        <td>{{private_higher_data.rightagemale}}</td>
                        <td>{{private_higher_data.rightagefemale}}</td>
                        <td>{{parseInt(private_higher_data.rightagemale)+parseInt(private_higher_data.rightagefemale)}}</td>

                        <td>{{population_male}}</td>
                        <td>{{population_female}}</td>
                        <td>{{population_male+population_female}}</td>

                        <td>{{ ((parseInt(private_higher_data.rightagemale)/population_male)*100).toFixed(2) }}</td>
                        <td>{{((parseInt(private_higher_data.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                        <td>{{(((parseInt(private_higher_data.rightagemale)+parseInt(private_higher_data.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                        <!-- <td>{{private_higher_data.abovemale}}</td>
                        <td>{{private_higher_data.abovefemale}}</td> -->
                    </tr>
                    <tr v-if="private_middle_data!={}">
                        <td>MSS</td>
                        <td>{{private_middle_data.rightagemale}}</td>
                        <td>{{private_middle_data.rightagefemale}}</td>
                        <td>{{parseInt(private_middle_data.rightagemale)+parseInt(private_middle_data.rightagefemale)}}</td>

                        <td>{{population_male}}</td>
                        <td>{{population_female}}</td>
                        <td>{{population_male+population_female}}</td>

                        <td>{{ ((parseInt(private_middle_data.rightagemale)/population_male)*100).toFixed(2) }}</td>
                        <td>{{((parseInt(private_middle_data.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                        <td>{{(((parseInt(private_middle_data.rightagemale)+parseInt(private_middle_data.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
                    </tr>
                    <tr v-if="private_lower_data!={}">
                        <td>LSS</td>
                        <td>{{private_lower_data.rightagemale}}</td>
                        <td>{{private_lower_data.rightagefemale}}</td>
                        <td>{{parseInt(private_lower_data.rightagemale)+parseInt(private_lower_data.rightagefemale)}}</td>

                        <td>{{population_male}}</td>
                        <td>{{population_female}}</td>
                        <td>{{population_male+population_female}}</td>

                        <td>{{ ((parseInt(private_lower_data.rightagemale)/population_male)*100).toFixed(2) }}</td>
                        <td>{{((parseInt(private_lower_data.rightagefemale)/population_female)*100).toFixed(2)}}</td>
                        <td>{{(((parseInt(private_lower_data.rightagemale)+parseInt(private_lower_data.rightagefemale))/(population_male+population_female))*100).toFixed(2)}}</td>
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
        return{
            studentList:[],
            public_childrenList:[],
            private_childrenList:[],

            public_higher_data:[],
            public_lower_data:[],
            public_middle_data:[],

            private_higher_data:[],
            private_lower_data:[],
            private_middle_data:[],
            population_male:0,
            population_female:0,
        }
    },
    methods:{
        async generatesdetail(dzo_id){
            axios.get('students/ExternalDataImport/loadInstitues/censusData_'+new Date().getFullYear()+'_5,6,7,8,9,10,11,12,13,14,15,16/CensusModel')
            .then(response => {
                let population_data = response.data.data;
                population_data.forEach(data => {
                    this.population_male=this.population_male+parseInt(data.male);
                    this.population_female=this.population_female+parseInt(data.female);
                });
            });

            let response_data=  await this.loadStudents(dzo_id);
            this.public_childrenList=response_data.public_data[0];
            this.private_childrenList=response_data.private_data[0];
            this.public_higher_data=response_data.public_higher_data[0];
            this.public_lower_data=response_data.public_lower_data[0];
            this.public_middle_data=response_data.public_middle_data[0];

            this.private_higher_data=response_data.private_higher_data[0];
            this.private_lower_data=response_data.private_lower_data[0];
            this.private_middle_data=response_data.private_middle_data[0];
        }
    },
    mounted() {
        this.generatesdetail(this.$route.query.dzo_id);
    },
    watch: {
        '$route.query.dzo_id': {
            handler: function(dzo_id) {
                this.generatesdetail(dzo_id);
            },
        }
    },

}
</script>

