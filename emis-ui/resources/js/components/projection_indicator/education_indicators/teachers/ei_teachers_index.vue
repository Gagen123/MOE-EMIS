<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pt-1 pb-1">
                Education Indicator - Teachers/Facilitators/Trainers
            </div>
            <div class="card-body" >
                <div class="form-group row mt-xl-n2">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="dzosection">
                        <label class="mb-0">Dzongkhag:</label>
                        <select class="form-control select2" id="dzongkhag_id">
                            <option value="ALL"> ALL</option>
                            <option v-for="(item, index) in dzongkhagList" :key="index" v-bind:value="item.id">{{ item.name }}</option>
                        </select>
                        <span class="text-danger" id="dzongkhag_id_err"></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <label class="mb-0">Organization Category:</label>
                        <select class="form-control select2" id="category_id">
                            <option value="ECCD"> ECCD</option>
                            <option value="Primary"> Primary School</option>
                            <option value="Middle"> Middle Secondary School</option>
                            <option value="Lower"> Lower Secondary School</option>
                            <option value="Higher"> Higher Secondary School</option>
                        </select>
                        <span class="text-danger" id="org_id_err"></span>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pt-3">
                        <button class="btn btn-primary btn-sm btn-lg mb-lg-n4" @click="loadpage()" type="button"> <span class="fa fa-download"></span> Load Details</button>
                    </div>
                </div>
                <hr>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            dzongkhagList:[],
        }
    },
    methods:{
        loadpage:function(){
            let dzo_id=$('#dzongkhag_id').val();
            let type=$('#category_id').val();
            let route='teachers_eccd';
            if(type=="PrePrimary"){
                route='teachers_pre_primary';
            }
            if(type=="Primary"){
                route='teachers_primary';
            }
            if(type=="Middle"){
                route='teachers_middle_secondary';
            }
            if(type=="Lower"){
                route='teachers_lower_secondary';
            }
            if(type=="Higher"){
                route='teachers_higher_secondary';
            }
            if(type=="Tertiary"){
                route='teachers_tertiary';
            }
            // this.$router.push({name:route,query: {dzo_id:dzo_id}});
            this.$router.push({path:route,query: {dzo_id:dzo_id}}).catch(()=>{});
        },
    },
    async mounted() {
        this.dzongkhagList= await this.loadactivedzongkhags();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });
    },

}
</script>

