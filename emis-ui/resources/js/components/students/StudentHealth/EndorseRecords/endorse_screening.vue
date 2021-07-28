<template>
    <div>
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Eyes Screening Record</th>
                                <th>Boys </th> 
                                <th>Girls</th>
                            </tr>
                        </thead>
                        <tbody id="table_data_populate">
                            <tr>
                                <td>Number of Students Screened</td>
                                <td><input type="number" name="number" class="form-control"/></td>
                                <td><input type="number" name="number1" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td> Number of Students Referred for evaluation and treatment </td>
                                <td><input type="number" name="number" class="form-control"/></td>
                                <td><input type="number" name="number1" class="form-control" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Dental Screening Record</th>
                                <th>Boys </th> 
                                <th>Girls</th>
                            </tr>
                        </thead>
                        <tbody id="table_data_populate">
                            <tr>
                                <td>Number of Students Screened</td>
                                <td><input type="number" name="number" class="form-control"/></td>
                                <td><input type="number" name="number1" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td> Number of Students Referred for evaluation and treatment </td>
                                <td><input type="number" name="number" class="form-control"/></td>
                                <td><input type="number" name="number1" class="form-control" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Ear Screening Record</th>
                                <th>Boys </th> 
                                <th>Girls</th>
                            </tr>
                        </thead>
                        <tbody id="table_data_populate">
                            <tr>
                                <td>Number of Students Screened</td>
                                <td><input type="number" name="number" class="form-control"/></td>
                                <td><input type="number" name="number1" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td> Number of Students Referred for evaluation and treatment </td>
                                <td><input type="number" name="number" class="form-control"/></td>
                                <td><input type="number" name="number1" class="form-control" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="transferoption-table" class="table w-100 table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>General Examination</th>
                                <th>Boys </th> 
                                <th>Girls</th>
                            </tr>
                        </thead>
                        <tbody id="table_data_populate">
                            <tr>
                                <td>Number of Students Screened</td>
                                <td><input type="number" name="number" class="form-control"/></td>
                                <td><input type="number" name="number1" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td> Number of Students Referred for evaluation and treatment </td>
                                <td><input type="number" name="number" class="form-control"/></td>
                                <td><input type="number" name="number1" class="form-control" /></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row form-group fa-pull-right">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" @click="saveScreening('save')"> <i class="fa fa-save"></i>Save </button>
                </div>
            </div>
        </div>
    </div> 
</template>
<script>

export default {
    data(){
        return{
            dataList:[],
            form: new form({
                endorsed_by:'',
                health_record_type:'Screening',
                term_id:''
            })
        }
    },
    methods: {
        loadDataList(uri='students/loadScreeningEndorsement'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#list-screening").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        /**
         * method to remove error
         */
        remove_error(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
                $('#'+field_id+'_err').html('');
            }
        },

        /**
         * method to populate dropdown
         */
        async changefunction(id){
            if(id=="organizationId"){
                this.form.organizationId=$('#organizationId').val();
                this.getorgdetials($('#organizationId').val());
            }

            if(id=="term_id"){
                this.form.term_id=$('#term_id').val();
            }
        },

        /**
         * Save Function
         */
        saveScreening: function(type){
            this.form.post('/students/saveHealthEndorsement',this.form)
            .then((response) => {  
                Toast.fire({
                    icon: 'success',
                    title: 'Data saved Successfully'
                });
            })
            .catch((error) => {  
                console.log("Error:"+error)
            });
        }, 

    },

    mounted() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });

        this.loadDataList();
    }
}
</script>
