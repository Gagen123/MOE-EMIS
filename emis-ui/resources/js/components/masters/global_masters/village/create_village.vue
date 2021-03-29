<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Dzongkhag/Thromde:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="dzo_id">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in dzo_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Gewog:<span class="text-danger">*</span></label> 
                        <select class="form-control" id="parent_field" v-model="form.parent_field" :class="{ 'is-invalid': form.errors.has('parent_field') }">
                            <option v-for="(item, index) in gewog_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> 
                        <has-error :form="form" field="parent_field"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Village Name:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
            dzo_list:[],
            gewog_list:[],
            form: new form({
                id: '',
                parent_field:'',
                name: '',
                code:'',
                status: 1,
                record_type:'village',
                action_type:'add',
            })
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loaddzolist(uri = 'masters/load_global_masters/all_active_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzo_list =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error."+error)
            });
        },
        async getgewoglist(){
            let dzoId=$('#dzo_id').val();
            let uri = 'masters/all_active_dropdowns/dzongkhag/'+dzoId;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.gewog_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/masters/save_global_masters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_village');
                })
                .catch((error) => {
                    console.log("Error."+error)
                })
            }
		}, 
    },
    mounted(){ 
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        this.loaddzolist();
        $('.select2').on('select2:select', function (){
            if($(this).attr('id')=="dzo_id"){
                Fire.$emit('changeval')
            }
        });
        Fire.$on('changeval',()=> {
            this.getgewoglist();
        });
    },
    
    
}
</script>