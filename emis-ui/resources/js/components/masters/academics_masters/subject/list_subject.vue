<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="subject-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Display Order</th>
                            <th>Subject</th>
                            <th>Code</th>
                            <th>Subject Category</th>
                            <th>Assessed by Class Teacher</th>
                            <th>Is Stem</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in subjectList" :key="index">
                            <td class="text-right">{{ item.display_order }}</td>
                            <td>{{ item.name }} 
                                <br> 
                                <span v-if="item.dzo_name"> {{ item.dzo_name }} </span>
                            </td>
                            <td>{{ item.code }} </td>
                            <td>{{ item.sub_category_name }}</td>
                            <td>{{ item.assessed_by_class_teacher ==  1 ? "Yes" : "No" }}</td>
                            <td>{{ item.is_stem ==  1 ? "Yes" : "No" }}</td>
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
        loadsubjectgroupList(uri = 'masters/loadAcademicMasters/all_subject'){
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
            this.$router.push({name:'edit_subject',params: {data:data}});
        },
    },
    mounted(){ 
        this.loadsubjectgroupList();
        this.dt =  $("#subject-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
                { width: 50, targets: 4},
                { width: 100, targets: 5},
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
