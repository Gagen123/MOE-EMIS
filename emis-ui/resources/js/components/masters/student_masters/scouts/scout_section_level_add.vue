<template>
    <div>
        <form class="bootbox-form" id="programNameId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label>Scout Section Level Name:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text" autocomplete="off">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label>Scout Section:<span class="text-danger">*</span></label> 
                        <select v-model="form.scout_type" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('scout_type') }" class="form-control select2" name="scout_type" id="scout_type">
                        <option v-for="(item, index) in programList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                    </select>
                    <has-error :form="form" field="scout_type"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-2">
                        <label>Description:</label> 
                        <textarea class="form-control" v-model="form.description" id="description" type="text" autocomplete="off"/>
                    </div>
                </div> 
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2" >
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text" autocomplete="off">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
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
            programList:[],

            form: new form({
                id: '',
                name: '',
                scout_type:'',
                code:'',
                description:'',
                status: 1,
                model:'CeaScoutSectionLevel',
                action_type:'add',
            })
        }
    },
    methods: {
        loadActiveScoutList(uri="masters/loadActiveStudentMasters/CeaScoutSection"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.programList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="scout_type"){
                this.form.scout_type=$('#scout_type').val();
            }
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.description='';
                this.form.status= 1;
            }
             if(type=="save"){
                this.submitstudentmaster('scout_section_level_list');
            }
		}, 
    },
    created() {
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
        this.loadActiveScoutList();
    },
    
}
</script>