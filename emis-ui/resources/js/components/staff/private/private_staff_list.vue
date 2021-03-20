<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Emp Id</th>
                            <th>Name</th>
                            <th>Sex</th> 
                            <th>Position Title</th>    
                            <th>Working Agency</th>
                            <th>Type</th>    
                            <th>Action</th>                     
                        </tr>
                    </thead> 
                    <tbody>
                        
                        <tr>
                            <td> 5</td>
                            <td>20203323321</td>
                            <td>Sonam Tshomo</td>
                            <td>Female</td>
                            <td>Teacher</td>
                            <td> Mothithang HSS</td>
                            <td> Volunteer</td>
                            <td> 
                                <button type="button" class="btn btn-success btn-sm mb-0.5" @click="loadeditpage('edit_staff')"><i class="fa fa-edit"></i> Edit</button>
                            </td>
                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{ 
            totle:0,
        } 
    },
    methods: {
        loadeditpage(type){
            this.$router.push("/"+type);
		},
    },
    mounted() {
        $("#training-table").DataTable({
            "responsive": true,
            "autoWidth": true,
        }); 
    },
    
}
</script>


