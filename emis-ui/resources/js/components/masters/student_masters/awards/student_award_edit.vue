<template>
    <div>
        <form class="bootbox-form" id="studentAwardId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Award Name:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0.5">Award Type:<i class="text-danger">*</i></label>
                            <select v-model="form.award_type_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('award_type_id') }" class="form-control select2" name="award_type_id" id="award_type_id">
                                <option v-for="(item, index) in awardList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                            </select>
                            <has-error :form="form" field="award_type_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="mb-0.5">Program:</label>
                            <select v-model="form.program_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('program_id') }" class="form-control select2" name="program_id" id="program_id">
                                <option v-for="(item, index) in programList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                            </select>
                            <has-error :form="form" field="program_id"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
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
            awardList:[],
            programList:[],

            form: new form({
                id: '',
                name: '',
                code:'',
                award_type_id:'',
                program_id:'',
                description:'',
                status: 1,
                model:'StudentAwards',
                action_type:'edit',
            })
        }
    },
    methods: {
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="award_type_id"){
                this.form.award_type_id=$('#award_type_id').val();
            }
            if(id=="program_id"){
                this.form.program_id=$('#program_id').val();
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
                this.form.description='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.submitstudentmaster('student_award_list');
            }
		}, 
    },
    async mounted(){
        this.awardList =await this.loadActiveAwardList();
        this.programList =await this.loadActiveProgramList();
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
    },
     created() {
        this.form.name=this.$route.params.data.Name;
        this.form.description=this.$route.params.data.Description;
        this.form.code=this.$route.params.data.Code;
        this.form.award_type_id=this.$route.params.data.CeaAwardTypeId;
        this.form.program_id=this.$route.params.data.CeaProgrammeId;
        this.form.status=this.$route.params.data.Status;
        this.form.id=this.$route.params.data.id;
    },
    
}
</script>