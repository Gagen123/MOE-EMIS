<template>
    <div>
        <div class="card">
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 alert alert-default-info text-center pb-0 pt-1" id="guidelines_id" style="display:none">
                        <label class="mb-0.5">You can submit attendance once in a month and not allow to edit them once submitted:</label>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="dzongkhag_id" style="display:none">
                        <label class="mb-0.5">Dzongkhag:</label>
                        <select v-model="dzongkhag" class="form-control select2" name="dzongkhag" id="dzongkhag">
                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="dzongkhag_err"></span>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="org_section">
                        <label class="mb-0.5">Organization:<i class="text-danger">*</i></label>
                        <select v-model="organizaiton" class="form-control select2" name="organizaiton" id="organizaiton">
                            <option v-for="(item, index) in orgList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="organizaiton_err"></span>
                    </div>
                </div>
                <table id="responsible-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Remarks</th>
                            <th>Submitted Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in data_list" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.year}}</td>
                            <td>{{ months[item.month]}}</td>
                            <td>{{ item.remarks}}</td>
                            <td>{{ reverseDateTime(item.created_at)}}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View</a>
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
            access_level:'',
            orgList:[],
            dzongkhagList:[],
            dzongkhag:'',
            organizaiton:'',
            data_list:[],
            months:{1:'January',2:'Febuary',3:'March',4:'April',5:'May',6:'June',
            7:'July',8:'August',9:'September',10:'October',11:'November',12:'December'}
        }
    },
    methods: {
        loadDataList(org_id){
            let uri = 'staff/staffServices/loadStaffattendance/'+org_id;
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.data_list = data;
            })
            .catch(function (error){
               console.log('Error: '+error);
            });
        },
        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dzongkhagList =  data.data.data;
            })
            .catch(function (error){
                console.log("Error: "+error)
            });
        },

        allOrgList(dzo_id){
            if(dzo_id==""){
                dzo_id=$('#dzongkhag').val();
            }
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
            this.orgList = [];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.orgList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadeditpage(itme){
            this.$router.push({name:"edit_attendance",params:{data:itme.id}});
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag"){
                this.dzongkhag=$('#dzongkhag').val();
                this.allOrgList($('#dzongkhag').val());
            }
            if(id=="organizaiton"){
                this.loadDataList($('#organizaiton').val());
            }
        },
    },
    mounted(){
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
        this.dt =  $("#responsible-table").DataTable();

        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.access_level=data['acess_level'];
            if(data['acess_level']=="Org"){
                this.loadDataList(data['Agency_Code']);
                $('#org_section').hide();
                $('#guidelines_id').show();
            }
            if(data['acess_level']=="Dzongkhag"){
                this.allOrgList(data['Dzo_Id']);
            }
            if(data['acess_level']=="Ministry"){
                $('#dzongkhag_id').show();
                this.loadactivedzongkhagList();
            }
        })
        .catch(errors => {
            console.log(errors)
        });
    },
    watch: {
        data_list() {
            this.applydatatable('responsible-table');
        }
    },
}
</script>
