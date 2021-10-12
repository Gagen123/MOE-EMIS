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
                            <th>StaffID</th>
                            <th>RefNo</th>
                            <th>Name</th>
                            <!-- <th>Position Title</th> -->
                            <th>Seperation Type</th>
                            <th>Effective Date</th>
                            <th>Approved Date</th>

                            <!-- <th>Working Agency</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in staffList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.StaffID}}</td>
                            <td>{{ item.RefNo}}</td>
                            <td>{{ item.staffName}}</td>
                            <!-- <td>{{ positiontitleList[item.staff_detials.position_title_id]}}</td> -->
                            <td v-if="item.type!=null">{{ item.type.mastertypename }}</td>
                            <td v-else></td>
                            <td>{{ item.EffectiveDate}}</td>
                            <td>{{ item.ApprovedDate}}</td>

                            <!-- <td>{{ item.staff_detials.working_agency}}</td> -->
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
        loadactiveSeperationListList(uri="staff/loadStaffMasters/active/SeperationMaster"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.seperationList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        loadpositionTitleList(uri = 'staff/loadStaffMasters/active/PositionTitle'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.positiontitleList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        },
        getDepartmentList(type){
            let uri = 'loadCommons/loadHeaquarterList/all_ministry_departments/'+type.toLowerCase();
            if(this.accesslevel=="Dzongkhag"){
                uri = 'loadCommons/loadHeaquarterList/user_dzongkhag/user_dzongkhag';
            }
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.departmentList = data.data.data;
            })
            .catch(function (error){
                console.log("Error getDepartmentList:"+error)
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag_id"){
                $('#organization_type').val('ALL').trigger('change');
                // this.orgList=await this.schoolList($('#dzongkhag_id').val());
            }

            if(id=="organization_type"){
                $('#department').val('ALL').trigger('change');
                this.departmentList =[];
                if($('#dzongkhag_id').val()==""){
                    $('#dzongkhag_id_err').html('Please select dzongkhag');
                    $('#organization_type').val('ALL').trigger('change');
                }
                else{
                    if($('#organization_type').val()=="Ministry" || $('#organization_type').val()=="Dzongkhag"){
                        this.getDepartmentList($('#organization_type').val());
                        $('#departmentdiv').show();
                    }
                    else{
                        this.orgList=await this.schoolList($('#dzongkhag_id').val());
                        $('#departmentdiv').hide();
                    }
                }
            }
            if(id=="department"){
                this.orgList=await this.getdepartmentList($('#department').val());
            }
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
        // this.dzongkhagList= await this.loadactivedzongkhags();
        // this.loadpositionTitleList();
        // this.loadactiveSeperationListList();
        // $('.select2').select2();
        // $('.select2').select2({
        //     theme: 'bootstrap4'
        // });
        // $('.select2').on('select2:select', function (el){
        //     Fire.$emit('changefunction',$(this).attr('id'));
        // });

        // Fire.$on('changefunction',(id)=> {
        //     this.changefunction(id);
        // });
        // axios.get('common/getSessionDetail')
        // .then(response =>{
        //     let data = response.data.data;
            // if(data['acess_level']=="Org"){
            //     this.loadstff('userOrgWiseCivilServent/ALL_TYPE');
            // }
            // if(data['acess_level']=="Dzongkhag"){
            //     this.loadstff('userDzoWiseCivilServent/ALL_TYPE');
            // }
            // if(data['acess_level']=="Ministry"){
            //     this.loadstff('allCivilServent/ALL_TYPE');
            //     this.showedit=true;
            // }

            //axios.get('staff/staffSepSecController/loadSecondment/all/Seperation')

        // })
        // .catch(errors => {
        //     console.log(errors)
        // });
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


