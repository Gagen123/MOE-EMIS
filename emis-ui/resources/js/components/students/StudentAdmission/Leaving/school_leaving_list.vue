<template>
    <div>
        <table id="list-student-left" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>

                     <th >No.</th>
                     <th >Student CID</th>
                     <th >Student Code</th>
                     <th >Student Name</th>
                     <th >Dzongkhag</th>
                     <th >School Name</th>
                     <th >Status</th>
                     <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                     <td>1</td>
                     <td>12345678901</td>
                     <td>201.00005.11.0925</td>
                     <td>Karma Wangmo</td>
                     <td>Bumthang</td>
                     <td >Jakar HSS</td>
                     <td>Dropped</td>
                     <td>
                         <button class="btn btn-secondary btn-xs" @click="editstudentstatus('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                     </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>10948753421</td>
                    <td>201.00010.11.0032</td>
                    <td>Choki Wangchuk</td>
                    <td>Bumthang</td>
                    <td >Jakar HSS</td>
                    <td>Dropped</td>
                    <td>
                         <button class="btn btn-secondary btn-xs" @click="editstudentstatus('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                </tr>
                <tr>
                    <td class="">3</td>
                    <td>10946740934</td>
                    <td>201.00020.13.0164</td>
                    <td>Deki Tshomo</td>
                    <td>Bumthang</td>
                    <td >Jakar HSS</td>
                    <td>Left</td>
                    <td>
                         <button class="btn btn-secondary btn-xs" @click="editstudentstatus('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                </tr>
                <tr>
                    <td class="">4</td>
                    <td>19463566974</td>
                    <td>201.00010.11.0016</td>
                    <td>Hemant Biswa </td>
                    <td>Bumthang</td>
                    <td >Jakar HSS</td>
                    <td>Transferred</td>
                    <td>
                         <button class="btn btn-secondary btn-xs" @click="editstudentstatus('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                </tr>
                <tr>
                    <td class="">5</td>
                    <td>12345098701</td>
                    <td>201.00017.11.0165</td>
                    <td>Karma Rigden</td>
                    <td>Bumthang</td>
                    <td >Jakar HSS</td>
                    <td>Dropped</td>
                    <td>
                         <button class="btn btn-secondary btn-xs" @click="editstudentstatus('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="editstudentstatus" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Edit Student Leaving School Record</h4>
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
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Last Class Attendant</label>
                                        <input type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Date of Leaving</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Reasons</label>
                                        <input type="text" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Current Engagement</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Current Address</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        <div class="modal fade" id="viewstudentstatus" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">View Student Leaving School Record</h4>
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
                                <label class="font-weight-normal">Last Class Attendant: </label>
                                <span class="text-indigo-600">9</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Date of Leaving: </label>
                                <span class="text-indigo-600">19-02-2020</span>
                            </div>
                        </div>
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
                                <label class="font-weight-normal">Current Engagement: </label>
                                <span class="text-indigo-600">Monk</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Current Address: </label>
                                <span class="text-indigo-600">Punakha Dzong</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Deleting Student</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
					<div class="modal-body">
						<div class="bootbox-body">
							<form class="bootbox-form">
								<div class="row">
									<div class="col-12 alert alert-danger">
										<span class="">Are you sure you wish to delete the selected Student?</span>
										<input type="hidden" id="deleterecordid"/>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-default">No</button>
						<button data-bb-handler="confirm" @click="deleterecords()" type="button" class="btn btn-primary">Yes</button>
					</div>
				</div>
			</div>
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
        viewstudentstatus:function(){
            $('#viewstudentstatus').modal('show');
		},
        editstudentstatus:function(){
            $('#editstudentstatus').modal('show');
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
        $("#list-student-left").DataTable({
            "responsive": true,
            "autoWidth": false,
        }); 
        $('.dataTables_filter').addClass('fa-pull-right');
        $('#student-table_paginate').addClass('fa-pull-right');
    },
}
</script>