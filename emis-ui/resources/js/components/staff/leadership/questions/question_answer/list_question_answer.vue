<template>
    <div class="card">
        <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
            <div class="card-body pb-0 mb-0" style="display:none">
                <div class="callout callout-success">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Leadership Selection Type:</label>
                            <select class="form-control select2" id="leadership_type">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in leadershipe_type_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="leadership_type_err"></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label class="mb-0">Feedback Category:</label>
                            <select class="form-control select2" id="category_type_id">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in category_type_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="category_type_id_err"></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-3">
                            <button type="button" @click="loaddata()" class="btn btn-success">
                                <i class="fas fa-search" ></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header pb-0 pt-2">
                <h3 class="card-title"><b>Advance Search </b>(Search By Selection Type & Feedback Category)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus" ></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body pb-1 mb-0 pt-1 mt-0 overflow-auto">
            <table id="data-table" class="table table-bordered text-sm table-striped">
                <thead>
                    <tr>
                        <th style="width:5%">SL#</th>
                        <th style="width:8%">Leadership</th>
                        <th style="width:10%">Category</th>
                        <th style="width:40%">Question</th>
                        <th style="width:5%">display Order</th>
                        <th style="width:9%">Status</th>
                        <th style="width:13%">Created Date</th>
                        <th style="width:10%" class="pl-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ leadershipe_list[item.leadership_type_id]}}</td>
                        <td>{{ categoryList[item.category_type_id]}}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.display_order}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ item.created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dataList:[],
            dt:'',
            categoryList:{},
            leadershipe_list:{},
            category_type_list:[],
            leadershipe_type_list:[],
        }
    },
    methods:{
        loadcategoryList(uri = 'staff/staffLeadershipSerivcesController/loadData/allData_FeedbackCategory'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.category_type_list=data;
                for(let i=0;i<data.length;i++){
                    this.categoryList[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        leadershipelist(){
            let uri = 'staff/staffLeadershipSerivcesController/loadData/activeData_LeadershipType';
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.leadershipe_type_list=data;
                for(let i=0;i<data.length;i++){
                    this.leadershipe_list[data[i].id] = data[i].name;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadquestionList(uri = 'staff/staffLeadershipSerivcesController/loadData/allData_Question'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.dataList=data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        loaddata(){
            this.dataList=[];
            let feedback_category_id=$('#category_type_id').val();
            let leadership_selection_id=$('#leadership_type').val();
            axios.get('staff/staffLeadershipSerivcesController/loadData/questionsUnderCatType_Question_'+feedback_category_id+'_'+leadership_selection_id)
            .then(response => {
                let data = response.data.data;
                this.dataList=data;
            })
            .catch(function (error){
                console.log(error);
            });
        },

        showedit(data){
            this.$router.push({name:'edit_question_answer',params: {data:data.id}});
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="category_type_id"){
                this.form.category_type_id=$('#category_type_id').val();
            }
            if(id=="leadership_type"){
                this.form.leadership_type=$('#leadership_type').val();
            }
        }
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=> {
            this.changefunction(id);
        });

        this.loadcategoryList();
        this.leadershipelist();
        this.loadquestionList();
        this.dt =  $("#data-table").DataTable()
    },
    watch: {
        dataList() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#data-table").DataTable()
            });
        }
    },
}
</script>
