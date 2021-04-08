<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header ">
                <h3 class="card-title">Application Details</h3>
            </div>
            <div class="card-body" >
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Proposed Name::</label>
                        <span class="text-indigo-600" id="scode">YangchenPhug</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Category:</label>
                        <span class="text-indigo-600" id="scode">Public</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Level:</label>
                        <span class="text-indigo-600" id="scode">Higher Secondary School</span>
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Dzongkhag:</label>
                        <span class="text-indigo-600" id="scode">Thimphu</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Gewog:</label>
                        <span class="text-indigo-600" id="scode">Babesa</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label>Chiwog:</label>
                        <span class="text-indigo-600" id="scode">Olakha</span>
                    </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Location Category:</label>
                            <span class="text-indigo-600" id="scode">Urban 1</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Geopolitically Located:</label>
                            <span class="text-indigo-600" id="scode">Yes</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Parent School:</label>
                            <span class="text-indigo-600" id="scode"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Co-located with Parent School:</label>
                            <span class="text-indigo-600" id="scode">No</span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Sen School/ECCD:</label>
                            <span class="text-indigo-600" id="scode">No</span>
                        </div>
                                        
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <ul>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;PP</label></li>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;I</label></li>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;II</label></li>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;III</label></li>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;IV</label></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <ul>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;V</label></li>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VI</label></li>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VII</label></li>
                                <li><input type="checkbox"><label> &nbsp;&nbsp;&nbsp;VIII</label></li>
                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;IX</label></li>
                                
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <ul>
                                <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;X</label></li>
                                <li><input type="checkbox" checked id="xlsection_check" @click="showchild('xlsection')"><label> &nbsp;&nbsp;&nbsp;XI</label></li>
                                <ul id="xlsection"   class="pl-4">
                                    <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                    <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                    <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                </ul>
                               <li><input type="checkbox" checked id="xlisection_check" @click="showchild('xlisection')"><label> &nbsp;&nbsp;&nbsp;XII</label></li>
                                <ul id="xlisection"  class="pl-4">
                                    <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Science</label></li>
                                    <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Commerce</label></li>
                                    <li><input type="checkbox" checked><label> &nbsp;&nbsp;&nbsp;Arts</label></li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md- font-weight-normal">Remark:</label>
                            <textarea id="remark" class="form-control"></textarea> 
                        </div>
                    </div>
                    
                </div>
                <div class="card-footer text-right">   
                    <button type="button" class="btn btn-danger btn-sm btn-flat pl-1 mb-0.5" @click="takeaction('reject')"><i class="fa fa-times"></i> Reject</button>
                    <button type="button" class="btn btn-success btn-sm btn-flat pl-1 mb-0.5" @click="takeaction('approve')"><i class="fa fa-check"></i> Approve</button>
                    <button type="button" class="btn btn-dark btn-sm btn-flat pl-1" @click="takeaction('verify')"><i class="fa fa-forward"></i> &nbsp;Verify &nbsp;</button>
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