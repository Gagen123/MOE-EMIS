<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="agency-input-form-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Input<small><br>(Resources & trainings provided by the agency)</small></th>
                            <th class="text-center">Observation</th>
                            <th class="text-center">Action Taken by Agency</th>
                            <th class="text-center">Acknowledgement by Schools</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item,index) in agency_inputs" :key="index">
                            <td>
                                {{item.input}}
                                <i  v-if="item.can_edit_input == 1"  @click="showedit(item,'edit_agency_input_form')" class="fa fa-edit color" data-toggle="tooltip" data-placement="top" title="Edit"></i >
                            </td>
                            <td>
                                <router-link v-if="item.can_add_observation == 1" :to="{name:'create_observation_agency_input_form', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-plus"></i > Add</router-link>
                                <span v-else>
                                    {{item.observation}}
                                    <i v-if="item.can_edit_observation == 1" @click="showedit(item,'edit_observation_agency_input_form')" class="fa fa-edit color" data-toggle="tooltip" data-placement="top" title="Edit"></i >
                                </span>
                            </td>
                            <td>
                                <span class="ml-4 pl-3" v-if="(item.observation == null && item.action_taken == null)">NA</span>
                                <router-link  v-else-if="item.can_add_action_taken == 1" :to="{name:'create_action_agency_input_form', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-plus"></i > Add</router-link>
                                <span v-else>
                                    {{item.action_taken}}
                                    <i v-if="item.can_edit_action_taken == 1" @click="showedit(item,'edit_action_agency_input_form')" class="fa fa-edit color" data-toggle="tooltip" data-placement="top" title="Edit"></i >
                                </span>
                            </td>
                            <td>
                                <span class="ml-4 pl-4" v-if="(item.action_taken == null && item.acknowledgement == null)">NA</span>
                                <router-link  v-else-if="item.can_add_acknowledgement == 1" :to="{name:'create_acknowledgement_agency_input_form', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-plus"></i > Add</router-link>
                                <span v-else>
                                    {{item.acknowledgement}}
                                </span>
                            </td>
                            <td>
                                <router-link :to="{name:'view_agency_input_form', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-eye"></i > View</router-link> 
                                <!-- <router-link :to="{name:'edit_annual_school_plan', params: {data:item}}" class="btn btn-info btn-sm text-white"><i class="fa fa-edit"></i > Edit</router-link> --> 
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
            agency_inputs:[],
            school:'',
            year:'',
            dt:'',
        }
    },
    methods:{
        getAgencyInputForm(){
             axios.get('spms/getAgencyInputForm')
            .then(response => { 
                this.agency_inputs = response.data.data
            }).catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data,type){
            this.$router.push({name:type,params: {data:data}});
        },
    },
    mounted(){
        this.dt = $("#agency-input-form-table").DataTable({
             columnDefs: [
                { width: 500, targets: 0},
                { width: 100, targets: 3},
                { width: 70, targets: 4},
            ],
        })
        this.getAgencyInputForm()
    },
    watch: {
        agency_inputs(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#agency-input-form-table").DataTable({
                    columnDefs: [
                        { width: 500, targets: 0},
                        { width: 100, targets: 3},
                        { width: 70, targets: 4},
                    ],
                })
            });
        }
    }
}
</script>
<style scoped>
.color {
    color: #42b9f5;
}
</style>