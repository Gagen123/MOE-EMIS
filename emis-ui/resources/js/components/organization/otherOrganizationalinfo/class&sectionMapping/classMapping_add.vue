<template>
    <div>
        <form class="bootbox-form" id="classMappingId">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>School:<span class="text-danger">*</span></label> 
                            <select name="class" id="class" class="form-control" v-model="form.school" :class="{ 'is-invalid': form.errors.has('spo_name') }"  @change="remove_err('school')">
                                <option value="">--- Please Select ---</option>
                                <option v-for="(item, index) in schoolList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                            </select>
                            <has-error :form="form" field="str_name"></has-error>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Class:<span class="text-danger">*</span></label> <br>
                            <span v-for="(item, key, index) in  classList" :key="index">
                                <input type="checkbox" v-model="form.class" :value="item.id"><label class="pr-4"> &nbsp;{{ item.class }}</label>
                            </span>
                            <has-error :form="form" field="str_name"></has-error>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            classList:[],
            schoolList:[],
            form: new form({
                id: '',school:'',class:[],
            })
        }
    },

    methods:{

        getschoolDetials(uri = 'organization/getschoolDetials'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.schoolList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#closure-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },
        formaction: function(type){
            if(type=="reset"){
                this.form.school= '';
                this.form.class= '';
            }
            if(type=="save"){
                this.form.post('/organization/saveClassMapping',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Class mapping is added successfully'
                    })
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},
        /**
         * method to get class in checkbox
         */
        getClass:function(){
            axios.get('/organization/getClass')
              .then(response => {
                  let data = response.data;
                  this.classList = data;
            });
        },
    },

    mounted(){
        this.getClass();
        this.getschoolDetials();
    }
}
</script>