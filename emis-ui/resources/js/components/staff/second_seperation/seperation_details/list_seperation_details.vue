<template>
    <div>
        <search />
        <!-- <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
            <div class="card-header pb-0 pt-2">
                <h3 class="card-title"><b>Search </b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus" ></i>
                    </button>
                </div>
            </div>
            <div class="card-body pb-0 mb-0" style="display:none">
                <div class="form-group row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="dzosection">
                        <label class="mb-0">Dzongkhag: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="dzongkhag_id">
                            <option value="ALL"> --Select--</option>
                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="dzongkhag_id_err"></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="mb-0">Organization Type: <i class="text-danger">*</i></label>
                        <select class="form-control select2" name="organization_type" id="organization_type">
                            <option value="ALL"> --Select--</option>
                            <option value="Org">Organization/School </option>
                            <option value="Dzongkhag">Dzongkhag</option>
                            <option value="Ministry">Ministry </option>
                        </select>
                        <span class="text-danger" id="organization_type_err"></span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="display:none" id="departmentdiv">
                        <label class="mb-0">Department: <i class="text-danger">*</i></label>
                        <select class="form-control select2" name="department" id="department">
                            <option value="ALL"> --Select--</option>
                            <option v-for="(item, index) in departmentList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="department_err"></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="mb-0">Organization: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="org_id">
                            <option value="ALL"> --Select--</option>
                            <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="org_id_err"></span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-4">
                        <button type="button" @click="loaddata()" class="btn btn-success">
                            <i class="fas fa-search" ></i> Search
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                <table id="seperation_table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Name</th>
                            <th>EID</th>
                            <th>Position Title</th>
                            <th>Position Level</th>
                            <th>Working Address</th>
                            <th>Seperation Type</th>
                            <th>Effective Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in staffList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.staff_name}}</td>
                            <td>{{ item.emp_id}}</td>
                            <td>{{ item.position_title_name}}</td>
                            <td>{{ item.positionlevel}}</td>
                            <td>{{ item.working_agency}}</td>
                            <td v-if="item.type!=null">{{ item.type.mastertypename }}</td>
                            <td v-else></td>
                            <td>{{ reverseDateTime(item.EffectiveDate)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import search from "../../searchpage.vue";
export default {
    components: {
        search,
    },
    data(){
        return{
            dzongkhagList:[],
            dzo_id:'',
            departmentList:[],
            seperationList:[],
            orgList:[],
            staffList:[],
            genderArray:{},
            cureerstageArray:{},
            positiontitleList:{},
            dt:'',
        }
    },
    methods: {
        loadeditpage(staff){
            this.$router.push({name:"edit_seperation_details",query:{data:staff}});
		},

        async loaddata(){
            this.staffList=[];
            if($('#org_id').val()!="ALL"){
                this.staffList=await this.staffSchoolwise($('#org_id').val());
            }
            if($('#dzongkhag_id').val()!="ALL" && $('#org_id').val()=='ALL'){
                this.staffList=await this.staffDzongkhagwise($('#dzongkhag_id').val());
            }
        }
    },
    async mounted(){
        axios.get('staff/zest/loadSeperation')
        .then((response) => {
            this.staffList =  response.data.data;
        })
        .catch((error) => {
            console.log("Error."+error);
        });
        this.dt =  $("#seperation_table").DataTable()
    },
    watch: {
        staffList(){
            this.applydatatable('seperation_table');
        }
    },


}
</script>


