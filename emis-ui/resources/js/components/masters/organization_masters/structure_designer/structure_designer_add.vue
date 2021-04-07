<template>
    <div>
        <form class="bootbox-form" id="structureDesignerId">
        <div class="card-body">
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Designer Name:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="form.disgnerName" :class="{ 'is-invalid': form.errors.has('disgnerName') }" id="disgnerName" @change="remove_err('disgnerName')" type="text" tabindex="1" autofocus="true">
                    <has-error :form="form" field="disgnerName"></has-error>
                </div>
                
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="required">Status:</label>
                    <br>
                    <label><input v-model="form.status"  type="radio" value="1" tabindex="2"/> Active</label>
                    <label><input v-model="form.status"  type="radio" value="0" tabindex="3"/> Inactive</label>
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
            count:10,
            form: new form({
                id: '',
                disgnerName: '',
                status: 1,
            })
        }
    },

    methods:{
        
    }
}
</script>