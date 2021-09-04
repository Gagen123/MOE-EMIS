<template>
    <div>
        <table id="award-list-table" class="table table-bordered text-sm table-striped">
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
            <tbody>
                <tr v-for="(item, index) in dataList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.Name}}</td>
                    <td>{{ item.student_code}}</td>
                    <td>{{ studentClassArray[item.OrgClassStreamId]}}</td>
                    <td>{{ studentSectionArray[item.SectionDetailsId]}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>      
</template>
<script>
export default {
    data(){
        return{
            org_id:'2',
            dataList:[],
            studentClassArray:{},
            studentStreamArray:{},
            studentSectionArray:{},
        }
    },
    methods:{
        /**
         * method to get stream list
         */
        getStreamList(id){
            let classId=$('#std_class').val();
            if(id!="" && classId==null){
            classId=id;
            }
            let uri = 'loadCommons/loadStreamList/'+classId;
            this.streamList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.streamList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        getSectionList(id){
            let classId=$('#std_class').val();
            if(id!="" && classId==null){
                classId=id;
            }
            let uri = 'loadCommons/loadSectionList/'+classId;
            this.sectionList =[];
            axios.get(uri)
            .then(response =>{
                let data = response;
                this.sectionList = data.data.data;
            })
            .catch(function (error){
                console.log("Error:"+error)
            });
        },
        loadClassStreamSectionList(uri="loadCommons/loadClassStreamSection/userworkingagency/org"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                this.testData = data;
                if(data!=null && data!="" && data!=undefined){
                    for(let i=0;i<data.length;i++){
                        this.studentClassArray[data[i].id] = data[i].class;
                        this.studentSectionArray[data[i].id] = data[i].section;
                        this.studentStreamArray[data[i].id] = data[i].stream;
                    }
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },
        loadDataList(uri='students/loadUnreportedStudents/'+this.org_id){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
            setTimeout(function(){
                $("#award-list-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        showedit(data){
            this.$router.push({name:'edit_reported_students',params: {data:data}});
        },
    },
    mounted(){
        this.loadClassStreamSectionList();
        this.loadDataList();
    },
}
</script>
