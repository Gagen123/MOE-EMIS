<template>
    <div>
        <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">Details of School</h3>
                </div>
                <div class="card-body" >
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
                            <select class="form-control" disabled>
                                <option value="1">Closing for reason 1</option>
                                <option value="2">Closing for reason 2</option>
                            </select>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Remarks:</label>
                            <textarea class="form-control" readonly> Explanation of the school closing</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label>Your Remarks:</label>
                            <textarea class="form-control" id="remarks"></textarea>
                        </div>
                    </div>
                    <div class="row form-group fa-pull-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-flat btn-danger" @click="shownexttab('reject')"> <i class="fa fa-times"></i> Reject </button>
                            <button class="btn btn-flat btn-primary" @click="shownexttab('verify')"> <i class="fa fa-forward"></i>Verify </button>
                            <button class="btn btn-flat btn-dark" @click="shownexttab('approve')"> <i class="fa fa-check"></i>Approve </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },

    methods:{

    }
}
</script>