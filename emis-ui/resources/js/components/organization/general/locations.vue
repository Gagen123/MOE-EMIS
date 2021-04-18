<template>
    <div>
        <form class="bootbox-form" id="locationsId">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <input type="hidden" class="form-control" v-model="form.organizationId"/>
                    <input type="hidden" class="form-control" v-model="form.id"/>
                    <!-- <div class="form-group row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>School:</label>
                                <span class="text-indigo-600" id="scode">&nbsp; YangchenPhug</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Dzongkhag:</label>
                                <span class="text-indigo-600" id="scode">&nbsp; Thimphu</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Gewog:</label>
                                <span class="text-indigo-600" id="scode">&nbsp;Thimphu throm</span>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label class="required">Land Ownership:<span class="text-danger">*</span></label>
                            <br>
                            <label><input v-model="form.landOwnership" type="radio" value="1"/> Public</label>
                            <label><input v-model="form.landOwnership" type="radio" value="0" /> Private</label>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label class="required">Compound Fencing:<span class="text-danger">*</span></label>
                            <br>
                            <label><input v-model="form.compoundFencing" type="radio" value="1"/> Yes</label>
                            <label><input v-model="form.compoundFencing" type="radio" value="0" /> No</label>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            
                            <label class="required">Entrance Gate:<span class="text-danger">*</span></label>
                            <br>
                            <label><input v-model="form.entranceGate" type="radio" value="1"/> Yes</label>
                            <label><input v-model="form.entranceGate" type="radio" value="0" /> No</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Longitude:</label>
                            <input type="text" v-model="form.longitude" class="form-control editable_fields" id="longitude" />
                        </div> 
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Latitude:</label>
                            <input type="text" v-model="form.latitude" class="form-control editable_fields" id="latitude" />
                        </div> 
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Altitude:</label>
                            <input type="text" v-model="form.altitude" class="form-control editable_fields" id="altitude" />
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding:25px">
                            <input type="button" value="Get Value" @click="getLat()" class="bt btn-primary form-control" />
                        </div>
                    </div>
                                        
                    <div class="form-group row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Thram No:<span class="text-danger">*</span></label>
                            <input type="text" v-model="form.thramNo" :class="{ 'is-invalid': form.errors.has('thramNo') }" class="form-control editable_fields" @change="remove_err('thramNo')" id="thramNo"/>
                            <has-error :form="form" field="thramNo"></has-error>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>CID No. of Owner:</label>
                            <input type="text" v-model="form.cid" class="form-control editable_fields" id="cidOfOwner"/>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Name of Owner:</label>
                            <input type="text" v-model="form.name" class="form-control editable_fields" id="nameOwner"/>
                        </div> 
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Compound Area:<span class="text-danger">*</span></label>
                            <input type="text" v-model="form.compoundArea" :class="{ 'is-invalid': form.errors.has('compoundArea') }" @change="remove_err('compoundArea')" class="form-control editable_fields" id="compoundArea"/>
                            <has-error :form="form" field="compoundArea"></has-error>
                        </div> 
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label >Disaster risks:</label><br>
                            <span v-for="(item, key, index) in  disasterList" :key="index">
                                <input type="checkbox" v-model="form.disaster" :value="item.id"><label class="pr-4"> &nbsp;{{ item.name }}</label>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><b>&nbsp;&nbsp; Attachments</b><br><br>
                        <table id="attachmentTable" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <!-- <th></th> -->
                                    <th>Title</th>
                                    <th>File</th>
                                    <th>Remark</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in form.attachment_details" :key="index">
                                    <td><input type="text" class="form-control" v-model="item.name" readonly/></td>
                                    <td><input type="file"  id="filePath"></td>
                                    <td><input type="text" name="remark" class="form-control" v-model="item.remarks"/></td>
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
    data(){
        return{
            disasterList:[],
            attachmentList:[],
            
            form: new form({
                id: '', 
                organizationId:'',
                landOwnership: '1',
                compoundFencing: '1',
                entranceGate: '1',
                longitude: '',
                latitude: '',
                altitude: '',
                thramNo: '', 
                cid:'', 
                name: '',
                compoundArea: '',
                action_type:'add', 
                disaster:[],
                attachment_details:[{name:'',attach:'',remarks:''}],
            }),
        }
    },

    methods:{

        /**
         * method to current get lat and longitude 
         */
        getLat: function(){
            this.form.latitude = 27.514162;
            this.form.longitude = 90.433601;
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
         * method to save or update data
         */
        formaction: function(type){
            if(type=="reset"){
                $(".editable_fields").val('');
            }
            if(type=="save"){
                this.form.post('/organization/saveLocation',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Location is added successfully'
                    })
                    // if(this.form.organizationId != null || this.form.organizationId != ""){
                    //     this.$router.push("/school_list")
                    // }
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        /**
         * method to get disaster list in checkbox
         */
        getDisasterList:function(){
            axios.get('/organization/getDisasterListInCheckbox')
              .then(response => {
                this.disasterList = response.data;
            });
        },

        /**
         * method to load attachments
         */
        loadAttachmentList(uri = 'masters/loadAttachment'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.form.attachment_details=[];
                for(let i=0;i<data.length;i++){
                    this.form.attachment_details.push({name:data[i].name,attach:'',remarks:''});
                }
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },

         /**
         * method to get organization details by id
         */
        getLocationDetails(id){
            axios.get('organization/getLocationDetails/'+id)
            .then((response) => {  
                let data=response.data.data;
                this.form.landOwnership     = data.landOwnership;
                this.form.compoundFencing   = data.compoundFencing;
                this.form.entranceGate      = data.entranceGate;
                this.form.longitude         = data.longitude;
                this.form.latitude          = data.latitude;
                this.form.altitude          = data.altitude;
                this.form.cid               = data.cid;
                this.form.name              = data.name;
                this.form.thramNo           = data.thramNo;
                this.form.compoundArea      = data.compoundArea;
                this.form.id                = data.id;
            })
            .catch((error) =>{  
                console.log("Error:"+error);
            }); 
        },
    },

    created(){
        this.getLocationDetails(this.$route.query.orgId);
    },

    mounted(){
        this.getDisasterList();
        this.loadAttachmentList();
        this.form.organizationId = this.$route.query.orgId;
    }
}
</script>