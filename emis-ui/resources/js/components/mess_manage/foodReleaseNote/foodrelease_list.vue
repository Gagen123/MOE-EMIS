<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="foodrelease-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Date of Food Release</th>
                            <!-- <th>Dzongkhag</th>
                            <th>School Name</th> -->
                            <th>Quarter</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in foodrelease_list" :key="index">
                            <td> {{index + 1}}</td>
                            <td> {{reverseDate1(item.dateOfrelease)}}</td>
                            <!-- <td> {{dzongkhagList[item.dzongkhag]}}</td>
                            <td> {{orgList[item.organization]}}{{orgList}}</td> -->
                            <td> {{quarterList[item.quarter_id]}}</td>
                            <td> {{ item.remarks}}</td>
                            <td>
                              <div class="btn-group btn-group-sm">

                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="FoodReleaseView(item)"><i class="fas fa-eye"></i ></a>
                               </div>
                               <div v-if="access_level === 'Ministry' || access_level === 'Dzongkhag'" class="btn-group btn-group-sm">
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
                                 <span class="text-indigo-600">{{reverseDate1(displayItem.dateOfrelease)}}</span>
                                </div>
                                <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <label class="font-weight-normal">Dzongkhag Name: </label>
                                 <span class="text-indigo-600">{{ dzongkhagList[displayItem.dzongkhag]}}</span>
                                </div> -->
                           </div>
                           <div class="form-group row">
                               <!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                 <label class="font-weight-normal">School Name: </label>
                                 <span class="text-indigo-600">{{orgList[displayItem.organizaiton]}}</span>
                               </div> -->
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
            quarterList:[],
            orgList:[],
            dt:'',
            access_level:'',

        }
    },
    methods: {
        loadFoodReleaseList(id,type){
            let uri = 'mess_manage/loadFoodReleaseList/'+id+'__'+type;
            axios.get(uri)
            .then(response => {
                let data = response;
                this.foodrelease_list =  data.data;
            })
            .catch(function (error) {
               console.log(error);
            });
        },
        

        // viewfoodreleasenote:function(item){
        //     this.displayItem="";
        //     this.displayItem=item;
        //    // alert(this.displayItem.foodreleaseId);
        //     axios.get('mess_manage/getFoodReleaseItem/' + this.displayItem.id)
        //     .then(response => {
        //         let data = response;
        //         this.itemrelease_list =  data.data;
        //     })
        //     .catch(function (error) {
        //         console.log(error);
        //     });
        //     $('#viewfoodreleasenote').modal('show');
		// },
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

        loadActiveQuarterList(uri="masters/loadActiveStudentMasters/CeaQuarterType"){
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
        loadActiveItemList(uri="masters/loadActiveStudentMasters/CeaProgramItem"){
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
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/CeaProgramMeasurement"){
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
        allOrgList(dzo_id,org_id){
            if(dzo_id==""){
                dzo_id=$('#dzongkhag').val();
            }
            let uri = 'loadCommons/loadOrgList/dzongkhagwise/'+dzo_id;
            this.orgList = [];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.orgList = data.data.data;
                setTimeout(function () {
                     $('#organizaiton').val(org_id).trigger('change');
                }, 300);

            })

            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        changefunction(id){
            if($('#'+id).val()!=""){
                $('#'+id).removeClass('is-invalid select2');
                $('#'+id+'_err').html('');
                $('#'+id).addClass('select2');
            }
            if(id=="dzongkhag"){
              // alert($('#dzongkhag').val());
                this.form.dzongkhag=$('#dzongkhag').val();
                this.allOrgList($('#dzongkhag').val(),'');
            }
            if(id=="quarter"){
                this.form.quarter=$('#quarter').val();
            }
            if(id=="organizaiton"){
                this.form.organizaiton=$('#organizaiton').val();
            }

        },

    },
    mounted(){
        this.loadactivedzongkhagList();
        this.allOrgList();
        this.loadActiveQuarterList();
        this.loadActiveItemList();
        this.loadActiveUnitList();
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.loadFoodReleaseList(data['Agency_Code'],'Org');
            }
            if(data['acess_level']=="Dzongkhag"){
                this.loadFoodReleaseList(data['Dzo_Id'],'Dzongkhag');
            }
            if(data['acess_level']=="Ministry"){
                this.loadFoodReleaseList('NA','All');
            }
            this.form.org_id=data['Agency_Code'];
            this.access_level = data['acess_level']; 
        })
        .catch(errors =>{
            console.log(errors)
        });

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


