<template>
    <div>
        <table id="furniture-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Type</th>
                    <th>Item</th>
                    <th>Usable No.</th>
                    <th>Not Usable No.</th>
                    <!-- <th>Received Date</th>
                    <th>Life Expectancy</th> -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <tr v-for="(item, index) in furnitureList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.type}}</td>
                    <td>{{ item.item}}</td>
                    <td>{{ item.usable}}</td>
                    <td>{{ item.notusable}}</td>
                    <!-- <td>{{ item.dateReceived}} </td>
                    <td>{{ item.lifeExpectancy }}</td> -->
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewFurnitureList(item)"><i class="fas fa-edit"></i ></a>
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
            furnitureList:[],
        }
    },

    methods:{

        /**
         * method ti load furniture list
         */
        loadFurnitureList(uri = 'organization/loadFurniture'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.furnitureList =  data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#tbody').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#furniture-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 300);  
        },

        /**
         * method to view furniture list
         */
        viewFurnitureList(data){
            data.action='edit';
            this.$router.push({name:'furniture_edit',params: {data:data}});
        },
    },

     mounted(){
        this.loadFurnitureList();
    },
}
</script>