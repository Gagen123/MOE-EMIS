<template>
    <div>
        <table id="sport-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Facility</th>
                    <th>Supported By</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in sportList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.facilityName}}</td>
                    <td>{{ item.SupportedBy}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewEccdList(item)"><i class="fas fa-edit"></i > Edit</a>
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
            sportList:[],
        }
    },

    methods:{
        /**
         * method to load sport facility
         */
        viewEccdList(uri = 'organization/loadeccd/null'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sportList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                   
                }
            });
        },

        /**
         * method to view sport list
         */
        viewSportList(data){
            data.action='edit';
            this.$router.push({name:'EccdEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadEccdList();
    },
}
</script>