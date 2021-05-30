<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div id="mainformid">
            <form class="bootbox-form" id="classMappingId">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row form-group pl-5">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <span v-for="(item, key, index) in  classStreamList" :key="index">
                                    <span v-if="item.class!='Class 11' && item.class!='XI' && item.class!='Class 12' && item.class!='XII'">
                                        <input type="checkbox" name="orgclass" v-model="form.class" :value="item.classId" :id="item.classId">
                                        <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                    </span>  
                                </span> 
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <span v-for="(item, key, index) in  classStreamList" :key="index">
                                    <span v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                        <input type="checkbox" name="classStream" v-model="form.stream"  :id="item.id" :value="item.id"> 
                                        <label class="pr-3"> 
                                            {{ item.class }} 
                                            <span v-if="item.stream"> - 
                                                {{  item.stream  }}
                                            </span>
                                        </label>
                                    </span>  
                                </span> 
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
        
    </div>
</template>

<script>
export default {
    data(){
        return{
            classList:[],
            schoolList:[],
            classStreamList:[],
            form: new form({
                id: '',school:'',class:[], stream:[],
            })
        }
    },

    methods:{
        getschoolDetials(uri = 'loadCommons/loadOrgList/userworkingagency'){
            axios.get(uri)
            .then(response => { 
                let data = response;
                this.schoolList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#closure-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.school= '';
                this.form.class= '';
            }
            if(type=="save"){
                this.form.class=[];
                let clasArray=[];
                $("input[name='orgclass']:checked").each( function () {
                    clasArray.push($(this).val());
                });
                this.form.class=clasArray;
                let calss_strm=[];
                $("input[name='classStream']:checked").each( function () {
                    calss_strm.push($(this).val());
                });
                this.form.stream=calss_strm;
                this.form.post('/organization/saveClassMapping',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Class mapping is added successfully'
                    })
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        /**
         * method to get class in checkbox
         */
        getClassStream:function(){
            axios.get('/masters/loadClassStreamMapping/school')
              .then(response => {
                this.classStreamList = response.data.data;
            });
        },
        getCurrentClassStream(schoolId){
            axios.get('/organization/getCurrentClassStream/'+schoolId)
              .then(response => {
                let response_data = response.data;
                for(let i=0;i<response_data.length;i++){
                    if(response_data[i].streamId!=""){
                        $('#'+response_data[i].classStreamId).prop('checked',true);
                    }
                    else{
                        $('#'+response_data[i].classId).prop('checked',true);
                    }
                }
            });
        },
    },

    mounted(){
        this.getClassStream();
        
        this.getschoolDetials();
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.form.school=data['Agency_Code'];
                this.getCurrentClassStream(data['Agency_Code']);
            }
            else{
                $('#screenPermission').show();
                $('#mainformid').hide();
                $('#message').html('This page is not accessible to you');
            }
        })    
        .catch(errors => { 
            console.log(errors)
        });
    }
}
</script>