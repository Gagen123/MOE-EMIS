<template>
    <div>
        <form class="bootbox-form" id="subjectTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="list-remedial-class-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Time Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in remedialClasses" :key="index">
                                <td> {{ item.class_stream_section}}</td>
                                <td> {{ item.subject}}</td>
                                <td>{{item.techer_name}} [{{item.emp_id}}]</td>
                                <td> {{ item.from_date}}</td>
                                <td> {{ item.to_date}}</td>
                                <td> {{ item.time}}</td>
                                <td>
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                </td>                                                                               
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>     
</template>
<script>
export default {
    data() {
        return {
            remedialClasses: [],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        async getRemedialClass(){
             try{
                let classSections = await axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA').then(response => response.data)
                let remedialClasses = await axios.get('academics/getRemedialClass').then(response => response.data.data)
                let teachers = await axios.get('loadCommons/loadFewDetailsStaffList/userworkingagency/NA').then(response => response.data.data);
               
                remedialClasses.forEach((item,index) => {
                    classSections.forEach(item1 => {
                        teachers.forEach(item3 => {
                            if((item.org_class_id == item1.org_class_id && 
                                (item.org_stream_id == item1.org_stream_id 
                                || (item.org_stream_id == null && item1.org_stream_id == null) 
                                || (item.org_stream_id == "" && item1.org_stream_id == "")) 
                                && (item.org_section_id == item1.org_section_id 
                                || (item.org_section_id == null && item1.org_section_id == null) 
                                || (item.org_section_id == "" && item1.org_section_id == "")) && item.stf_staff_id == item3.id)){
                                    remedialClasses[index]['OrgClassStreamId'] =  item1.OrgClassStreamId 
                                        if(item1.stream && item1.section){
                                            remedialClasses[index]['class_stream_section'] = item1.class+' '+item1.stream+' '+item1.section
                                        }else if(item1.stream){
                                            remedialClasses[index]['class_stream_section'] = item1.class+' '+item1.stream
                                        }else if(item1.section){
                                            remedialClasses[index]['class_stream_section'] = item1.class+' '+item1.section
                                        }
                                        else{
                                            remedialClasses[index]['class_stream_section'] = item.class
                                        }
                                    remedialClasses[index]['techer_name'] = item3.name
                                    remedialClasses[index]['emp_id'] = item3.emp_id

                            }
                        })
                    })
                });
                this.remedialClasses = remedialClasses
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             } 

        },
        showedit(data){
            this.$router.push({name:'edit_remedial_class',params: {data:data}});
        },
	 
    },
    mounted(){ 
        this.getRemedialClass();
        this.dt = $("#list-remedial-class-table").DataTable({
               columnDefs: [
                { width: 2, targets: 0},
            ],
        })
    },
    watch: {
        remedialClasses(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#list-remedial-class-table").DataTable()
            });
        }
    }
    
}
</script>