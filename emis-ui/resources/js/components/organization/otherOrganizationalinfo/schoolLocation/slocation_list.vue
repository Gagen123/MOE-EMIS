<template>
    <div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <strong>Owner</strong>
                    <address>
                    <ul>
                        <li v-for="(item, index) in locationList" :key="index">
                            {{item.landOwnership  == 1 ? "Public" :  "Private"}}
                        </li>
                    </ul>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <strong>Location</strong>
                    <address>
                        <ul>
                            <li v-for="(item, index) in locationList" :key="index">
                                Latitude: {{item.latitude}}<br>
                                Longitude: {{item.longitude}}<br>
                                Altitude: {{item.altitude}}<br>
                            </li>
                        </ul>
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">
                    <strong>Others</strong>
                    <address>
                    <ul>
                            <li v-for="(item, index) in locationList" :key="index">
                                Compound Area: {{item.latitude}}<br>
                                Entrance Gate: {{item.longitude}}<br>
                                Fencing: {{item.altitude}}<br>
                            </li>
                        </ul>
                    </address>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            locationList:[],
            dt:'',
        }
    },
    methods:{
        loadLocationList(uri = 'organization/getLocationDetails'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.locationList =  data.data.data;
            })
            .catch(function (error) {
                if(error.toString().includes("500")){
                    $('#locationdata').html('<tr><td colspan="6" class="text-center text-danger text-bold">This server down. Please try later</td></tr>');
                }
            });
            setTimeout(function(){
                $("#location-table").DataTable({
                    "responsive": true,
                    "autoWidth": true,
                }); 
            }, 3000);  
        },
        viewLocationList(data){
            this.$router.push({name:'LocationAdd',query: {data:data}});
        },
    },
    mounted(){
        this.loadLocationList();
        this.dt =  $("#location-table").DataTable();

    },
    watch: {
        locationList(){
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#location-table").DataTable()
            });
        }
    },
}
</script>