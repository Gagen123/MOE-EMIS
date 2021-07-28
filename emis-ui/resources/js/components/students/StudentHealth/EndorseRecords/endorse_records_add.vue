<template>
    <div> 
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Health Record Type:</label>
                        <select name="health_record_type" id="health_record_type" v-model="student_form.health_record_type" :class="{ 'is-invalid': student_form.errors.has('health_record_type') }" class="form-control select2" @change="getCategory(),remove_error('health_record_type')">
                            <option value="">--- Please Select ---</option>
                            <option value="endorse_vaccination"> Vaccination </option>
                            <option value="endorse_supplementation"> Supplementation and Deworming </option>
                            <option value="endorse_screening"> Health Screening </option>
                        </select>
                        <has-error :form="student_form" field="health_record_type"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Term:</label>
                        <select v-model="student_form.term_id" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('term_id') }" class="form-control select2" name="term_id" id="term_id">
                            <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="student_form" field="term_id"></has-error>
                    </div> 
                </div>
                <hr>
                <router-view></router-view>
            </div>
        </div>
    </div> 
</template>
<script>
export default {
   data(){
        return{
            dt:'',
            termList:[],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                term_id: '',
                health_record_type:'',
                std_class: '',
                std_stream: '',
                std_section: '',
                date: '',
                std_id: [],
                std_screened:[]
            }),
        }
    },

    methods: {
         loadActiveTermList(uri="masters/loadActiveStudentMasters/term_type"){
            axios.get(uri)
            .then(response => {
                let data = response;
                // alert(JSON.stringify(response));
                this.termList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        /**
         * to load the respective pages depending on the type of establishment
         */

        loadRespectivePage(val){
            this.$router.push("/"+val);
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.screening= '';
                this.student_form.prepared_by='';
                this.student_form.screening_position='';
                this.student_form.screening_endorsed_by= '';
                this.student_form.date='';
            }
            if(type=="save"){
                this.student_form.std_screened=[];
                let screenedArray=[];
                let oTable = $('#student-list-table').dataTable({
                    stateSave: true,
                    destroy: true,
                });
                $("input[name='screened']:not(:checked)",oTable.fnGetNodes()).each( function () {
                    screenedArray.push($(this).val());
                });
                this.student_form.std_screened=screenedArray;
                
                this.student_form.post('/students/addDewormingRecords',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/std_deworming_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="term_id"){
                this.student_form.term_id=$('#term_id').val();
            }
            if(id=="health_record_type"){
                this.student_form.health_record_type=$('#health_record_type').val(); 
                this.loadRespectivePage($('#health_record_type').val());   
            }
                        
        },
    },
    mounted() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
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
        
        this.loadActiveTermList();
        
        this.dt =  $("#student-list-table").DataTable()
    },
    
}
</script>