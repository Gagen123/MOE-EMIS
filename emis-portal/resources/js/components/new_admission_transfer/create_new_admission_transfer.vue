<template>
    <div class="card-body">
        <div class="row form-group">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>CidNo/Student Code:</label>
                <input type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('cid_std_code') }" id="cid_std_code" v-model="form.cid_std_code" placeholder="Ref/cid No">
                <has-error :form="form" field="cid_std_code"></has-error>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pt-4 mt-2">
                <button class="btn btn-primary" @click="getDetailsbyCID('cid_std_code')"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
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
     getDetailsbyCID(cid_std_code){
        if ($('#'+cid_std_code).val()== ""){
            Swal.fire({
                html: "Please enter your CID/Passport No/ Student code",
                icon: 'error'
            });
        }
        else {
            axios.get('/getstudentdetailsbyCid/' +$('#'+cid_std_code).val())
            .then(response => {
                let data = response.data.data;
                data = data==null ? "" : data;
                if(data!=""){
                    this.$Progress.start();
                    if(data.IsNewAdmission==1){
                        this.$router.push({name:'admission_initiated',query: {data:data.id}});
                        this.$Progress.finish()
                    }
                    else{
                        this.$router.push({name:'classxi_student',query: {data:data}});
                        this.$Progress.finish()
                    }
                }
                else{
                    this.$Progress.start();
                    this.$router.push({name:'new_registration_for_admission',query: {cid:$('#'+cid_std_code).val()}});
                    this.$Progress.finish()
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
        // loadRespectivePage(val){
        //     this.$router.push("/"+val);
        // },

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
