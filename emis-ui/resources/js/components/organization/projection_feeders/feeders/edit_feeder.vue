<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                  <label>Feeder Schools:<span class="text-danger">*</span></label>
                     <select v-model="form.preference_school1" :class="{ 'is-invalid ': form.errors.has('preference_school1') }" class="form-control " name="preference_school1" id="preference_school1">
                        <option value=""> -- Select-- </option>
                        <option v-for="(item, index) in SchoolList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                    </select>
                    <has-error :form="form" field="preference_school1"></has-error>
                    <span class="text-danger" id="preference_school1_err"></span>
                </div>
                 <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <label>Feeder School Class:<span class="text-danger">*</span></label><br>
                        <input type="radio" name="class" v-model="form.class" value="Class(VI-VII)" id="Class(VI-VII)"  checked> <label>Class(VI-VII):</label>&nbsp;&nbsp;
                        <input type="radio" name="class" v-model="form.class" value="Class (VIII-IX)" id="sClass (VIII-IX)" ><label>Class (VIII-IX)</label>&nbsp;&nbsp;
                        <input type="radio" name="class" v-model="form.class" value="Class (X-XI)" id="Class (X-XI)"> <label>Class (X-XI)</label>
                </div> 
            </div>
            <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Parents Schools<span class="text-danger">*</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr v-for='(item, index) in form.items_received' :key="index">
                                  <td>
                                    <select v-model="item.parentschool" :class="{ 'is-invalid': form.errors.has('parentschool') }" class="form-control" name="parentschool" id="parentschool">
                                        <option value=""> -- Select-- </option>
                                        <option v-for="(item, index) in SchoolList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                    </select>
                                    <has-error :form="form" field="parentschool"></has-error>
                                    <span class="text-danger" id="parentschool_error"></span>
                                  </td>
                              </tr> 
                               <tr>
                                    <td colspan=7> 
                                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                        @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove" 
                                        @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                    </td>
                               </tr>                                    
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
            classList:[],
            form: new form({
                id:'',
                preference_school1:'',
                class:'',
                remarks:'',
                action_type:'add',
                 items_received:
                [{
                    parentschool:''
                }], 
            }),
        }
    },
    methods: {
        //need to get the organisation id and pass it as a parameter
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
        loadClassList(uri="loadCommons/getOrgClassStream"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get stream list
         */
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
            this.form.items_received.push({
               parentschool:''})    
        }, 
        remove(index){    
             if(this.form.items_received.length>1){
                this.count--;
                this.form.items_received.splice(index,1); 
            }
        },
        
    },
     mounted() {
        var checkedValue = $('.messageCheckbox:checked').val();

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
        this.loadClassList();
        this.loadOrgList();
        this.form.id=this.$route.params.data.id;
        this.form.preference_school1=this.$route.params.data.feederschool;
        this.form.class=this.$route.params.data.class;
        this.form.parentschool=this.$route.params.data.parentschool;
    },
    
}
</script>