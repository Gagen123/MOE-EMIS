<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="screenPermission">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <div class="callout callout-danger" style="display:none" id="newMessage">
            Seems there is no section mapping in your Organizaiton. Please update your classes and section <br>
            Thank you
        </div>
        <div id="mainformid">
            <form class="bootbox-form" id="classMappingId">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row form-group pl-5">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                               <table id="class_strm-table" class="table table-sm table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">Classes</th>
                                            <th class="streamsec" style="width:15%">Stream</th>
                                            <th style="width:10%">
                                            <!-- <input type="checkbox" id="chkbtn" @click="checkall('chkbtn')"> Check All -->
                                            </th>
                                            <th style="width:20%">No. Section</th>
                                            <th style="width:15%">Section</th>
                                            <template v-if="org_type == 'multigrade'" >
                                                <th style="width:15%">Multi Grade</th>
                                                <th style="width:20%">Group</th>
                                            </template>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, key, index) in  classStreamList" :key="index">
                                            <td>
                                                <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                            </td>
                                            <td class="streamsec" v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                {{  item.stream  }}<input type="hidden" name="selectedSection" :id="'seelctedsec'+item.id">
                                            </td>
                                            <td class="streamsec" v-else> <input type="hidden" name="selectedSection" :id="'seelctedsec'+item.classId"></td>

                                            <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                <input type="checkbox" :id="'applibable'+item.id" @click="showNoSection(item.id)" class="classname"
                                                v-model="form.stream" name="classStream" :value="item.id">
                                            </td>
                                            <td v-else>
                                                <input type="checkbox" :id="'applibable'+item.classId" @click="showNoSection(item.classId)" class="streamname"
                                                v-model="form.class" name="orgclass" :value="item.classId">
                                            </td>

                                            <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                <input type="number" min="1" max="2" @keyup.enter="setsections(item.id)" @blur="setsections(item.id)"
                                                :id="'no_section'+item.id" class="form-control" placeholder="No of section" style="display:none">
                                            </td>
                                            <td v-else>
                                                <input type="number" min="1" max="2" @keyup.enter="setsections(item.classId)" @blur="setsections(item.classId)"
                                                :id="'no_section'+item.classId" class="form-control" placeholder="No of section" style="display:none">
                                            </td>

                                            <td v-if="item.class=='Class 11' || item.class=='XI' || item.class=='Class 12' || item.class=='XII'">
                                                <span :id="'sectionval'+item.id"></span>
                                            </td>
                                            <td v-else>
                                                <span :id="'sectionval'+item.classId"></span>
                                            </td>

                                            <template v-if="org_type == 'multigrade'" >
                                                <td >
                                                    <input type="checkbox" class="multiageclass" :id="'check'+item.classId" @click="showMF('multigrade',item.classId)">
                                                </td>
                                                <td>
                                                    <select name="multiAgeId" disabled :id="'multigrade'+item.classId" :class="{ 'is-invalid select2 select2-hidden-accessible':form.errors.has('multiAgeId') }" class="form-control multiageclassval" >
                                                        <option value="">--- Please Select ---</option>
                                                        <option v-for="(multi, index) in multiAgeIdList" :key="index" v-bind:value="item.classId+'__'+multi.id">{{ multi.name }}</option>
                                                    </select>
                                                </td>
                                            </template>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 row">
                                <span v-for="(item, key, index) in  classStreamList" :key="index">
                                    <span v-if="item.class!='Class 11' && item.class!='XI' && item.class!='Class 12' && item.class!='XII'">
                                        <input type="checkbox" name="orgclass" v-model="form.class" :value="item.classId" :id="item.classId">
                                        <label class="pr-4"> &nbsp;{{ item.class }} </label>
                                    </span>
                                </span>

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
                            </div> -->
                        </div>
                    </div>
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
            org_type:"",
            levelArray:{},
            classList:[],
            schoolList:[],
            classStreamList:[],
            selected_sections:[],
            multiAgeIdList:[],
            secval:['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'],
            form: new form({
                id: '',school:'',class:[], stream:[],sections:[],multigrade:[],
            })
        }
    },

    methods:{
        checkall(id){
            if($('#'+id).prop('checked')){
                $('.classname').prop('checked',true);
                $('.streamname').prop('checked',true);
            }
            else{
                $('.classname').prop('checked',false);
                $('.streamname').prop('checked',false);
            }
        },
        showNoSection(item_id){
            if($('#applibable'+item_id).prop('checked')){
                $('#no_section'+item_id).show();
                $('#no_section'+item_id).val(1);
                this.setsections(item_id);
            }
            else{
                $('#seelctedsec'+item_id).val('');
                $('#no_section'+item_id).val('');
                $('#no_section'+item_id).hide();
                $('#sectionval'+item_id).html('');
            }
        },
        setsections(id){
            let noSec=$('#no_section'+id).val();
            this.form.users=[];
            let sections="";
            let sectionValue="";
            let sectionArray=[];
            for(let i=0;i<noSec;i++){
                if(i==noSec-1){
                    sections+=this.secval[i];
                    // sectionValue+=id+':'+this.secval[i];
                }
                else{
                    sections+=this.secval[i]+", ";
                    // sectionValue+=id+':'+this.secval[i]+", ";
                }
                this.insertvalue(id+':'+this.secval[i]);
                sectionArray.push(id+'#'+this.secval[i]);
            }
            $('#seelctedsec'+id).val(sectionArray);
            $('#sectionval'+id).html(sections);
        },
        showMF(id,count){
            if($('#check'+count).prop('checked')){
                $('#'+id+count).prop('disabled',false);
            }
            else{
                $('#'+id+count).prop('disabled',true);
                $('#'+id+count).val('');
            }
        },
        insertvalue(section){
            if(this.form.sections.join('; ').includes(section)==false){
                this.form.sections.push(section);
            }
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
                let calss_section=[];
                $("input[name='selectedSection']").each( function () {
                    if($(this).val()!=null && $(this).val()!="null" && $(this).val()!=""){
                        if($(this).val().includes(',')){
                            for(let p=0;p<$(this).val().split(",").length;p++){
                                calss_section.push($(this).val().split(",")[p]);
                            }
                        }
                        else{
                            calss_section.push($(this).val());
                        }
                    }
                });
                this.form.sections=calss_section;
                if(clasArray=="" && calss_strm==""){
                    Swal.fire({
                        html: "Please select class",
                        icon: 'error'
                    });
                }else{

                    let multiage=[];
                    $.each(this.classStreamList, function(key, value){
                        if($('#multigrade'+value.classId).val()!=""){
                            multiage.push($('#multigrade'+value.classId).val());
                            // alert($('#multigrade'+i).val());
                        }
                    })
                    for(let i=0;i<this.classStreamList.length;i++){

                    }
                    this.form.multiAgeId=multiage;
                    this.form.post('/organization/saveClassMapping',this.form)
                    .then(() => {
                        Toast.fire({
                            icon: 'success',
                            title: 'Class mapping is added successfully'
                        })
                    })
                    .catch((e) => {
                        console.log("Error: "+e)
                    })
                }
            }
		},
        getmultiGrade(){
            axios.get('/masters/loadClassStreamMapping/multiGrade')
              .then(response => {
                this.multiAgeIdList = response.data.data;
            })
            .catch(errors => {
                console.log(errors)
            });
        },

        getCurrentClassStream(schoolId){
            axios.get('/organization/getCurrentClassStream/'+schoolId)

              .then(response => {
                let response_data = response.data;
                let isNew=false;
                for(let i=0;i<response_data.length;i++){
                    let sec_count=response_data[i].sectionCount;
                    if(sec_count==0){
                        isNew=true;
                    }
                    if(response_data[i].streamId!=""){
                        $('#applibable'+response_data[i].classStreamId).prop('checked',true);
                        this.showNoSection(response_data[i].classStreamId);
                        $('#no_section'+response_data[i].classStreamId).val(sec_count);//set the value of onput section count
                        this.setsections(response_data[i].classStreamId);
                    }
                    else{
                        $('#applibable'+response_data[i].classId).prop('checked',true);
                        this.showNoSection(response_data[i].classId);//show the input field
                        $('#no_section'+response_data[i].classId).val(sec_count);//set the value of onput section count
                        this.setsections(response_data[i].classId);
                        if(response_data[i].isMultiGrade==1){
                            $('#check'+response_data[i].classId).prop('checked',true);
                            $('#multigrade'+response_data[i].classId).val(response_data[i].classId+'__'+response_data[i].multiGradeId);
                        }
                    }
                }
                if(isNew){
                    $('#newMessage').show();
                }
            });
        },
        getorgdetials(org_id){
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                let org_data=response.data.data;
                this.org_type = org_data.category;
                this.getClassStream(this.levelArray[org_data.levelId]);
                this.getCurrentClassStream(org_id);
            });
        },
        getClassStream(text){
            let level = text;
            $('streamsec').hide();
            if(level!=undefined && level.toLowerCase().includes('middle')){
                level="10";
            }
            else if(level!=undefined &&  level.toLowerCase().includes('lower')){
                level="8";
            }
            else if(level!=undefined &&  level.toLowerCase().includes('primary')){
                level="6";
                this.org_type = 'multigrade';
            }
            else{
                if(level==undefined){
                    level="ECCD";
                }
                else{
                    level="12";
                    $('.streamsec').show();
                }
            }
            if(level!=undefined){
                let url="";
                if(level=="ECCD"){
                    url='/masters/loadClassStreamMapping/ECCD_'+level;
                }
                else{
                    url='/masters/loadClassStreamMapping/school_'+level;
                }
                axios.get(url)
                .then(response => {
                    this.classStreamList = response.data.data;
                });
            }
        },

        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
                 for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },
    },

    mounted(){
        this.getLevel();
        this.getmultiGrade();
        // this.getClassStream();
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.getorgdetials(data['Agency_Code']);
                this.form.school=data['Agency_Code'];
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
