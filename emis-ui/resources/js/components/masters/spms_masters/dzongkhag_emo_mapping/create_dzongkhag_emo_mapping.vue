<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="classTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="dzo-emo-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Dzongkhag</th>
                                <th>Assigned to EMO</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in dzongkhagEMOs" :key="index">
                                 <td>{{ index+1}}</td>
                                <td>
                                    {{item.name}}
                                </td>
                                <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <select v-model="dzongkhagEMOs[index].staff_id" class="form-control select2">
                                            <option value="">---Select---</option>
                                            <option v-for="(item1, index1) in emdStaffs" :key="index1" :value="item1.id">
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
                <button type="submit" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            emdStaffs:[],
            dzongkhagEMOs:[],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        getEMDStaffs(){
            axios.get('loadCommons/loadFewDetailsStaffList/userworkingagency/NA')
            .then(response => {
                this.emdStaffs = response.data.data
            }).catch(e =>{
                console.log("Error"+e)
            })
        },
        async getDzongkhagEMOs(){
            let dzongkhags =  await this.loadactivedzongkhags()
            let dzongkhagEMOs = await axios.get('masters/getDzoEMO').then(response => response.data.data)
            
            dzongkhags.forEach((item,index)=>{
                dzongkhags[index].dzon_id = item.id
                dzongkhags[index].staff_id = ""
                dzongkhagEMOs.forEach(item1 => {
                    if(item.id == item1.dzon_id){
                        dzongkhags[index].staff_id = item1.staff_id
                    }
                })
            })
            this.dzongkhagEMOs = dzongkhags
        },
        save(){
             axios.post('/masters/saveDzoEMO', {data:this.dzongkhagEMOs})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-dzo-emo');
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
    mounted(){
        this.getDzongkhagEMOs()
        this.getEMDStaffs()
        this.dt = $("#dzo-emo-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
                { width: 200, targets: 1},

            ],
            drawCallback: function(dt) {
                $('.select2').select2().
                on("select2:select", e => {
                    const event = new Event("change", { bubbles: true, cancelable: true })
                    e.params.data.element.parentElement.dispatchEvent(event);
                })
                .on("select2:unselect", e => {
                const event = new Event("change", { bubbles: true, cancelable: true })
                e.params.data.element.parentElement.dispatchEvent(event)
                });
            },
        })
    },
    watch: {
        dzongkhagEMOs(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#dzo-emo-table").DataTable({
                     drawCallback: function(dt) {
                        $('.select2').select2().
                        on("select2:select", e => {
                            const event = new Event("change", { bubbles: true, cancelable: true })
                            e.params.data.element.parentElement.dispatchEvent(event);
                        })
                        .on("select2:unselect", e => {
                        const event = new Event("change", { bubbles: true, cancelable: true })
                        e.params.data.element.parentElement.dispatchEvent(event);
                        });
                    },
                })
            });
        }
    }
}
</script>
