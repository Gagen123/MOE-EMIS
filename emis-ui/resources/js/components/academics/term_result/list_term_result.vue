
<template>
    <div>
        <div class="form-group row">
             <!-- <div class="row form-group">
               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Class:<span class="text-danger">*</span></label> 
                    <select class="form-control select2" id="class_stream_section_id" v-model="class_stream_section_id" :class="{ 'is-invalid select2-hidden-accessible': form.errors.has('org_class_id') }"  @change="remove_err('org_class_id');">
                        <option value=""> --Select--</option>
                        <option v-for="(item, index) in classes" :key="index" v-bind:value="[item.OrgClassStreamId,item.org_class_id,item.org_stream_id,item.org_section_id,item.class_stream_section]">
                            {{ item.class_stream_section }} 
                        </option>
                    </select> 
                    <has-error :form="form" field="org_class_id"></has-error>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Term:<span class="text-danger">*</span></label> 
                        <select class="form-control select2" id="aca_assmt_term_id" v-model="form.aca_assmt_term_id" :class="{ 'is-invalid select2-hidden-accessible': form.errors.has('aca_assmt_term_id') }"  @change="remove_err('aca_term_id')">
                            <option value=""> --Select--</option>
                            <option v-for="(item, index) in terms" :key="index" v-bind:value="item.id">
                                {{ item.name }} 
                            </option>
                        </select> 
                        <has-error :form="form" field="aca_assmt_term_id"></has-error>
                </div>
                <div class="col-auto pt-1 mt-4">
                    <button type="button" class="btn btn-primary btn-sm" @click="getTermResult()"><i class="fa fa-download"></i> Fetch Student</button>
                </div>
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="assessment-term-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Term</th> 
                        <th>Result Status</th> 
                        <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in classSubjectTermList" :key="index">
                            <td>{{ item.class_stream_section }}</td>
                            <td>{{ item.sub_name }} <span v-if="item.sub_dzo_name">( {{ item.sub_dzo_name }} )</span></td>
                            <td>{{item.term_name}} <span v-if="item.term_dzo_name && item.sub_dzo_name">( {{ item.term_dzo_name }} )</span></td>
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
                                    <div class="btn btn-info btn-sm btn-default text-white" width="500" @click="showedit(item)">
                                        <span v-if="item.std_assmt_id"><i class="fas fa-edit"></i >Edit</span>
                                        <span v-else><i class="fas fa-plus"></i >Add</span>
                                    </div>
                                </div>
                                <div v-if="item.std_assmt_id" class="ml-2 mt-1 btn-group btn-group-sm">
                                    <router-link :to="{name:'view_term_result', params: {data:item}}" class="btn btn-info btn-sm btn-flat text-white"><i class="fa fa-eye"></i > View</router-link>
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
            classSubjectTermList:[],
            dt:''
        }
    },
    methods:{
        async classSubjectTeacher(){
            try{
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => { return response.data})
                // let subjectTeacher = await axios.get('academics/loadClassBySubjectTeacher').then(response=> {
                //     console.log(response);
                // })
                let classSubjectTerms = await axios.get('academics/loadStudentAssessmentList').then(response => {
                    return response.data.data
                })
                classSubjectTerms.forEach((classSubjectTerm,index) => {
                    classSections.forEach(item => {
                        if(classSubjectTerm.org_class_id == item.org_class_id && (classSubjectTerm.org_stream_id == item.org_stream_id || (classSubjectTerm.org_stream_id == null && item.org_stream_id == null)) && (classSubjectTerm.org_section_id == item.org_section_id || (classSubjectTerm.org_section_id == null && item.org_section_id == null))){
                            if(item.stream && item.section){
                                classSubjectTerms[index].class_stream_section = item.class+' '+item.stream+' '+item.section
                            }else if(item.stream){
                                classSubjectTerms[index].class_stream_section = item.class+' '+item.stream
                            }else if(item.section){
                                classSubjectTerms[index].class_stream_section = item.class+' '+item.section
                            }else{
                                classSubjectTerms[index].class_stream_section = item.class
                            }
                            classSubjectTerms[index].OrgClassStreamId = item.OrgClassStreamId
                        }
                    })
                })
                this.classSubjectTermList = classSubjectTerms
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }   
           },
        showedit(data){
            this.$router.push({name:'edit_term_result',params: {data:data}});
        },
        // getTerms(){
        //     this.terms = [];
        //     let uri = 'academics/getTermsByClass/'+this.class_stream_section_id[1]
        //     if(this.class_stream_section_id[2] !== null){
        //         uri += ('/'+this.class_stream_section_id[2])
        //     }
        //     axios.get(uri).then((response)=>{
        //         this.terms = response.data.data
        //     })
        // },
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
        this.classSubjectTeacher()
        this.getTerms()
        this.dt = $("#assessment-term-table").DataTable({
            "order": [[ 0, "asc" ]]
        })

    },
    watch: {
        classSubjectTermList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#assessment-term-table").DataTable()
            });
        }
    }
        
}
</script>