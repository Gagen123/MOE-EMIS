<template>
    <div>
        <form class="bootbox-form" id="contactTypeId">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Document Type:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:</label>
                        <textarea class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" type="text"/>
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" type="text"/>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" tabindex="2"/> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" tabindex="3"/> Inactive</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Document For:<span class="text-danger">*</span></label>
                        <span v-for='(doc, index) in doc_for' :key="index">
                            <select name="addfield_1" id="addfield_1" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('addfield_1') }" v-model="doc.addfield_1">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in service_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select><br>
                        </span>
                        <has-error :form="form" field="addfield_1"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <br>
                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove" @click="remove()"><i class="fa fa-trash"></i> Remove</button>
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
            service_list:'',
            doc_for:
            [{
                addfield_1:''
            }],
            form: new form({
                id: '',
                name: '',
                code:'',
                addfield_1:'',
                description:'',
                status: 1,
                action_type:'add',
                model:'DocumentType'
            })
        }
    },

    methods:{
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        addMore: function(){
            this.doc_for.push({ addfield_1:''})
        },

        remove(index){
             if(this.doc_for.length>1){
                this.doc_for.pop();
            }
        },
        loadservices(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/Service'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.service_list =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.description= '';
                this.form.status= 1;
            }
            // if(type=="save"){
            //     this.form.addfield_1=[];
            //     for(let i=0;i<this.doc_for.length;i++){
            //         this.form.addfield_1.push(this.doc_for[i].addfield_1);
            //     }
            //     this.form.post('masters/organizationMasterController/saveOrganizationMaster')
            //     .then(() => {
            //         Toast.fire({
            //             icon: 'success',
            //             title: 'Department is added successfully'
            //         })
            //         this.$router.push('/list_document_type');
            //     })
            //     .catch((err) => {
            //         console.log("Error:"+err)
            //     })
            // }
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.form.addfield_1=[];
                        for(let i=0;i<this.doc_for.length;i++){
                            this.form.addfield_1.push(this.doc_for[i].addfield_1);
                        }
                        this.form.post('masters/organizationMasterController/saveOrganizationMaster',this.form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/list_document_type');
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured. Try again.'
                            });
                            console.log("Error:"+error);
                        })
                    }
                })
            }
		},
    },
    created(){
        this.loadservices();
    }
}
</script>
