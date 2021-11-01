<template>
    <div>
        <form class="bootbox-form" id="compoundarea-detail">
            <div class="card-body">
                <div class="form-group row"> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Thram No:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @change="removeerror('thramno')" :class="{ 'is-invalid': form.errors.has('thramno') }" id="thramno" name= "thramno" v-model="form.thramno" placeholder="thramno">
                        <has-error :form="form" field="thramno"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label > Plot No: </label>
                        <input type="text" class="form-control" @change="removeerror('plotno')" :class="{ 'is-invalid': form.errors.has('plotno') }" id="plotno" v-model="form.plotno" placeholder="plotno">
                        <has-error :form="form" field="plotno"></has-error>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Compound Area(sq.meter):<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @change="removeerror('sizecompound')" :class="{ 'is-invalid': form.errors.has('sizecompound') }" id="sizecompound" v-model="form.sizecompound" >
                        <has-error :form="form" field="sizecompound"></has-error>
                    </div> 
                    
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="mb-0">Lag Thram/Peg Info & other related document <span class="text-danger">*</span></label>
                    </div>
                </div>
                <!-- <div class="card"> -->
                    <div class="form-group row">
                        <div class="card-body col-lg-8 col-md-8 col-sm-8 col-xs-8">
                            <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Upload File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="record1" v-for='(att, index) in form.attachments' :key="index">
                                        <td>
                                            <input type="text" class="form-control" :class="{ 'is-invalid' :form.errors.has('file_name') }" v-model="att.file_name" :id="'file_name'+(index+1)">
                                            <span class="text-danger" :id="'file_name'+(index+1)+'_err'"></span>
                                        </td>
                                        <td>
                                            <input type="file" name="attachments" class="form-control" v-on:change="onChangeFileUpload" :id="'attach'+(index+1)">
                                            <span class="text-danger" :id="'attach'+(index+1)+'_err'"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
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
                <!-- </div> -->
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Land Ownership Type<span class="text-danger">*</span></label>
                        <br>
                        <label><input v-model="form.ownership"  type="radio" value="government">Government</label>
                        <label><input v-model="form.ownership"  type="radio" value="private">Private</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Does the School/ECCD/ECR have Playground area?<span class="text-danger">*</span></label>
                        <br>
                        <label><input v-model="form.statusofplay"  type="radio" value="0" @click="showtextboxPlay('No')" />No</label>
                        <label><input v-model="form.statusofplay"  type="radio" value="1" @click="showtextboxPlay('Yes')"/>Yes</label>
                    </div>
                </div>
                <div class="form-group row" style="display:none" id="playgroundarea">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Play Ground Area(sq.meter):<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @change="removeerror('sizeplayground')" :class="{ 'is-invalid': form.errors.has('sizeplayground') }" id="dob" v-model="form.sizeplayground">
                        <has-error :form="form" field="sizeplayground"></has-error>

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Playground area used(sq.meter):<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" @change="removeerror('playgroundused')" :class="{ 'is-invalid': form.errors.has('playgroundused') }" id="playgroundused" v-model="form.playgroundused">
                        <has-error :form="form" field="playgroundused"></has-error>
                    </div>
                 
                    <!-- commented by tshewang, need to check insert link
                    comment: SAP: program type field is requred- Piggery, Poultry Cattle.. with add more features -->
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="">Does the School/ECCD/ECR have agricultural area?<span class="text-danger">*</span></label>
                        <br>
                        <label><input v-model="form.status"  type="radio" value="0" @click="showtextbox('No')" />No</label>
                        <label><input v-model="form.status"  type="radio" value="1" @click="showtextbox('Yes')"/>Yes</label>
                    </div>
                </div>
                <div class="form-group row" style="display:none" id="agriculturalarea">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Size of Agriculture Area(sq.meter) : </label>
                        <input type="text" v-model="form.agriculturalarea" class="form-control editable_fields" id="agriculturalarea" />

                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" >
                        <label>Size of Agriculture Area used(sq.meter) :</label>
                        <input type="text" v-model="form.areaused" class="form-control editable_fields" id="areaused" />

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <label>Program Practise By the School/ECCD/ECR:</label><br>
                        <label  v-for="(item, index) in  programTypeList" :key="index" class="pr-4">
                            <input  type="checkbox" name="programType" v-model="form.programType" :value="item.id"/> 
                            {{item.name}}
                        </label>
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
            filecount:1,
            programTypeList:[],
            attachments:[],
            form: new form({
                id: '',
                thramno:'',
                plotno: '',
              //  attachments: [],
                sizecompound:'',
                sizeplayground:'',
                playgroundused: '',
                status: '0',
                statusofplay: '',
                agriculturalarea: '',
                areaused:'',
                ownership:'',
                programType:[],
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
            this.form.thramno= '';
            this.form.plotno = '';
            this.form.attachments = '';
            this.form.sizecompound= '';
            this.form.sizeplayground= '';
            this.form.playgroundused= '';
            this.form.status= '';
            this.form.statusofplay= '';
            this.form.agriculturalarea='';
            this.form.ownership='';
            this.form.areaused = '';
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
               // formData.append('attachments', this.form.attachments);
                formData.append('sizecompound', this.form.sizecompound);
                formData.append('sizeplayground', this.form.sizeplayground);
                formData.append('playgroundused', this.form.playgroundused);
                formData.append('status', this.form.status);
                formData.append('statusofplay', this.form.statusofplay);
                formData.append('agriculturalarea', this.form.agriculturalarea);
                formData.append('areaused', this.form.areaused);
                formData.append('ownership',this.form.ownership);
                formData.append('programType', this.form.programType);
                for(let i=0;i<this.form.ref_docs.length;i++){
                        formData.append('attachments[]', this.form.ref_docs[i].attach);
                        formData.append('attachmentname[]', this.form.ref_docs[i].name);
                    }
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
        onChangeFileUpload(e){
            let currentcount=e.target.id.match(/\d+/g)[0];
            if($('#file_name'+currentcount).val()!=""){
                this.form.ref_docs.push({name:$('#file_name'+currentcount).val(), attach: e.target.files[0]});
                $('#file_name'+currentcount).prop('readonly',true);
            }
            else{
                $('#file_name'+currentcount+'_err').html('Please mention file name');
                $('#'+e.target.id).val('');
            }
        },
        addMore: function(){
            this.filecount++;
            this.form.attachments.push({file_name:'', attachment:''});
        },
        remove(){
            if(this.form.attachments.length>1){
                this.filecount--;
                this.form.attachments.pop();
                this.form.ref_docs.pop();
            }
        },

        removeattachments(index){
            if(this.form.attachments.length>1){
                this.filecount--;
                this.form.attachments.pop();
                this.form.ref_docs.pop();
            }
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
    }
}
</script>