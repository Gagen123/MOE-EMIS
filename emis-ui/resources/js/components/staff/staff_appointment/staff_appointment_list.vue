<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="data-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Emp Id</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Position Title</th>
                            <th>Working Agency</th>
                            <th>Email</th>
                            <th>Contact No.</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in substaffList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.emp_type_id}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ genderArray[item.sex_id]}}</td>
                            <!-- <td>{{ item.position_title.name}}</td> -->
                            <td>{{ item.position_title_id }}</td>
                            <td>{{ item.working_agency}}</td>
                            <td>{{ item.email}}</td>
                            <td>{{ item.contact_no}}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)">View</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            accesslevel:'',
            dzo_id:'',
            substaffList:[],
            genderArray:{},
            dt:''
        }
    },
    methods: {
        loadstff(type){
            axios.get('loadCommons/loadStaffList/'+type)
            .then((response) => {
                this.substaffList =  response.data.data;
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },
        loadgenderList(uri = 'masters/loadGlobalMasters/all_active_gender'){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.genderArray[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },

        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag_id"){
                this.dzo_id=$('#dzongkhag_id').val();
                this.orgList = [];
            }

        },
        loaddata(){
            let dzongkhag_id=$('#dzongkhag_id').val();
            let org_id=$('#org_id').val();
            let url="loadCommons/loadStaffList/";
            if(org_id!="ALL"){
                url+='selectedOrgWisePrivateStaff/'+org_id;
            }else{
                url+='selectedOrgWisePrivateStaff/'+dzongkhag_id;
            }
            axios.get(url)
            .then((response) => {
                this.substaffList =  response.data.data;
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        }
    },
    mounted() {
        this.loadgenderList();
        this.dt =  $("#data-table").DataTable();
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
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.accesslevel=data['acess_level'];
            if(data['acess_level']=="Org"){
                this.loadstff('userOrgWisePrivateStaff/ALL_TYPE');
                this.dzo_id=data['Dzo_Id'];
                $('#dzongkhag').val(data['Dzo_Id']).trigger('change');
                $('#adv_serach_ection').hide();
            }
            if(data['acess_level']=="Dzongkhag"){
                this.dzo_id=data['Dzo_Id'];
                $('#dzongkhag').val(data['Dzo_Id']).trigger('change');
                $("#organization_type option[value='Ministry']").remove();
                this.loadstff('userDzoWisePrivateStaff/ALL_TYPE');
                $('#dzosection').hide();
            }
            if(data['acess_level']=="Ministry"){
                this.loadstff('allPrivateStaff/ALL_TYPE');
            }
        })
        .catch(errors => {
            console.log(errors)
        });
    },
    watch: {
        substaffList(){
            this.applydatatable('data-table');
        }
    },
}
</script>


