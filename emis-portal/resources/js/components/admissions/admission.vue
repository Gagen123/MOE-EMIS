<template>
    <div class="container-fluid">
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
     getDetailsbyCID(cid_std_code){
        if ($('#'+cid_std_code).val().length != 11){
            Swal.fire({
                html: "Please enter 11 digit CID",
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
                        this.$router.push({name:'admission_initiated',query: {data:$('#'+cid_std_code).val()}});
                        this.$Progress.finish()
                    }
                    else{
                        this.$router.push({name:'classxi_student',query: {data:data}});
                        this.$Progress.finish()
                    }
                }
                else{
                    this.$Progress.start();
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: 'please fill the details before you apply'
                    // })
                    this.$router.push({name:'notenrolled_student',query: {cid:$('#'+cid_std_code).val()}});
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
