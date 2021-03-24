<template>
    <div>
         <form>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Code:</label>
                    <span class="text-indigo-600" id="scode">00020292</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Name:</label>
                    <span class="text-indigo-600" id="sname">YangchenPhug HSS</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Category:</label>
                    <span class="text-indigo-600" id="scategory">Public</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Level:</label>
                    <span class="text-indigo-600" id="slevel">Higher Secondary School</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Dzongkhag:</label>
                    <span class="text-indigo-600" id="sdzongkhag">Thimphu</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Gewog:</label>
                    <span class="text-indigo-600" id="sgewog">Thimthrom</span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Chiwog:</label>
                    <span class="text-indigo-600" id="schiwog">Yangchenphug</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Location Type:</label>
                    <span class="text-indigo-600" id="slocationtype">Urban grade 1</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Geopolitically Located:</label>
                    <span class="text-indigo-600" id="sgeo">No</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>SEN School:</label>
                    <span class="text-indigo-600" id="ssen">No</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label>Reason:</label>
                    <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="1">Closing for reason 1</option>
                        <option value="2">Closing for reason 2</option>
                    </select>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <label>Remarks:</label>
                    <textarea class="form-control"></textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger" tabindex="5"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" tabindex="4"><i class="fa fa-save"></i> Close School</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },

    methods:{
        save(){ 
            Swal.fire({
                text: "Are you sure you wish to submit the application for closure?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Success!',
                        'Application for School Closure has been submitted successfully. You may track your application status with application number: #112211',
                        'success',
                    )
                    this.$router.push('/taslistforall');
                }
            });
        },
        /** method to reset forms */
        reset: function(){
           window.location.reload();
        },
    }
}
</script>