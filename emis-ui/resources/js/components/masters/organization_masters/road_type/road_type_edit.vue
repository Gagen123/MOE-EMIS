<template>
    <div>
        <form class="bootbox-form" id="roadTypeId">
            <div class="card-body">
                <div class="row form-group">
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Road Type:<span class="text-danger">*</span></label> 
                        <input class="form-control" v-model="form.roadType" :class="{ 'is-invalid': form.errors.has('roadType') }" id="roadType" @change="remove_err('roadType')" type="text" tabindex="1" autofocus="true">
                        <has-error :form="form" field="roadType"></has-error>
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
                roadType: '',
                status: 1,
                // action_type:'add',
            })
        }
    },

    methods:{
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.roadType= '';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('masters/saveRoadType',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Road Type deatails is updated successfully'
                    })
                    this.$router.push('/road_type_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
    },
    created() {
        this.form.roadType=this.$route.params.data.name;
        this.form.status=this.$route.params.data.status;
        this.form.id=this.$route.params.data.id;
        // this.form.action_type=this.$route.params.data.action;
    },
}
</script>