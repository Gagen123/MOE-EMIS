<template>
    <div>
        <form class="bootbox-form" id="compoundarea-detial">
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Thram No:<span class="text-danger">*</span> </label>
                        {{form.thramNo}}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label > Plot No: </label>
                        {{form.plotNo}}
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                       <label>Size of Compound Area:<span class="text-danger">*</span></label>
                       {{form.compoundArea}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Lag Tharm(Peg Information): </label>
                        {{attach.attachments}}
                        <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>   
                    </div>
                </div>
                 <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Does the School/ECCD/ECR have Playground area?<span class="text-danger">*</span></label>
                        <br>
                       {{form.statusofplay}}
                    </div>
                </div>
                <div class="form-group row" style="display:none" id="playgroundarea">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Play Ground Area:<span class="text-danger">*</span></label>
                       {{form.playgroundArea}}

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Playground area used:<span class="text-danger">*</span></label>
                      {{form.playgroundAreaUsable}}
                    </div>
                 
                    <!-- commented by tshewang, need to check insert link
                    comment: SAP: program type field is requred- Piggery, Poultry Cattle.. with add more features -->
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Does the School have agricultural area?<span class="text-danger">*</span></label>
                        <br>
                        {{form.status}}
                    </div>
                </div>
                <div class="form-group row" style="display:none" id="agriculturalarea">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Agriculture Area : </label>
                        {{form.agricultureArea}}

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                        <label>Size of Agriculture Area used :</label>
                       {{form.agricultureAreaUsed}}

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Program Practise By the Organization:</label><br>
                        <label  v-for="(item, index) in  programTypeList" :key="index" class="pr-4">
                            <input  type="checkbox" :id="'PrgType'+item.id" name="programType" v-model="form.programType" :value="item.id" /> 
                            {{item.name}}
                        </label>
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
            programTypeList:[],
            display:'',

            form: new form({
                id: '',
                thramno:'',
                plotno: '',
                attachments: '',
                sizecompound:'',
                sizeplayground:'',
                playgroundused: '',
                status: '0',
                statusofplay: '',
                agriculturalarea: '',
                areaused:'',
                programType:[],

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

        showtextboxPlay:function(type){
            if(type=="Yes"){
                $('#playgroundarea').show();
            }
            else{
                $('#playgroundarea').hide();
            }
        },

        onChangeFileUpload(e){
            this.form.attachments = e.target.files[0];
        },
        /**
         * method to reset form
         */
        restForm(){
            this.form.thramno= '';
            this.form.plotno = '';
            this.form.attachments = '';
            this.form.sizecompound= '';
            this.form.sizeplayground= '';
            this.form.playgroundused= '';
            this.form.status= '';
            this.form.statusofplay= '';
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
                 const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let formData = new FormData();
                formData.append('thramno', this.form.thramno);
                formData.append('plotno', this.form.plotno);
                // alert(this.form.attachments);
                formData.append('attachments', this.form.attachments);
                formData.append('sizecompound', this.form.sizecompound);
                formData.append('sizeplayground', this.form.sizeplayground);
                formData.append('playgroundused', this.form.playgroundused);
                formData.append('status', this.form.status);
                formData.append('statusofplay', this.form.statusofplay);
                formData.append('agriculturalarea', this.form.agriculturalarea);
                formData.append('areaused', this.form.areaused);
                formData.append('programType', this.form.programType);
                    axios.post('/organization/saveSchoolCompundDetails',formData,config)
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


        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html('');
            }
        },
        loadProgramTypeList(uri = 'masters/organizationMasterController/loadOrganizaitonmasters/active/ProgramType'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.programTypeList =  data;
            })
        },
        
        getEditCompoundDetail(compId){
            axios.get('organization/getEditCompoundDetail/'+compId)
            .then((response) => {  
                let data=response.data;
                this.display=response.data;
                this.form.thramno                       =    data.thramNo;
                this.form.plotno                        =    data.plotNo;
                this.form.attachments                   =    data.attachments;
                this.form.sizecompound                  =    data.compoundArea;
                this.form.sizeplayground                =    data.playgroundArea;
                this.form.playgroundused                =    data.playgroundAreaUsable;
                this.form.status                        =    data.status;
                this.form.statusofplay                  =    data.statusofplay;
                this.form.agriculturalarea              =    data.agricultureArea;
                this.form.areaused                      =    data.agricultureAreaUsed;
                this.form.id                            =    data.id;
                if(data.programType!=null && data.programType.includes(',')){
                    for(let i=0;i<data.programType.split(',').length;i++){
                        let ret_data=data.programType.split(',')[i];
                        $('#PrgType'+ret_data).prop('checked',true);
                    }
                }
                else if(data.programType!=null && data.programType!=""){
                    $('#PrgType'+data.programType).prop('checked',true);
                }
                 
              //+'selcid'
               
                
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },

    },
    mounted() {

        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        this.loadProgramTypeList();
        this.getEditCompoundDetail(this.$route.params.data.id)
    }
}
</script>
