<template>
    <div>
        <div class="card-body">
            <form>
                <div id="schoolsections">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Program/Club</label>
                                <select class="form-control">
                                <option>Program 1</option>
                                <option>Program 2</option>
                                <option>Club 3</option>
                                <option>Club 4</option>
                                <option>Club 5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Year of Establishment:</label>
                            <input type="text" class="form-control" placeholder="Establishment Year">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                            <label>Suppported By:</label>
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
                            <textarea class="form-control" rows="3" placeholder="Enter Remarks"></textarea>
                        </div>
                    </div>
                </div>
                <table id="dynamic-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Role</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="record1" v-for='(user, index) in users' :key="index">
                            <td>
                                <select name="title" id="title" class="form-control editable_fields" v-model="user.title">
                                    <option value="">--- Please Select ---</option>
                                    <option value="title1">Sonam Dorji (EID 1)</option>
                                    <option value="title2">Kinley (EID 2)</option>
                                </select>
                            </td>
                            <td>                                
                                <input type="text" name="remark" class="form-control" v-model="user.remark"/>
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="3"> 
                                <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                <button type="button" class="btn btn-flat btn-sm btn-danger" id="addMore" 
                                @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                            </td>
                        </tr>                                          
                    </tbody>
                </table>
            </form>
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
        addMore: function(){
                this.users.push({title:'',remark:''})
            },

            remove(index){    
                this.users.splice(index,1);             
            },

            /** method to reset forms */
            reset: function(){
                window.location.reload();
            },
            /** method to save data */
            save: function(){
                Swal.fire(
                        'Success!',
                        'Your Data has been successfully saved.',
                        'success',
                    )
                    $(".editable_fields").val("");
            },
    
    },
    
    mounted() {
        $("#add-student-programs").DataTable({
            "responsive": true,
            "autoWidth": true,
        }); 
        $('.dataTables_filter').addClass('fa-pull-right');
        $('#student-table_paginate').addClass('fa-pull-right');
    },
}
</script>