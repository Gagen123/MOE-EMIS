<template>
    <div>
        <table id="list-student-roles" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>

                     <th >No.</th>
                     <th >Student CID</th>
                     <th >Student Code</th>
                     <th >Student Name</th>
                     <th >Class</th>
                     <th >Section</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                     <td>1</td>
                     <td>12345678901</td>
                     <td>201.00005.11.0925</td>
                     <td>Karma Wangmo</td>
                     <td>9</td>
                     <td>A</td>
                     <td>
                         <button class="btn btn-primary btn-xs" @click="viewstudentrole('1')" type="button"><i class="fa fa-search"></i> View</button>
                     </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>10948753421</td>
                    <td>201.00010.11.0032</td>
                    <td>Choki Wangchuk</td>
                    <td>9</td>
                    <td>B</td>
                    <td>
                         <button class="btn btn-primary btn-xs" @click="viewstudentrole('1')" type="button"><i class="fa fa-search"></i> View</button>
                    </td>
                </tr>
                <tr>
                    <td class="">3</td>
                    <td>10946740934</td>
                    <td>201.00020.13.0164</td>
                    <td>Deki Tshomo</td>
                    <td>9</td>
                    <td>B</td>
                    <td>
                         <button class="btn btn-primary btn-xs" @click="viewstudentrole('1')" type="button"><i class="fa fa-search"></i> View</button>
                    </td>
                </tr>
                <tr>
                    <td class="">4</td>
                    <td>19463566974</td>
                    <td>201.00010.11.0016</td>
                    <td>Hemant Biswa </td>
                    <td>9</td>
                    <td>B</td>
                    <td>
                         <button class="btn btn-primary btn-xs" @click="viewstudentrole('1')" type="button"><i class="fa fa-search"></i> View</button>
                    </td>
                </tr>
                <tr>
                    <td class="">5</td>
                    <td>12345098701</td>
                    <td>201.00017.11.0165</td>
                    <td>Karma Rigden</td>
                    <td>9</td>
                    <td>B</td>
                    <td>
                         <button class="btn btn-primary btn-xs" @click="viewstudentrole('1')" type="button"><i class="fa fa-search"></i> View</button>
                    </td>
                </tr>

            </tbody>
        </table>
        <div class="modal fade" id="viewstudentrole" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">View Student Roles</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Student Name: </label>
                                <span class="text-indigo-600">Dorji</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Student ID: </label>
                                <span class="text-indigo-600">01000</span>
                            </div> 
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Class: </label>
                                <span class="text-indigo-600">9</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Section: </label>
                                <span class="text-indigo-600">A</span>
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th style="width: 10px">#</th>
                                <th>Roles</th>
                                <th>Country</th>
                                <th style="width: 40px">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>1.</td>
                                <td>Update software</td>
                                <td>
                                    <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-danger">55%</span></td>
                                </tr>
                                <tr>
                                <td>2.</td>
                                <td>Clean database</td>
                                <td>
                                    <div class="progress progress-xs">
                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-warning">70%</span></td>
                                </tr>
                                <tr>
                                <td>3.</td>
                                <td>Cron job running</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary">30%</span></td>
                                </tr>
                                <tr>
                                <td>4.</td>
                                <td>Fix and squish bugs</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-success" style="width: 90%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-success">90%</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            count:5,
        }
    },
    methods: {
        viewstudentrole:function(){
            $('#viewstudentrole').modal('show');
		},
     
    addrecords: function(){
			let tablestr="";
			this.count++;
			let today = new Date();
			let dd = String(today.getDate()).padStart(2, '0');
			let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
			let yyyy = today.getFullYear();
			today =   yyyy+'-'+mm+'-'+dd;
			tablestr="<tr id='record"+this.count+"'><td>"+this.count+"</td><td>"+$('#newlevelname').val()+"</td><td><span class='label label-success label-sm'>Active</span></td><td>"+today+"</td><td> <button class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Edit</button><button class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</button></td></tr>";
			$('#dynamic-table').append(tablestr);
			$('#samplemodal').modal('hide');
		}, 
		showdelete: function(id){
			$('#deleterecordid').val(id);
			$('#deletemodal').modal('show');
		},
		deleterecords(){
			$('#record'+$('#deleterecordid').val()).remove();
			$('#deletemodal').modal('hide');
        },
        
        showadprocess(type){
           this.$router.push("/"+type);
        },
    
    },


    mounted() {
        $("#list-student-roles").DataTable({
            "responsive": true,
            "autoWidth": false,
        }); 
        $('.dataTables_filter').addClass('fa-pull-right');
        $('#student-table_paginate').addClass('fa-pull-right');
    },
}
</script>