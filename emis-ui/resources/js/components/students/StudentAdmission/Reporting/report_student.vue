<template>
    <div>
        <form>
            <table id="list-student-reported" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Click (if reported)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 1</td>
                        <td> Kuenga Wangchuk</td>
                        <td> 17888888</td>
                        <td> PP</td>
                        <td> A</td>
                        <td> <input type="checkbox" id="reported1" name="reported1"></td>
                    </tr> 
                    <tr>
                        <td> 2</td>
                        <td>Phuntsho Chogyel</td>
                        <td> 17888888</td>
                        <td> PP</td>
                        <td> A</td>
                        <td> <input type="checkbox" id="reported2" name="reported2"></td>
                    </tr> 
                    <tr>
                        <td> 3</td>
                        <td> Sonam Zangmo</td>
                        <td> 17888888</td>
                        <td> PP</td>
                        <td> A</td>
                        <td> <input type="checkbox" id="reported3" name="reported3"></td>
                    </tr> 
                    <tr>
                        <td> 4</td>
                        <td> Phuntsho Wangmo</td>
                        <td> 17888888</td>
                        <td> PP</td>
                        <td> A</td>
                        <td> <input type="checkbox" id="reported4" name="reported4"></td>
                    </tr> 
                    <tr>
                        <td> 5</td>
                        <td> Karma Sonam</td>
                        <td> 17888888</td>
                        <td> PP</td>
                        <td> A</td>
                        <td> <input type="checkbox" id="reported5" name="reported5"></td>
                    </tr> 
                </tbody>
            </table>
        </form>
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
        $("#list-student-reported").DataTable({
            "responsive": true,
            "autoWidth": true,
        }); 
        $('.dataTables_filter').addClass('fa-pull-right');
        $('#student-table_paginate').addClass('fa-pull-right');
    },
}
</script>