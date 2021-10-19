<template>
    <div>
        <table id="sectiont-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Class</th>
                    <th>Stream</th>
                    <th>Section</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in data_list" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.class}}</td>
                    <td>{{ item.stream}}</td>
                    <td>{{ item.section}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewEquipmentList(item)"><i class="fas fa-edit"></i > Edit</a>
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
            data_list:[],
        }
    },
    methods:{

        /**
         * method ti load equipment list
         */
        loadEquipmentList(uri = 'organization/loadEquipment/null'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.data_list =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
        },

        /**
         * method to view equipment list
         */
        viewEquipmentList(data){
            data.action='edit';
            this.$router.push({name:'EquipmentEdit',params: {data:data}});
        },
    },

    mounted(){
        this.loadEquipmentList();
        this.dt =  $("#sectiont-table").DataTable()
    },
    watch: {
        data_list(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#sectiont-table").DataTable()
            });
        }
    },
}
</script>