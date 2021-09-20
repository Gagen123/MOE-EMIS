<template>
    <div>
        <div class="card-body pb-0 mb-0">
            <div class="form-group row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0">Health Record: <i class="text-danger">*</i></label>
                    <select class="form-control select2" name="health_record_type" id="health_record_type">
                        <option value="none"> --Select--</option>
                        <option value="std_health_screening">Health Screening</option>
                        <option value="std_health_supplementation">Health Supplementation</option>
                        <option value="std_health_vaccination">Vaccination</option>
                        <option value="std_health_bmi">BMI</option>
                    </select>
                    <span class="text-danger" id="health_record_type_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0">Type: <i class="text-danger">*</i></label>
                    <select class="form-control select2" name="health_type" v-model="health_type" id="health_type">
                        <option value="ALL"> --Select--</option>
                        <option v-for="(item, index) in healthType" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <span class="text-danger" id="health_type_err"></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="mb-0">Term: <i class="text-danger">*</i></label>
                    <select class="form-control select2" name="term" v-model="term" id="term">
                        <option value="ALL"> --Select--</option>
                        <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <span class="text-danger" id="term_err"></span>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                    <button type="button" @click="loaddata()" class="btn btn-success">
                        <i class="fas fa-search" ></i> Search
                    </button>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="student-list-table" class="table w-100 table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Status</th>
                                <th>Action</th>                     
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in dataList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ classArray[item.OrgClassStreamId]}}</td>
                                <td>{{ sectionList[item.SectionDetailsID]}}</td>
                                <td>{{ item.health_status}}</td>
                                <td>
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            dt:'',
            id:'2',
            dataList:[],
            healthType:[],
            termList:[],
            term:'',
            health_type:'',
            health_record_type:'',
            classList:[],
            classArray:{},
            sectionList:{},
            streamList:{},
        }
    },
    methods:{
        /**
         * to load the array definitions of class, stream and section
         */
        loadClassArrayList(uri="loadCommons/getClassArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.classArray[data[i].id] = data[i].class;
                }
            })
        },
        loadSectionArrayList(uri="loadCommons/getSectionArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.sectionList[data[i].id] = data[i].section;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadStreamArrayList(uri="loadCommons/getStreamArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.streamList[data[i].id] = data[i].stream;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadTermList(uri = 'masters/loadStudentMasters/HealthTerm'){
            axios.get(uri)
            .then(response => {
                // alert(JSON.stringify(response));
                let data = response;
                this.termList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="health_record_type"){
                let id = $('#health_record_type').val();
                this.health_record_type = $('#health_record_type').val();
                if($('#health_record_type').val() == 'std_health_bmi'){
                    this.health_type = 'bmi';
                } 
                this.loadHealthType(id);
            }
            if(id=="health_type"){
                if($('#health_record_type').val() == 'std_health_bmi'){
                    this.health_type = 'bmi';
                } else {
                    this.health_type = $('#health_type').val();
                }
                
            }
            if(id=="term"){
                this.term = $('#term').val();
            }
            
        },
        loadHealthType(id){
            this.healthType=[];
            let model ='';
            if(id == 'std_health_screening'){
                model = 'HealthScreening';
            } else if(id == 'std_health_supplementation'){
                model = 'HealthSupplementation';
            } else if(id== 'std_health_vaccination'){
                model = 'VaccineType';
            } else{
                model = 'BMI';
            }

            let uri = "masters/loadStudentMasters/"+model;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.healthType =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loaddata(){
            this.dataList=[];
            
            let term=$('#term').val();

            let uri = "students/loadHealthSummary/"+this.health_record_type+"/"+this.health_type+"/"+this.term;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        showview(data){
            this.$router.push({name:'std_deworming_view',params: {data:data}});
        },
    },
    mounted(){
        this.loadClassArrayList();
        this.loadSectionArrayList();
        this.loadStreamArrayList();
        
        this.loadTermList();
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

        this.dt =  $("#student-list-table").DataTable()
    },
    watch: {
        dataList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#student-list-table").DataTable()
            });
        }
    },
}
</script>