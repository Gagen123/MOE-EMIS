<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-1">Visitor Information:<i class="text-danger">*</i></label>
                    <select v-model="form.visitor_information" class="form-control" name="visitor_information" id="visitor_information">
                        <option v-for="(item, index) in visitorTypeList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="visitor_information"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date of Visit:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="form.date" :class="{ 'is-invalid': form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="form" field="remarks"></has-error>
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
            dataList:[],
            visitorTypeList:[],

            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            form: new form({
                id:'',
                remarks: '',
                visitor_information: '',
                date: '',
                action_type:'add'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        
        loadMastersList(uri='organization/loadVisitorInformation'){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        getVisitorTypeDropdown(uri = '/organization/getVisitorTypeDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.visitorTypeList = data;
            });
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.visitor_information= '';
                this.form.remarks='';
                this.form.id= '';
                this.form.date='';
            }
            if(type=="save"){
                this.form.post('/organization/saveVisitorInformation',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list_visitors_information');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
        },

        getVisitorDetails(visId){
            axios.get('organization/getVisitorDetails/'+visId)
            .then((response) => {  
                let data=response.data.data;
                this.form.visitor_information       =    data.visitor;
                this.getVisitorTypeDropdown();
                this.form.remarks                   =    data.remarks;
                this.form.date                      =    data.dateOfVisit;
                this.form.id                        =    data.id;
                
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },



    },
     mounted() {
        this.getVisitorTypeDropdown();
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

        // this.loadMasterList();
    },
    created() {
        this.getVisitorTypeDropdown();
        this.getVisitorDetails(this.$route.params.data.id)
    },
    
}
</script>