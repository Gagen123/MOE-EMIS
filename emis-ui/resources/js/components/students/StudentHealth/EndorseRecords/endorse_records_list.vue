<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="list-deworming" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Term</th>
                            <th>Health Record Type</th>
                            <th>Status</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.term}}</td>
                            <td>{{ item.date}}</td>
                            <td>{{ item.not_given}}</td>
                            <td>
                                <div class="btn-group btn-group-sm" v-if="showmess">
                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewitemreceived(item,'view')"><i class="fas fa-eye"></i ></a>
                                </div>
                                <div class="btn-group btn-group-sm" v-if="showprincipaltask">
                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="viewitemreceived(item,'open')"><i class="fa fa-file-signature"></i > Open</a>
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
    components: {
    },
    data() {
        return {
            id:'2',
            dataList:[],
            sectionList:{},
            classList:[],
            classArray:{},
            streamList:{},
        }
    },
    methods:{
        loadDataList(uri='students/loadHealthSummary'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },
        /**
         * to load the array definitions of class, stream and section
         */
        loadClassArrayList(uri="loadCommons/getClassArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.classArray[data[i].id] = data[i].class;
                }
            })
        },
        loadSectionArrayList(uri="loadCommons/getSectionArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.sectionList[data[i].id] = data[i].section;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadStreamArrayList(uri="loadCommons/getStreamArray"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.streamList[data[i].id] = data[i].stream;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        showview(data){
            this.$router.push({name:'std_deworming_view',params: {data:data}});
        },
    },
    mounted(){
        this.loadClassArrayList();
        this.loadSectionArrayList();
        this.loadStreamArrayList();
        
        this.loadDataList();
        // axios.get('common/getSessionDetail')
        // .then(response => {
        //     let data = response.data.data;
        //     let roleName="";
        //     for(let i=0;i<data['roles'].length;i++){
        //         if(i==data['roles'].length-1){
        //             roleName+=data['roles'][i].roleName;
        //         }
        //         else{
        //             roleName+=data['roles'][i].roleName+', ';
        //         }
        //     }
        //     if(roleName.toLowerCase().includes('teacher')){
        //         this.showmess=true;
        //         this.loadFoodReleaseListing('Creater');
        //     }
        //     if(roleName.toLowerCase().includes('principal') && !roleName.toLowerCase().includes('assistant') && !roleName.toLowerCase().includes('vice')){
        //         this.showprincipaltask=true;
        //         this.loadFoodReleaseListing('OrgWise');
        //     }
        // })
        // .catch(errors =>{
        //     console.log(errors)
        // });
    },
}
</script>