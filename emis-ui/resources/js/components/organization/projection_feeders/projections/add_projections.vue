<template>
    <div>
        <form class="bootbox-form" id="stockReceivedId">
            <div class="card-body">
            <div class="form-group row"> 
                 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Academics Year of:</label>
                        <span class="text-blue">{{this.form.academicYear}}</span>
                    </div>
            </div>
            <div class="card">
                <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Sl No<span class="text-danger"></span></th>
                                  <th>Class<span class="text-danger"></span></th>
                                  <th>Total Projection<span class="text-danger">*</span></th>
                                  <th>Remarks</th>
                              </tr>
                           </thead>
                           <tbody>
                                <tr v-for="(item, index) in classList" :key="index" >
                                    <td>{{ index + 1 }}</td>
                                    <td >
                                        {{item.class}} 
                                    </td>
                                    <td>                          
                                        <input type="number" name="ProjectionNo" class="form-control" v-model="item.ProjectionNo" :class="{ 'is-invalid': form.errors.has('ProjectionNo') }"/>
                                    </td>
                                    <td>                          
                                        <input type="text" name="remarks" class="form-control" v-model="item.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }"/>
                                    </td>
                                </tr>                                  
                          </tbody>
                     </table>
                  </div>
              </div>
            </div>
            <div class="card-footer text-right">
                 <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                 <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>                                               
            </div> 
            
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            classList:[],
            items_received: [],
            academicYear:'',
            form: new form({
                academicYear:'',
                class_projections:[],
            })
        }
    },

    methods:{
        restForm(){
            this.form.academicYear= '';
            let formReset =this.form.items_received;
            formReset.splice(0, formReset.length);
            this.form.items_received.push({class:'',ProjectionNo:'',remarks:'',})
        },

        formaction: function(type){ 
            if(type=="reset"){
                this.restForm();
            }
             if(type=="save"){
                    this.form.class_projections = this.classList;
                    this.form.post('organization/saveProjections',this.form)
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Projections added successfully'
                        })
                        this.$router.push('/list_projections');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        applyselect(){
            if(!$('#quarter').attr('class').includes('select2-hidden-accessible')){
                $('#quarter').addClass('select2-hidden-accessible');
            }
        },

        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
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

        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="quarter"){
                this.form.quarter=$('#quarter').val();
            }
        },

        addMore: function(){
            this.count++;
            this.form.items_received.push({
               class:'',ProjectionNo:'',remarks:'',})    
        }, 
        remove(index){    
             if(this.form.items_received.length>1){
                this.count--;
                this.form.items_received.splice(index,1); 
            }
        },
        },
        mounted() { 
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
            let currentdate = new Date();
            this.form.academicYear=currentdate.getFullYear()+1;
        }
}
</script>