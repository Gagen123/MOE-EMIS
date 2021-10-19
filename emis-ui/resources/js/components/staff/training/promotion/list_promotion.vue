<template>
    <div>
        <search />
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 overflow-auto">
                <table id="promotion-table" class="table table-bordered text-sm table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Dzongkhag</th>
                            <th>Organization</th>
                            <th>Name</th>
                            <th>Promotion Type</th>
                            <th>Superstructure</th>
                            <th>Position Title</th>
                            <th>Position Level</th>
                            <th>Effective Date</th>
                            <th>Joining Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(promotion, index) in staffList" :key="index">
                            <td>{{ index + 1 }} </td>
                            <td>{{ promotion.dzongkhag }}</td>
                            <td>{{ promotion.working_agency }}</td>
                            <td>{{ promotion.staff_name }}</td>
                            <td>{{ promotion.PromotionTypeID }}</td>
                            <td>{{ promotion.superstructure }}</td>
                            <td>{{ promotion.position_title_name }}</td>
                            <td>{{ promotion.positionlevel }}</td>
                            <td>{{ promotion.EffectiveDate }}</td>
                            <td>{{ promotion.JoiningOrderDate }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm btn-flat text-white" @click="loadviewpage(promotion)">Veiw</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import search from "../../searchpage.vue";
export default {
    components: {
        search,
    },
    data() {
        return {
            staffList:[],
            dt:'',
        }
    },

    methods: {
        loadviewpage(data){
            this.$router.push({name:'view_promotion',query: {data:data}});
        },
        async loadRespectiveDataData(org_id){
            this.staffList = [];
            let uri='/staff/zest/loadPromotion/byOrdId__'+org_id;
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.staffList = data.data;
            });
        },
    },
    mounted(){
        Fire.$on('loadRespectiveDataData',(id)=>{
            this.loadRespectiveDataData(id);
        });
        let uri='/staff/zest/loadPromotion/Limit__20';
        axios.get(uri)
        .then(response => {
            let data = response.data;
            this.staffList = data.data;
        });
        this.dt =  $("#promotion-table").DataTable()
    },
    watch: {
        staffList(){
            this.applydatatable('promotion-table');
        }
    },
}
</script>
