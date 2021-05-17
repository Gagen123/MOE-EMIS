<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="assessmentFrequency">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="class-assessment-frequency-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL#</th>
                                <th>Class</th>
                                <th>Stream</th>
                                <th>Assessment Frequency</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classAssessmentFrequencyList" :key="index">
                                <td class="text-right">{{ index + 1 }}</td>
                                <td>
                                    <input v-model="classAssessmentFrequencyList[index].org_class_id" class="form-control" type="hidden">
                                    {{ item.class }}
                                </td>                                                                              
                                <td>
                                    <input v-model="classAssessmentFrequencyList[index].org_stream_id" class="form-control" type="hidden">
                                    {{ item.stream }}
                                </td>
                                <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <!-- :class="{ 'is-invalid': classAssessmentFrequencyList.errors.data.has('aca_assmnt_frequency_id') }"  @change="remove_err('aca_assmnt_frequency_id')" -->
                                        <select v-model="classAssessmentFrequencyList[index].aca_assmt_frequency_id" class="form-control  editable_fields" id="aca_assmnt_frequency_id" > 
                                            <option selected value="">--SELECT--</option>
                                            <option v-for="(item, index) in assesmentFrequencyList" :key="index" :value="item.id">{{ item.name }}</option>
                                        </select>
                                        {{errMessage}}
                                        <!-- {{classAssessmentFrequencyList}}------error -->
                                        <!-- <has-error :form="classAssessmentFrequencyList[index]" field="aca_assmnt_frequency_id"></has-error> -->
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
            classAssessmentFrequencyList: [],
            assesmentFrequencyList:[],
            errMessage:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        getAssessmentFrequencyList(uri = 'masters/loadAcademicMasters/all_assessment_frequency'){
            axios.get(uri)
            .then(response =>{
                this.assesmentFrequencyList = response.data.data;
            })
            .catch(function (error){
                 if(error.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            })
            setTimeout(function(){
                $("#class-assessment-frequency-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                      columnDefs: [
                        { width: 2, targets: 0}
                    ],
                }); 
            }, 3000);
        },
         async classAssessmentFrequency(){
             try{
                let classStreams = await axios.get('masters/getClassStream').then(response => {
                    return  response.data.data
                })
                let classAssessmentFrequencies = await axios.get('masters/getClassAssessmentFrequency').then(response => {
                    return  response.data.data
                })
                classStreams.forEach((classStream,index) => {
                    classAssessmentFrequencies.forEach(item => {
                        if(classStream.org_class_id == item.org_class_id && (classStream.org_stream_id == item.org_stream_id || classStream.org_stream_id == null)){
                            classStreams[index].aca_assmt_frequency_id = item.aca_assmt_frequency_id
                        }
                    })
                })
                this.classAssessmentFrequencyList = classStreams
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }                           
        },
        save(){
             axios.post('/masters/saveAssessmentFrequency', {data:this.classAssessmentFrequencyList})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-assessment-frequency');
                })
                .catch(function(error){
                    if(error.response.status === 422){
                        this.errMessage = error.response.data.message;
                    }
                    console.log(error.response.data.errors);
            });
        },
	 
    },
    mounted(){ 
        this.getAssessmentFrequencyList();
        this.classAssessmentFrequency()
        
    },
    
}
</script>