<template>
    <div>
        <table id="student-table" class="table table-bordered table-striped table-head-fixed">
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
                     <td>Inschool</td>
                     <td>
                         <button class="btn btn-primary btn-xs" @click="showadprocess('studentprofile')" type="button"><i class="fa fa-search"></i> View</button>
                         <button class="btn btn-secondary btn-xs" @click="showadprocess('editstudent')" type="button"><i class="fa fa-edit"></i> Edit</button>
                         <button class="btn btn-danger btn-xs" @click="showdelete('1')" type="button"><i class="fa fa-trash"></i> Delete</button>
                     </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>10948753421</td>
                    <td>201.00010.11.0032</td>
                    <td>Choki Wangchuk</td>
                    <td>Bumthang</td>
                    <td >Jakar HSS</td>
                    <td>Inschool</td>
                    <td>
                         <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-search"></i> View</button>
                         <button class="btn btn-secondary btn-xs" type="button"><i class="fa fa-edit"></i> Edit</button>
                         <button class="btn btn-danger btn-xs" @click="showdelete('1')" type="button"><i class="fa fa-trash"></i> Delete</button>
                     </td>
                </tr>
                <tr>
                    <td class="">3</td>
                    <td>10946740934</td>
                    <td>201.00020.13.0164</td>
                    <td>Deki Tshomo</td>
                    <td>Bumthang</td>
                    <td >Jakar HSS</td>
                    <td>Inschool</td>
                    <td>
                         <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-search"></i> View</button>
                         <button class="btn btn-secondary btn-xs" type="button"><i class="fa fa-edit"></i> Edit</button>
                         <button class="btn btn-danger btn-xs" @click="showdelete('1')" type="button"><i class="fa fa-trash"></i> Delete</button>
                     </td>
                </tr>
                <tr>
                    <td class="">4</td>
                    <td>19463566974</td>
                    <td>201.00010.11.0016</td>
                    <td>Hemant Biswa </td>
                    <td>Bumthang</td>
                    <td >Jakar HSS</td>
                    <td>Inschool</td>
                    <td>
                         <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-search"></i> View</button>
                         <button class="btn btn-secondary btn-xs" type="button"><i class="fa fa-edit"></i> Edit</button>
                         <button class="btn btn-danger btn-xs" @click="showdelete('1')" type="button"><i class="fa fa-trash"></i> Delete</button>
                     </td>
                </tr>
                <tr>
                    <td class="">5</td>
                    <td>12345098701</td>
                    <td>201.00017.11.0165</td>
                    <td>Karma Rigden</td>
                    <td>Bumthang</td>
                    <td >Jakar HSS</td>
                    <td>Inschool</td>
                    <td>
                         <button class="btn btn-primary btn-xs" @click="showadprocess('edit_training')" type="button"><i class="fa fa-search"></i> View</button>
                         <button class="btn btn-secondary btn-xs" @click="showadprocess('edit_training')" type="button"><i class="fa fa-edit"></i> Edit</button>
                         <button class="btn btn-danger btn-xs" @click="showdelete('1')" type="button"><i class="fa fa-trash"></i> Delete</button>
                     </td>
                </tr>

            </tbody>
        </table>
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
        $("#student-table").DataTable({
            "responsive": true,
            "autoWidth": true,
        }); 
        $('.dataTables_filter').addClass('fa-pull-right');
        $('#student-table_paginate').addClass('fa-pull-right');
    },
}
</script>