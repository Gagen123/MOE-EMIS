
<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Class:<span class="text-danger">*</span></label> 
                <select class="form-control select2" id="class_stream_section_id" v-model="class_stream_section_id" @change="getTerms(); getTermResult();">
                    <option value=""> --Select--</option>
                    <option v-for="(item, index) in classList" :key="index" v-bind:value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                        {{ item.class_stream_section }} 
                    </option>
                </select> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label>Term:<span class="text-danger">*</span></label> 
                <select class="form-control select2" id="aca_assmt_term_id" v-model="aca_assmt_term_id"  @change="getTermResult()">
                    <option value=""> --Select--</option>
                    <option v-for="(item, index) in terms" :key="index" v-bind:value="item.id">
                        {{ item.name }} <span v-if="item.term_dzo_name">( {{ item.term_dzo_name }} )</span>
                    </option>
                </select> 
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-4">
                <table id="assessment-term-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Subject</th>
                        <th>Result Status</th> 
                        <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in TermsResultList" :key="index">
                            <td>{{ item.sub_name }} <span v-if="item.sub_dzo_name">( {{ item.sub_dzo_name }} )</span></td>
                            <td>
                                <span v-if="item.finalized"><strong>Finalized</strong> by
                                    <span v-if="item.assessed_by_class_teacher">class</span>
                                    <span v-else>subject</span> teacher on {{item.finalized_date}}
                                </span>
                                <span v-else-if="item.std_assmt_id"><strong>Under process</strong> with 
                                    <span v-if="item.assessed_by_class_teacher">class</span>
                                    <span v-else>subject</span> teacher
                                </span>
                                <span v-else><strong>Not added</strong></span>
                            </td>
                            <td>
                                 <div v-if="item.finalized && item.is_class_teacher" class="ml-2 btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="unlockForEdit(item.std_assmt_id)"><i class="fa fa-unlock-alt"></i > Undo Finalize </div>
                                </div>
                                <div v-else-if="item.is_subject_teacher && !item.finalized" class="ml-2 btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-default text-white" width="500" @click="showedit('edit_term_result',item)">
                                        <span v-if="item.std_assmt_id"><i class="fas fa-edit"></i > Edit</span>
                                        <span v-else><i class="fas fa-plus"></i > Add</span>
                                    </div>
                                </div>
                                <div v-if="item.std_assmt_id" class="ml-2 mt-1 btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit('view_term_result',item)"> <i class="fas fa-eye"></i > View</div>
                                </div>
                              
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return{
            classList:[],
            terms:[],
            aca_assmt_term_id:'',
            class_stream_section_id:'',
            TermsResultList:[],
            dt:'',
        }
    },
    methods:{
        async classSubjectTeacher(){
            try{
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                let subjectTeachers = await axios.get('academics/loadClassBySubjectTeacher').then(response=> {return response.data.data})
                subjectTeachers.forEach((subjectTeacher,index) => {
                    classSections.forEach(item => {
                        if(subjectTeacher.org_class_id == item.org_class_id && (subjectTeacher.org_stream_id == item.org_stream_id || ((subjectTeacher.org_stream_id == null || subjectTeacher.org_stream_id == "") && (item.org_stream_id == null || item.org_stream_id == ""))) && (subjectTeacher.org_section_id == item.org_section_id || ((subjectTeacher.org_section_id == null || subjectTeacher.org_section_id == "") && (item.org_section_id == null || item.org_section_id == "")))){
                            if(item.stream && item.section){
                                subjectTeachers[index].class_stream_section = item.class+' '+item.stream+' '+item.section
                            }else if(item.stream){
                                subjectTeachers[index].class_stream_section = item.class+' '+item.stream
                            }else if(item.section){
                                subjectTeachers[index].class_stream_section = item.class+' '+item.section
                            }else{
                                subjectTeachers[index].class_stream_section = item.class
                            }
                            subjectTeachers[index].OrgClassStreamId = item.OrgClassStreamId
                        }
                    })
                })

                this.classList = subjectTeachers
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }   
           },
        showedit(route,data){
            this.$router.push({name:route,params: {data:data,class_stream_section:this.class_stream_section_id}});
        },
        getTerms(){
            this.terms=[];
            let uri = 'academics/getTermsByClass/'+this.class_stream_section_id[1]
            if(this.class_stream_section_id[2]){
                uri += ('/'+this.class_stream_section_id[2])
            }
            axios.get(uri).then((response)=>{
                this.terms = response.data.data
            })
        },
       async getTermResult(){
            this.TermsResultList = []
            let uri = 'academics/loadStudentAssessmentList'
            uri += ('?aca_assmt_term_id='+this.aca_assmt_term_id+'&org_class_id='+this.class_stream_section_id[1])
           if(this.class_stream_section_id[2] !== null){
                    uri += ('&org_stream_id='+this.class_stream_section_id[2])
            }
            if(this.class_stream_section_id[3] !== null){
                uri += ('&org_section_id='+this.class_stream_section_id[3])
            }
            axios.get(uri).then(response=>{
                this.TermsResultList =  response.data
            })
        },
        unlockForEdit(Id){
            Swal.fire({
                title: 'Are you sure you want to undo finalize (unlock for editing)?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                        axios.post('/academics/unlockForEdit/'+Id)
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Result unlocked for editing by subject teacher.'
                                })
                                window.location.reload()
                                this.$router.push('/list-term-result');
                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
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
            const event = new Event("change", { bubbles: true, cancelable: true });
            e.params.data.element.parentElement.dispatchEvent(event);
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true });
        e.params.data.element.parentElement.dispatchEvent(event);
        });
        this.classSubjectTeacher()
        this.getTerms()
        this.getTermResult()
        this.dt = $("#assessment-term-table").DataTable({
            "order": [[ 0, "asc" ]],
            "lengthChange": false,
            "searching": false,
        })

    },
    created(){
        if(!(this.$route.params.aca_assmt_term_id == undefined) && !(this.$route.params.aca_assmt_term_id == undefined)){
            this.aca_assmt_term_id=this.$route.params.aca_assmt_term_id.aca_assmt_term_id;
            this.class_stream_section_id=this.$route.params.class_stream_section_id.class_stream_section_id;
        }
    },
    watch: {
        TermsResultList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#assessment-term-table").DataTable({
                    "order": [[ 0, "asc" ]],
                    "lengthChange": false,
                    "searching": false,
                })
            });
        }
    }
        
}
</script>