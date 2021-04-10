<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="col-md-5 ">Category:<span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control editable_fields" v-model="form.category" @change="show()">
                            <option value="">--- Please Select ---</option>
                            <option value="1">Public</option>
                            <option value="2">Private</option>
                            <option value="3">NGo</option>
                            <option value="3">Coporate</option>
                        </select>
                        <!-- <select name="category" id="category" class="form-control" v-model="form.category" @change="show()" :class="{ 'is-invalid': form.errors.has('spo_name') }">
                            <option value="">--- Please Select ---</option>
                            <option v-for="(item, index) in categoryList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select> -->
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label class="col-md-10 ">Year of Establishment:</label>
                            <input type="text" class="form-control" v-model="form.yearOfEstablishment" id="yearOfEst"/>
                    </div>                   
                </div>
                
                <!-- for public category -->
                <div style="display:none" id="publicCategory">
                    <div class="form-group row" >  
                        <label class="col-md-7 ">ZEST Working Agency Code:<span class="text-danger">*</span></label>
                        <div class="input-group col-md-12 col-sm-12 col-xs-12">
                            <input type="text" id="workingAgencyCode" class="col-md-4 form-control" @change="removeerror('workingAgencyCode','workingAgencyCode_error')"/>
                            <div class="input-group-append">
                                <span type="button" class="col-md-12 btn  btn-primary" @click="getSchoolDeails()"><i class="fa fa-search">&nbsp;Search</i></span>
                            </div>
                        </div>
                        <span id="workingAgencyCode_error" class="text-danger"></span>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="school1" style="display:none">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Working Agency Code:</label>
                                    <span class="text-indigo-600" id="scode">00020292</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name:</label>
                                    <span class="text-indigo-600" id="sname">YangchenPhug HSS</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Parent Agency:</label>
                                    <span class="text-indigo-600" id="scategory">MOE</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Level:</label>
                                    <span class="text-indigo-600" id="slevel">Higher Secondary School</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Dzongkhag:</label>
                                    <span class="text-indigo-600" id="slevel">Thimphu</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Gewog:</label>
                                    <span class="text-indigo-600" id="sdzongkhag">Thimthrom</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Chiwog:</label>
                                    <span class="text-indigo-600" id="sdzongkhag">Thimthrom</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Location Type:</label>
                                    <span class="text-indigo-600" id="slevel">Urban Grade 1</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Geopolitically Located:</label>
                                    <span class="text-indigo-600" id="sdzongkhag">No</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Sen School/ECCD:</label>
                                    <span class="text-indigo-600" id="sdzongkhag">No</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Location Type:</label>
                                    <span class="text-indigo-600" id="slevel">Urban Grade 1</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Geopolitically Located:</label>
                                    <span class="text-indigo-600" id="sdzongkhag">No</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="mb-0">Select classes and streams</label>
                                </div>
                            </div><br>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <span v-for="(item, key, index) in  classList" :key="index">
                                    <br>
                                    <input type="checkbox" v-model="form.class" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                    <span v-for="(stm, key, index) in streamList" :key="index" >
                                        <span v-if="item.class=='XI' || item.class=='XII'">
                                            <br>
                                            <input type="checkbox" v-model="form.stream"  :id="stm.id" :value="item.id+'##'+stm.id"> <label class="pr-3"> {{ stm.stream  }}</label>
                                        </span>
                                    </span>
                                </span> 
                            </div>
                        </div>
                    </div>  
                </div>

                <!-- for private category -->
                <div style="display:none" id="privateCategory">
                    <div class="form-group row" >    
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
                            <label class="col-md-12 ">School/ECR/ECCD:<span class="text-danger">*</span></label>
                            <select name="organization" id="organization" class="form-control editable_fields " @change="getPvtApprovedSchoolDetails()">
                                <option value="">--- Please Select ---</option>
                                <option value="1">Kelki HSS</option>
                            </select>
                        </div> 
                    </div> 
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="privateSchoolDetails" style="display:none">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:</label>
                                <span class="text-indigo-600" id="sdzongkhag">Kelki HSS</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Level:</label>
                                <span class="text-indigo-600" id="sdzongkhag">Higher Secondary School</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Dzongkhag:</label>
                                <span class="text-indigo-600" id="sdzongkhag">Thimphu</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Gewog:</label>
                                <span class="text-indigo-600" id="sdzongkhag">Thimthrom</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Chiwog:</label>
                                <span class="text-indigo-600" id="sdzongkhag">Thimthrom</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Location:</label>
                                <span class="text-indigo-600" id="sdzongkhag">Urban Grade 1</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Geopolitically Located:</label>
                                <span class="text-indigo-600" id="sdzongkhag">No</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>SEN School:</label>
                                <span class="text-indigo-600" id="sdzongkhag">No</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Proprietor Details:</label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>CID:</label>
                                <span class="text-indigo-600" id="sdzongkhag">10604002392</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Name:</label>
                                <span class="text-indigo-600" id="sdzongkhag">Sonam Dorji</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Phone:</label>
                                <span class="text-indigo-600" id="sdzongkhag">17439832</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label>Email:</label>
                                <span class="text-indigo-600" id="sdzongkhag">sonam@gmail.com</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Classes and Streams</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mb-0">Select classes and streams</label>
                            </div>
                        </div><br>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                            <span v-for="(item, key, index) in  classList1" :key="index">
                                <br>
                                <input type="checkbox" v-model="form.class1" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                                <span v-for="(stm, key, index) in streamList1" :key="index" >
                                    <span v-if="item.class=='XI' || item.class=='XII'">
                                        <br>
                                        <input type="checkbox" v-model="form.stream1"  :id="stm.id" :value="item.id+'##'+stm.id"> <label class="pr-3"> {{ stm.stream  }}</label>
                                    </span>
                                </span>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
            <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            categoryList:[],
            classList:[],
            streamList:[],
            classList1:[],
            streamList1:[],
            form: new form({
                id: '',category:'',yearOfEstablishment:'',class:[],stream:[],class1:[],stream1:[]
            }),
        }
    },

    methods:{

        /** method to show div*/
        show: function(){
            let category = $("#category").val();
            if(category == 1 || category == 3 || category == 4){
                $("#publicCategory").show();
                $("#privateCategory").hide();

            }else{
                $("#privateCategory").show();
                $("#publicCategory").hide();
            }
        },

        /** method to get org details from ZEST system */

        getSchoolDeails: function(){
            if($('#workingAgencyCode').val()==""){
                $('#workingAgencyCode_error').html('Please enter zest working agency code.');
                $('#workingAgencyCode').focus();
                $('#workingAgencyCode').removeClass('is-invalid');
            }
            else{
                $('#school1').show();
                $('#school2').show();
            }
        },

        getPvtApprovedSchoolDetails: function(){
            $("#code").val("201.00005.11.0925");
            $("#schoolName").val("Private 1");
            $("#privateSchoolDetails").show();
            $("#classAndStream").show();
        },

        /**
         * method to get road type in dropdown
         */
        getCategoryDropdown(uri = '/organization/getCategoryInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.categoryList = data;
            });
        },

        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList = response.data;
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream:function(){
            axios.get('/organization/getStream')
              .then(response => {
                this.streamList = response.data;
            });
        },

        /**
         * method to get class in checkbox
         */
        getClass1:function(){
            axios.get('/organization/getClass')
              .then(response => {
                this.classList1 = response.data;
            });
        },

        /**
         * method to get stream in checkbox
         */
        getStream1:function(){
            axios.get('/organization/getStream')
              .then(response => {
                this.streamList1 = response.data;
            });
        },
    },

    mounted(){
        // this.getCategoryDropdown();
        this.getClass();
        this.getStream();
        this.getClass1();
        this.getStream1();
    }
}
</script>