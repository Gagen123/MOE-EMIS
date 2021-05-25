<template>
    <div>
        <br />
        <div class="form-group row"> 
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <label class="mb-0">Please Select the Type of Establishment:<span class="text-danger">*</span></label>
                <select name="establishment_type" id="establishment_type" v-model="form.establishment_type" :class="{ 'is-invalid': form.errors.has('establishment_type') }" class="form-control select2" @change="getCategory(),remove_error('establishment_type')">
                    <option value="">--- Please Select ---</option>
                    <option value="public_school"> Public School </option>
                    <option value="private_school"> Private School </option>
                    <option value="public_eccd"> Public ECCD </option>
                    <option value="private_eccd"> Private ECCD </option>
                    <option value="public_ecr"> Public ECR </option>
                </select>
                <has-error :form="form" field="establishment_type"></has-error>
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
                id: '',proposedName:'',level:'',category:'1',dzongkhag:'',gewog:'',chiwog:'0',locationType:'',
                geopolicaticallyLocated:'0',senSchool:'0',parentSchool:'',coLocatedParent:'0',cid:'',name:'',
                phoneNo:'',email:'',status:'pending',isfeedingschool:'0',feeding:[],
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
         * to load the respective pages depending on the type of establishment
         */

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
            if(id=="establishment_type"){
                this.form.establishment_type=$('#establishment_type').val(); 
                this.loadRespectivePage($('#establishment_type').val());   
            }
        },
    },
    
    created(){
        this.getScreenAccess();
        this.getLevel();
        this.getLocation();
        // this.checkPendingApplication();
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
