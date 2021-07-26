<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectGroup">
            <div class="ml-0 row form-group">
                <div class="mr-3">
                    <strong>Class: </strong> {{ class_stream }} 
                </div>
            </div>  
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="subject-assessment-type-table" class="subject-assessment-type-table table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Rating Type</th>
                                <th>Pass Score</th>
                                <th>Is Optional</th>
                                <th>Show in Result</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                             <tr v-for="(item, index) in classSubjects" :key="index">
                                <td>
                                    <div class="form-check ml-2">
                                        <input v-model="classSubjects[index].sub_selected" :value="item.aca_sub_id" class="form-check-input" type="checkbox">
                                        <label class="form-check-label">
                                            {{item.subject}} 
                                        </label>
                                        <br>
                                        <span class="ml-2" v-if="item.sub_dzo_name">{{item.sub_dzo_name}}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="ml-2">
                                        <select v-model="classSubjects[index].aca_rating_type_id" :id="'rating_type_'+index" @change="onChange($event)"  :disabled="!classSubjects[index].sub_selected" class="form-control form-control-sm select2" :class="{ 'is-invalid': errors}"  > 
                                            <option selected :value="null">--SELECT--</option>
                                            <template v-for="(item1, index1) in rating_type_list">
                                                <option v-if="(item.aca_sub_category_id==item1.aca_sub_category_id) || (item1.aca_sub_category_id === null) " :key="index1" :value="item1.id" :data-input_type="item1.input_type">{{ item1.name }}</option>
                                            </template>
                                        </select>
                                        <has-error v-if="errors" field="aca_rating_type_id"></has-error>
                                    </div>
                                </td>
                                 <td>
                                    <div class="form-group">
                                        <select v-show="classSubjects[index].input_type==0" :id="'pass_score_'+index" v-model="classSubjects[index].pass_score" class="form-control form-control-sm" :disabled="!classSubjects[index].sub_selected" >
                                            <template v-for="(item2, index2) in rating_list">
                                                <option :key="index2"  v-if="item2.aca_rating_type_id == classSubjects[index].aca_rating_type_id" :value="item2.score" >{{item2.name}}</option>
                                            </template>
                                        </select>
                                        <input v-show="classSubjects[index].input_type==1" type='number' step='0.01' max='100' min='0' v-model='classSubjects[index].pass_score' :disabled="!classSubjects[index].sub_selected" class="form-control form-control-sm text-right">
                                    </div>
                                </td>
                                 <td>
                                    <div class="form-check col-lg-8 col-md-8 col-sm-8 col-xs-12 ml-2">
                                        <input 
                                            v-model="classSubjects[index].is_elective"
                                            class="form-check-input" 
                                            type="checkbox"
                                            :value="item.is_elective"
                                            :disabled="!classSubjects[index].sub_selected"
                                        >
                                    </div>
                                </td>
                                   <td>
                                    <div class="form-check col-lg-8 col-md-8 col-sm-8 col-xs-12 ml-2">
                                        <input 
                                            v-model="classSubjects[index].show_in_result"
                                            class="form-check-input" 
                                            type="checkbox" 
                                            :value="item.show_in_result"
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
            rating_list:[],
            classId:'',
            streamId:'',
            class_stream:'',
            classSubjects: [],
            dt:'',
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
                let classSubject = response.data.data
                let classSubjects = []
                let tempValue = []
                classSubject.forEach(item => {
                    tempValue['aca_rating_type_id'] = item.aca_rating_type_id
                    tempValue['aca_sub_category_id'] = item.aca_sub_category_id
                    tempValue['aca_sub_id'] = item.aca_sub_id
                    tempValue['input_type'] = item.input_type
                    tempValue['is_elective'] = item.is_elective
                    tempValue['pass_score'] = item.pass_score
                    tempValue['sub_dzo_name'] = item.sub_dzo_name
                    tempValue['sub_selected'] = item.sub_selected
                    tempValue['subject'] = item.subject
                    if(item.show_in_result == 1 || item.show_in_result === null){
                        tempValue['show_in_result'] = 1
                    }else{
                        tempValue['show_in_result'] = item.show_in_result
                    }
                    const obj = {...tempValue}
                    classSubjects.push(obj)
                });
                this.classSubjects = classSubjects
                
            })
            .catch(function (error){
                console.log('Error..... '+error)
            });
        },
     
        loadRatingTypeList(){
            let uri = 'masters/loadAcademicMasters/all_active_rating_type'
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.rating_type_list = data
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        onChange(event){
            let passScoreInput = "<option value=''>---Select---</option>"
            const rowIndex = (event.target.id).replace("rating_type_","")
            const passScoreSelectId = "pass_score_" + rowIndex
            const selectedInputType = $(event.target).children(':selected').attr('selected', true).data("input_type")
            this.classSubjects[rowIndex].pass_score = ""
            this.classSubjects[rowIndex].input_type = selectedInputType
            if(selectedInputType==0){
                this.rating_list.forEach((item)=>{
                    if(item.aca_rating_type_id == event.target.value) {
                        passScoreInput += ("<option value='" + item.score + "'>" + item.name + "</option>")
                    }
                })
            }
            $("#"+passScoreSelectId).html(passScoreInput)
        },
        loadRatingList(){
            let uri = 'masters/loadAcademicMasters/all_active_rating'
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.rating_list = data
                console.log(this.rating_list);
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        save(){
            let selectedSujects = this.classSubjects.filter((classSuject)=>classSuject.sub_selected)
            axios.post('/masters/saveClassSubject', {class_stream:this.class_stream,org_class_id:this.classId,org_stream_id:this.streamId,data:selectedSujects})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list-subject-assessment-type');
                })
                .catch(function (error){
                    if(error.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'All fields are required for a selected Subject.',
                        })
                    }
            });
        },
	 
    },
    mounted(){ 
        this.loadClassSubject();
        this.loadRatingTypeList();
        this.loadRatingList();
        this.dt =  $("#subject-assessment-type-table").DataTable({
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
        });
    },
    created() {
        this.classId=this.$route.params.data.org_class_id;
        this.streamId=this.$route.params.data.org_stream_id;
        this.class_stream =this.$route.params.data.class_stream;
        this.id=this.$route.params.data.id;
    },
    watch: {
        classSubjects(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#subject-assessment-type-table").DataTable({
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
<style scoped>
.form-control-sm {
    font-size:0.9rem;
}
</style>