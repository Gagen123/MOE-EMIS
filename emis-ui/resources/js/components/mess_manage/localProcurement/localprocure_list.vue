<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="localprocure-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Date of Procurement</th>
                            <th>Item Procured </th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr v-for="(item, index) in localprocure_list" :key="index">
                            <td> {{index + 1}}</td>
                            <td> {{reverseDate1(item.dateOfprocure)}}</td>
                            <td> {{itemList[item.item]}}</td>
                            <td> {{item.quantity}}</td>
                            <td> {{unitArray[item.unit]}} </td>
                            <td> {{item.amount}}</td>
                            <td>
                              <div v-if="showedit" class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadeditpage(item)"><i class="fas fa-edit"></i></a>
                               </div>
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
            totle:0,
            localprocure_list:[],
            itemList:{},
            unitList:[],
            unitArray:{},
            dt:'',
            showedit:false,
        }
    },
    methods: {
        loadLocalProcure(uri = 'mess_manage/loadLocalProcure'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.localprocure_list =  data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        viewLocalProcure(data){
            data.action='edit';
            this.$router.push({name:'LocalProcureEdit',params: {data:data}});
        },
        loadeditpage(data){
            data.action='edit';
            this.$router.push({name:'LocalProcureEdit',params: {data:data}});
        },
        loadActiveItemList(uri="masters/loadActiveStudentMasters/program_item_local"){
            axios.get(uri)
            .then(response => {
                let data = response;
               for(let i=0;i<data.data.length;i++){
                    this.itemList[data.data[i].id] = data.data[i].Name;
                }
               // alert(data.data.length);
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadActiveUnitList(uri="masters/loadActiveStudentMasters/CeaProgramMeasurement"){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.unitList =  data.data.data;
                for(let i=0;i<data.data.data.length;i++){
                    this.unitArray[data.data.data[i].id] = data.data.data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
    },
    mounted(){
        this.loadActiveItemList();
        this.loadActiveUnitList();
        this.loadLocalProcure();
        this.dt =  $("#localprocure-table").DataTable();
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            let roleName="";
            for(let i=0;i<data['roles'].length;i++){
                if(i==data['roles'].length-1){
                    roleName+=data['roles'][i].roleName;
                }
                else{
                    roleName+=data['roles'][i].roleName+', ';
                }
            }
            if(roleName.toLowerCase().includes('mess')){
                this.showedit=true;
            }

        })
        .catch(errors =>{
            console.log(errors)
        });

    },
     watch: {
        localprocure_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#localprocure-table").DataTable()
            });
        }
    },

}
</script>


