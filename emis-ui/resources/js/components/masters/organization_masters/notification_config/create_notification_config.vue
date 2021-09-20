<template>
    <div>
        <form class="bootbox-form">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Service Name:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="service_id" v-model="form.service_id" :class="{ 'is-invalid': form.errors.has('service_id') }">
                            <option v-for="(item, index) in service_list" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="service_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Submitter:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="submitter_role_id" v-model="form.submitter_role_id" :class="{ 'is-invalid': form.errors.has('submitter_role_id') }">
                            <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="form" field="submitter_role_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Notification To:<span class="text-danger">*</span></label>
                        <select class="form-control select2" id="notification_to_role_id" v-model="form.notification_to_role_id" :class="{ 'is-invalid': form.errors.has('notification_to_role_id') }">
                            <option v-for="(item, index) in roleList" :key="index" v-bind:value="item.Id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="form" field="notification_to_role_id"></has-error>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            service_list:[],
            roleList:[],
            count:1,
            form: new form({
                id: '',
                service_id:'',
                submitter_role_id:'',
                notification_to_role_id:'',
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
        loadservices(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active_notification_type/Service'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.service_list =  data;
            })
            .catch(function (error) {
                console.log('error: '+error);
            });
        },
        loadroleList(uri = 'masters/getroles/allActiveRoles'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.roleList =  data.data;
            })
            .catch(function (error){
                console.log(error);
            });
        },

		formaction: function(type){
            if(type=="save"){
                this.form.post('masters/organizationMasterController/saveNotificationConfigMasters',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.applyselect2();
                    this.$router.push('/list_leave_config');
                })
                .catch((err) => {
                    this.applyselect2();
                    console.log("Error: "+err)
                })
            }
		},
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
        },
        applyselect2(){
            if(!$('#service_id').attr('class').includes('select2-hidden-accessible')){
                $('#service_id').addClass('select2-hidden-accessible');
            }
            if(!$('#submitter_id').attr('class').includes('select2-hidden-accessible')){
                $('#submitter_id').addClass('select2-hidden-accessible');
            }
            if(!$('#notification_to_id').attr('class').includes('select2-hidden-accessible')){
                $('#notification_to_id').addClass('select2-hidden-accessible');
            }
        },

    },
    mounted(){
         $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true });
            e.params.data.element.parentElement.dispatchEvent(event);
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true });
        e.params.data.element.parentElement.dispatchEvent(event);
        });
        Fire.$on('changeval',(id)=>{
            this.changefunction(id);
        });
        
        this.loadservices();
        this.loadroleList();
    },
}
</script>
