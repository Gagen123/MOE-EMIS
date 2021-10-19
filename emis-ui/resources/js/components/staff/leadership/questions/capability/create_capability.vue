<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Category:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="category" v-model="form.category" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('category') }">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in category_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="category"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Name:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="dzongkhag_name" @change="remove_error('dzongkhag_name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_error('description')" ></textarea>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label>Code:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_error('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pt-2">
                        <label class="required">status:</label>
                        <br>
                        <label><input v-model="form.status" type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status" type="radio" value="0" /> Inactive</label>
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
            category_list:[],
            form: new form({
                id: '',
                category:'',
                name: '',
                code:'',
                status:1,
                description:'',
                model:'staff_leadership___Capability',
                action_type:'add',
            })
        }
    },
    methods: {
		formaction: function(type){
            if(type=="save"){
               this.submitstaffmaster('list_capability');
            }
		},

    },
    async mounted(){
        this.category_list =  await this.loadstaffMasters('active','staff_leadership___QuestionCategory');
    },
}
</script>
