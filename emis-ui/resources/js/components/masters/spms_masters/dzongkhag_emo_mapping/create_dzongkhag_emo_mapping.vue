<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="classTeacher">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="dzo-emo-table" class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl#</th>
                                <th>Dzongkhag</th>
                                <th>EMO</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr  v-for="(item, index) in dzongkhags" :key="index">
                                 <td>{{ index+1}}</td>
                                <td>
                                    {{item.name}}
                                </td>
                                <td>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <!-- <select v-model="classTeacherList[index].stf_staff_id" class="form-control select2">
                                            <option selected="selected" value="">---Select---</option>
                                            <option v-for="(item1, index1) in emos" :key="index1" :value="item1.stf_staff_id">
                                                <span v-if="item1.cid_work_permit">{{item1.cid_work_permit}}: </span>
                                                {{ item1.name }}, {{item1.position_title}}
                                            </option>
                                        </select> -->
                                        <!-- <has-error :form='form' field="aca_assmnt_frequency_id"></has-error> -->
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
            dzongkhags:[],
            emos:[],
            dt:''
        }
    },
    methods: {
        remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        getEMO(){
            

        },
        getDzongkhagEMO(){
            // let emo = await axios.get('academics/getDzoEMO').then(response => response.data.data);
            // this.dzongkhags.forEach((item,index)=>{

            // })

        },
        save(){
             axios.post('/academics/saveClassTeacher', {data:this.classTeacherList})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data saved successfully.'
                    })
                    this.$router.push('/create-class-teacher');
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
        this.dzongkhags = await this.loadactivedzongkhags()
        this.dt = $("#dzo-emo-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
                { width: 300, targets: 1},

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
        classTeacherList(val) {
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
