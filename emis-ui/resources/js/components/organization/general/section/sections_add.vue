<template>
    <div>
        <form class="bootbox-form" id="equipmentId">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row form-group">
                        <input type="hidden" class="form-control" v-model="form.organizationId"/>
                        <input type="hidden" class="form-control" v-model="form.id"/>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>School:<span class="text-danger">*</span></label> 
                            <select name="school" id="school" class="form-control select2" v-model="form.school" :class="{ 'is-invalid': form.errors.has('school') }">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="school"></has-error>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Class:<span class="text-danger">*</span></label> 
                            <select name="classes" id="classes" class="form-control select2" :class="{ 'is-invalid': form.errors.has('classes') }" v-model="form.classes">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in classList" :key="index" v-bind:value="item.record_id">{{ item.class }}</option>
                            </select>
                            <has-error :form="form" field="classes"></has-error>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="stream_section">
                            <label>Stream:<span class="text-danger"></span></label> 
                            <select name="stream" id="stream" class="form-control select2" v-model="form.stream">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in streamList" :key="index" v-bind:value="item.record_id">{{ item.stream }}</option>
                            </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>No. of Sections:<span class="text-danger">*</span></label> 
                            <input type="number" class="form-control" @keyup.enter="secSections()" @blur="secSections()" id="nosec" name="nosec"/>
                        </div> 
                    </div> 
                    <div class="row form-group mb-0">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Sections:<span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pt-2" v-for='(user, index) in form.users' :key="index">
                            <input type="text" readonly class="form-control section" id="section" v-model="user.section"/>
                        </div> 
                    </div> 
                    <!-- <div class="form-group row">
                        <div class="col-4">
                            <button type="button" class=" btn btn-flat btn-sm btn-primary"
                            @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                            <button type="button" class=" btn btn-flat btn-sm btn-danger" value="Remove"
                            @click="remove()" ><i class="fa fa-trash"></i> Remove</button>
                        </div>
                    </div> -->
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
        return{
            secval:['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'],
            count:1,
            users: [],
            classList:[],
            schoolList:[],
            streamList:[],
            form: new form({
                id: '',
                school: '',
                classes: '',
                class_stream_id:'',
                stream:'',
                action_type:'add',
                users:
                [{
                    section:''
                }]  
            }),
        }
    },

    methods:{
        secSections(){
            this.form.users=[];
            let sections=[];
            if($('#nosec').val()<2){
                Swal.fire({
                    html: "You cannot create single or less section",
                    icon: 'error'
                });
            }
            else{
                for(let i=0;i<$('#nosec').val();i++){
                    sections.push({section:this.secval[i]});
                }
                this.form.users=sections;
            }
        },
        
        /**
         * method to get current user organization
         */
        getschoolDetials(uri = 'organization/getschoolDetials'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.schoolList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#closure-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+errid).html(''); 
            }
        },

        /**
         * method to reset form
         */
        resetForm(){
            this.form.school= '';
            this.form.classes= '';
            this.form.class_stream_id='';
            this.form.stream='';
            let formReset =this.form.users;
            formReset.splice(0, formReset.length);
            this.form.users.push({section:''})
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.resetForm();  
            }
            if(type=="save"){
                this.form.post('/organization/saveSection',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Section is added successfully'
                    })
                    this.resetForm();
                    this.applyselect();
                    this.resetForm(); 
                    this.form.school= '';
                    this.form.classes= '';
                    this.form.class_stream_id='';
                    this.form.stream='';
                })
                .catch(() => {
                    console.log("Error......");
                    this.applyselect();
                });
            }
		},
        applyselect(){
            if(!$('#school').attr('class').includes('select2-hidden-accessible')){
                $('#school').addClass('select2-hidden-accessible');
            }
            if(!$('#classes').attr('class').includes('select2-hidden-accessible')){
                $('#classes').addClass('select2-hidden-accessible');
            }
            if(!$('#stream').attr('class').includes('select2-hidden-accessible')){
                $('#stream').addClass('select2-hidden-accessible');
            } 
         },
         changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="school"){
                this.form.school=$('#school').val();
                this.getClassByOrganizationId();
            }
            if(id=="classes"){
                let classText = $('#classes option:selected').text();
                if(classText == "XI" || classText == "XII"){
                    this.getStreamByClassId($('#classes').val());
                }
                else{
                    this.getExistingSection($('#classes').val());
                    $('#stream_section').hide();
                }
                this.form.classes=$('#classes').val();
            }
            if(id=="stream"){
                this.form.stream=$('#stream').val();
                this.getExistingSection($('#stream').val());
            }
         },

        /**
         * method to get class by organizationId
         */
        getClassByOrganizationId:function(){
            axios.get('/organization/getClassByOrganizationId/'+this.form.school)
              .then(response => {
                  let data = response.data;
                  this.classList = data;
            });
        },

        /**
         * method to get class by classId
        */
        getStreamByClassId(classid){
            axios.get('/organization/getStreamByClassId/'+classid)
              .then(response => {
                let data = response.data;
                if(data==""){
                    this.form.class_stream_id=classid;
                    $('#stream_section').hide();
                }
                else{
                    this.streamList = data;
                    $('#stream_section').show();
                }
            });
        },

        /**
         * method to get existing section by class
         */
        getExistingSection(classId){
            this.form.class_stream_id=classId;
            this.form.users=[];
            axios.get('/organization/getExistingSectionByClass/'+classId)
            .then(response => {
                let data = response.data;
                if(data != ""){
                    let sections=[];
                    for(let i=0;i<data.length;i++){
                        sections.push({section:data[i].section});
                    }
                    this.count=data.length;
                    this.form.users=sections;
                    this.form.id = data[0].id;
                }
            });
        },

        setClassStreamId(){
            this.form.class_stream_id=this.form.stream;
        },

        /**
         * method to get section details by orgId
         */
        getSectionDetails(id){
            axios.get('organization/getSectionDetails/'+id)
            .then((response) => {  
                let data=response.data.data;
                this.form.school  = data[0].organizationId;
                this.getClassByOrganizationId();
                this.form.classes = data[0].classId;
                this.form.stream  = data[0].streamId;
                let sections=[];
                for(let i=0;i<data.length;i++){
                    sections.push({section:data[i].section});
                }
                this.count=data.length;
                this.form.users=sections;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            });
        },

        /**method to add more field */
        addMore: function(){
            this.count++;
            this.form.users.push({section:''})
        },
        
        /** method to remove field */
        remove(index){    
             if(this.form.users.length>1){
                this.count--;
                this.form.users.splice(index,1); 
            }
        },
    },

    mounted(){
        this.form.organizationId = this.$route.query.orgId; 
        this.getschoolDetials();
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
    }
}
</script>