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
                                <th>Assessment Frequency</th>
                                <th>Academic Transcript Format</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in classAssessmentFrequencyList" :key="index">
                                <td class="text-right">{{ index + 1 }}</td>
                                <td>
                                    {{ item.class_stream }}
                                </td>                                                                              
                                <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <select v-model="classAssessmentFrequencyList[index].aca_assmt_frequency_id" class="form-control select2 editable_fields" > 
                                            <option selected="selected" value="">---Select---</option>
                                            <option v-for="(item1, index1) in assesmentFrequencyList" :key="index1" :value="item1.id">{{ item1.name }}</option>
                                        </select>
                                    </div>
                                </td>
                                 <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <select v-model="classAssessmentFrequencyList[index].aca_assmnt_type" class="form-control select2 editable_fields" > 
                                            <option selected="selected" value="">---Select---</option>
                                            <option value="0">NA</option>
                                            <option value="1">Subjects as Rows </option>
                                            <option value="2">Subjects as Columns</option>
                                        </select>
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
            dt:''
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
        },
         async classAssessmentFrequency(){
             try{
                let classStreams = await axios.get('masters/loadClassStreamMapping/NA').then(response => {return  response.data.data })
                let finalClassStreams = [];
                let renameId = []
                classStreams.forEach((item => {
                    if(item.stream){
                       renameId['class_stream'] = item.class+' '+item.stream
                    }else{
                        renameId['class_stream'] = item.class
                    }
                    renameId['org_class_id'] = item.classId;
                    renameId['org_stream_id'] = item.streamId;
                    renameId['aca_assmt_frequency_id'] ='';
                    renameId['aca_assmnt_type'] ='';
                    const obj = {...renameId};
                    finalClassStreams.push(obj);
                }))
                let classAssessmentFrequencies = await axios.get('masters/getClassAssessmentFrequency').then(response => {return  response.data.data})
        
                finalClassStreams.forEach((classStream,index) => {
                    classAssessmentFrequencies.forEach(item => {
                        if(classStream.org_class_id == item.org_class_id && (classStream.org_stream_id == item.org_stream_id || classStream.org_stream_id == null)){
                            finalClassStreams[index].aca_assmt_frequency_id = item.aca_assmt_frequency_id
                            finalClassStreams[index].aca_assmnt_type = item.aca_assmnt_type
                            finalClassStreams[index].id = item.id
                           
                        }
                    })
                })
                this.classAssessmentFrequencyList = finalClassStreams
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
                .catch(function(errors){
                    if(errors.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'All the fields are required!',
                        })
                    }
                });
        },
	 
    },
    mounted(){ 
        this.getAssessmentFrequencyList();
        this.classAssessmentFrequency();
        this.dt =  $("#class-assessment-frequency-table").DataTable({
            columnDefs: [
                { width: 2, targets: 0},
            ],
             drawCallback: function(dt) {
                $('.select2').select2().
                on("select2:select", e => {
                    const event = new Event("change", { bubbles: true, cancelable: true });
                    e.params.data.element.parentElement.dispatchEvent(event);
                })
                .on("select2:unselect", e => {
                const event = new Event("change", { bubbles: true, cancelable: true });
                e.params.data.element.parentElement.dispatchEvent(event);
                });
            },
            destroy: true,
        })
    },
    watch: {
        classAssessmentFrequencyList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#class-assessment-frequency-table").DataTable({
                    columnDefs: [
                        { width: 2, targets: 0},
                    ],
                   drawCallback: function(dt) {
                    $('.select2').select2().
                        on("select2:select", e => {
                            const event = new Event("change", { bubbles: true, cancelable: true });
                            e.params.data.element.parentElement.dispatchEvent(event);
                        })
                        .on("select2:unselect", e => {
                        const event = new Event("change", { bubbles: true, cancelable: true });
                        e.params.data.element.parentElement.dispatchEvent(event);
                        });
                    },
                    destroy: true,
                })
            });
        }
    }
    
}
</script>
<style>

</style>