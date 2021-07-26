<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="class_subject_assessment_area-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Term</th> 
                        <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in classSubAssmtFrequencyList" :key="index">
                            <td><strong>{{ item.class_stream }} </strong></td>
                            <td>{{ item.sub_name }}
                                <span v-if="item.sub_dzo_name">( {{ item.sub_dzo_name}} )</span>
                            </td>
                            <td>{{item.term_name}}
                                <span v-if="item.sub_dzo_name && item.term_dzo_name">( {{ item.term_dzo_name}} )</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
                                    <!-- <a href="#" @click="deleteLeaveRequest(item.id)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> -->
                                </div>
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
            classSubAssmtFrequencyList:[],
            dt:''
        }
    },
    methods:{
        async classSubAssmtFrequency(){
            try{
                let classStreams = await axios.get('masters/loadClassStreamMapping/NA').then(response => {
                    return response.data.data
                })
                let classSubAssmtFrequencies = await axios.get('masters/loadclassSubAssmtFrequency').then(response => {
                    return response.data.data
                })
                classSubAssmtFrequencies.forEach((classSubAssmtFrequency,index) => {
                    classStreams.forEach(item => {
                        if(!classSubAssmtFrequencies[index].class_stream){
                            if(classSubAssmtFrequency.org_class_id == item.classId && (classSubAssmtFrequency.org_stream_id == item.classId || classSubAssmtFrequency.org_stream_id == null)){
                                classSubAssmtFrequencies[index].org_class_id = item.classId
                                classSubAssmtFrequencies[index].org_stream_id  = item.streamId
                                classSubAssmtFrequencies[index].class_stream = item.class + ' ' + item.stream
                            }
                        }
                    })
                })
                this.classSubAssmtFrequencyList = classSubAssmtFrequencies
             }catch(e){
                if(e.toString().includes("500")){
                  $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
             }   
           },
        showedit(data){
            this.$router.push({name:'aca_subject_assessment_area',params: {data:data}});
        },
    },
    mounted(){ 
        this.classSubAssmtFrequency();
        this.dt =  $("#class_subject_assessment_area-table").DataTable({
            rowGroup: {
                    dataSrc: 0 
            },
            columnDefs: [{
                targets:  0,
                visible: false
            }],
            destroy: true,
            
         }) 
    },
    watch: {
        classSubAssmtFrequencyList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#class_subject_assessment_area-table").DataTable({
                    rowGroup: {
                    dataSrc: 0 
                    },
                    columnDefs: [{
                        targets:  0,
                        visible: false
                    }],
                      destroy: true,
                })
            });
        }
    }
}
</script>
