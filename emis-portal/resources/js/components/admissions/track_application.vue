<template>
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-body">
                 <div class="form-group"> 
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label class="mb-0">Track Application:</label>
                        <label class="mb-0"><span class="text-danger">*</span><span class="cus-tooltips">Press Enter</span></label>
                        <div class="row form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label id="level_name"></label>
                                <input type="text" class="form-control" @keyup.enter="applicationDetailsbyCID('cid_passport')"   :class="{ 'is-invalid': form.errors.has('cid_passport') }" id="cid_passport" v-model="form.cid_passport" placeholder="CID/Ref. No">
                                <has-error :form="form" field="cid_passport"></has-error>
                            </div>
                        </div>
                        <has-error :form="form" field="admission"></has-error>
                    </div>
                </div>  
            </div>
        </div>
        <hr>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    data(){
        return{
            form: new form({
                id: '',
            })
        } 
    },
    methods: {
     applicationDetailsbyCID(cid_passport){
        if ($('#'+cid_passport).val().length != 11){
            Swal.fire({
                html: "Please enter 11 digit CID",
                icon: 'error'
            });
        }
        else {
            axios.get('/getstudentdetailsbyCid/' +$('#'+cid_passport).val())
            .then(response => {
                let data = response.data.data;
                if(data!=null && data!="" && data!=undefined){
                //Already for enrolled students  
                    this.$Progress.start();
                        // Toast.fire({
                        //     icon: 'success',
                        //     title: 'please fill the details before you apply'
                        // });
                        this.$router.push({name:'applicationLists',query: {cid:$('#'+cid_passport).val()}});
                        this.$Progress.finish() 
                    }
                    else{
                          Swal.fire(
                            'Sorry!',
                            'You are not admitted into the system.',
                            'Fail',
                            this.$router.push('#')
                        );
                       
                    }
                
                }).catch(function (error){
                    console.log("Retrieving error: "+error)
                });
            }
            
        },
        
        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        }, 


        loadRespectivePage(val){
            this.$router.push("/"+val);
        },

        /**
         * method to populate dropdown
         */
        async changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="admission"){
                this.form.admission=$('#admission').val(); 
                this.loadRespectivePage($('#admission').val());   
            }
        },
    },
    
    created(){
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
    }, 
}
</script>
