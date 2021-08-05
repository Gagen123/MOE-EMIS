<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                <table id="career_stage_table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:10%">Sl#</th>
                            <th style="width:10%">Emp Id</th>
                            <th style="width:15%">Name</th>
                            <th style="width:15%">Position Title</th>
                            <!-- <th style="width:15%">Working Agency</th> -->
                            <th style="width:15%">Is SEN</th>
                            <th style="width:15%">Is Tranined</th>
                            <th style="width:20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in substaffList" :key="index">
                            <td>{{ index+1}}</td>
                            <td>{{ item.emp_id}}</td>
                            <td>{{ item.name}}</td>
                            <td>{{ positiontitleList[item.position_title_id]}}</td>
                            <!-- <td>{{ item.working_agency}}</td> -->
                            <td>{{ item.is_sen==1 ? 'Yes' : 'No'}}</td>
                            <td>{{ item.is_trained_in_sen== 1 ? 'Yes' : 'No'}}</td>
                            <td>
                                <!-- <a href="#" v-if="showedit" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item,'view_sen')"><span class="fa fa-eye"></span> view</a> -->
                                <a href="#" v-if="showedit" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item,'edit_sen')"><span class="fa fa-edit"></span> Edit</a>
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
            showedit:false,
            substaffList:[],
            genderArray:{},
            cureerstageArray:{},
            positiontitleList:{},
            dt:'',
        }
    },
    methods: {
        loadeditpage(staff,route){
            this.$router.push({name:route,params:{data:staff}});
		},
        loadstff(type){
            axios.get('loadCommons/loadStaffList/'+type)
            .then((response) => {
                this.substaffList =  response.data.data;
             })
            .catch((error) => {
                console.log("Error."+error);
            });
        },

        loadpositionTitleList(uri = 'masters/loadStaffMasters/all_active_position_title'){
            axios.get(uri)
            .then(response =>{
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.positiontitleList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log('Error: '+error);
            });
        },
    },
    mounted(){
        this.loadpositionTitleList();
         axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.loadstff('userOrgWiseCivilServent/SEN');
            }
            if(data['acess_level']=="Dzongkhag"){
                this.loadstff('userDzoWiseCivilServent/SEN');
            }
            if(data['acess_level']=="Ministry"){
                this.showedit=true;
                this.loadstff('allCivilServent/SEN');
            }
        })
        .catch(errors => {
            console.log(errors)
        });

        this.dt =  $("#career_stage_table").DataTable()
    },
    watch: {
        substaffList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#career_stage_table").DataTable()
            });
        }
    },


}
</script>


