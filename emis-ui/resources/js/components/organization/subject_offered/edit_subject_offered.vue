<template>
    <div>
        <form>
             <div class="ml-0 row form-group">
                <div class="mr-3">
                    <strong>Class: </strong> {{ cl }} <span v-if="stream">{{ stream }}</span> <span v-if="section">{{ section }}</span> 
                </div>
             </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="subject-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Optional Subject</th>
                                <th>Is offered</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in dataList" :key="index">
                                <td>
                                    {{ item.name }}
                                </td>
                                <td >
                                    <input type="checkbox" name="class" v-model="dataList[index].is_offered" :value="item.is_offered">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <span class="text-danger" id="sugject_error"></span>
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
            subjectList:[],
            dataList:[],
            record_type:'edit',
            dt:''
        }
    },
    methods: {
        loadAcademicMasters(){
          let uri = "masters/loadAcademicMasters/optional_subject_classId_"+this.classId
            if(this.streamId){
                 uri += '_streamId_'+this.streamId
            }
            if(this.sectionId){
                uri +='_sectionId_'+this.sectionId
            }
            axios.get(uri)
            .then(response => {
               this.subjectList = response.data.data
            }).catch((error) => {
                console.log("Error: "+error);
            });
        },
        loadDataList(uri="organization/getSubjectMapping"){
            axios.get(uri)
            .then(response => {
                let orgOptionalsubjects = response.data
                let optionalSubjects = this.subjectList
                optionalSubjects.forEach((item,index)=>{
                    optionalSubjects[index]['is_offered'] = 0
                    optionalSubjects[index]['org_section_id'] = this.sectionId
                    orgOptionalsubjects.forEach(item2 => {
                        if(item.aca_sub_id == item2.aca_sub_id && item.org_class_id ==item2.classId && (item.org_stream_id ==item2.streamId || (item.org_stream_id == null && item2.streamId == null)) && item2.sectionId==this.sectionId){
                            optionalSubjects[index]['org_class_id'] = item2.classId
                            optionalSubjects[index]['org_stream_id'] = item2.streamId
                            optionalSubjects[index]['org_section_id'] = this.sectionId
                            optionalSubjects[index]['is_offered'] = 1
                        }

                    })
                })
                this.dataList=optionalSubjects;
            })

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
               let filterData = this.dataList.filter(item=>item.is_offered==true)
                axios.post('/organization/saveSubjectMapping',{data:filterData})
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_subject_offered');
                })
                .catch((error) => {
                    console.log("Error:"+error)
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
    },
    created(){
        this.cl =this.$route.params.data.class;
        this.classId=this.$route.params.data.org_class_id;
        this.section = this.$route.params.data.section;
        this.streamId=this.$route.params.data.org_stream_id;
        this.sectionId=this.$route.params.data.org_section_id;
        this.stream=this.$route.params.data.stream;
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
        this.loadAcademicMasters();
        this.loadDataList();
        this.dt =  $("#subject-table").DataTable({
            distroy:true,
        })
    },
      watch: {
        dataList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#subject-table").DataTable({
                    distroy:true,
                })
            });
        }
    }
}
</script>
