<template>
    <div>
        <table id="subject-offered-table" class="table table-bordered table-striped table-head-fixed">
            <thead>
                <tr>
                     <th >SL#</th>
                     <th >Class</th>
                     <th >Action</th>

                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in classList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.class }} <span v-if="item.stream">{{ item.stream }}</span> <span v-if="item.section">{{ item.section }}</span> </td>
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
            classList:[],
            dt:'',
        }
    },
    methods:{
        loadAcademicMasters(){
          axios.get('loadCommons/loadClassStreamSection/userworkingagency/NA')
          .then(response => {
              this.classList = response.data
            })
            .catch((error) => {
                console.log("Error: "+error);
            });
        },
    
        showedit(data){
            this.$router.push({name:'edit_subject_offered',params: {data:data}});
        },
    },
    mounted(){
        this.loadAcademicMasters();
        this.dt =  $("#subject-offered-table").DataTable({
            distroy:true,
        })
    },
    watch: {
        classList(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#subject-offered-table").DataTable({
                    distroy:true,
                })
            });
        }
    }
}
</script>
