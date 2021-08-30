<template>
    <div>
        <div class="form-group row mt-2">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12 mt-2">
                <label>Year:</label> 
                <select class="form-control select2" id="year" v-model="year">
                    <option :value="year">{{year}}</option>
                </select> 
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="evaluation-list-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Class </th>
                            <th>Academic Performance Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr>
                            <td>Class VI</td>
                            <td>Finalized</td>
                             <td></td>
                        </tr>
                        <tr>
                            <td>Class X</td>
                            <td>Processed, Not Finalize </td>
                             <td>
                                <button type="button" class="btn btn-flat bg-primary btn-sm"  @click="loadpage()"><i class="fas fa-retweet"></i> Re-process</button>
                                <button type="button" class="btn btn-flat bg-primary btn-sm"  @click="loadpage()"><i class="fa fa-check"></i> Finalize</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Class XII</td>
                            <td>Not Processed</td>
                             <td>
                                <button type="button" class="btn btn-flat bg-primary btn-sm"  @click="loadpage()"><i class="fas fa-redo-alt"></i> Process</button>
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
        return {
            year:new Date().getFullYear(),
            dt:''
        }
    },
    methods:{
        loadpage(){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Academic result for the class does not exist!',
            })
        }
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true })
            e.params.data.element.parentElement.dispatchEvent(event)
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true })
        e.params.data.element.parentElement.dispatchEvent(event)
        });
        this.dt = $("#evaluation-list-table").DataTable()
    },
    // watch: {
    //     schoolLists(val) {
    //         this.dt.destroy();
    //         this.$nextTick(() => {
    //             this.dt = $("#evaluation-list-table").DataTable();
    //         })
    //     }
    // },
}
</script>