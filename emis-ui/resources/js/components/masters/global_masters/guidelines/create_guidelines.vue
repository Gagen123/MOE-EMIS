<template>
    <div>
        <form class="bootbox-form" id="dzongkhagId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Guideline For:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="guideline_for" v-model="form.guideline_for" :class="{ 'is-invalid': form.errors.has('guideline_for') }">
                            <option value="">--Select--</option>
                            <option value="Organization Establishment">Organization Establishment</option>
                            <option value="Organization Establishment Change">Organization Establishment Change</option>
                            <option value="Organization Change Details">Organization Change Details</option>
                            <option value="Student Admission Validation">Student Admission Validation</option>
                            <option value="Student Admission">Student Admission</option>
                            <option value="Equipment And Furniture">Equipment And Furniture</option>
                            <option value="Structural Index List">Structural Index List</option>
                            <option value="Student Admission">Student Admission</option>
                            <option value="Class Section Allocation">Class Section Allocation</option>
                            <option value=" Student Service">Student Service</option>
                            <option value="Student Health">Student Health</option>
                            <option value="Student Programs Club">Student Programs Club</option>
                            <option value="Student Scouts">Student Scouts</option>
                            <option value="Student Training Workshop">Student Training Workshop</option>
                            <option value="HR Development">HR_Development</option>
                            <option value="Leave Service">Leave Service</option>
                            <option value="Staff Service">Staff Service</option>
                            <option value="Staff Transfer Service">Staff Transfer Service</option>
                            <option value="Leadership Selection">Leadership Selection</option>
                            <option value="Organization Master">Organization Master</option>
                            <option value="Academics Master">Academics Master</option>
                            <option value="Academics">Academics</option>
                            <option value="Question & Answer Setup">Question & Answer Setup</option>
                            <option value="Mess Management">Mess Management</option>
                            <option value="Management Body">Management Body</option>
                            <option value="Staff Recuritment"> Staff Recuritment</option>
                        </select>
                        <has-error :form="form" field="guideline_for"></has-error>
                    </div>
                </div>
                <div class="row form-group" v-for='(item, index) in form.guidelines' :key="index">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Guideline:<span class="text-danger">*</span></label>
                        <textarea class="form-control" v-model="item.guideline" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" />
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="required">Display Order:</label>
                       <input type="number" min="1" name="display_order" id="display_order" class="form-control"/>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="item.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="item.status"  type="radio" value="0" /> Inactive</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove" @click="remove()"><i class="fa fa-trash"></i> Remove</button>
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
    data() {
        return {
            count:1,
            form: new form({
                guideline_for: '',
                guidelines:[
                    {guideline:'',display_order:1,status:1,}
                ],
                record_type:'guidelines',
                action_type:'add',
            })
        }
    },
    methods: {
        addMore: function(){
            this.count++;
            this.form.guidelines.push({ guideline:'',display_order:'',status:1,})
        },

        remove(){
            if(this.form.guidelines.length>1){
                this.count--;
                this.form.guidelines.pop();
            }
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.code='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveGlobalMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_guidelines');
                })
                .catch((error) => {
                    console.log("Error:"+error)
                })
            }
		},
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="guideline_for"){
                this.form.guideline_for=$('#guideline_for').val();
            }
        }
    },
    mounted(){
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
    },

}
</script>
