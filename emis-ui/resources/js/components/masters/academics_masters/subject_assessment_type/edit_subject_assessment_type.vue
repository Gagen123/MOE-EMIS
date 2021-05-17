<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectGroup">
            <div class="ml-0 row form-group">
                <div class="mr-3">
                    <strong>Class: </strong> {{ className}} {{streamName}} 
                </div>
            </div>  
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="subject-assessment-type-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Rating Type</th>
                                <th>Pass Score</th>
                                <th>Is Elective</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                             <tr v-for="(item, index) in classSubjects" :key="index">
                                <td>
                                    <div class="form-check">
                                        <input v-model="classSubjects[index].sub_selected" :value="item.aca_sub_id" class="form-check-input" type="checkbox" id="subject">
                                        <label class="form-check-label" for="subject">
                                            {{item.subject}}
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <select v-model="classSubjects[index].aca_rating_type_id" :disabled="!classSubjects[index].sub_selected" class="form-control  editable_fields" id="aca_rating_type_id" :class="{ 'is-invalid': errors}"> 
                                            <option selected value="">--SELECT--</option>
                                            <option v-for="(item, index) in rating_type_list" :key="index" :value="item.id">{{ item.name }}</option>
                                        </select>
                                        <has-error v-if="errors" field="aca_rating_type_id"></has-error>
                                    </div>
                                </td>
                                 <td>
                                    <div class="form-check col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <input 
                                            v-model="classSubjects[index].pass_score"
                                            class="form-check-input text-right" 
                                            type="number" id="pass-score" max="100" min="0"
                                            :disabled="!classSubjects[index].sub_selected"
                                        >
                                     
                                    </div>
                                </td>
                                 <td>
                                    <div class="form-check col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <input 
                                            v-model="classSubjects[index].is_elective"
                                            class="form-check-input" 
                                            type="checkbox" id="elective"
                                            :value="item.is_elective"
                                            :disabled="!classSubjects[index].sub_selected"
                                        >
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            errors:'',
            rating_type_list:[],
            classId:'',
            streamId:'',
            className:'',
            streamName:'',
            classSubjects: []
        }
    },
    methods: {
         remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        loadClassSubject(){
            let uri = 'masters/loadClassSubject/'+this.classId
            if(this.streamId !== null){
                uri += ('/'+this.streamId)
            }
            axios.get(uri)
            .then(response => {
                this.classSubjects =  response.data.data;
                console.log(this.classSubjects);
            })
            .catch(function (error){
                console.log('Error..... '+error)
            });
            setTimeout(function(){
                $("#subject-assessment-type-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);
        },
        loadRatingTypeList(uri = 'masters/loadAcademicMasters/all_active_rating_type'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.rating_type_list = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        save(){
            let selectedSujects = this.classSubjects.filter((classSuject)=>classSuject.sub_selected)
            axios.post('/masters/saveClassSubject', {org_class_id:this.classId,org_stream_id:this.streamId,data:selectedSujects})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list-subject-assessment-type');
                })
                .catch(function (error){
                this.errors = response.error;
            });
        },
	 
    },
    mounted(){ 
        this.loadClassSubject();
        this.loadRatingTypeList();
    },
    created() {
        this.className=this.$route.params.data.class;
        this.classId=this.$route.params.data.org_class_id;
        this.streamId=this.$route.params.data.org_stream_id;
        this.streamName=this.$route.params.data.stream;
        this.id=this.$route.params.data.id;
    },
    
}
</script>