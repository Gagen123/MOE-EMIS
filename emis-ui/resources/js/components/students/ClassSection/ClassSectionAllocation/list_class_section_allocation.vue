<template>
    <div>
        <section class="content">
            <div class="card card-primary card-outline">
                <div class="card-header pt-0 mt-0 pb-0"> 
                    <div>
                        <table id="classsection-list-table" class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th >SL#</th>
                                    <th >Student Name</th>
                                    <th >Student Code</th>
                                    <th >Class</th>
                                    <th >Section</th>
                                    <th >Action</th> 
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr v-for="(item, index) in dataList" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.Name}}</td>
                                    <td>{{ item.student_code}}</td>
                                    <td>{{ studentClassArray[item.OrgClassStreamId] }}</td>
                                    <td>{{ studentSectionArray[item.OrgClassStreamId] }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-eye"></i > View</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>  
    </div>     
</template>
<script>
export default {
    data(){
        return{
            org_id:'2',
            dataList:[],
            testData:[],
            sectionList:{},
            classList:[],
            studentClassArray:{},
            studentStreamArray:{},
            studentSectionArray:{},
            streamList:{},
            classSectionStreamList:{}
        }
    },
    methods:{
        loadDataList(uri='students/loadBasicStudentList/'+this.org_id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#classsection-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
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
        loadClassStreamSectionList(uri="loadCommons/loadClassStreamSection/userworkingagency/org"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.testData = data;
                for(let i=0;i<data.length;i++){
                    this.studentClassArray[data[i].id] = data[i].class;
                    this.studentSectionArray[data[i].id] = data[i].section;
                    this.studentStreamArray[data[i].id] = data[i].stream;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

        showedit(data){
            this.$router.push({name:'student_profile',params: {data:data}});
        },
    },
    mounted(){
        this.loadClassArrayList();
        this.loadSectionArrayList();
        this.loadStreamArrayList();
        this.loadClassStreamSectionList();
        
        this.loadDataList();
    },
}
</script>
