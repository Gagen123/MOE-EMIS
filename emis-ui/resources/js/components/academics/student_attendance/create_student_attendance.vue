<template>
    <div>
        <div class="card-body">
            <div class="row" id="student-attendance">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <form>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Class: <span class="text-danger">*</span></label>
                                 <span></span>
                                <select class="form-control" id="system_role" @change="removeerror('system_role','system_role_err')" v-model="form.system_role">
                                    <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                                </select>
                                <span class="text-danger" id="system_role_err"></span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mt-4 pt-2">
                                <button class="btn btn-primary btn-sm btn-flat" @click="generatescreens()" type="button"> <span class="fa fa-download"></span> Load Details</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Select Module: <span class="text-danger">*</span></label> 
                                <select class="form-control" id="module_name" @change="removeerror('module_name','module_name_err'),loadsubmodule()" v-model="form.module_name">
                                    <option v-bind:value="'No_Module'">No Module & Sub Module</option>
                                    <option v-for="(item, index) in moduleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                                </select>
                                <span class="text-danger" id="module_name_err"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive overflow-auto">
                                    <table id="priveleges_table" class="table table-sm table-bordered table-striped" style="width: 100%;">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>Roll No.</th>
                                                <th>Name</th>
                                                <th>Present</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in classStremSectionList" :key="index">
                                                <td>{{ index+1 }}</td>
                                                <td> {{ item.class }} </td>
                                                <td> {{ item.stream }}  </td>
                                                <td> {{ item.section }} </td>
                                                <td>
                                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                                </td>                                                                               
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row form-group fa-pull-right">
                <div class="col-md-12">
                    <a href="dashboard">
                        <button type="button" class="btn btn-flat btn-danger"> <i class="fa fa-ban"></i> Cancel</button>
                    </a>
                    <button type="button" class="btn btn-flat btn-primary" @click="updateprivileges()"> <i class="fa fa-edit"></i> Update</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {}
    },

    methods:{
      
       
    },
    mounted(){
    
    }
}
</script>