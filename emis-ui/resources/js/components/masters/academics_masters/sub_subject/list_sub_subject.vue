<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="subject-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th >Display Order</th>
                            <th >Subject</th>
                            <th >Sub-Subject (Paper) </th>
                            <th >Code</th>
                            <th >Status</th>
                            <th >Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in subjectList" :key="index">
                            <td class="text-right">{{ item.display_order}}</td>
                            <td>{{item.sub_name}} <span v-if="item.dzo_subject">( {{ item.dzo_subject }} )</span></td>
                            <td>{{ item.sub_subeject_name }} <br><span v-if="item.dzo_name"> {{ item.dzo_name }} </span></td>
                            <td class="text-right">{{ item.code}}</td>
                            <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div>
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
            subjectList:[],
            dt:''
        }
    },
    methods:{
        loadSubjectList(uri = 'masters/loadAcademicMasters/all_sub_subject'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.subjectList =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        showedit(data){
            this.$router.push({name:'edit_sub_subject',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadSubjectList();
        this.dt =  $("#subject-table").DataTable({
            columnDefs: [
                { width: 60, targets: 0},
            ],
        })
    },
    watch: {
        subjectList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#subject-table").DataTable()
            });
        }
    }
}
</script>
