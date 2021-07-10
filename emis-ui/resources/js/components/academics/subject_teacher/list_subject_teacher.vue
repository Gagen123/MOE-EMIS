<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="subject-teacher-list-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Class</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr  v-for="(item, index) in class_list" :key="index">
                                <td>{{ index+1}}</td>
                            <td>{{ item.class_stream_section }} </td> 
                            <td>
                               <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
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
    data() {
        return {
            class_list:[],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        getClasses(){
           axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA')
           .then((response) => {
            let classStreamSectionArray = []
            let classes = response.data
            classes.forEach(item => {
                let CombineClassStreamSection =[]
                if(item.stream && item.section){
                    CombineClassStreamSection['class_stream_section'] = item.class+' '+item.stream+' '+item.section
                }else if(item.stream){
                    CombineClassStreamSection['class_stream_section'] = item.class+' '+item.stream
                } else if(item.section){
                    CombineClassStreamSection['class_stream_section'] = item.class+' '+item.section
                }else{
                    CombineClassStreamSection['class_stream_section'] = item.class
                }
                CombineClassStreamSection["org_class_id"] = item.org_class_id;
                CombineClassStreamSection["org_stream_id"] = item.org_stream_id;
                CombineClassStreamSection["org_section_id"] = item.org_section_id;
                CombineClassStreamSection["org_id"] = item.org_id;
                const object = {...CombineClassStreamSection}
                classStreamSectionArray.push(object)
            });
            this.class_list = classStreamSectionArray
           })
           .catch(function(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             })                         
        },
        showedit(data){
            this.$router.push({name:'create_subject_teacher',params: {data:data}});
        },
	 
    },
    mounted(){ 
        this.getClasses();
        this.dt = $("#subject-teacher-list-table").DataTable({
            columnDefs: [
                { width: 2, targets: 0},
                { width: 200, targets: [1,2]},
            ],
        })

        
    },
    watch: {
        class_list(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#subject-teacher-list-table").DataTable()
            });
        }
    }
    
}
</script>


