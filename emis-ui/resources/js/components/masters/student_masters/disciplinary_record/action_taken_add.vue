<template>
    <div>
        <form class="bootbox-form" id="actionTakenId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Student Disciplinary Action Taken:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0.5">Offence Severity:<i class="text-danger">*</i></label>
                            <select v-model="form.offence_severity_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('offence_severity_id') }" class="form-control select2" name="offence_severity_id" id="offence_severity_id">
                                <option v-for="(item, index) in offenceSeverity" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                            </select>
                            <has-error :form="form" field="offence_severity_id"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Description:</label> 
                        <textarea class="form-control" v-model="form.description" id="description" type="text"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
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
            offenceSeverity:[],

            form: new form({
                id: '',
                name: '',
                offence_severity_id:'',
                description: '',
                status: 1,
                record_type:'disciplinary_action_taken',
                action_type:'add',
            })
        }
    },
    methods: {
        loadActiveOffenceList(uri="masters/loadActiveStudentMasters/offence_severity"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.offenceSeverity =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="offence_severity_id"){
                this.form.offence_severity_id=$('#offence_severity_id').val();
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
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/saveStudentMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/action_taken_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		}, 
    },
    mounted(){
        $('[data-toggle="tooltip"]').tooltip();
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
        this.loadActiveOffenceList();
    },
    
}
</script>