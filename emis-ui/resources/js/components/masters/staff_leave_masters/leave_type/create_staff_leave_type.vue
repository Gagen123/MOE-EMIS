<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Type:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
                    </div>
                    <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Leave Category:<span class="text-danger">*</span></label> <br>
                        <label><input v-model="form.category"  type="radio" value="Months" /> Months</label>
                        <label><input v-model="form.category"  type="radio" value="Days" /> Days</label>
                    </div> -->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Number of Days:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.no_days" :class="{ 'is-invalid': form.errors.has('no_days') }" id="no_days" @change="remove_err('no_days')" type="number">
                        <has-error :form="form" field="no_days"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Code:<span class="text-danger">*</span></label>
                        <input class="form-control" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" id="code" @change="remove_err('code')" type="text">
                        <has-error :form="form" field="code"></has-error>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Carry Forward:</label>
                        <br>
                        <label><input v-model="form.carryforward"  type="radio" value="1" /> Yes</label>
                        <label><input v-model="form.carryforward"  type="radio" value="0" /> No</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="required">Status:</label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" /> Active</label>
                        <label><input v-model="form.status"  type="radio" value="0" /> Inactive</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Description:</label>
                        <textarea class="form-control" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" id="description" @change="remove_error('description')" ></textarea>
                        <has-error :form="form" field="description"></has-error>
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
        return {
            form: new form({
                id: '',
                name: '',
                category:'',
                carryforward:0,
                no_days:'',
                code:'',
                description:'',
                status:1,
                model:'LeaveType',
                action_type:'add',
            })
        }
    },
    methods: {
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.submitstaffmaster('list_leave_type');
            }
		},
    },
}
</script>
