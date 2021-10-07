<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="publish-result">
            <div class="ml-1 row form-group">
                 <div class="mr-3">
                    <strong>Term: </strong> {{ roll_no }}
                </div>
                <div class="mr-3">
                    <strong>Student Id: </strong> {{std_student_id }}
                </div>
                <div class="mr-3">
                    <strong>Name: </strong> {{ name }}
                </div>
                <div class="mr-3">
                    <strong>Roll No.: </strong> {{ roll_no }}
                </div>
            </div>  
            <div class="form-group row">
                <div class="col-lg-124 col-md-12 col-sm-12 col-xs-12">
                    <label>Overall Remarks for the <span>Term</span><span>Final Result</span></label> 
                    <textarea class="form-control form-control-sm" id="remarks" v-model="remarks[0]['remarks']"></textarea>
                </div>
            </div>
            <div v-if="aca_assmt_term_id != null && aca_assmt_term_id !='null' && aca_assmt_term_id !=''" class="form-group row mb-0">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Select a subject to edit marks/ratings:<span class="text-danger">*</span></label> 
                    <select class="form-control form-control-sm select2" id="aca_sub_id" v-model="aca_sub_id" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="getConsolidatedResultForEdit(); remove_err('aca_sub_id')">
                        <option selected="selected" value="">---Select---</option>
                        <option v-for="(item1, index1) in subjects" :key="index1" :value="item1.id">
                            {{ item1.name }}
                            <span v-if="item1.dzo_name">{{item1.dzo_name}}</span>
                        </option>
                    </select> 
                    <span id= "errorId" class="text-danger">{{ errorMessage }}</span>
                </div>
            </div>
            <div v-else>
                <strong>* <i>To edit a subject's marks/ratings for a term, go to List, select the term and edit.</i></strong>
            </div>
            <hr v-if="aca_assmt_term_id != null && aca_assmt_term_id !='null' && aca_assmt_term_id !=''">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <template v-for="(item,index) in assmnt_areas">
                        <div :key="index" class="mt-2">
                            <label>{{item.assmnt_area}} <span v-if="item.weightage">({{item.weightage}}%)</span></label> 
                            <select v-if="item.input_type == 0" class="form-control form-control-sm" :id="'rating_'+index" v-model="assmnt_areas[index].score" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="remove_err('rating_'+index)">
                                <option selected="selected" value="">---Select---</option>
                                <option v-for="(item1, index1) in rating(item.aca_rating_type_id)" :key="index1" :value="assmnt_areas[index].score">
                                    {{ item1.name }}
                                </option>
                            </select>
                            <input v-else-if="item.input_type == 1" v-model="assmnt_areas[index].score" type="number" class="form-control form-control-sm" min="0" :max="item.weightage" step="0.01">
                            <input v-else-if="item.input_type == 2" v-model="assmnt_areas[index].descriptive_score" type="text" class="form-control form-control-sm">
                        </div>
                    </template>
                </div>
            </div>
        </form>
         <div class="card-footer text-right">
            <button class="btn btn-flat btn-sm btn-primary" @click="save"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>  
</template>
 <script>
 export default {
    data(){
           return {
            subjects:[],
            aca_sub_id:'',
            assmnt_areas:[],
            ratingsList:[],
            remarks:'',
            std_student_id:'',
            name:'',
            roll_no:'',
            aca_assmt_term_id:'',
            org_class_id:'',
            org_stream_id:'',
            org_section_id:'',
            errorMessage:''
        }
    },
    methods:{
        remove_err(id){
            if($('#' + id).val()!=""){
               $('#'+id).removeClass('is-invalid select2');
               $('#'+id).addClass('select2');
               $('#errorId').remove()
            }
        },
        getSubjectOfTerm(){
            let uri = 'academics/getSubjectOfTerm?aca_term_id='+this.aca_assmt_term_id+'&std_student_id='+this.std_student_id+'&org_class_id='+this.org_class_id;
            if(this.org_stream_id){
                uri += '&org_stream_id='+this.org_stream_id;
            }
            if(this.org_section_id){
                uri += '&org_section_id='+this.org_section_id;
            }
            axios.get(uri)
            .then(response => {
                this.subjects = response.data.data.subjects
                this.remarks = response.data.data.remarks
            }).catch(function (error){
                console.log(error)
            })
        },
        getConsolidatedResultForEdit(){
            axios.get('academics/getConsolidatedResultForEdit/'+this.std_student_id+'/'+this.aca_assmt_term_id+'/'+this.aca_sub_id)
            .then(response => {
                 this.assmnt_areas = response.data.data.result
                 this.ratingsList = response.data.data.ratings
            }).catch(function (error){
                console.log(error)
            })
        },
        rating(rating_type_id){
             return this.ratingsList.filter(item => item.aca_rating_type_id == rating_type_id)
        },
        save(){
            if(aca_assmt_term_id != null && aca_assmt_term_id != 'null' && aca_assmt_term_id != ''  && this.aca_sub_id == ""){
                this.errorMessage = "This field is required";
            }
            axios.post('/academics/updateResult', {data:this.assmnt_areas,std_student_id:this.std_student_id,remarks:this.remarks[0],aca_sub_id:this.aca_sub_id})
                .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                })
                .catch(function(error){
                this.errors = error;
            });
           
        }      
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
        this.getSubjectOfTerm()
        
    },
    created() {
        this.org_class_id=this.$route.params.org_class_id
        this.std_student_id=this.$route.params.student.std_student_id;
        this.name=this.$route.params.student.Name;
        this.roll_no=this.$route.params.student.roll_no;
        this.aca_assmt_term_id=this.$route.params.aca_term_id
        this.org_class_id=this.$route.params.org_class_id
        this.org_stream_id=this.$route.params.org_stream_id
        this.org_section_id=this.$route.params.org_section_id
    },
}
</script>

