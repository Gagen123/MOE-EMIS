<template>
    <div>
        <form class="bootbox-form" id="stockReceivedId">
            <div class="card-body">
                <div class="form-group row"> 
                 <label class="col-lg-2 col-md-2 col-sm-2 col-form-label">Facility:<span class="text-danger">*</span></label>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <select name="facility" id="facility" class="form-control editable_fields" @change="getSubFacilityDropdown(),remove_err('facility')" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in facilityList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <has-error :form="form" field="facility"></has-error>
                    </div>
                </div>
                  
            <div class="card">
                <div class="form-group row">
                   <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Type of facilities<span class="text-danger">*</span></th>
                                  <th>No. of Facilities<span class="text-danger">*</span></th>
                                  <th>Year of establishment<span class="text-danger">*</span></th>
                                  <th>support By<span class="text-danger">*</span></th>
                                  <th id='sizeAndarea1'>Area/Size</th>
                                  <th>Accessible to SEN<span class="text-danger">*</span></th>
                                  <th>Sports type</th>
                                  <th>Status<span class="text-danger">*</span></th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr id="record1" v-for='(item, index) in form.items_received' :key="index">
                                  <td>
                                        <select name="type" id="type" class="form-control editable_fields" v-model="item.type " :class="{ 'is-invalid': form.errors.has('type') }" @change="remove_err('type'), showfield('type')">
                                         <option v-for="(item, index) in facilitySubList" :key="index" v-bind:value="item.id">{{ item.typeName }}</option>
                                      </select>
                                  </td>
                                   <td>                          
                                        <input type="number" name="number" class="form-control" v-model="item.number"/>
                                  </td>
                                  <td>                          
                                        <input type="number" name="yoe" class="form-control" v-model="item.yoe"/>
                                  </td>
                                  <td>
                                        <select name="support"  class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('support') }" v-model="item.support">
                                            <option value="">--- Please Select ---</option>
                                            <option v-for="(item, index) in supportList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                                        </select>
                                  </td>
                                  <td id='sizeAndarea'> 
                                        <input name="area" class="form-control" v-model="item.area"/>
                                 </td>
                                  <td>                                
                                     <select name="access" id="access" class="form-control editable_fields" v-model="item.access">
                                           <option  value="">--- Please Select ---</option>
                                                <option  value="0">yes</option>
                                                <option value="1">no</option>
                                            <option value="2">partial</option>
                                     </select> 
                                  </td>
                                  <td>                                
                                        <label><input v-model="item.sportstype"  type="radio" value="1" /> Indoor</label>
                                        <label><input v-model="item.sportstype"  type="radio" value="0" /> Outdoor</label>
                                  </td>
                                  <td>                                
                                        <label><input v-model="item.status"  type="radio" value="1" /> Usable</label>
                                        <label><input v-model="item.status"  type="radio" value="0" /> Non_Usable</label>
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
            facilityList:[],
            supportList:[],
            facilitySubList:[],
            items_received: [],
            form: new form({
                 id: '',facility:'',
                  items_received:
                [{
                    type:'',yoe:'',number:'', access:'',area:'', status:'',sportstype:'',support:'',
                }], 
            })
        }
    },

    methods:{

        /**
         * method to reset form
         */
        restForm(){
            this.form.facility= '';
            let formReset =this.form.items_received;
            formReset.splice(0, formReset.length);
            this.form.items_received.push({type:'',yoe:'',number:'', access:'',area:'', status:'',sportstype:'',support:'',})
        },

        /**
         * method to save data
         */
        formaction: function(type){ 
            if(type=="reset"){
                this.restForm();
            }
             if(type=="save"){
                     this.form.post('/organization/saveSport',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Sports added successfully'
                    })
                    this.$router.push('/sport_list');
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

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        getSubFacilityDropdown(uri = '/organization/getSubFacilityDropdown/' +this.form.facility){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilitySubList = data;
            });
        },

        /**
         * method to get quarter in dropdown
         */
        
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

        /**
         * method to get unit in dropdown
         */
        getFacilityDropdown(uri ='/organization/getFacilityInDropdown/'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilityList = data;
            });
        },
        /**
         * method to get item in dropdown
         */
        getSupportDropdown(uri = '/organization/getSupportInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.supportList = data;

            });
        },
          showfield:function(type){
            let selecttype = $("#"+type+" option:selected").text();
                if(selecttype =="standard"){
                    $('#sizeAndarea').hide();
                    $('#sizeAndarea1').hide();
                    
                
                }

            else if(selecttype =="non standard"){ 
                    $('#sizeAndarea').show();
                    $('#sizeAndarea1').show();

                }
                else{
                    $('#sizeAndarea').hide();
                    $('#sizeAndarea1').hide();

                }

        },
        /**
         * 
         */
        
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
               type:'',number:'', yoe:'',access:'',area:'', status:'',sportstype:'',support:'',})    
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.form.items_received.length>1){
                this.count--;
                this.form.items_received.splice(index,1); 
            }
        },
        getSportsDetails(sportId){
            this.form.items_received=[];
            axios.get('organization/getSportsDetails/' +sportId)
            .then((response) => {  
                let data=response.data.data;
                // alert(data.length);
                for(let i=0; i<data.length;i++){
                    this.form.facility = data[i].facility;
                    this.form.id       = data[i].id;
                    this.form.items_received.push({
                        type:data[i].type,
                        
                        number:data[i].number,
                        yoe:data[i].yearOfEstablishment,
                        access:data[i].accessibleToDisabled,
                        area:data[i].size,
                        sportstype:data[i].sportstype,
                        support:data[i].supportedBy,
                        status:data[i].status
                    });
                }
                // this.form.organizationId        =    data.organizationId;
                // this.form.facility              =    data.facility;
                // this.form.id                    =    data.id;
                // let prop=data.facility;
                // let facilityDetails=[];
               
                // for(let i=0;i<prop.length;i++){
                //     facilityDetails.push({type:prop[i].type,
                //     number:prop[i].number,
                //     yoe:prop[i].yearOfEstablishment,
                //     access:prop[i].accessibleToDisabled,
                //     area:prop[i].size,
                //     sportstype:prop[i].sportstype,
                //     support:prop[i].supportedBy,
                //     status:prop[i].status});
                   // this.getSubFacilityDropdown();
                   // 
            
                this.count=data.length;
                this.getSubFacilityDropdown();
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
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
        
        },
        created(){
            this.getSportsDetails(this.$route.params.data.id);
            this.getFacilityDropdown();
            this.getSupportDropdown();
            this.getSubFacilityDropdown();
            
        }
}
</script>