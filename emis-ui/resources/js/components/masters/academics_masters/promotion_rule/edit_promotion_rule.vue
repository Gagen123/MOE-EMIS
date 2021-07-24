<template>
    <div>
        <form @submit.prevent="save" class="bootbox-form" id="subjectGroup">
            <div class="ml-0 row form-group">
                <div class="mr-3">
                    <strong>Class: </strong> {{ class_stream }} 
                </div>
            </div>  
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <table id="promotion-rule-edit-table" class="subject-assessment-type-table table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Promotion Rule</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                             <tr v-for="(item, index) in promotionRule" :key="index">
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            {{item.subject}} 
                                        </label>
                                        <br>
                                        <span class="ml-2" v-if="item.sub_dzo_name">{{item.sub_dzo_name}}</span>
                                    </div>
                                </td>
                                <td>
                                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <select v-model="promotionRule[index].aca_promotion_sub_group_id" class="form-control select2">
                                            <option selected :value="null">---Select---</option>
                                            <option v-for="(item1, index1) in promotion_sub_groups" :key="index1" :value="item1.id">
                                               {{item1.description}}
                                            </option>
                                        </select>
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
            errors:'',
            promotion_sub_groups:[],
            classId:'',
            streamId:'',
            class_stream:'',
            promotionRule: [],
            dt:'',
        }
    },
    methods: {
         remove_err(field_id){
            if($('#' + field_id).val()!=""){
                $('#' + field_id).removeClass('is-invalid')
            }
        },
        loadPromotionSubGroup(uri = 'masters/loadAcademicMasters/promotion_sub_group'){
            axios.get(uri)
            .then(response => {
                let data = response 
                this.promotion_sub_groups =  data.data.data;
            })
            .catch(function (error){
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        loadClassSubjectPromotionRule(){
            let uri = 'masters/loadPromotionRule/'+this.classId
            if(this.streamId !== null){
                uri += ('/'+this.streamId)
            }
            axios.get(uri)
            .then(response => {
                let datas = response.data.data
                let arrayData = []
                datas.forEach(element => {
                let renameDatas = []
                    renameDatas['aca_sub_id'] = element.aca_sub_id
                    renameDatas['aca_promotion_sub_group_id'] = element.aca_promotion_sub_group_id
                    renameDatas['sub_dzo_name'] = element.sub_dzo_name
                    renameDatas['subject'] = element.subject

                    const obj = {...renameDatas}
                    arrayData.push(obj)

                });
                this.promotionRule = arrayData
                
            })
            .catch(function (error){
                console.log('Error..... '+error)
            });
        },
        save(){
            axios.post('/masters/savePromotionRule', {class_stream:this.class_stream,org_class_id:this.classId,org_stream_id:this.streamId,data:this.promotionRule})
                 .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Details updated successfully'
                    })
                    this.$router.push('/list-promotion-rule');
                })
                .catch(function (error){
                    if(error.response.status === 422){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'All fields are required for a selected Subject.',
                        })
                    }
            });
        },
	 
    },
    mounted(){ 
        this.loadClassSubjectPromotionRule();
        this.loadPromotionSubGroup()
        this.dt =  $("#promotion-rule-edit-table").DataTable({
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
            destroy: true,
        });
    },
    created() {
        this.classId=this.$route.params.data.org_class_id;
        this.streamId=this.$route.params.data.org_stream_id;
        this.class_stream =this.$route.params.data.class_stream;
        this.id=this.$route.params.data.id;
    },
    watch: {
        promotionRule(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#promotion-rule-edit-table").DataTable({
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
                     destroy: true,
                })
            });
        }
    }
    
}
</script>
<style scoped>
.form-control-sm {
    font-size:0.9rem;
}
</style>