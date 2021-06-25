<template>
    <div>
        <table id="list-student-table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >No.</th>
                     <th >Student CID</th>
                     <th >Student Name</th>
                     <th >Created At</th>
                     <!-- <th >Class</th>
                     <th >Section</th> -->
                     <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(std, index) in stdList" :key="index">
                    <td>{{ index + 1 }} </td>
                    <td>{{ std.CidNo }}</td>
                    <td>{{ std.Name }}</td>
                    <td>{{ std.created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(std.id)"><span clas="fa fa-edit"></span>Veiw/Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            dzongkhagList:[],
            orgList:[],
            stdList:[],
            clasList:[],
            streamList:[],
            streamListSelected:[],
            sectionList:[],
            class_form: new form({
                dzongkhag:'',
                org:'',
                class:'',
                stream:'',
                section:'',
            }),
        }
    },
    methods: {
        loadeditpage(id){
            this.$router.push({name:'edit_student_registration',params: {data:id}});
        },
        loadStudentList(param){
            this.stdList =[];
            let uri="";
            if(param=="session"){
                uri='students/admission/loadStudentAdmissionList/';
                axios.get(uri)
                .then(response => {
                    let data = response.data;
                    this.stdList = data.data;
                });
            }
            else{
                this.class_form.post('students/admission/loadStudentAdmissionList')
                .then((response) => {
                    this.stdList = response.data.data;
                    this.applyselect();
                })
                .catch((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Unexpected error occured. Try again.'
                    });
                    this.applyselect();
                    console.log("Error:"+error);
                });
            }
        },
        applyselect(){
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#org').attr('class').includes('select2-hidden-accessible')){
                $('#org').addClass('select2-hidden-accessible');
            }
            if(!$('#class').attr('class').includes('select2-hidden-accessible')){
                $('#class').addClass('select2-hidden-accessible');
            }
            if(!$('#stream').attr('class').includes('select2-hidden-accessible')){
                $('#stream').addClass('select2-hidden-accessible');
            }
            if(!$('#section').attr('class').includes('select2-hidden-accessible')){
                $('#section').addClass('select2-hidden-accessible');
            }
        },
        loadclasses(id){
            let uri = "";
            if(id=="session"){
                uri = 'organization/getClassByOrg/sessionDet';
            }
            else{
                uri = 'organization/getClassByOrg/'+id;
            }
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.clasList=data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        changefunction(id){
            if(id=="class"){
                this.class_form.class=$('#class').val();
                $('#stream_section').hide();
                if($('#class option:selected').text()=="XI" || $('#class option:selected').text()=="XII"){
                    $('#stream_section').show();
                    this.showstream($('#class').val());
                }
                else{
                    this.getExistingSection($('#class').val());
                }
            }
            if(id=="dzongkhag"){
                this.class_form.dzongkhag=$('#dzongkhag').val();
                this.getschoolList($('#dzongkhag').val());
            }
            if(id=="org"){
                this.class_form.org=$('#org').val();
                this.loadclasses($('#org').val());
            }
            if(id=="class"){
                this.class_form.class=$('#class').val();
            }
            if(id=="stream"){
                this.class_form.stream=$('#stream').val();
                this.getExistingSection($('#stream').val());
            }
            if(id=="section"){
                this.class_form.section=$('#section').val();
            }
        },
        getschoolList(dzo_id){
            let uri="organization/loadOrganizationByDzoId/"+dzo_id;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.orgList =  data.data.data;
            })
            .catch(function (error) {
                console.log("Error:"+error)
            });
        },
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
        showstream(valu){
            this.streamListSelected=[];
            axios.get('/organization/getStreamByClassId/'+valu)
            .then(response => {
                let data = response.data;
                this.streamListSelected = data;
            });
        },
        getExistingSection(classId){
            this.class_form.class_stream_id=classId;
            this.sectionList=[];
            axios.get('/organization/getExistingSectionByClass/'+classId)
            .then(response => {
                let data = response.data;
                if(data != ""){
                    this.sectionList=data;
                }
            });
        },
    },
    mounted(){
        this.loadStudentList('session');
        this.loadactivedzongkhagList();
        $('.select2').select2();
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id')); 
        });
        
        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        $("#list-student-table").DataTable({
            "responsive": true,
            "autoWidth": false,
        }); 
        this.loadclasses('session');
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.class_form.dzongkhag=data['Dzo_Id'];
            $('#dzongkhag').val(data['Dzo_Id']).trigger('change');
            this.getschoolList(data['Dzo_Id']);
            this.class_form.org=data['Agency_Code'];
            $('#org').val(data['Agency_Code']).trigger('change');
            this.loadclasses(data['Agency_Code']);
        })    
        .catch(errors => { 
            console.log(errors)
        }); 
    },
}
</script>