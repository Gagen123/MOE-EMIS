<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="foodrelease-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Date of Food Release</th>
                            <th>Dzongkhag</th>
                            <th>School Name</th>
                            <th>Quarter</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in foodrelease_list" :key="index">
                            <td> {{index + 1}}</td>
                            <td> {{item.dateOfrelease}}</td>
                            <td> {{dzongkhagList[item.dzongkhag]}}</td>
                            <td> {{orgList[item.organization]}}</td>
                            <td> {{quarterList[item.quarter]}}</td>
                            <td> {{ item.remarks}}</td>
                            <td>
                              <div class="btn-group btn-group-sm">

                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="FoodReleaseView(item)"><i class="fas fa-eye"></i ></a>
                               </div>
                               <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewFoodReleaseList(item)"><i class="fas fa-edit"></i ></a>

                               </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
      <!--  Temporary model table  -->
      <div class="modal fade" id="viewfoodreleasenote" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                     <h4 class="modal-title">Food Release Note</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                     </button>
                    </div>
                    <div class="modal-body">
                     <div class="card-body">
                            <div class="form-group row">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label class="font-weight-normal">Date of Release: </label>
                                 <span class="text-indigo-600">{{displayItem.dateOfrelease}}</span>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <label class="font-weight-normal">Dzongkhag Name: </label>
                                 <span class="text-indigo-600">{{ dzongkhagList[displayItem.dzongkhag]}}</span>
                                </div>
                           </div>
                           <div class="form-group row">
                               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <label class="font-weight-normal">School Name: </label>
                                 <span class="text-indigo-600">{{orgList[displayItem.organizaiton]}}</span>
                               </div>
                               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <label class="font-weight-normal">Quarter: </label>
                                 <span class="text-indigo-600">{{quarterList[displayItem.quarter]}}</span>
                              </div>
                          </div>
                      </div>
                    <!--   <div class="card-body"> -->
                         <table id="dynamic-table" class="table table-bordered table-striped">
                             <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr v-for="(tableitem, index) in itemrelease_list" :key="index">
                                     <td> {{index + 1}}</td>
                                     <td> {{itemList[tableitem.item]}}</td>
                                     <td> {{tableitem.quantity}}</td>
                                     <td> {{unitList[tableitem.unit]}}</td>
                                 </tr>
                             </tbody>
                          </table>
                    <!--  </div>-->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>



    </div>
</template>
<script>
export default {
    data(){
        return{
            foodrelease_list:[],
            displayItem:'',
            itemrelease_list:[],
            dzongkhagList:{},
            termList:{},
            orgList:{},
            unitList:{},
            itemList:{},
            quarterList:{},
            dt:''

        }
    },
    methods: {
        loadFoodReleaseList(uri = 'mess_manage/loadFoodReleaseList'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.foodrelease_list =  data.data;
            })
            .catch(function (error) {
               console.log(error);
            });
        },


        viewfoodreleasenote:function(item){
            this.displayItem="";
            this.displayItem=item;
           // alert(this.displayItem.foodreleaseId);
            axios.get('mess_manage/getFoodReleaseItem/' + this.displayItem.id)
            .then(response => {
                let data = response;
                this.itemrelease_list =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
            $('#viewfoodreleasenote').modal('show');
		},
        viewFoodReleaseList(data){
            data.action='edit';
            this.$router.push({name:'FoodReleaseEdit',params: {data:data}});
        },
        FoodReleaseView(data){
           data.action='view';
            this.$router.push({name:'FoodReleaseView',params: {data:data}});
        },

        loadactivedzongkhagList(uri="masters/loadGlobalMasters/all_active_dzongkhag"){
            axios.get(uri)
            .then(response => {
                let data = response;
                for(let i=0;i<data.data.data.length;i++){
                    this.dzongkhagList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        allOrgList(uri="loadCommons/loadOrgList/allorganizationList/NA"){
            axios.get(uri)
            .then(response =>{
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.orgList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },

        loadActiveQuarterList(uri="masters/loadActiveStudentMasters/quarter_name"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.quarterList[data.data.data[i].id] = data.data.data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.itemList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/program_measurement"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.data.length;i++){
                    this.unitList[data.data.data[i].id] = data.data.data[i].name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

    },
    mounted(){
        this.loadactivedzongkhagList();
        this.allOrgList();
        this.loadActiveQuarterList();
        this.loadActiveItemList();
        this.loadActiveUnitList();
        this.loadFoodReleaseList();
        this.dt =  $("#foodrelease-table").DataTable();

    },
    watch: {
        foodrelease_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#foodrelease-table").DataTable()
            });
        }
    },

}
</script>


