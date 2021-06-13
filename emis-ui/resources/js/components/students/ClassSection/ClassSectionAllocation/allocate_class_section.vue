<template>
    <div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                     <small>(You will be provided the list of previous academic year)</small><br>
                     <label>Class:</label>
                    <select v-model="student_form.std_class" :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('std_class') }" @change="aboveClass10()"  class="form-control select2" name="std_class" id="std_class">
                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                    </select>
                    <has-error :form="student_form" field="std_class"></has-error>
                </div>
            </div>
            <hr>
            <form>
                <div>
                    <table id="allocation-list-table" class="table table-bordered text-sm table-striped">
                        <thead>
                            <tr>
                                <th >SL#</th>
                                <th >Student Name</th>
                                <th >Student Code</th>
                                <th >Class</th>
                                <th >Section</th>
                                <th >Stream</th>
                                <th class="no_sec">No. of Meals</th>
                                <th class="private_sec">Boarder</th>
                                <th class="private_sec">SF/GS</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr v-for="(item, index) in studentList" :key="index">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.Name}}</td>
                                <td>{{ item.student_code}}</td>
                                <td>
                                    <select v-model="item.orgClassStreamId"  :class="{ 'is-invalid select2 select2-hidden-accessible': student_form.errors.has('class') }" class="form-control select2" name="class" id="class">
                                        <option v-for="(item, index) in classList" :key="index" v-bind:value="item.id">{{ item.class }}</option>
                                    </select>
                                    <has-error :form="student_form" field="class"></has-error>
                                </td>
                                <td>
                                    <select v-model="item.sectionId" :class="{ 'is-invalid  select2-hidden-accessible': student_form.errors.has('std_section') }" class="form-control select2" name="std_section" id="std_section">
                                        <option v-for="(item, index) in sectionList" :key="index" v-bind:value="item.section_id">{{ item.section }}</option>
                                    </select>
                                    <has-error :form="student_form" field="std_section"></has-error>
                                </td>
                                <td>
                                    <select v-model="item.streamId" :class="{ 'is-invalid  select2-hidden-accessible': student_form.errors.has('std_stream') }" class="form-control select2" name="std_stream" id="std_stream">
                                        <option v-for="(item, index) in sectionList" :key="index" v-bind:value="item.section_id">{{ item.stream }}</option>
                                    </select>
                                    <has-error :form="student_form" field="std_stream"></has-error>
                                </td>
                                <td class="no_sec">
                                    <label><input  type="radio" v-model="item.noOfMeals" name="feeding1" id="feeding1" value="1" tabindex=""/> One Meal</label>
                                    <label><input  type="radio" v-model="item.noOfMeals" name="feeding2" id="feeding2" value="2" tabindex=""/> Two Meals</label>
                                    <label><input  type="radio" v-model="item.noOfMeals" name="feeding3" id="feeding3" value="3" tabindex=""/> Three Meals</label>
                                </td>
                                <td class="private_sec">
                                    <label><input  type="radio" v-model="item.isBoarder" name="boarder1" id="feeding1" value="1" tabindex=""/> Yes</label>
                                    <label><input  type="radio" v-model="item.isBoarder" name="boarder2" id="feeding2" value="2" tabindex=""/> No</label>
                                </td>
                                <td class="private_sec">
                                    <label class="private_sec"><input  type="radio" v-model="item.scholarshipType" name="scholarshipType1" id="feeding1" value="1" tabindex=""/> Gov.</label>
                                    <label class="private_sec"><input  type="radio" v-model="item.scholarshipType" name="scholarshipType2" id="feeding2" value="2" tabindex=""/> Self Financed</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
   data(){
        return{
            dt:'',
            orgDetails:'',
            classStreamSections:[],
            classList:[],
            sectionList:[],
            streamList:[],
            byClass:[],
            studentList:[],
            cat_data:'',
            student_form: new form({
                std_class: '',
                std_stream: '',
                std_section: '',
                class_section_stream:[],
                date: '',
                std_id: [],
                std_class:[],
                std_section:[],
                std_meals:[],
                std_finance:[],
                std_boarder:[]
            }),
        }
    },

    methods: {
        /**
         * to load the class list
         */
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
        getStreamList(id){
            let classId=$('#std_class').val();
            if(id!="" && classId==null){
                classId=id;
            }
            let uri = 'loadCommons/loadStreamList/'+classId;
            this.streamList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.streamList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getSectionList(id){
            let classId=$('#std_class').val();
            if(id!="" && classId==null){
                classId=id;
            }
            let uri = 'loadCommons/loadSectionList/'+classId;
            this.sectionList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.sectionList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        
        getAge(DateOfBirth){
            let date_of_birth = new Date(DateOfBirth);
            var diff_ms = Date.now() - date_of_birth.getTime();
            var age_dt = new Date(diff_ms);
            return Math.abs(age_dt.getUTCFullYear()-1970);
        },
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.student_form.screening= '';
                this.student_form.prepared_by='';
                this.student_form.screening_position='';
                this.student_form.screening_endorsed_by= '';
                this.student_form.date='';
            }
            if(type=="save"){
                this.student_form.std_screened=[];
                let screenedArray=[];
                $("input[name='height']:checked").each( function () {
                    screenedArray.push($(this).val());
                });
                this.student_form.std_screened=screenedArray;
                
                this.student_form.std_referred=[];
                let referredArray=[];
                $("input[name='weight']:checked").each( function () {
                    referredArray.push($(this).val());
                });

                this.student_form.class_section_stream = this.studentList;
                this.student_form.post('/students/saveStudentClassAllocation',this.student_form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details added successfully'
                    })
                    this.$router.push('/class_section');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="screening"){
                this.student_form.screening=$('#screening').val();
            }
            if(id=="screening_position"){
                this.student_form.screening_position=$('#screening_position').val();
            }
            if(id=="screening_endorsed_by"){
                this.student_form.screening_endorsed_by=$('#screening_endorsed_by').val();
            }
            if(id=="std_class"){
                this.student_form.std_class=$('#std_class').val();
                let class_selected = $("#std_class").val();
                this.getStreamList();
                this.getSectionList();

                axios.get('/students/loadStudentByClass/'+$('#std_class').val())
                .then((response) => {
                    this.studentList = response.data;  
                    this.showhidetable();
                })
                .catch(() => {
                    consoele.log("Error:"+e)
                });
            }

            if(id=="std_stream"){
                this.student_form.std_stream=$('#std_stream').val();
            }
            if(id=="std_section"){
                // axios.get('/students/loadStudentBySection/'+$('#std_class').val()+'__'+$('#std_stream').val()+'__'+$('#std_section').val())
                //     .then((response) => {
                //         this.studentList = response.data;  
                // })
                // .catch(() => {
                //     consoele.log("Error:"+e)
                // });

                this.student_form.std_section=$('#std_section').val();
            }
            
        },

        getorgName(rogId,accessLevel){
            let type="Headquarterbyid";
            if(accessLevel=="Org"){
                type="Orgbyid";
            }
            axios.get('loadCommons/loadOrgDetails/'+type+'/'+rogId)
            .then(response => {
                let data = response.data.data;
                this.orgDetails=data;
                this.cat_data=data.category;
                this.showhidetable();
            })    
            .catch(errors => { 
                console.log(errors)
            });
        },

        showhidetable(){
            // alert(this.cat_data);
            if(this.cat_data=="public_school"){
                $('.private_sec').hide();
                $('.no_sec').show();
            }
            else{
                $('.private_sec').show();
                $('.no_sec').hide();
            }
        },
            
        checkall(class_to_check,id){
            if($('#'+id).prop('checked')){
                $("."+class_to_check).prop("checked",true);
            }
            else{
                $("."+class_to_check).prop("checked",false);
            }
        }
    },
    mounted() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
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

        //get the session details to find out private or public
        axios.get('common/getSessionDetail')
            .then(response => {
                let data = response.data.data;
                let roleName="";
                for(let i=0;i<data['roles'].length;i++){
                    if(i==data['roles'].length-1){
                        roleName+=data['roles'][i].roleName;
                    }
                    else{
                        roleName+=data['roles'][i].roleName+', ';
                    }
                }

                this.getorgName(data['Agency_Code'],data['acess_level']);
            })    
            .catch(errors => { 
                console.log(errors)
            });
        
        this.loadClassList();
        // this.loadSectionList();
        // this.loadStreamList();
        this.dt =  $("#allocation-list-table").DataTable()
    },
    watch: {
        studentList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#allocation-list-table").DataTable();
                this.showhidetable();
            });
        }
    },
    
}
</script>