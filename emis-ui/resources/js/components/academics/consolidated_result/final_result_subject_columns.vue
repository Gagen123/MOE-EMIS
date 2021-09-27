<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="final-result-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="3" class="fw-bolder" style="font-size:15px;">Personal Characteristics</th>
                            <td colspan="8" rowspan="5" class="text-center" style="font-size:20px;">
                                <strong>Royal Government of Bhutan <br>
                                Ministry of Education <br></strong>
                                <img src="../../../../../public/img/MoE_Logo.png" alt="Logo"> <br>
                                <span style="font-size:12px;"><strong>STUDENT PROGRESS REPORT</strong></span> <br>
                                <span style="font-size:13px;"><strong>Year:</strong> {{ new Date().getFullYear() }}</span>
                            </td>
                        </tr>
                        <tr v-for="(item,index) in subCategNonAcademics" :key="index" >
                            <th colspan="3">{{item.name}} : {{item.description}}</th>
                        </tr>
                        <tr>
                            <th >Sl No</th>
                            <th >Qualities</th>
                            <th >Level</th>
                            <td colspan="3" rowspan="2">
                                <strong>Name of the School : </strong> {{organizations.name}} <br>
                                <strong>Gewog : </strong> <span class="mr-4"> {{organizations.gewog}} </span> 
                                <strong>Dungkhag/Thromde :  </strong> <span class="fw-normal"> {{organizations.dungkhag}}</span> <br>        
                                <strong>Dzongkhag :  </strong> <span> {{organizations.dzongkhag}} </span> <br> 
                            </td>
                        </tr>
                        <!-- <tr>
                            <th colspan="8" rowspan="3">Level</th>
                        </tr>  -->
                    </thead>
                    <tbody id="tbody">
                        <tr class="text-center"></tr>
                        <th colspan="8" rowspan="3">Level</th>
                        <!-- <tr v-for="(item, index) in assessmentAreaList" :key="index">
                            <td class="text-right">{{ item.display_order }}</td>
                            <td>{{item.sub_name}}
                                 <br>
                                <span class="text-center" v-if="item.sub_dzo_name"> {{item.sub_dzo_name}} </span>
                            </td>
                            <td>{{ item.assessment_area_name }}
                                <br>
                                <span v-if="item.area_dzo_name"> {{item.area_dzo_name}}</span>
                            </td>
                            <td>{{ item.code }}</td>
                            <td>{{item.aca_assmnt_type_name}}</td>
                            <td>{{item.rating_type_name}}</td>
                            <td>{{ item.status ==  1 ? "Active" : "Inactive" }}</td>
                            <td>
                                <div class="btn-group btn-group-sm"> -->
                                    <!-- <div class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</div> -->
                                <!-- </div> -->
                            <!-- </td>
                        </tr> -->
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
            organizations:'',
            subCategNonAcademics:[],
            org_id:'',
            dt:''
        }
    },
    methods:{
        getSubCategNonAcademic(){
            axios.get('academics/getSubCategNonAcademic').then(response => {
                this.subCategNonAcademics = response.data.data
            })
        },
        getSchoolName(){
            axios.get('loadCommons/loadOrgDetails/Orgbyid/'+this.org_id)
            .then(response => {
                this.organizations=response.data.data;
            })
            .catch(errors => {
                console.log(errors)
            });
            },
   
    },
    mounted(){ 
        this.getSubCategNonAcademic()
        this.getSchoolName()
        // this.dt =  $("#final-result-table").DataTable();
    },
    created(){
        console.log(this.$route.params.data)
        this.org_id=this.$route.params.data.org_id;
    },
    // watch: {
    //     subCategNonAcademics(val) {
    //         this.dt.destroy();
    //         this.$nextTick(() => {
    //             this.dt = $("#final-result-table").DataTable()
    //         });
    //     }
    // }
}
</script>
 