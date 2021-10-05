<template>
    <div>
        <form class="bootbox-form" id="disasterId">
            <div class="card-body">
                <table id="class-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th style=" width:15%">Sl No</th>
                            <th style=" width:35%">Class</th>
                            <th>Map to Stream</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in classList" :key="index">
                            <td>{{ item.displayOrder}}</td>
                            <td>{{ item.class}}</td>
                            <td>
                                <span v-for="(stream, index1) in  streamList" :key="index1">
                                    <input type="checkbox" :id="'stream'+(index)" v-model="form.classStream" :value="item.id+'_'+stream.id"><label class="pr-4"> &nbsp;{{ stream.stream }}</label>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>       
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger" ><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary" ><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            count:10,
            classList:[],
            streamList:[],

            form: new form({
                id: '',
                classStream:[],
                status:'1',
            })
        }
    },

    methods:{
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.className= '';
                this.form.status= 1;
            }
            // if(type=="save"){
            //     this.form.post('masters/saveClass',this.form)
            //         .then(() => {
            //         Toast.fire({
            //             icon: 'success',
            //             title: 'Class details is updated successfully'
            //         })
            //         this.$router.push('/class_list');
            //     })
            //     .catch(() => {
            //         console.log("Error......")
            //     })
            // }
            if(type=="save"){
                Swal.fire({
                    title: 'Are you sure you wish to submit this form ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    }).then((result) =>{
                    if (result.isConfirmed){
                        this.form.post('masters/saveClassStreamMapping',this.form)
                        .then((response) =>{
                            Toast.fire({
                            icon: 'success',
                            title: 'Details added successfully'
                        })
                        this.$router.push('/class_stream_list');
                        })
                        .catch((error) => {
                            Toast.fire({
                                icon: 'error',
                                title: 'Unexpected error occured. Try again.'
                            });
                            console.log("Error:"+error);
                        })
                    }
                })
            }
		},
        loadClassList(uri = 'masters/loadClass'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.classList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#class-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        loadStreamList(uri = 'masters/loadStream'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.streamList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#stream-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
    },

    mounted(){
        this.loadClassList();
        this.loadStreamList();
    },
}
</script>