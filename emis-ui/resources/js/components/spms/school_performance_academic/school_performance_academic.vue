<template>
    <div>
        <div class="form-group row mt-2">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12 mt-2">
                <label>Year:</label> 
                <select class="form-control select2" id="year" v-model="year" @change="getacademicSchoolPerformace();">
                        <option :value="year+1">{{year+1}}</option>
                        <option :value="year">{{year}}</option>
                        <option :value="year-1">{{year-1}}</option>
                        <option :value="year-2">{{year-2}}</option>
                        <option :value="year-3">{{year-3}}</option>
                        <option :value="year-4">{{year-4}}</option>
                        <option :value="year-5">{{year-5}}</option>
                </select> 
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="academic-school-performace-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Class </th>
                            <th>Academic Performance Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item,index) in academicSchoolPerformace" :key="index">
                            <td>{{item.name}}</td>
                            <td>
                                <span v-if="item.status == 2">Finalized</span>
                                <span v-else-if="item.status == 1">Processed but not finalized</span>
                                <span v-else>Not Processed</span>
                            </td>
                             <td>
                                <span v-if="item.status == 2">`</span>
                                 <span v-else-if="item.status == 1">
                                      <button type="button" class="btn btn-flat bg-primary btn-sm"  @click="processAcademicSchoolPerformace(item.org_class_id,item.previous_org_class_id)"><i class="fas fa-retweet"></i> Re-process</button>
                                        <button type="button" class="btn btn-flat bg-primary btn-sm"  @click="finalizeAcademicSchoolPerformace()"><i class="fa fa-check"></i> Finalize</button>
                                 </span>
                                <button  v-else type="button" class="btn btn-flat bg-primary btn-sm"  @click="processAcademicSchoolPerformace(item.org_class_id,item.previous_org_class_id)"><i class="fas fa-redo-alt"></i> Process</button>
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
            academicSchoolPerformace:[],
            year:new Date().getFullYear(),
            dt:'',
        }
    },
    methods:{
        processAcademicSchoolPerformace(org_class_id,previous_org_class_id){
            Swal.fire({
                title: 'Are you sure you want to process?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                    axios.post("spms/processAcademicSchoolPerformace",{year:this.year,org_class_id:org_class_id,previous_org_class_id:org_class_id})
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Processed successfully.'
                                })
                                //  window.location.reload();
                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
                })
        },
        finalizeAcademicSchoolPerformace(){
            const finalize_status = 1
            Swal.fire({
                title: 'You cannot edit the result after finalizing. Are you sure you want to finalize?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                }).then((result) => {
                    if(result.isConfirmed) {
                    axios.post("spms/finalizeAcademicSchoolPerformace",finalize_status)
                            .then(() => {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Finalized successfully.'
                                })
                                // window.location.reload();
                            })
                            .catch(function(error){
                            this.errors = error;
                        });
                    }
                })
        },
        getacademicSchoolPerformace(){
            axios.get("spms/getacademicSchoolPerformace/"+this.year)
            .then(response => {
                this.academicSchoolPerformace = response.data.data
            })
        }
    },
    mounted(){
        this.getacademicSchoolPerformace()
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
    watch: {
        academicSchoolPerformace(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#academic-school-performace-table").DataTable();
            })
        }
    },
}
</script>