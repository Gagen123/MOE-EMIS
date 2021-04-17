<template>
    <div>
        <form class="bootbox-form" id="equipmentId">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row form-group">
                        <input type="hidden" class="form-control" v-model="form.organizationId"/>
                        <input type="hidden" class="form-control" v-model="form.id"/>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>School:<span class="text-danger">*</span></label> 
                            <select name="school" id="school" class="form-control" v-model="form.school" :class="{ 'is-invalid': form.errors.has('spo_name') }"  @change="remove_err('school'),getClassByOrganizationId()">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="str_name"></has-error>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Class:<span class="text-danger">*</span></label> 
                            <select name="class" id="class" class="form-control editable_fields" v-model="form.classes" @change="getStreamByClassId(),getExistingSectionByClass()">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in classList" :key="index" v-bind:value="item.record_id+'_'+item.id">{{ item.class }}</option>
                            </select>
                            <has-error :form="form" field="str_name"></has-error>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" id="stream_section">
                            <label>Stream:<span class="text-danger"></span></label> 
                            <select name="stream" id="stream" class="form-control editable_fields" v-model="form.stream" @change="setClassStreamId(),getExistingSectionByStream()">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in streamList" :key="index" v-bind:value="item.record_id">{{ item.stream }}</option>
                            </select>
                        </div>
                    </div>  
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Sections:<span class="text-danger">*</span></label>
                        <div class="form-group row" v-for='(user, index) in form.users' :key="index" > 
                            <input type="text" class="form-control" id="section" v-model="user.section"/>
                        </div>    
                    </div>  
                    <div class="form-group row">
                        <div class="col-4">
                            <button type="button" class=" btn btn-flat btn-sm btn-primary"
                            @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                            <button type="button" class=" btn btn-flat btn-sm btn-danger" value="Remove"
                            @click="remove()" ><i class="fa fa-trash"></i> Remove</button>
                        </div>
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
        return{
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
            }
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.form.school= '';
                this.form.classes= '';
                // this.form.section= '';
            }
            if(type=="save"){
                this.form.post('/organization/saveSection',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Section is added successfully'
                    })
                })
                .catch(() => {
                    console.log("Error......")
                })
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
        getStreamByClassId:function(){
            let classid=this.form.classes.split('_')[1];
            axios.get('/organization/getStreamByClassId/'+classid)
              .then(response => {
                let data = response.data;
                if(data==""){
                    this.form.class_stream_id=this.form.classes.split('_')[0];
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
        getExistingSectionByClass(){
            let classText = $('#class option:selected').text();
            let classid=this.form.classes.split('_')[1];
            axios.get('/organization/getExistingSectionByClass/'+classid)
              .then(response => {
                if(classText == "XI" || classText == "XII"){
                }else{
                    let data = response.data;
                    if(data == ""){
                    }else{
                        let sections=[];
                        for(let i=0;i<data.length;i++){
                            sections.push({section:data[i].section});
                        }
                        this.count=data.length;
                        this.form.users=sections;
                        this.form.id = data[0].id;
                    }
                }
            });
        },

        /**
         * method to get existing section by class
         */
        getExistingSectionByStream(){
            let classid=this.form.classes.split('_')[1];
            let streamid=this.form.class_stream_id;
            axios.get('/organization/getExistingSectionByStream/'+classid +'/'+streamid)
              .then(response => {
                  let data = response.data;
                  if(data == ""){
                      
                  }else{
                    let sections=[];
                    for(let i=0;i<data.length;i++){
                        sections.push({section:data[i].section});
                    }
                    this.count=data.length;
                    this.form.users=sections;
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
        this.getschoolDetials();
        // this.getSectionDetails(this.$route.query.orgId); 
        this.form.organizationId = this.$route.query.orgId;     
    }
}
</script>