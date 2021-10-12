<template>
    <div>
        <div class="callout callout-danger" style="display:none" id="errorscreen">
            <h5 class="bg-gradient-danger">Sorry!</h5>
            <div id="message"></div>
        </div>
        <form class="bootbox-form">
            <div class="row form-group">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label class="mb-0.5">Merge Organization:<i class="text-danger">*</i></label>
                        <select v-model="form.bfOrglist" :class="{ 'is-invalid select2 select2-hidden-accessible': form.errors.has('bfOrglist') }" class="form-control select2" name="bfOrglist" id="bfOrglist">
                            <option v-for="(item, index) in registeredOrgList" :key="index" v-bind:value="item.id">{{ item.NewproposedName }}</option>
                        </select>
                        <has-error :form="form" field="bfOrglist"></has-error>
                    </div>
            </div>
            <label><u>Allocating the staff to each organization which has been Bifcurcated:</u><br><small><i>(Allocate to one organization)</i></small></label><br>
            <div class="form-group row " >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="content">
                    <div class="table-responsive overflow-auto">
                        <table id="priveleges_table" class="table table-sm table-bordered table-striped" style="width: 100%;">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Name of staff</th>
                                    <th>{{this.form.NewOrgName}}</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(staff, key) in staffList">
                                    <tr :key="key">
                                        <td><b><i>{{staff.name}}</i></b></td>
                                        <td><input type="radio" name="name" :value="staff.id+'__'+form.bifuractionOrg"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
             <!-- <div class="form-group row " >
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="message">
                     <label><i class="text-danger">(If you wish to cancel the transfer after processing)</i></label><br/>
                </div>
             </div> -->
            <div class="row form-group fa-pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary" @click="submitDetails()"> <i class="fa fa-save"></i>Update</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data(){
        return {
            staffList:[],
            registeredOrgList:[],
            form: new form({
                bfOrglist:'',
                NewOrgName:'',
                biffOrgId:'',
                parentOrg:'',
                staff:'',
                action_type:'add',
            }),
        }
    },
    methods: {
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },


        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="bfOrglist"){
                this.form.biffOrgId=$('#bfOrglist').val();
                this.loadParentOrgDetailOfRegistered(this.form.biffOrgId)
            }
            
        },
        loadBifurcationList(uri='common/loadRegisteredList/merge'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.registeredOrgList = data;
                for(let i=0;i<data.length;i++){
                    this.form.NewOrgName= data[i].NewproposedName;
                }
            })
            .catch(function (error){
                console.log("Error: "+error)
            });
        },

        loadParentOrgDetailOfRegistered(id){
             axios.get('common/loadParentOrgDetailOfRegistered/merge/' +id)
            .then(response => {
                let data = response.data;
                this.loadStaffList(data[0].orgId)
           })
            .catch(function (error){
                console.log("Error: "+error)
            });
        },
        loadStaffList(org_id){
             axios.get('common/loadStaffList/'+org_id)
            .then(response => {
                if(response!="" || response!=null){
                    let data = response.data.data;
                    this.staffList =data;
                }
                // else{
                //     $('#content').hide();
                //     $('#message').show();
                    
                // }
           })
            .catch(function (error){
                console.log("Error: "+error)
            });

        },
        submitDetails(){
            if(this.validateform()){
                Swal.fire({
                    text: "Are you sure you wish to save this staff details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('staff/substitution/savestaff')
                        .then((response)=> {
                            Swal.fire(
                                'Success!',
                                'Details has been saved successfully.',
                                'success',
                            )
                            this.$router.push('/list_substitute');
                        })
                        .catch((error) => {
                            console.log("Error shownexttab:"+error)
                        });
                    }
                });
            }
        },
        validateform(){
            let returntype=true;
            if($('#cid').val()==""){
                $('#cid_err').html('Please provide CID');
                returntype=false;
            }
            if($('#name').val()==""){
                $('#name_err').html('Please provide name of the person');
                returntype=false;
            }
            if($('#contact').val()==""){
                $('#contact_err').html('Please provide contact number');
                returntype=false;
            }
            return returntype;
        }
    },
    async mounted(){
        this.loadBifurcationList();
        this.loadParentOrgDetailOfRegistered();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=>{
            this.changefunction(id);
        });
    },
}
</script>
