<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Class:</label>
                    <select v-model="form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('std_class') }" @change="aboveClass10()"  class="form-control select2" name="std_class" id="std_class">
                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                    </select>
                    <has-error :form="form" field="std_class"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stream_selection" style="display:none">
                    <label>Streams:</label>
                    <select v-model="form.std_stream" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('std_stream') }" class="form-control select2" name="std_stream" id="std_stream">
                        <option v-for="(item, index) in streamList" :key="index" v-bind:value="item.stream_id">{{ item.stream }}</option>
                    </select>
                    <has-error :form="form" field="std_stream"></has-error>
                </div> 
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="mb-1">Projection No:<i class="text-danger">*</i></label>
                        <input type="text" @change="remove_error('projections')" v-model="form.projections" :class="{ 'is-invalid': form.errors.has('projections') }" class="form-control" name="projections" id="projections" >
                        <has-error :form="form" field="projections"></has-error>
                    </div> 
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
            studentList:[],
            classList:[],
            sectionList:[],
            streamList:[],

            form: new form({
                id:'',
                std_class: '',
                std_stream: '',
                projections:'',
                date: '',
                remarks:'',
                action_type:'add'
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
        
        loadStudentList(uri='organization/loadStudentWhereabouts/'+this.org_id){
            axios.get(uri)
            .then(response => {
                let data = response;
                console.log(data);
                this.studentList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
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
                this.form.student= '';
                this.form.remarks='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/organization/saveProjections',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_projections');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        /**
         * to load the class list
         */
        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get stream list
         */
        getStreamList(id){
            let classId=$('#std_class').val();
            if(id!="" && classId==null){
                classId=id;
            }
            let uri = 'loadCommons/loadStreamList/'+classId;
            this.streamList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.streamList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getSectionList(id){
            let classId=$('#std_class').val();
            if(id!="" && classId==null){
                classId=id;
            }
            let uri = 'loadCommons/loadSectionList/'+classId;
            this.sectionList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.sectionList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="screening"){
                this.form.screening=$('#screening').val();
            }
            if(id=="screening_position"){
                this.form.screening_position=$('#screening_position').val();
            }
            if(id=="screening_endorsed_by"){
                this.form.screening_endorsed_by=$('#screening_endorsed_by').val();
            }
            if(id=="std_class"){
                this.form.std_class=$('#std_class').val();
                let class_selected = $("#std_class").val();
                this.getStreamList();
                this.getSectionList();
                if(class_selected == 11 || class_selected == 12){
                    $(".stream_selection").show();
                    $(".section_selection").show();
                }else{
                    $(".section_selection").show();
                    $(".stream_selection").hide();
                }
            }

            if(id=="std_stream"){
                this.form.std_stream=$('#std_stream').val();
            }
            if(id=="std_section"){
                axios.get('/students/loadStudentBySection/'+$('#std_class').val()+'__'+$('#std_stream').val()+'__'+$('#std_section').val())
                    .then((response) => {
                        this.studentList = response.data;  
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });

                this.form.std_section=$('#std_section').val();
            }
            
        },
        checkall(class_to_check,id){
            if($('#'+id).prop('checked')){
                $("."+class_to_check).prop("checked",true);
            }
            else{
                $("."+class_to_check).prop("checked",false);
            }
        }
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

        this.loadStudentList();
        this.loadClassList();
        this.loadSectionList();
        this.loadStreamList();
    },
    
}
</script>