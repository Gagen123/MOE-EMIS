<template>
    <div class="card">
        <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
            <div class="card-body pb-0 mb-0" style="display:none">
                <div class="callout callout-success">
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Category:<span class="text-danger">*</span></label>
                            <select  @change="remove_error('categoty')" class="form-control select2" id="category" name="category">
                                <option value=""> --Select--</option>
                                <option v-for="(item, index) in category_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <span id="categoty_err" class="text-danger"></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-4">
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
                        <th >SL#</th>
                        <th >Trait</th>
                        <th >Code</th>
                        <th >Status</th>
                        <th >Description</th>
                        <th >Created Date</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dataList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.name}}</td>
                        <td>{{ item.code}}</td>
                        <td>{{ item.status==  1 ? "Active" : "Inactive" }}</td>
                        <td>{{ item.description}}</td>
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
            dataList:[],dt:'',
            category_list:[],
        }
    },
    methods:{
        showedit(data){
            this.$router.push({name:'edit_capability',params: {data:data}});
        },
        async loaddata(){
            if($('#category').val()==""){
               $('#categoty_err').html('Please select catetory');
            }else{
                this.dataList =  await this.loadstaffMasters('byparent__category__'+$('#category').val(),'staff_leadership___Capability');
            }
        }
    },
    async mounted(){
        this.category_list =  await this.loadstaffMasters('active','staff_leadership___QuestionCategory');
        this.dataList =  await this.loadstaffMasters('all','staff_leadership___Capability');
        this.dt =  $("#data-table").DataTable()
    },
    watch: {
        dataList() {
            this.applydatatable('data-table');
        }
    },
}
</script>
