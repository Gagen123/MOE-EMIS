<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="classTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="school-deo-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>School</th>
                                <th>Assigned to DEO/TEO</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in schoolDEOs" :key="index">
                                 <td>{{ index+1}}</td>
                                <td>
                                    {{ item.name }}
                                </td>
                                <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <select v-model="schoolDEOs[index].staff_id" class="form-control select2">
                                            <option value="">---Select---</option>
                                            <option v-for="(item1, index1) in deos" :key="index1" :value="item1.id">
                                                <span v-if="item1.cid_work_permit">{{item1.cid_work_permit}}: </span>
                                                {{ item1.name }}, {{item1.position_title}}
                                            </option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="reset" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            schoolDEOs:[],
            deos: [],
            dzo_id:[],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        getDEOs(){
            axios.get('loadCommons/loadFewDetailsStaffList/userworkingagency/NA')
            .then(response => {
                this.deos = response.data.data
            }).catch(e =>{
                console.log("Error"+e)
            })
        },
        async getSchoolDEOs(){
          let schools = await this.schoolList(this.dzo_id);
          let schoolDEOs = await axios.get('masters/getSchoolDEO').then(response => response.data.data)

          schools.forEach((item,index) => {
              schools[index].staff_id = ""
              schools[index].school_id = item.id
              schoolDEOs.forEach(item1 => {
                  if(item.id == item1.org_id){
                      schools[index].staff_id = item1.staff_id
                  }
              })
          })
          this.schoolDEOs = schools
        },
        save(){
             axios.post('/masters/saveSchoolDEO', {data:this.schoolDEOs,dzon_id:this.dzo_id})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-school-deo');
                }).catch(function(errors){
                    if(errors.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'All the fields are required!',
                        })
                    }
                });
        },

    },
    async mounted(){
        this.dzo_id = await axios.get('common/getSessionDetail') .then(response => {return response.data.data.Dzo_Id})
        this.getSchoolDEOs();
        this.getDEOs();
        this.dt = $("#school-deo-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
            ],
            drawCallback: function(dt) {
                $('.select2').select2().
                on("select2:select", e => {
                    const event = new Event("change", { bubbles: true, cancelable: true });
                    e.params.data.element.parentElement.dispatchEvent(event);
                })
                .on("select2:unselect", e => {
                const event = new Event("change", { bubbles: true, cancelable: true });
                e.params.data.element.parentElement.dispatchEvent(event);
                });
            },
        })
    },
    watch: {
        schoolDEOs(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#school-deo-table").DataTable({
                     drawCallback: function(dt) {
                        $('.select2').select2().
                        on("select2:select", e => {
                            const event = new Event("change", { bubbles: true, cancelable: true });
                            e.params.data.element.parentElement.dispatchEvent(event);
                        })
                        .on("select2:unselect", e => {
                        const event = new Event("change", { bubbles: true, cancelable: true });
                        e.params.data.element.parentElement.dispatchEvent(event);
                        });
                    },
                })
            });
        }
    }

}
</script>
