<template>
    <div>
        <div class="alert alert-warning alert-dismissible" style="display:none" id="warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Information!</h5>
            <div id="message"></div>
        </div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Scout Member:<i class="text-danger">*</i></label>
                    <select v-model="student_form.scout" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('scout') }" class="form-control select2" name="scout" id="scout">
                        <option v-for="(item, index) in memberList" :key="index" v-bind:value="item.StdStudentId+'_'+item.CeaScoutSectionId">{{ item.student_name}} ({{ item.student_code}})</option>
                    </select>
                    <has-error :form="student_form" field="scout"></has-error>
                </div> 
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0.5">Proficiency Badge:<i class="text-danger">*</i></label>
                    <select v-model="student_form.badgeEarned" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('badgeEarned') }" class="form-control select2" name="badgeEarned" id="badgeEarned">
                        <option v-for="(item, index) in badgeList" :key="index" v-bind:value="item.id">{{ item.name}}</option>
                    </select>
                    <has-error :form="student_form" field="badgeEarned"></has-error>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Date of Award of Badge:<span class="text-danger">*</span></label> 
                    <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                    <has-error :form="student_form" field="date"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label class="mb-0.5">Remarks:</label>
                    <textarea @change="remove_error('remarks')" class="form-control" v-model="student_form.remarks" :class="{ 'is-invalid': student_form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                    <has-error :form="student_form" field="remarks"></has-error>
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
            scout_list:'1',
            memberList:[],
            badgeList:[],
            org_id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                id:'',
                scout: '',
                badgeEarned:'',
                date:'',
                remarks:'',
                action_type:'add'
            }),
        }
    },
    methods: {
        loadScoutMemberList(uri="students/listScoutMembers"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.memberList =  data.data.data;
                if(data.data.data != null && data.data.data !=''){
                    this.scout_list='1';
                } else {
                    this.scout_list='0';
                    $('#warning').show();
                    $('#message').html('There are no scouts registered in the class');
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveScoutBagde(id){
            let scout_section=$('#CeaScoutSectionId').val();
            if(id!="" && scout_section==null){
                scout_section=id;
            }
            let uri = '/masters/getScoutBadge/'+scout_section;
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.badgeList = data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
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
                this.student_form.student= '';
                this.student_form.remarks='';
                this.student_form.status= 1;
            }
            if(type=="save"){
                this.student_form.post('/students/saveStudentScoutsBadge',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/scouts_badge_list');
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
            if(id=="scout"){
                let selected_value = $('#scout').val();
                let std_id = selected_value.split("_")[0];
                let scout_section = selected_value.split("_")[1];

                this.student_form.scout= std_id;

                this.loadActiveScoutBagde(scout_section);
            }
            if(id=="badgeEarned"){
                this.student_form.badgeEarned=$('#badgeEarned').val();
            }
        },
    },
     mounted() {
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

        this.loadScoutMemberList();
    },
    
}
</script>