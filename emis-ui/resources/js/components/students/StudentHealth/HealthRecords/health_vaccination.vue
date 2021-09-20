<template>
    <div>
       <div class="card card-primary card-outline card-outline-tabs">
            <div>
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Student vaccinated with TD</th>
                                    <th>Boys</th> 
                                    <th>Girls</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Number of Student who received TD at 6 years</td>
                                    <td><input type="number" name="number" class="form-control"/></td>
                                    <td><input type="number" name="number1" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <td>Number of Student who received TD 12 years</td>
                                    <td><input type="number" name="number" class="form-control"/></td>
                                    <td><input type="number" name="number1" class="form-control"/></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div>
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th colspan="3" style="text-align:center">Number of Class VI Girls vaccinated with HPV Vaccine</th>
                                </tr>
                                <tr>
                                    <th>Number of Girls who received 1st Dose</th>
                                    <th>Number of Girls who received 2nd Dose</th> 
                                    <th>Number of Girls who received 3rd Dose</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="number" name="number" class="form-control"/></td>
                                    <td><input type="number" name="number" class="form-control"/></td>
                                    <td><input type="number" name="number1" class="form-control"/></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row form-group fa-pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" @click="shownexttab('expenditure-tab','final-tab')"> <i class="fa fa-save"></i>Save </button>
                </div>
            </div>
        </div>
    </div> 
</template>
<script>

export default {
    data(){
        return{
            orgList:'',
            classList:[],
            streamList:[],
            classStreamList:[],
            levelList:[],
            form: new form({
                organizationId:'', level:'', application_type:'level_change', class:[], stream:[],
                application_for:'Change in Level', action_type:'add', status:'pending',organization_type:''
            })
        }
    },
    methods: {
        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        /**
         * method to get level in dropdown
         */
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.levelList = data;
            });
        },

        //getOrgList(uri = '/organization/getOrgList'){
        getOrgList(uri = 'loadCommons/loadOrgList/userdzongkhagwise/NA'){
            axios.get(uri)
            .then(response => {
                this.orgList = response.data.data;
            });
        },

        /**
         * method to populate dropdown
         */
        async changefunction(id){
            if(id=="organizationId"){
                this.form.organizationId=$('#organizationId').val();
                this.getorgdetials($('#organizationId').val());
            }

            if(id=="level"){
                this.form.level=$('#level').val();
            }
        },

        getorgdetials(org_id){
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+org_id)
            .then(response => {
                this.form.organization_type=response.data.data.organizationType;
            });
        },

        /**
         * method to show next and previous tab
         */
        shownexttab(nextclass){
            if(nextclass=="final-tab"){
                Swal.fire({
                    text: "Are you sure you wish to save this details ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.form.post('organization/saveChangeBasicDetails')
                        .then((response) => {
                            if(response!=""){
                                if(response.data=="No Screen"){
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Technical Errors: please contact system admimnistrator for further details'
                                    });
                                }
                                if(response!="" && response!="No Screen"){
                                    let message="Application for Change basic details has been submitted for approval. System Generated application number for this transaction is: <b>"+response.data.data.application_number+'.</b><br> Use this application number to track your application status. <br><b>Thank You !</b>';
                                    this.$router.push({name:'restr_acknowledgement',params: {data:message}});
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Change details is saved successfully'
                                    });
                                }
                            }
                        })
                        .catch((err) => {
                            console.log("Error:"+err)
                        })
                    }
                });
            }
        },

        change_tab(nextclass){
            $('#tabhead >li >a').removeClass('active');
            $('#tabhead >li >a >span').addClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').addClass('active');
            $('.'+nextclass+' >a >span').removeClass('bg-gradient-secondary text-white');
            $('.'+nextclass+' >a').removeClass('disabled');
            $('.tab-content-details').hide();
            $('#'+nextclass).show().removeClass('fade');
        },

        applyselect2(){
            if(!$('#level').attr('class').includes('select2-hidden-accessible')){
                $('#level').addClass('select2-hidden-accessible');
            }
            if(!$('#dzongkhag').attr('class').includes('select2-hidden-accessible')){
                $('#dzongkhag').addClass('select2-hidden-accessible');
            }
            if(!$('#gewog').attr('class').includes('select2-hidden-accessible')){
                $('#gewog').addClass('select2-hidden-accessible');
            }
            if(!$('#chiwog').attr('class').includes('select2-hidden-accessible')){
                $('#chiwog').addClass('select2-hidden-accessible');
            }
            if(!$('#locationType').attr('class').includes('select2-hidden-accessible')){
                $('#locationType').addClass('select2-hidden-accessible');
            }
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
         * method to get class stream in checkbox
         */
        getClassStream:function(){
            axios.get('/masters/loadClassStreamMapping/school')
              .then(response => {
                this.classStreamList = response.data.data;
            });
        },

    },

    mounted() {
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
    }
}
</script>
