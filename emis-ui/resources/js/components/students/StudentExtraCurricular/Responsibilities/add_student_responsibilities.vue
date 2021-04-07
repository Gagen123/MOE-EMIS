<template>
    <div>
        <form>
            <div class="form-group row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Student:<span class="text-danger">*</span></label>
                        <select class="form-control select2bs4" name="stydentdetails" id="student_details">
                        <option value="" label="- Please Select -">- Please Select -</option>
                        <option value="Tashi Tshomo, Class 9 A">Tashi Tshomo, Class 9 A</option>
                        <option value="Pema Dorji, Class 10 B">Pema Dorji, Class 10 B</option>
                        <option value="Tshering Pema, Class 9 B" >Tshering Pema, Class 9 B</option>
                        <option value="Dorji Khandu, Class 10 C">Dorji Khandu, Class 10 C </option>
                        <option value="Jigme Choden, Class 9 B">Jigme Choden, Class 9 B</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                        <label>Roles</label>
                        <select class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                </div>
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
    methods: {
        showadprocess(type){
            if(type=="create_new_staff" || type=="edit_staff"){
                this.$router.push("/"+type);
            }
            if(type=="liststaff"){
                this.$router.push("/liststaff");
            }
		},
    },
    mounted() {
    },
    
}
</script>


