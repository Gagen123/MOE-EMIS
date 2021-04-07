<template>
    <div>
        <table id="list-student-programs" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>

                     <th >No.</th>
                     <th >Student CID</th>
                     <th >Student Code</th>
                     <th >Student Name</th>
                     <th >Class</th>
                     <th >Program</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                     <td>1</td>
                     <td>12345678901</td>
                     <td>201.00005.11.0925</td>
                     <td>Karma Wangmo</td>
                     <td>9</td>
                     <td>Program 1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>10948753421</td>
                    <td>201.00010.11.0032</td>
                    <td>Choki Wangchuk</td>
                    <td>9</td>
                    <td>Program 1</td>
                </tr>
                <tr>
                    <td class="">3</td>
                    <td>10946740934</td>
                    <td>201.00020.13.0164</td>
                    <td>Deki Tshomo</td>
                    <td>9</td>
                    <td>Program 3</td>
                </tr>
                <tr>
                    <td class="">4</td>
                    <td>19463566974</td>
                    <td>201.00010.11.0016</td>
                    <td>Hemant Biswa </td>
                    <td>9</td>
                    <td>Program 2</td>
                </tr>
                <tr>
                    <td class="">5</td>
                    <td>12345098701</td>
                    <td>201.00017.11.0165</td>
                    <td>Karma Rigden</td>
                    <td>9</td>
                    <td>Program 1</td>
                </tr>
            </tbody>
        </table>
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
        $("#list-student-programs").DataTable({
            "responsive": true,
            "autoWidth": false,
        }); 
        $('.dataTables_filter').addClass('fa-pull-right');
        $('#student-table_paginate').addClass('fa-pull-right');
    },
}
</script>