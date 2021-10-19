<template>
    <div class="card">
        <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
            <div class="card-body pb-0 mb-0" style="display:none">
                <div class="callout callout-success">
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Category:<span class="text-danger">*</span></label>
                            <select  @change="remove_error('category'),getcapabilities()" class="form-control select2" id="category" name="category">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in category_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span id="category_err" class="text-danger"></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Capability:<span class="text-danger">*</span></label>
                            <select  @change="remove_error('capability'),gettraits()" class="form-control select2" id="capability" name="capability">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in capabilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span id="capability_err" class="text-danger"></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Traits:</label>
                            <select class="form-control select2" id="trait">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in trait_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span class="text-danger" id="category_type_id_err"></span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pt-4 mt-2">
                            <button type="button" @click="loaddata()" class="btn btn-success">
                                <i class="fas fa-search" ></i> Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header pb-0 pt-2">
                <h3 class="card-title"><b>Search Options</b></h3>
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
                        <!-- <th style="width:8%">Leadership</th> -->
                        <th style="width:10%">Category</th>
                        <th style="width:48%">Question</th>
                        <th style="width:5%">display Order</th>
                        <th style="width:9%">Status</th>
                        <th style="width:13%">Created Date</th>
                        <th style="width:10%" class="pl-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <!-- <td>{{ leadershipe_list[item.leadership_type_id]}}</td> -->
                        <td>{{ item.category.name }}</td>
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

            category_list:[],
            capabilityList:[],
            trait_list:[],
        }
    },
    methods:{
        async getcapabilities(){
            this.capabilityList=[];
            if($('#category').val()!=""){
              this.capabilityList =  await this.loadstaffMasters('byparent__category__'+$('#category').val(),'staff_leadership___Capability');
            }
        },
        async gettraits(){
            this.trait_list=[];
            if($('#capability').val()!=""){
              this.trait_list =  await this.loadstaffMasters('byparent__category__'+$('#capability').val(),'staff_leadership___Traits');
            }
        },

        async loaddata(){
            this.dataList=[];
            if($('#trait').val()!=""){
              this.dataList =  await this.loadstaffMasters('withparent__category__category_type_id__'+$('#trait').val(),'staff_leadership___Question');
            }
        },
        showedit(data){
            this.$router.push({name:'edit_question_answer',params: {data:data.id}});
        },
    },
    async mounted(){
        this.category_list =  await this.loadstaffMasters('active','staff_leadership___QuestionCategory');
        this.dataList =  await this.loadstaffMasters('allwith__category','staff_leadership___Question');
        this.dt =  $("#data-table").DataTable()
    },
    watch: {
        dataList() {
            this.applydatatable('data-table');
        }
    },
}
</script>
