<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="training-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Term</th>
                            <th>Date</th>
                            <th>Total Issued (Boys)</th>
                             <th>Total Issued (Girls)</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 1</td>
                            <td>Term I</td>
                            <td>2020-03-04</td>
                            <td>236</td>
                            <td>456</td>
                            <td> 
                                <button type="button" class="btn btn-success btn-sm mb-0.5" @click="loadeditpage('edit_stddeworm')"><i class="fa fa-edit"></i> Edit</button> 
                            </td>
                        </tr> 
                            <tr>
                            <td> 2</td>
                            <td>Term 2</td>
                            <td>2020-05-25</td>
                            <td>456</td>
                            <td>560</td>
                            <td> 
                                <button type="button" class="btn btn-success btn-sm mb-0.5" @click="loadeditpage('edit_stdhealth')"> <i class="fa fa-edit"></i> Edit</button>
                            </td>
                        </tr> 
                        <tr>
                            <td>3</td>
                            <td>Term 3</td>
                            <td>2020-08-13</td>
                            <td>456</td>
                            <td>478</td>
                            <td> 
                                <button type="button" class="btn btn-success btn-sm mb-0.5" @click="loadeditpage('edit_stdhealth')"><i class="fa fa-edit"></i> Edit</button>
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


