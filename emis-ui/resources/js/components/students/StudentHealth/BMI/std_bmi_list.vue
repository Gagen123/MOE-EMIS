<template>
    <div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="bmi-list-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Sl#</th>
                            <th>Term </th>
                            <th>Class</th>
                            <th>Stream</th>
                            <th>Section</th>
                            <th>Date of Measurement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in dataList" :key="index">
                            <td>{{ index + 1 }}</td>
                            <td>{{ termListArray[item.term_id]}}</td>
                            <td>{{ classArray[item.class_id]}} </td>
                            <td v-if="item.stream_id">{{ item.stream_id}}</td>
                            <td v-else>NA</td>
                            <td>{{ sectionList[item.section_id]}} </td>
                            <td>{{ item.date}}</td>
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
            dataList:[],
            sectionList:{},
            classList:[],
            classArray:{},
            streamList:{},
            termListArray:{},
        }
    },
    methods:{
        loadDataList(uri='students/loadBmiSummary'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.dataList =  data.data.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        showedit(data){
            this.$router.push({name:'std_bmi_edit',params: {data:data}});
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
        loadActiveTermList(uri="masters/loadActiveStudentMasters/term_type"){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                 for(let i=0;i<data.length;i++){
                    this.termListArray[data[i].id] = data[i].Name;
                }
            })
            .catch(function (error) {
                console.log("Error......"+error)
            });
        },

    },
    mounted(){
        this.loadActiveTermList();
        this.loadClassArrayList();
        this.loadSectionArrayList();
        this.loadStreamArrayList();
        this.loadDataList();
    },
}
</script>


