<template> 
    <div>
        <div class="card card-success card-outline collapsed-card" id="adv_serach_ection" v-if="showdiv">
            <div class="card-header pb-0 pt-2">
                <h3 class="card-title"><b>Advance Search </b></h3>
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
                        <label class="mb-0">Level: <i class="text-danger">*</i></label>
                        <select class="form-control select2" id="levelId" v-model="levelId">
                            <option value="ALL"> ALL</option>
                            <option v-for="(item, index) in levelList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="level_type_err"></span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                        <button type="button" @click="loaddata()" class="btn btn-success">
                            <i class="fas fa-search" ></i> Search
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
            <li class="form-inline "><h6 class="pt-1">List of Organization</h6></li>
        </ol>
        <div class="card-header pb-1 mb-0 pt-0 mt-0"> 
            <span class="fa-pull-right pr-2" v-if="list">
                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpagelist()"> <span class="fa fa-list"></span> LIST</a>
            </span>
        </div>
        <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header pt-0 mt-0 pb-0">
                    <div>
                        <table id="register-table" class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Name</th>
                                    <th>Level</th>
                                    <th>Dzongkhag</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data_list" :key="index">
                                    <td>{{ index+1}}</td>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.LEVEL }}</td>
                                    <td>{{ dzoArray[item.dzongkhagId] }}</td>
                                    <td>{{ item.status}}</td>
                                    <td>{{ item.date}}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>
<script>
export default {
    data(){
        return{
            acess_level:'',
            dt:'',
            dzo_id:'',
            levelArray:{},
            dzoArray:{},
            data_list:[],
            dzongkhagList:[],
            departmentList:[],
            orgList:[],
            levelList:[],
            showdiv:false,
            levelId:'',
            list:false

        }
    },
    methods: {
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList =  data;
                for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzoArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        }, 
        loadeditpage(item){
            this.$router.push({name:"school_details_update",query:{org_id:item.id}});
        },
        loadeditpagelist(){
            location.reload();
        },
       
        loadOrgDataSubmissionList(type){
             axios.get('organization/loadOrgDataSubmissionList/'+type)
            .then((response) => {
                this.data_list=response.data.data;
            })
            .catch((error) =>{
                console.log("Error:"+error); 
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
          
            if(id=="dzongkhag_id"){
                this.orgList = [];
                this.orgList=await this.schoolList($('#dzongkhag_id').val());
            }
            //  if(id=="levelId"){
            //  //   this.levelList = []
            //     this.form.levelId=$('#levelId').val();
            //    // this.levelList=this.getlevel($('#levelId').val());
            // }
            if(id=="levelId"){
                this.levelId= $('#levelId').val();
            }
            if(id=="dzongkhag_id"){
                this.dzongkhag_id= $('#dzongkhag_id').val();
            }
            // if(id=="org_id"){
            //     this.staffList = [];
            //     this.staffList=await this.staffOrgwise($('#org_id').val());
            // }
        },
     
        loaddata(){
            //this.data_list=[];
            let levelId = $('#levelId').val();
            let dzongkhag_id = $('#dzongkhag_id').val();
            let uri="organization/loadOrgDataSubmissionListMinistry/"+this.dzongkhag_id+"/"+this.levelId;
            axios.get(uri)
            .then((response) => {
               this.data_list=response.data.data;
            })
             
            .catch((error) => {
                console.log("Error."+error);
            });
        },
  
    }, 
    async mounted(){
        this.getLevel();
        this.dzongkhagList= await this.loadactivedzongkhags();
        //this.loaddata();
        //this.dt =  $("#register-table").DataTable();
        // 
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=>{
            this.changefunction(id);
        });


    },
    created(){
        this.loaddzongkhagList();
        this.dt =  $("#register-table").DataTable();
      
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.loadOrgDataSubmissionList('userworkingagency/allData');
            }
            if(data['acess_level']=="Dzongkhag"){
                this.loadOrgDataSubmissionList('userdzongkhagwise/allData');
               
            }
            if(data['acess_level']=="Ministry"){
                this.loadOrgDataSubmissionList('allorganizationDataList/allData');
                this.showdiv=true;
                this.list=true;
            }
        })
        .catch(errors => {
            console.log(errors)
        });
        // workingAgency
   

    },
    watch: {
        data_list() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#register-table").DataTable()
            });
        }
    },
}
</script>
