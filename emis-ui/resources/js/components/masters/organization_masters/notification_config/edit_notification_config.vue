<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Type:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="leave_type_id" v-model="form.leave_type_id" :class="{ 'is-invalid': form.errors.has('leave_type_id') }">
                            <option v-for="(item, index) in leavetypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="leave_type_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Submitter:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="role_id" v-model="form.role_id" :class="{ 'is-invalid': form.errors.has('role_id') }">
                            <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                        </select> 
                        <has-error :form="form" field="role_id"></has-error>
                    </div>
                </div>  
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="dynamic-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sequence</th>
                                    <th>Authority Type</th>
                                    <th>Role</th>                           
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1" v-for='(user, index) in form.role_action_mapp' :key="index">
                                    <td>
                                        <input type="hidden" v-model="user.sequence">
                                        {{user.sequence}}
                                    </td>
                                    <td>
                                        <select name="authority" :id="'authority'+(index+1)" class="form-control" v-model="user.authority">
                                            <option value="">--- Please Select ---</option>
                                            <option value="2">Verify</option>
                                            <option value="10">Approve</option>
                                        </select>
                                        <span class="text-danger" :id="'authority_err'+(index+1)"></span>
                                    </td>
                                    <td>                                
                                        <select name="role" :id="'role'+(index+1)" class="form-control" v-model="user.role">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                                        </select>
                                        <span class="text-danger" :id="'role_err'+(index+1)"></span>
                                    </td>
                                </tr> 
                                <tr> 
                                    <td colspan="3">  
                                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                        @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore" 
                                        @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                    </td>
                                </tr>                                          
                            </tbody>
                        </table>
                    </div>
                </div>        
            </div>
            <div class="card-footer text-right">
                <!-- <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button> -->
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data(){
        return {
            leavetypeList:[],
            roleList:[],
            count:0,
            form: new form({
                id: '',
                leave_type_id:'',
                role_id:'',
                action_type:'edit',
                role_action_mapp:
                [{
                    sequence:1,authority:'',role:''
                }]  
            })
        }
    },
    methods: {
         addMore: function(){
            this.count++;
            this.form.role_action_mapp.push({sequence:this.count,authority:'',role:''})
        },

        remove(){    
            if(this.form.role_action_mapp.length>1){
                this.count--;
                this.form.role_action_mapp.pop(); 
            }
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadleaveTypeList(uri = 'masters/loadStaffMasters/all_leave_type_list'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.leavetypeList =  data.data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.roleList =  data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },
        
		formaction: function(type){
            if(type=="save"){
                this.form.post('/masters/saveLeaveConfigMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.applyselect2();
                    this.$router.push('/list_leave_config');
                })
                .catch((err) => {
                    this.applyselect2();
                    console.log("Error: "+err)
                })
            }
		}, 
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="leave_type_id"){
                this.form.leave_type_id=$('#leave_type_id').val();
                this.getLeave_details($('#role_id').val());
            }
            if(id=="role_id"){
                this.form.role_id=$('#role_id').val();
                this.getLeave_details();
            }
        },
        getLeave_details(){
            if($('#leave_type_id').val()!="" && $('#leave_type_id').val()!=null && $('#role_id').val()!="" && $('#role_id').val()!=null){
                axios.get('masters/loadLeaveConfigMasters/'+$('#leave_type_id').val()+'/'+$('#role_id').val())
                .then(response =>{
                    let data = response;
                    if(data.data.data!=null){
                        data.data.data;
                    }
                })
                .catch(function (error){
                    console.log(error);
                });
            }
        },        
        loadConfigDetails(id){
            axios.get('masters/loadLeaveConfigDetails/'+id)
            .then(response =>{
                let data = response.data.data;
                if(data!=null){
                    this.form.id=data.id;
                    this.form.leave_type_id=data.leave_type_id;
                    $('#leave_type_id').val(data.leave_type_id).trigger('change');
                    this.form.role_id=data.submitter_role_id;
                    $('#role_id').val(data.submitter_role_id).trigger('change');
                    this.form.role_action_mapp=[];
                    for(let i=0;i<data.conDetails.length;i++){
                        this.form.role_action_mapp.push({sequence:data.conDetails[i].sequence,authority:data.conDetails[i].authority_type_id,role:data.conDetails[i].role_id});
                        this.count=i+1;
                    }
                }
            })
            .catch(function (error){
                console.log(error);
            });
        },
        applyselect2(){
            if(!$('#leave_type_id').attr('class').includes('select2-hidden-accessible')){
                $('#leave_type_id').addClass('select2-hidden-accessible');
            }
            if(!$('#role_id').attr('class').includes('select2-hidden-accessible')){
                $('#role_id').addClass('select2-hidden-accessible');
            }
        }, 

    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (){
            Fire.$emit('changeval',$(this).attr('id'))
        });
        Fire.$on('changeval',(id)=>{
            this.changefunction(id);
        });
        this.loadleaveTypeList();
        this.loadroleList();
        this.loadConfigDetails(this.$route.params.data);
    },
}
</script>