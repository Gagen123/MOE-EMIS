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
                                <label>Date: <span class="text-danger">*</span></label> 
                                <input v-model="attendance_date" type="date">
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
                                        <tbody id="tbody">
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
import index from '../index.vue'
export default {
  components: { index },
    data(){
        return {}
    },

    methods:{
        async getClassTeacherClasss(){
            try{
                let classTeacherClass = await axios.get('academics/getClassTeacherClasss').then(response => { return response.data})
                console.log(classTeacherClass)

            }catch(e){
                if(e.toString().includes("500")){
                $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            }
        }
      
       
    },
    mounted(){
    this.getClassTeacherClasss()
    }
}
</script>