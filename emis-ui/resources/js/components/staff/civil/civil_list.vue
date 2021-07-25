<template>
    <div>
        <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
            <div class="card-header pb-0 pt-2">
                <h3 class="card-title"><b>Advance Search </b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus" ></i>
                    </button>
                </div>
            </div>
            <div class="card-body pb-0 mb-0" style="display:none">
                <div class="callout callout-success">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Dzongkhag:</label>
                            <select class="form-control select2" id="dzongkhag_id">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="dzongkhag_id_err"></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label class="mb-0">Organization Type:<i class="text-danger">*</i></label>
                            <select class="form-control select2" name="organization_type" id="organization_type">
                                <option value="Org">Organization/School </option>
                                <option value="Dzongkhag">Dzongkhag</option>
                                <option value="Ministry">Ministry </option>
                            </select>
                            <span class="text-danger" id="organization_type_err"></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label class="mb-0">Organization:</label>
                            <select class="form-control select2" id="org_id">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in org_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="org_id_err"></span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                            <button type="button" @click="loaddata()" class="btn btn-success">
                                <i class="fas fa-search" ></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="civil-staff-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Emp Id</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Position Title</th>
                            <th>Working Agency</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th class="pl-5 pr-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in substaffList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.emp_id}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ genderArray[item.sex_id]}}</td>
                            <!-- <td>{{ item.position_title.name}}</td> -->
                            <td>{{ positiontitleList[item.position_title_id]}}</td>
                            <td>{{ item.working_agency}}</td>
                            <td>{{ item.email}}</td>
                            <td>{{ item.contact_no}}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item,'view')">View</a>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item,'edit')">Edit</a>
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
        return{
            dzongkhagList:[],
            departmentList:[],
            org_list:[],
            substaffList:[],
            genderArray:{},
            positiontitleList:{},
            dt:'',
        }
    },
    methods: {
        loadeditpage(staff,type){
            if(type=="edit"){
                this.$router.push({name:"edit_civil_staff",params:{data:staff}});
            }
            else{
                this.$router.push({name:"view_civil_staff",params:{data:staff}});
            }
		},
        loadstff(type){
            axios.get('loadCommons/loadStaffList/'+type)
            .then((response) => {
                this.substaffList =  response.data.data;
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },
        loadgenderList(uri = 'masters/loadGlobalMasters/all_active_gender'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        loadpositionTitleList(uri = 'masters/loadStaffMasters/all_active_position_title'){
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
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        getDepartmentList(type){
            let uri = 'loadCommons/loadHeaquarterList/all_ministry_departments/'+type.toLowerCase();
            this.gewog_list =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.departmentList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag"){
                this.personal_form.dzongkhag=$('#dzongkhag').val();
                this.getgewoglist();
                // this.allOrgList('school');
            }
            if(id=="organization_type"){
                if($('#organization_type').val()=="Ministry" || $('#organization_type').val()=="Dzongkhag"){
                    this.getDepartmentList($('#organization_type').val());
                    $('#departmentdiv').show();
                }
                else{
                    this.allOrgList('school');
                    $('#departmentdiv').hide();
                }
            }
        },
    },
    mounted(){
        this.loadactivedzongkhagList();
        this.loadgenderList();
        this.loadpositionTitleList();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            //1-regualr,2-contract,3-voluntary
            if(data['acess_level']=="Org"){
                this.loadstff('orgWsirRegContract/1,2,3');
            }
            if(data['acess_level']=="Dzongkhag"){
                this.loadstff('dzoWsirRegContract/1,2,3');
            }
            if(data['acess_level']=="Ministry"){
                this.loadstff('allRegContract/1,2,3');
            }
        })
        .catch(errors => {
            console.log(errors)
        });

        this.dt =  $("#civil-staff-table").DataTable()
    },
    watch: {
        substaffList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#civil-staff-table").DataTable()
            });
        }
    },


}
</script>


