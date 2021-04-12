<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Term:</label>
                        <select v-model="student_form.screening" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('screening') }" class="form-control select2" name="screening" id="screening">
                            <option v-for="(item, index) in termList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="student_form" field="screening"></has-error>
                    </div> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Date of Supplementation Issued:</label>
                        <input class="form-control" v-model="student_form.date" :class="{ 'is-invalid': student_form.errors.has('date') }" id="date" @change="remove_err('date')" type="date">
                        <has-error :form="student_form" field="date"></has-error>
                    </div> 
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Boys </th> 
                                    <th>Girls</th>
                                </tr>
                            </thead>
                            <tbody id="table_data_populate">
                                <tr id="record1" v-for='(user, index) in byClass' :key="index">
                                    <td>
                                        <select v-model="student_form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_class') }" class="form-control select2" name="std_class" id="std_class">
                                            <option v-for="(item, index) in classList" :key="index" v-bind:value="item.std_class">{{ item.class }}</option>
                                        </select>
                                        <has-error :form="student_form" field="std_class"></has-error>
                                    </td>
                                    <td>
                                        <input class="form-control" v-model="student_form.boys_given" :class="{ 'is-invalid': student_form.errors.has('boys_given') }" id="boys_given" @change="remove_err('boys_given')" type="number">
                                        <has-error :form="student_form" field="boys_given"></has-error>
                                    </td>
                                    <td>
                                        <input class="form-control" v-model="student_form.girls_given" :class="{ 'is-invalid': student_form.errors.has('girls_given') }" id="girls_given" @change="remove_err('girls_given')" type="number">
                                        <has-error :form="student_form" field="girls_given"></has-error>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="9"> 
                                        <button type="button" class="btn btn-xs btn-primary" id="addMore" @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                        <button type="button" class="btn btn-xs btn-danger" id="addMore"  @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>   
</template>
<script>
export default {
    
    data() {
        return {
            termList:[],
            //temporary definition
            classList:[{class:"1"}, {class:"2"}, {class:"3"}, {class:"4"}],
            id:'2fea1ad2-824b-434a-a608-614a482e66c1',

            student_form: new form({
                screening: '',
                screening_position: '',
                screening_endorsed_by: '',
                date: '',
            }),

            byClass:
            [{
                std_class:'',boys_given:'',girls_given:''
            }] 
        }
    },

    methods: {
        loadActiveTermList(uri="masters/loadActiveStudentMasters/term_type"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.termList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        addMore: function(){
            this.byClass.push({std_class:'',boys_given:'',girls_given:''})
        },
        remove(index){    
             this.byClass.splice(index,1);             
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_award_form.student= '';
                this.student_award_form.remarks='';
                this.student_award_form.status= 1;
            }
            if(type=="save"){
                this.student_award_form.post('/students/addStudentSupplementation',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/std_supplementation_list');
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
            if(id=="std_class"){
                this.student_form.std_class=$('#class').val();
            }
            if(id=="term_id"){
                this.student_form.term_id=$('#term_id').val();
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
        //Fix this when the classes are loaded in database
        //this.loadClassList();
    },
    
}
</script>