<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                  <label>Select Parent School:<span class="text-danger">*</span></label>
                     <select v-model="form.parent_school" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('parent_school') }" class="form-control " name="parent_school" id="parent_school">
                        <option value=""> -- Select-- </option>
                        <option v-for="(item, index) in SchoolList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                     </select>
                    <has-error :form="form" field="parent_school"></has-error>
                    <span class="text-danger" id="parent_school_err"></span>
                </div>
                 <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <label>Feeder School Class:<span class="text-danger">*</span></label><br>
                        <input type="radio" name="class" v-model="form.class" value="VI-VII" id="VI-VII"  checked> <label>Class(VI-VII):</label>&nbsp;&nbsp;
                        <input type="radio" name="class" v-model="form.class" value="VIII-IX" id="VIII-IX" ><label>Class (VIII-IX)</label>&nbsp;&nbsp;
                        <input type="radio" name="class" v-model="form.class" value="X-XI" id="X-XI"> <label>Class (X-XI)</label>
                </div> 
            </div>
            <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Feeder Schools<span class="text-danger">*</span></th>
                              </tr>
                           </thead>
                           <tbody>
                                <select v-model="form.feeder_school" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('feederschool') }" class="form-control " name="feederschool" id="feederschool">
                                    <option value=""> -- Select-- </option>
                                    <option v-for="(item, index) in SchoolList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                </select>
                                <has-error :form="form" field="feederschool"></has-error>
                                <span class="text-danger" id="feederschool_err"></span>                             
                          </tbody>
                     </table>
                  </div>
              </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            SchoolList:[],
            form: new form({
                id:'',
                parent_school:'',
                class:'',
                remarks:'',
                action_type:'add',
                feeder_school:''
            }),
        }
    },
    methods: {
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.student= '';
                this.form.remarks='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.post('/organization/saveFeeders',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/list_feeder');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        //loading school based on the dzongkhag id
        loadOrgList(uri ='staff/transfer/LoadSchoolByDzoId/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.SchoolList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
           
        },
        checkall(class_to_check,id){
            if($('#'+id).prop('checked')){
                $("."+class_to_check).prop("checked",true);
            }
            else{
                $("."+class_to_check).prop("checked",false);
            }
        },
        addMore: function(){
            this.count++;
            this.form.feeder_school.push({
               feederschool:''})    
        }, 
        remove(index){    
             if(this.form.feeder_school.length>1){
                this.count--;
                this.form.feeder_school.splice(index,1); 
            }
        },
        
    },
     mounted() {
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
        this.loadOrgList();
        this.form.id=this.$route.params.data.id;
        this.form.parent_school=this.$route.params.data.parent_school;
        this.form.feeder_school=this.$route.params.data.feeder_school;
        this.form.class=this.$route.params.data.class;
    },
    
}
</script>