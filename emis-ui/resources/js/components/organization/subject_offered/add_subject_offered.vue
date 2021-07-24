<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Class:<i class="text-danger">*</i></label>
                    <select v-model="form.class_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('class_id') }" class="form-control select2" name="class_id" id="class_id">
                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                    </select>
                    <has-error :form="form" field="class_id"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="subject-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Is offered</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in this.subjectList" :key="index">
                                <td>
                                    <label class="pr-4"> &nbsp;{{ item.name }}</label>
                                </td>
                                <td >
                                    <input type="checkbox" name="class" v-model="form.subject_ids" :value="item.id">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <span class="text-danger" id="sugject_error"></span>
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
        return {
            classList:[],
            subjectList:[],
            form: new form({
                id:'',
                class_id:'',
                subject_ids: [],
                record_type:'add'
            }),
        }
    },
    methods: {
        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        loadAcademicMasters(uri="masters/loadAcademicMasters/all_active_subject"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.subjectList =  data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        formaction: function(type){
            if(type=="reset"){
                this.form.student= '';
                this.form.remarks='';
                this.form.status= 1;
            }
            if(type=="save"){
                // alert(this.form.subject_ids.length);
                this.form.post('/organization/saveSubjectMapping',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_subject_offered');
                })
                .catch((error) => {
                    console.log("Error:"+error)
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="class_id"){
                this.form.class_id=$('#class_id').val();
            }
        },
    },
    mounted() {
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
        this.loadClassList();
        this.loadAcademicMasters();
    },
}
</script>
