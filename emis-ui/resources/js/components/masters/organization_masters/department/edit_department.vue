<template>
    <div>
        <form class="bootbox-form" id="contactTypeId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Dzongkhag:<span class="text-danger">*</span></label>
                        <select class="form-control" id="dzo_id" v-model="form.dzo_id" :class="{ 'is-invalid': form.errors.has('dzo_id') }">
                            <option v-for="(item, index) in dzo_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="dzo_id_field"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Department Name:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" id="description" type="text"/>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Type:</label>
                        <br>
                        <label><input v-model="form.type"  type="radio" value="ministry"/> Ministry</label>
                        <label><input v-model="form.type"  type="radio" value="dzongkhag"/> Dzongkhag</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger" tabindex="5"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" tabindex="4"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            dzo_list:[],
            form: new form({
                id: '',
                dzo_id:'',
                name: '',
                description:'',
                type:'',
                status: '',
                action_type:'edit',
                model:'DepartmentMaster'
            })
        }
    },

    methods:{
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loaddzolist(uri = 'masters/loadGlobalMasters/all_active_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzo_list =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.description= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('masters/organizationMasterController/saveOrganizationMaster')
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Department is edited successfully'
                    })
                    this.$router.push('/list_department');
                })
                .catch((err) => {
                    console.log("Error:"+err)
                })
            }
		},
    },
    created() {
        this.loaddzolist();
    },
    mounted(){
        this.form.name=this.$route.params.data.name;
        this.form.description=this.$route.params.data.description;
        this.form.status=this.$route.params.data.status;
        this.form.dzo_id=this.$route.params.data.dzo_id;
        this.form.type=this.$route.params.data.type;
        this.form.name=this.$route.params.data.name;
        this.form.id=this.$route.params.data.id;
    }
}
</script>
