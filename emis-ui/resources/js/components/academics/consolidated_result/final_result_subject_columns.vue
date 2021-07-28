<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="final-result-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th colspan="3" class="fw-bolder" style="font-size:15px;">Personal Characteristics</th>
                            <th colspan="8" rowspan="4" class="text-center" style="font-size:20px;">
                                Royal Government of Bhutan <br>
                                Ministry of Education <br>
                                <img src="../../../../../public/img/MoE_Logo.png" alt="Logo"> <br>
                                <span style="font-size:12px;">STUDENT PROGRESS REPORT</span> <br>
                                <span style="font-size:13px;">Year: {{ new Date().getFullYear() }}</span>
                            </th>
                        </tr>
                         <tr>
                            <th colspan="3" class="fw-bolder">Outstanding : Personal characteristics are beyond expectations and targets</th>
                        </tr>
                         <tr>
                            <th colspan="3" class="fw-bolder">Good : Personal characteristics are towards the expectations</th>
                        </tr>
                         <tr>
                            <th colspan="3" class="fw-bolder">Need Improvement : Personal characteristics are below expectations</th>
                        </tr>
                        <tr>
                            <th >Sl No</th>
                            <th >Qualities</th>
                            <th >Level</th>
                              <th colspan="3" rowspan="1">
                                    <strong>Name of the School : </strong>  <span> Gyelpozhing Center School </span> <br>
                                    <strong>Gewog : </strong> <span class="mr-4"> Saling </span> 
                                    <strong>Dungkhag/Thromde :  </strong> 
                                    <span class="fw-normal"> </span> <br>        
                                    <strong>Dzongkhag :  </strong> <span> Mongar </span> <br> 
                            </th>
                        </tr>
                         <tr>
                            <th colspan="8" rowspan="3">Level</th>
                          
                        </tr> 
                    </thead>
                    <tbody id="tbody">
                        <tr class="text-center"></tr>
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
            assessmentAreaList:[],
            dt:''
        }
    },
    methods:{
   
    },
    mounted(){ 
        this.dt =  $("#final-result-table").DataTable({
            columnDefs: [
                    { width: 2, targets: 0},
                    { width: 150, targets:1},
                    { width: 40, targets:3},
                    { width: 10, targets:5},
                ],
        });
    },
    watch: {
        assessmentAreaList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#final-result-table").DataTable()
            });
        }
    }
}
</script>
 