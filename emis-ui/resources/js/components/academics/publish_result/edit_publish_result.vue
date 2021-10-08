<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="publish-result">
            <div class="ml-1 row form-group">
                 <div class="mr-3">
                    <strong>Term: </strong> {{ form.roll_no }}
                </div>
                <div class="mr-3">
                    <strong>Student Id: </strong> {{form.std_student_id }}
                </div>
                <div class="mr-3">
                    <strong>Name: </strong> {{ form.name }}
                </div>
                <div class="mr-3">
                    <strong>Roll No.: </strong> {{ form.roll_no }}
                </div>
            </div>  
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Select Subject:<span class="text-danger">*</span></label> 
                    <select class="form-control form-control-sm select2" id="aca_sub_id" v-model="aca_sub_id" :class="{'is-invalid select2 select2-hidden-accessible': errorMessage  }" @change="loadConsolidatedResultForPublish(); remove_err('aca_sub_id')">
                        <option selected="selected" value="">---Select---</option>
                        <option v-for="(item1, index1) in subjects" :key="index1" :value="item1.id">
                            {{ item1.name }}
                            <span v-if="item1.dzo_name">{{item1.dzo_name}}</span>
                        </option>
                    </select> 
                    <span id= "errorId" class="text-danger">{{ errorMessage }}</span>
                </div>
            </div>
            
        </form>
    </div>  
</template>
 <script>
 export default {
    data(){
           return {
            subjects:[],
            aca_sub_id:'',
            form: new form({
                std_student_id:'',
                name:'',
                roll_no:'',
                aca_assmt_term_id:'',
                org_class_id:'',
                org_stream_id:'',
                org_section_id:''
            }),
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
        getConsolidatedResultForEdit(){
            axios.get('academics/getConsolidatedResultForEdit/'+this.form.std_student_id+'/'+this.form.aca_assmt_term_id+'/'+this.aca_sub_id)
            .then(response => {
                 console.log(response.data.data)
            }).catch(function (error){
                console.log(error)
            })
        },
        getSubjectOfTerm(){
            let uri = 'academics/getSubjectOfTerm?aca_term_id='+this.form.aca_assmt_term_id+'&org_class_id='+this.form.org_class_id;
            if(this.form.org_stream_id){
                uri += '&org_stream_id='+this.form.org_stream_id;
            }
            if(this.form.org_section_id){
                uri += '&org_section_id='+this.form.org_section_id;
            }
            axios.get(uri)
            .then(response => {
                this.subjects = response.data.data
            }).catch(function (error){
                console.log(error)
            })
        },
        save(){
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
        this.getConsolidatedResultForEdit() 
        this.getSubjectOfTerm()
        
    },
    created() {
        this.form.org_class_id=this.$route.params.org_class_id
        this.form.std_student_id=this.$route.params.student.std_student_id;
        this.form.name=this.$route.params.student.Name;
        this.form.roll_no=this.$route.params.student.roll_no;
        this.form.aca_assmt_term_id=this.$route.params.aca_term_id
        this.form.org_class_id=this.$route.params.org_class_id
        this.form.org_stream_id=this.$route.params.org_stream_id
        this.form.org_section_id=this.$route.params.org_section_id

    },
}
</script>

