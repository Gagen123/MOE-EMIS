<template>
    <div>
        <form class="bootbox-form" autocomplete="off">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Serial No.:<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm text-right" v-model="form.sequence_no" :class="{ 'is-invalid': form.errors.has('sequence_no') }" id="sequence_no" @change="remove_err('sequence_no')" type="text">
                        <has-error :form="form" field="sequence_no"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Domain:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="spm_domain_id" v-model="form.spm_domain_id" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('spm_domain_id') }" @change="remove_err('spm_domain_id')">
                            <option value=""> ---Select---</option>
                            <option v-for="(item, index) in domains" :key="index" v-bind:value="item.id">
                                {{ item.name }}
                            </option>
                        </select> 
                        <has-error :form="form" field="spm_domain_id"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Area:<span class="text-danger">*</span></label> 
                        <input class="form-control form-control-sm" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" id="name" @change="remove_err('name')" type="text">
                        <has-error :form="form" field="name"></has-error>
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
                <button type="button" @click="save" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data(){
        return {
            domains:[],
            form: new form({
                id:'',
                name: '',
                spm_domain_id:'',
                sequence_no:'',
                status:1,
                record_type:'area',
                action_type:'edit',
            })
        }
    },
    methods: {
        getDomains(){
            axios.get('masters/loadSpmMasters/all_active_domains')
            .then(response => {
                let data = response 
                this.domains =  data.data.data
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid')
            }
        },
		save(){
            this.form.post('/masters/saveSpmMasters',this.form)
                .then(() => {
                Toast.fire({
                    icon: 'success',
                    title: 'Details added successfully'
                })
                this.$router.push('/list-area')
            })
            .catch(() => {
                console.log("Error.")
            })
		}, 
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true })
            e.params.data.element.parentElement.dispatchEvent(event)
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true })
        e.params.data.element.parentElement.dispatchEvent(event)
        });
        this.getDomains()
    },
    created(){
        this.form.id = this.$route.params.data.id
        this.form.spm_domain_id = this.$route.params.data.spm_domain_id
        this.form.name = this.$route.params.data.name
        this.form.sequence_no = this.$route.params.data.sequence_no
        this.form.status = this.$route.params.data.status
    },
}
</script>