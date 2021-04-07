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
                    <!-- text input -->
                    <div class="form-group">
                        <label>Joining Date:</label>
                        <input type="date" class="form-control" placeholder="Date">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Responsibilities:</label>
                        <textarea class="form-control" rows="3" placeholder="Responsibilities"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                        <label> Roles:</label><br>
                        <input type="radio" name="connecgtion" id="connecgtion" @click="showidentity('President')" checked> President <br>
                        <input type="radio" name="connecgtion" id="connecgtion" @click="showidentity('Vice_President')"> Vice-President
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>