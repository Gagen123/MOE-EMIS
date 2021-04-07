<template>
    <div>
        <form>
            <div class="row">
                <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Training/Workshop/Seminar Title:</label>
                        <input type="text" class="form-control" placeholder="Training/Workshop/Seminar Title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>From:</label>
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>To:</label>
                        <input type="date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Place:</label>
                        <input type="text" class="form-control" placeholder="Place">
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                        <label> Country:</label>
                        <select class="form-control">
                        <option>Bhutan</option>
                        <option>India</option>
                        <option>Nepal</option>
                        <option>Thailand</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <!-- textarea -->
                    <div class="form-group">
                        <label>Details</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Details"></textarea>
                    </div>
                </div>
            </div>
        </form>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <span class="fa-pull-right">
                    <button type="button" class="btn btn-dark  text-white btn-xs" @click="showadprocess('create_new_participant')"><i class="fa fa-user-plus"></i> Add Nomination</button>
                </span>
            </div>
        </div>
        <div class="modal fade show" id="add_modal" aria-modal="true" style="padding-right: 17px;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Participant</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="bootbox-form">
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
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <textarea class="form-control" rows="3" placeholder="Remarks"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer text-right">
                        <button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
                        <button data-bb-handler="confirm" @click="addrecords()" type="button" class="btn btn-primary">OK</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</template>
<script>
export default {
     data() {
        return {
			count:0,
        }
    },
    methods: {
        showadprocess(type){
            if(type="create_new_participant"){
                $('#add_modal').modal('show');
            }
        },
        
    },
    
}
</script>
