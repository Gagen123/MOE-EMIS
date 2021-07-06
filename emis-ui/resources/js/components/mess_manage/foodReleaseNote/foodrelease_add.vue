<template>
    <div>
        <form class="bootbox-form" id="foodreleaseId">
            <div class="card-body">
                <div class="form-group row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Date of Food Release:<span class="text-danger">*</span></label>  
                        <input class="form-control editable_fields" name="dateOfrelease" id="dateOfrelease" type="date" 
                        v-model="form.dateOfrelease" :class="{ 'is-invalid': form.errors.has('dateOfrelease') }" @change="remove_err('dateOfrelease')">
                        <has-error :form="form" field="dateOfrelease"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Dzongkhag:<span class="text-danger">*</span></label> 
                        <select v-model="dzongkhag" class="form-control select2" :class="{ 'is-invalid': form.errors.has('dzongkhag') }" name="dzongkhag" id="dzongkhag">
                           <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="dzongkhag"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">School Name:<span class="text-danger">*</span></label> 
                       <select v-model="organizaiton" class="form-control select2" name="organizaiton" id="organizaiton">
                            <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="organizaiton"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <label class="">Quarter:<span class="text-danger">*</span></label> 
                       <select name="quarter" id="quarter" class="form-control select2" v-model="form.quarter" :class="{ 'is-invalid': form.errors.has('quarter') }" @change="remove_err('quarter')">
                            <option v-for="(item, index) in quarterList" :key="index" v-bind:value="item.id">{{ item.Name }}</option>
                        </select>
                        <has-error :form="form" field="quarter"></has-error> 
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label class="mb-0.5">Remarks:</label>
                        <textarea @change="remove_err('remarks')" class="form-control" v-model="form.remarks" :class="{ 'is-invalid': form.errors.has('remarks') }" name="remarks" id="remarks"></textarea>
                        <has-error :form="form" field="remarks"></has-error>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0.5">Attachments</label>
                        <table id="participant-table" class="table w-100 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Attachment Name</th> 
                                    <th>File</th> 
                                </tr> 
                            </thead> 
                            <tbody>
                                <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                    <td>
                                        <input type="text" class="form-control" @change="remove_err('file_name'+(index+1))" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                        <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                    </td>
                                    <td>                                
                                        <input type="file" class="form-control" @change="remove_err('attach'+(index+1))" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                        <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                    </td>
                                </tr> 
                                <tr>
                                    <td colspan="3"> 
                                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                        @click="addMoreattachments()"><i class="fa fa-plus"></i> Add More</button>
                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore" 
                                        @click="removeattachments()"><i class="fa fa-trash"></i> Remove</button>
                                    </td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="card">
                    <div class="form-group row">
                        <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                     <th>Item</th>
                                     <th>Quantity</th>
                                     <th>Unit</th>
                                     <th>Remarks</th>
                                 </tr>
                              </thead>
                                <tbody>
                                    <tr id="record1" v-for='(item, index) in form.items_released' :key="index">
                                        <td>
                                             <select name="item" id="item" class="form-control editable_fields" v-model="item.item">
                                             <option v-for="(item, index) in itemList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                        </td>
                                        <td>                          
                                         <input type="number" name="quantity" class="form-control" v-model="item.quantity"/>
                                       </td>
                                       <td>                                
                                         <select name="unit" id="unit" class="form-control editable_fields" v-model="item.unit">
                                         <option v-for="(item, index) in unitList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                         
                                         </select> 
                                       
                                        </td>
                                        <td>                                
                                          <input type="text" name="remarks" class="form-control" v-model="item.remarks">
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
                </div> -->
      
             <!-- <div class="form-group row">
                
             </div> -->
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
            orgList:[],
            quarterList:[],
            itemList:[],
            unitList:[],
            termList:[],
            dzongkhagList:[],
            dzongkhag:'',
            organizaiton:'',
            quarter:'',
           
          //  itemrelease:[],
            // items_released: [],
          
            form: new form({
                 id: '', dateOfrelease: '', dzongkhag: '', organizaiton: '',quarter: '', remarks: '',
                //  items_released:
                // [{
                //     item:'',quantity:'',unit:'', remarks:'',
                // }], 
                 attachments:
                [{
                    file_name:'',attachment:''
                }],
                ref_docs:[],
            }),
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.dateOfrelease= '';
            this.form.dzongkhag= '';
            this.form.organizaiton= '';
            this.form.quarter= '';
            this.form.remarks='';
            // let formReset =this.form.items_released;
            // formReset.splice(0, formReset.length);
            // this.form.items_released.push({item:'',quantity:'',unit:'',remarks:''})
        },
        

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/mess_manage/saveFoodRelease',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Food release detail is added successfully'
                    })
                    this.$router.push('/foodrelease_list');
                })
                .catch(() => {
                    console.log("Error......");
                    this.applyselect();
                })
            }
        },
        //     if(type=="save"){
        //         const config = { 
        //             headers: {
        //                 'content-type': 'multipart/form-data'
        //             }
        //         }
        //         let formData = new FormData();
        //         formData.append('id', this.form.id);
        //         formData.append('ref_docs[]', this.form.ref_docs);
        //         for(let i=0;i<this.form.ref_docs.length;i++){
        //             formData.append('attachments[]', this.form.ref_docs[i].attachment);
        //             formData.append('attachmentname[]', this.form.ref_docs[i].file_name);
        //         }
        //         axios.post('/mess_manage/saveFoodRelease', formData, config)
        //             .then(() => {
        //             Toast.fire({
        //                 icon: 'success',
        //                 title: 'Food Release Note is added successfully'
        //             })
                    
        //            this.$router.push('/foodrelease_list');
        //         })
        //         .catch((err) => {
        //             console.log("Error."+err.message)
        //         })
        //     }
		// },
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#file_name'+currentcount).val()!=""){
                this.form.ref_docs.push({file_name:$('#file_name'+currentcount).val(),attachment:e.target.files[0]});
                $('#file_name'+currentcount).prop('readonly',true);
            }
            else{
                $('#file_name'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            } 
        },

        applyselect(){
            if(!$('#quarter').attr('class').includes('select2-hidden-accessible')){
                $('#quarter').addClass('select2-hidden-accessible');
            }
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
             if(!$('#organizaiton').attr('class').includes('select2-hidden-accessible')){
                $('#organizaiton').addClass('select2-hidden-accessible');
            }


        },

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        /**
         * method to get term in dropdown
         */
        loadActiveQuarterList(uri="masters/loadActiveStudentMasters/quarter_name"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.quarterList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        /**
         * method to get unit in dropdown
         */
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/program_measurement"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.unitList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        /**
         * method to get item in dropdown
         */
        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.itemList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        /**
         * 
         */
        allOrgList(dzo_id){
            if(dzo_id==""){
                dzo_id=$('#dzongkhag').val();
            }
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
            this.orgList = [];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.orgList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        /**f
         * method to get dzongkhag in dropdown
         */
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },


        // loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
        //     axios.get(uri)
        //     .then(response => {
        //         let data = response;
        //         for(let i=0;i<data.data.data.length;i++){
        //             this.dzongkhagList[data.data.data[i].id] = data.data.data[i].name; 
        //         }
        //     })
        //     .catch(function (error) {
        //         console.log("Error......"+error)
        //     });
        // },
        

        /**
         * method to add more fields
         */
        // addMore: function(){
        //     this.count++;
        //     this.form.items_released.push({
        //         item:'',quantity:'',unit:'',remarks:''})    
        // }, 
        /**
         * method to remove fields
         */
        // remove(index){    
        //      if(this.form.items_released.length>1){
        //         this.count--;
        //         this.form.items_released.splice(index,1); 
        //     }
        // },
        addMoreattachments: function(){
            this.filecount++;
            this.form.attachments.push({file_name:'',attachment:''})
        },
        removeattachments(index){    
            if(this.form.attachments.length>1){
                this.filecount--;
                this.form.attachments.pop(); 
                this.form.ref_docs.pop();
            }
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag"){
              // alert($('#dzongkhag').val());
                this.form.dzongkhag=$('#dzongkhag').val();
                this.allOrgList($('#dzongkhag').val());
            }
            if(id=="quarter"){
                this.form.quarter=$('#quarter').val();
            }
            if(id=="organizaiton"){
                this.form.organizaiton=$('#organizaiton').val();
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
       
        this.loadactivedzongkhagList();
        this.loadActiveQuarterList();
        this.loadActiveItemList();
        this.loadActiveUnitList(); 
        this.allOrgList(); 
    }
}
</script>