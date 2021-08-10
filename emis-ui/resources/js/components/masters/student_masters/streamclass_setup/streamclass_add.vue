<template>
    <div>
        <form class="bootbox-form" id="responsibilitiesId">
            <div class="card-body">
                <div class="row form-group">
                     <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Streams:<span class="text-danger">*</span></label> 
                         <select v-model="form.streamId" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('streamId') }" class="form-control select2" name="streamId" id="streamId">
                            <option value=""> -- Select-- </option>
                            <option v-for="(item, index) in streamList" :key="index" v-bind:value="item.id">{{ item.stream }}</option>
                        </select>
                        <has-error :form="form" field="streamId"></has-error>
                        <span class="text-danger" id="streamId"></span>
                    </div>
                </div> 
                <div class="card">
                <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>SL#</th>
                                  <th>Subject</th>
                                  <th>Marks<span class="text-danger">*</span></th>
                                  <th>Grade<span class="text-danger">*</span></th>
                              </tr>
                           </thead>
                           <tbody id="tbody">
                            <tr v-for="(item, index) in subjectlist" :key="index" >
                                <td>{{ index + 1 }}</td>
                                <td >
                                    {{SubjectDropdown[item.aca_sub_id]}} 
                                </td>
                                 <td>                          
                                    <input type="text" name="marks" class="form-control" v-model="item.marks" :class="{ 'is-invalid': form.errors.has('marks') }"/>
                                 </td>
                                 <td>                          
                                    <input type="text" name="grade" class="form-control" v-model="item.grade" :class="{ 'is-invalid': form.errors.has('grade') }"/>
                                 </td>
                            </tr>
                        </tbody>
                     </table>
                  </div>
              </div>
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
    data() {
        return {
            streamList:[],
            subjectlist:[],
            SubjectDropdown:{},
            form: new form({
               subjectlist:[],
            })
        }
    },
    methods: {
        restForm(){
            this.form. this.subjectlist= '';
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        loadStreamList(uri = 'masters/loadStream'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.streamList =  data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
		formaction: function(type){
            if(type=="reset"){
                this.form.name= '';
                this.form.description='';
                this.form.status= 1;
            }
            if(type=="save"){
                this.form.subjectlist=this.subjectlist;
                this.form.post('/masters/saveStreamSubject',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/streamclass_list');
                })
                .catch((err) => {
                    console.log("Error"+err)
                })
            }
		},
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="streamId"){
                this.form.streamId=$('#streamId').val();
                this.getSubjectlist('');
            }
         }, 
        getSubjectlist(id){
            let streamid=$('#streamId').val();
            if(id!="" && streamid==null){
                streamid=id;
            }
            let uri = 'masters/subjectlist/'+streamid;
            axios.get(uri)
            .then(response =>{
                let data = response.data.data;
                this.subjectlist =data;
                this.form.class_id = data[0].org_class_id;
                
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadsubjectList(){
            axios.get('masters/loadClassSubject/' +this.class_id)
            .then(response => {
                let data = response.data.data;
                 for(let i=0;i<data.length;i++){
                    this.SubjectDropdown[data[i].aca_sub_id] =data[i].subject;
                }
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="7" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        addMore: function(){
            this.count++;
            this.form.items_received.push({
               class:'',ProjectionNo:'',})    
        }, 
        remove(index){    
             if(this.form.items_received.length>1){
                this.count--;
                this.form.items_received.splice(index,1); 
            }
        },
    },
        mounted() {
            this.loadStreamList();
            this.loadsubjectList();
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
    },
    
}
</script>