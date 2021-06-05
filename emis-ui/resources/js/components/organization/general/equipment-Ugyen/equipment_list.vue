<template>
    <div>
        <table id="equipment-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Type</th>
                    <th>Item</th>
                    <th>Location/Use</th>
                    <th>Number</th>
                    <!-- <th>Created Date</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in equipmentList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.type}}</td>
                    <td>{{ item.item}}</td>
                    <td>{{ item.location}}</td>
                    <td>{{ item.number}}</td>
                    <!-- <td>{{ item.Created_At }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewEquipmentList(item)"><i class="fas fa-edit"></i ></a>
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
            equipmentList:[],
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
                this.equipmentList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#equipment-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
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
    },
}
</script>