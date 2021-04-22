<template>
    <div>
        <table id="list-student-trainings" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>

                    <th >No.</th>
                    <th >Scout Program</th>
                    <th >Type</th>
                    <th >Under Program</th>
                    <th >Period</th>
                    <th >Place</th>
                    <th >Country</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>  
                    <td>1</td>
                    <td>Scout 1</td>
                    <td>Type 1</td>
                    <td>Program 1</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>Bhutan</td>
                    <td>
                        <i class="fa fa-search text-primary" @click="viewtrainings('1')"> View </i> |
                        <i class="fa fa-edit text-secondary"> Edit | </i>
                        <i class="fa fa-trash text-danger"> Delete </i>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Scout 2</td>
                    <td>Type 2</td>
                    <td>Program 2</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>Bhutan</td>
                    <td>
                        <i class="fa fa-search text-primary" @click="viewtrainings('1')"> View </i> |
                        <i class="fa fa-edit text-secondary"> Edit | </i>
                        <i class="fa fa-trash text-danger"> Delete </i>
                    </td>
                </tr>
                <tr>
                    <td class="">3</td>
                    <td>Scout 3</td>
                    <td>Type 3</td>
                    <td>Program 3</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>Bhutan</td>
                    <td>
                        <i class="fa fa-search text-primary" @click="viewtrainings('1')"> View </i> |
                        <i class="fa fa-edit text-secondary"> Edit | </i>
                        <i class="fa fa-trash text-danger"> Delete </i>
                    </td>
                </tr>
                <tr>
                    <td class="">4</td>
                    <td>Scout 4</td>
                    <td>Type 4</td>
                    <td>Program 4</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>Bhutan</td>
                    <td>
                        <i class="fa fa-search text-primary" @click="viewtrainings('1')"> View </i> |
                        <i class="fa fa-edit text-secondary"> Edit | </i>
                        <i class="fa fa-trash text-danger"> Delete </i>
                    </td>
                </tr>
                <tr>
                    <td class="">5</td>
                    <td>Scout 5</td>
                    <td>Type 5</td>
                    <td>Program 5</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>Bhutan</td>
                    <td>
                        <i class="fa fa-search text-primary" @click="viewtrainings('1')"> View </i> |
                        <i class="fa fa-edit text-secondary"> Edit | </i>
                        <i class="fa fa-trash text-danger"> Delete </i>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="edittrainings" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Student Trainings/Exchange Program</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
				<div class="modal-body">
					<div class="bootbox-body">
						<div class="card-body">
                            <form>
                                <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Name/Title of Trainings/Exchange Program:</label>
                                        <input type="text" class="form-control" placeholder="Trainings/Exchange Program Title">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Type:</label>
                                            <select class="form-control">
                                            <option>option 1</option>
                                            <option>option 2</option>
                                            <option>option 3</option>
                                            <option>option 4</option>
                                            <option>option 5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Under Program:</label>
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
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>From:</label>
                                        <input type="date" class="form-control" placeholder="From">
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>To:</label>
                                        <input type="date" class="form-control" placeholder="To">
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Place:</label>
                                            <input type="text" class="form-control" placeholder="Place">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Country:</label>
                                            <input type="text" class="form-control" placeholder="Country">
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
                        </div>
                        <!-- /.card-body -->
					</div>
				</div>
					<div class="modal-footer">
						<button data-bb-handler="cancel" type="button" data-dismiss="modal" class="btn btn-default">Cancel</button>
						<button data-bb-handler="confirm" @click="addrecords()" type="button" class="btn btn-primary">OK</button>
					</div>
				</div>
			</div>
		</div>
        <div class="modal fade" id="viewtrainings" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">View Student Trainings and Exchange Program</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Training/Exchange Program Title: </label>
                                <span class="text-indigo-600">Project 1</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Type: </label>
                                <span class="text-indigo-600">Type 1</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Under Program: </label>
                                <span class="text-indigo-600">Program A</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">From: </label>
                                <span class="text-indigo-600">20-Mar-2020</span>
                            </div> 
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">To: </label>
                                <span class="text-indigo-600">14-Apr-2020</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Place: </label>
                                <span class="text-indigo-600">Thimphu</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Country: </label>
                                <span class="text-indigo-600">Bhutan</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="font-weight-normal">Details: </label>
                                <span class="text-indigo-600">Initiated by BOC and undertaken by students</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
        viewtrainings: function(){
            $('#viewtrainings').modal('show');
        },
        edittrainings: function(){
            $('#edittrainings').modal('show');
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
        $("#list-student-initiatives").DataTable({
            "responsive": true,
            "autoWidth": false,
        }); 
        $('.dataTables_filter').addClass('fa-pull-right');
        $('#student-table_paginate').addClass('fa-pull-right');
    },
}
</script>