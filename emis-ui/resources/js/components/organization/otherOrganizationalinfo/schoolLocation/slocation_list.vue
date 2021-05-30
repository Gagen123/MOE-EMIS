<template>
    <div>
        <h5 class="text"><u>Location Details</u></h5><br>
        <div class="row invoice-info">
            <div v-if="locationList.OrgOrganizationId === ''">
                <strong>Details have not been entered. Please enter the Location Details of the Organization</strong>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong>Ownership Details</strong>
                <address>
                    {{locationList.category  == 0 ? "Public Organization" :  "Private Owned"}}
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong><i class="fas fa-map-marker-alt mr-1"></i>Geo-Position Location</strong>
                <address>
                    Latitude: {{locationList.latitude}}<br>
                    Longitude: <br>
                    Altitude: <br>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong><i class="fas fa-building mr-1"></i>Others</strong>
                <address>
                    Compound Area: {{locationList.compundArea}}<br>
                    Entrance Gate: <br>
                    Compound Fencing: {{locationList.compoundFencing}}<br>
                        
                </address>
            </div>
        </div>
        <hr>
        <h5 class="text"><u>Connectivity Details</u></h5><br>
         <div class="row invoice-info">
            <div v-if="locationList.OrgOrganizationId === ''">
                <strong>Details have not been entered. Please enter the Location Details of the Organization</strong>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong>Road Connectivity</strong>
                <address>
                    {{locationList.category  == 0 ? "Public Organization" :  "Private Owned"}}
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong>Electricity</strong>
                <address>
                    Latitude: {{locationList.latitude}}<br>
                    Longitude: <br>
                    Altitude: <br>
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong>Internet</strong>
                <address>
                    Compound Area: {{locationList.compundArea}}<br>
                    Entrance Gate: <br>
                    Compound Fencing: {{locationList.compoundFencing}}<br>
                        
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong>Telephone Service</strong>
                <address>
                    Compound Area: {{locationList.compundArea}}<br>
                    Entrance Gate: <br>
                    Compound Fencing: {{locationList.compoundFencing}}<br>
                        
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong>Contact Info</strong>
                <address>
                    Compound Area: {{locationList.compundArea}}<br>
                    Entrance Gate: <br>
                    Compound Fencing: {{locationList.compoundFencing}}<br>
                        
                </address>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            locationList:'',
            dt:'',
        }
    },
    methods:{
        loadLocationList(uri = 'organization/getLocationDetails'){
            axios.get(uri)
            .then(response => {
                let data = response;
                this.locationList =  data.data;
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