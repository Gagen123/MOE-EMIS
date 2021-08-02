<template>
    <div>
        <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
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
                        <select class="form-control select2" id="dzongkhag_id" v-model="dzo_id">
                            <option value="ALL"> --Select--</option>
                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="dzongkhag_id_err"></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="mb-0">Organization: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="org_id">
                            <option value="ALL"> --Select--</option>
                            <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
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
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                <table id="teaching_subject_table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Emp Id</th>
                            <th>Name</th>
                            <th>Position Title</th>
                            <th>Working Agency</th>
                            <th>Compulsory Subject</th>
                            <th>Elective Subject 1</th>
                            <th>Elective Subject 2</th>
                            <th class="pr-4 pl-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in staffList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.emp_id}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ positiontitleList[item.position_title_id]}}</td>
                            <td>{{ item.working_agency}}</td>
                            <td>{{ subjectList[item.comp_sub_id]}}</td>
                            <td>{{ subjectList[item.elective_sub_id1]}}</td>
                            <td>{{ subjectList[item.elective_sub_id2]}}</td>
                            <td v-if="showedit">
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)"><span class="fa fa-edit"></span> Edit</a>
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
            dzo_id:'',
            orgList:[],
            showedit:false,
            staffList:[],
            subjectList:{},
            positiontitleList:{},
            dt:'',
        }
    },
    methods: {
        loadeditpage(staff){
            this.$router.push({name:"edit_teacher_subject",query:{data:staff}});
		},
        loadstff(type){
            axios.get('loadCommons/loadStaffList/'+type)
            .then((response) => {
                this.staffList =  response.data.data;
             })
            .catch((error) => {
                console.log("Error."+error);
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
        loadAcademicMasters(uri="masters/loadAcademicMasters/all_active_subject"){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.subjectList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag_id"){
                this.dzo_id=$('#dzongkhag_id').val();
                this.orgList=await this.schoolList($('#dzongkhag_id').val());
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
        this.dzongkhagList= await this.loadactivedzongkhags();
        this.loadAcademicMasters();
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
        .then(response =>{
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.loadstff('userOrgWiseCivilServent/ALL_TYPE');
            }
            if(data['acess_level']=="Dzongkhag"){
                this.loadstff('userDzoWiseCivilServent/ALL_TYPE');
            }
            if(data['acess_level']=="Ministry"){
                this.loadstff('allCivilServent/ALL_TYPE');
                this.showedit=true;
            }
        })
        .catch(errors => {
            console.log(errors)
        });
        this.dt =  $("#teaching_subject_table").DataTable()
    },
    watch: {
        staffList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#teaching_subject_table").DataTable()
            });
        }
    },


}
</script>


