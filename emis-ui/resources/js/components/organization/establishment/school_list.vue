<template>
    <div>
        <div class="card ">
            <div class="card-body">   
                <div class="form-group row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="training-table" class="table w-100 table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>School Name</th>
                                    <th>Category</th>    
                                    <th>Level</th>    
                                    <th>Status</th> 
                                    <th width="10%"></th>
                                    <th width="10%"></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1</td>
                                    <td> Yangchenphug</td>
                                    <td> Public</td>
                                    <td> HSS</td>
                                    <td><span class="badge badge-info"> Open</span> </td>
                                    <td><button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('structureFacility')"><i class="fa fa-eye"></i> View</button></td>
                                    <td><button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('structureFacility')"><i class="fa fa-edit"></i> Edit</button></td>
                                </tr> 
                                 <tr>
                                    <td> 2</td>
                                    <td> Mothithang</td>
                                    <td> Public</td>
                                    <td> HSS</td>
                                    <td><span class="badge badge-info"> Open</span> </td>
                                    <td><button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('structureFacility')"><i class="fa fa-eye"></i> View</button></td>
                                    <td><button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('structureFacility')"><i class="fa fa-edit"></i> Edit</button></td>
                                </tr> 
                                <tr>
                                    <td> 3</td>
                                    <td> Changzamtog</td>
                                    <td> Public</td>
                                    <td>MHSS</td>
                                    <td><span class="badge badge-info"> Open</span> </td>
                                    <td><button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('structureFacility')"><i class="fa fa-eye"></i> View</button></td>
                                    <td><button type="button" class="btn btn-primary btn-flat text-white btn-xs" @click="showadprocess('structureFacility')"><i class="fa fa-edit"></i> Edit</button></td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{

        }
    },

    methods:{

    }
}
</script>