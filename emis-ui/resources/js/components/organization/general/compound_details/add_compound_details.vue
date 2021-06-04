<template>
    <div>
        <form class="bootbox-form" id="compoundarea-detial">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Thram No:<span class="text-danger">*</span> </label>
                        <input type="text" class="form-control" @change="removeerror('thramno')" :class="{ 'is-invalid': form.errors.has('thramno') }" id="first_name" v-model="form.thramno" placeholder="thramno">
                            <has-error :form="form" field="thramno"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label > Plot No: </label>
                         <input type="text" class="form-control" @change="removeerror('plotno')" :class="{ 'is-invalid': form.errors.has('plotno') }" id="plotno" v-model="form.plotno" placeholder="plotno">
                        <has-error :form="form" field="plotno"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Peg Information: </label>
                         <textarea class="form-control" rows="3" @change="removeerror('peginfo')" :class="{ 'is-invalid': form.errors.has('peginfo') }" id="peginfo" v-model="form.peginfo" ></textarea>
                        <has-error :form="form" field="peginfo"></has-error>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <label>Size of Compound Area:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @change="removeerror('sizecompound')" :class="{ 'is-invalid': form.errors.has('sizecompound') }" id="sizecompound" v-model="form.sizecompound" >
                        <has-error :form="form" field="sizecompound"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Play Ground Area:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @change="removeerror('sizeplayground')" :class="{ 'is-invalid': form.errors.has('sizeplayground') }" id="dob" v-model="form.sizeplayground">
                        <has-error :form="form" field="sizeplayground"></has-error>
                      
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Playground area used:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @change="removeerror('playgroundused')" :class="{ 'is-invalid': form.errors.has('playgroundused') }" id="playgroundused" v-model="form.playgroundused">
                        <has-error :form="form" field="playgroundused"></has-error>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Does the School have agricultural area?<span class="text-danger">*</span></label> 
                        <br>
                        <label><input v-model="form.status"  type="radio" value="1" @click="showtextbox('No')" checked/>No</label>
                        <label><input v-model="form.status"  type="radio" value="0" @click="showtextbox('Yes')"/>Yes</label>
                    </div>
                </div>
                <div class="form-group row" style="display:none" id="agriculturalarea">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Agriculture Area : </label>
                        <input type="text" v-model="form.agriculturalarea" class="form-control editable_fields" id="agriculturalarea" />
                       
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                        <label>Size of Agriculture Area used :</label>
                        <input type="text" v-model="form.areaused" class="form-control editable_fields" id="areaused" />
                       
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
    data(){
        return{
           
            form: new form({
                id: '', 
                thramno:'', 
                plotno: '',
                peginfo: '',
                sizecompound:'',
                sizeplayground:'',
                playgroundused: '',
                status: '1',
                agriculturalarea: '',
                areaused:'',
               
            })
        }
    },

    methods:{

        /**
         * method to remove error
         */
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
       showtextbox:function(type){
                if(type=="Yes"){
                    $('#agriculturalarea').show();
                }
                else{
                    $('#agriculturalarea').hide();
                }
            },

        /**
         * method to reset form
         */
        restForm(){
            this.form.thramno= '';
            this.form.plotno = '';
            this.form.peginfo = '';
            this.form.sizecompound= '';
            this.form.sizeplayground= '';
            this.form.playgroundused= '';
            this.form.status= '';
            this.form.agriculturalarea='';
            this.form.areaused = '';
        },

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.restForm();
            }
            if(type=="save"){
                    this.form.post('/organization/saveSchoolCompundDetails',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: ' Detail is added successfully'
                    })
                    this.$router.push('/list_compound_details');
                })
                .catch(() => {
                    console.log("Error......");
                    this.applyselect();
                })
            }
		},
        
        // applyselect(type){
        //     if(type=="std"){
        //         if(!$('#sex_id').attr('class').includes('select2-hidden-accessible')){
        //             $('#sex_id').addClass('select2-hidden-accessible');
        //         }
        //         if(!$('#mother_tongue').attr('class').includes('select2-hidden-accessible')){
        //             $('#mother_tongue').addClass('select2-hidden-accessible');
        //         }
        //     }
            
        // },
        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html(''); 
            }
        },
        // async changefunction(id){
        //     if($('#'+id).val()!=""){
        //         $('#'+id).removeClass('is-invalid select2');
        //         $('#'+id+'_err').html('');
        //         $('#'+id).addClass('select2');
        //     }
        //     if(id=="sex_id"){
        //         this.form.sex_id=$('#sex_id').val();
        //     }
        //     if(id=="mother_tongue"){
        //         this.form.mother_tongue=$('#mother_tongue').val();
        //     }
        //     if(id=="country"){
        //         this.form.country=$('#country').val();
        //     }
             
        // },
        
    },
     mounted() { 
      
           $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
    }
}
</script>