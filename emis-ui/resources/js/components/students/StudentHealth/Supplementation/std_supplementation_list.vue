<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="list-deworming" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Term</th>
                            <th>Date</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Stream</th>
                            <th>Total Given</th>
                            <th>Action</th>                     
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ item.term}}</td>
                            <td>{{ item.date}}</td>
                            <td>{{ classArray[item.OrgClassStreamId]}} </td>
                            <td>{{ sectionList[item.SectionDetailsId]}} </td>
                            <td v-if="item.stream">{{ item.stream}}</td>
                            <td v-else>NA</td>
                            <td>{{ item.given}}</td>
                            <td></td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="showedit(item)"><i class="fas fa-edit"></i > Edit</a>
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
        loadDataList(uri='students/loadSupplementationRecords/'+this.id){
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
        showedit(data){
            this.$router.push({name:'student_projects_edit',params: {data:data}});
        },
    },
    mounted(){
        this.loadClassArrayList();
        this.loadSectionArrayList();
        this.loadStreamArrayList();
        
        this.loadDataList();
    },
}
</script>