<template>
    <div>
        <form class="bootbox-form" id="equipmentId">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>School:<span class="text-danger">*</span></label> 
                            <select name="class" class="form-control" v-model="form.school" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="school" @change="remove_err('school')">
                                <option value="">--- Please Select ---</option>
                                <option value="1">Yangchenphug</option>
                            </select>
                            <has-error :form="form" field="str_name"></has-error>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Class:<span class="text-danger">*</span></label> 
                            <select name="class" class="form-control" v-model="form.classes" :class="{ 'is-invalid': form.errors.has('spo_name') }" id="classes" @change="remove_err('classes')">
                                <option value="">--- Please Select ---</option>
                                <option value="1">IX</option>
                                <option value="2">X</option>
                                <option value="3">XI</option>
                                <option value="4">XII</option>
                            </select>
                            <has-error :form="form" field="str_name"></has-error>
                        </div>
                    </div>  
                    
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Sections:<span class="text-danger">*</span></label>
                        <div class="form-group row" v-for='(user, index) in form.users' :key="index"> 
                            <input type="text" class="form-control" id="section" v-model="user.section"/>
                        </div>    
                    </div>  
                    <div class="form-group row">
                        <div class="col-4">
                            <button type="button" class=" btn btn-flat btn-sm btn-primary"
                            @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                            <button type="button" class=" btn btn-flat btn-sm btn-danger" value="Remove"
                            @click="remove()" ><i class="fa fa-trash"></i> Remove</button>
                        </div>
                    </div>        
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            count:1,
            users: [],
            form: new form({
                id: '',
                school: '',
                classes: '',
                action_type:'add',
                users:
                [{
                    section:''
                }]  
            }),
            
        }
    },

    methods:{
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.school= '';
                this.form.classes= '';
                // this.form.section= '';
            }
            if(type=="save"){
                this.form.post('/organization/saveSection',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Section is added successfully'
                    })
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        /**method to add more field */
        addMore: function(){
            this.count++;
            this.form.users.push({section:''})
        },
        /** method to remove field */
        remove(index){    
             if(this.form.users.length>1){
                this.count--;
                this.form.users.splice(index,1); 
            }
        },
    }
}
</script>