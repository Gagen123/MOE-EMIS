<template>
    <div>
        <table id="sport-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Facility</th>
                    <th>Type</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in sportList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.facility}}</td>
                    <td>{{ item.type}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewSportList(item)"><i class="fas fa-edit"></i > Edit</a>
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
        loadSportList(uri = 'organization/loadSport'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.sportList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                   
                }
            });
            setTimeout(function(){
                $("#sport-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },

        /**
         * method to view sport list
         */
        viewSportList(data){
            data.action='edit';
            this.$router.push({name:'SportEdit',params: {data:data}});
        },
    },
    mounted(){
        this.loadSportList();
    },
}
</script>