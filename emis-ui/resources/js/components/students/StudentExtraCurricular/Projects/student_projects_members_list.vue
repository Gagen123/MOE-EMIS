<template>
    <div>
        <table id="list-student-initiatives" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>

                    <th >No.</th>
                    <th >Project/Initiative</th>
                    <th >Type</th>
                    <th >Under Program</th>
                    <th >Period</th>
                    <th >Place</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>  
                    <td>1</td>
                    <td>Project 1</td>
                    <td>Type 1</td>
                    <td>Program 1</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>
                        <button class="btn btn-secondary btn-xs" @click="editinitiatives('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Project 2</td>
                    <td>Type 2</td>
                    <td>Program 2</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>
                        <button class="btn btn-secondary btn-xs" @click="editinitiatives('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                </tr>
                <tr>
                    <td class="">3</td>
                    <td>Project 3</td>
                    <td>Type 3</td>
                    <td>Program 3</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>
                        <button class="btn btn-secondary btn-xs" @click="editinitiatives('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                </tr>
                <tr>
                    <td class="">4</td>
                    <td>Project 4</td>
                    <td>Type 4</td>
                    <td>Program 4</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>
                        <button class="btn btn-secondary btn-xs" @click="editinitiatives('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                </tr>
                <tr>
                    <td class="">5</td>
                    <td>Project 5</td>
                    <td>Type 5</td>
                    <td>Program 5</td>
                    <td>12-Mar-2020 to 15-Jun-2020</td>
                    <td>Thimphu</td>
                    <td>
                        <button class="btn btn-secondary btn-xs" @click="editinitiatives('1')" type="button"><i class="fa fa-edit"></i> Edit</button>
                    </td>
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
        viewinitiatives: function(){
            $('#viewinitiatives').modal('show');
        },
        editinitiatives: function(){
            $('#editinitiatives').modal('show');
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