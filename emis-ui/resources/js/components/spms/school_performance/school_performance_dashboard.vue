<template>
       <div>
        <div class="form-group row">
            <div class="col-lg-3 col-md-2 col-sm-2 col-xs-12 mt-2">
                <label>Year:</label> 
                <select class="form-control select2" id="year" v-model="year" @change="getschoolPerformaceDashboard();">
                        <option :value="year+1">{{year+1}}</option>
                        <option :value="year">{{year}}</option>
                        <option :value="year-1">{{year-1}}</option>
                        <option :value="year-2">{{year-2}}</option>
                        <option :value="year-3">{{year-3}}</option>
                        <option :value="year-4">{{year-4}}</option>
                        <option :value="year-5">{{year-5}}</option>
                </select> 
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table id="evaluation-dashbord-table" class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>SL No.</th>
                            <th>Dzongkhag/Thromde</th>
                            <th>Not Assessed</th>
                            <th>Under Process</th>
                            <th>Completed</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr v-for="(item, index) in summaries" :key="index" @click.prevent="showedit(item)">
                            <td class="text-right">{{ index + 1}}</td>
                            <td>{{ item.dzongkhag}}</td>
                            <td class="text-right">
                                {{ item.not_assessed}}
                                <router-link v-if="(item.not_assessed > 0) && can_add_edit_performace==true" :to="{name:'list_school_performance',params: {data:item,status:0}}" class="badge badge-primary">
                                    Add Assessment
                                </router-link>
                            </td>
                            <td class="text-right">
                                {{ item.under_process}}
                                <span v-if="(item.under_process > 0) && can_add_edit_performace==true" class="ml-2">
                                    <router-link class="badge badge-primary" :to="{name:'list_school_performance',params: {data:item,status:1}}">
                                        Edit Assessment
                                    </router-link>
                                </span>
                            </td>
                            <td class="text-right">
                                {{ item.completed}}
                                <span  v-if="(item.completed > 0)" class="ml-2">
                                    <router-link class="badge badge-primary" :to="{name:'list_school_performance',params: {data:item,status:2}}">
                                        View Assessment
                                    </router-link>
                                </span>
                            </td>
                            <td class="text-right">{{ (isNaN(item.not_assessed) ? 0 : item.not_assessed) + (isNaN(item.under_process) ? 0 : item.under_process) + (isNaN(item.completed) ? 0 : item.completed) }}</td>

                            <!-- <td class="text-right pr-4"> 
                                <router-link :to="{name:'list_school_performance',params: {data:item}}">
                                     {{item.no_of_schools}}
                                </router-link>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</template>
<script>
export default {
    data(){
        return {
            year:new Date().getFullYear(),
            summaries:[],
            can_add_edit_performace:false,
            dt:'',
        }
    },
    methods:{
        getschoolPerformaceDashboard(){
            axios.get('spms/schoolPerformaceDashboard/'+this.year)
                .then(response => {
                    let data = response.data.performances
                    this.can_add_edit_performace = response.data.can_add_edit_performance
                    this.summaries = data
                })
        },
        showedit(data){
            this.$router.push({name:'list_school_performance',params: {data:data}})
        },
       
    },
    mounted(){
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').select2().
        on("select2:select", e => {
            const event = new Event("change", { bubbles: true, cancelable: true })
            e.params.data.element.parentElement.dispatchEvent(event)
        })
        .on("select2:unselect", e => {
        const event = new Event("change", { bubbles: true, cancelable: true })
        e.params.data.element.parentElement.dispatchEvent(event)
        });
        this.getschoolPerformaceDashboard()
        this.dt = $("#evaluation-dashbord-table").DataTable({
            columnDefs: [
                { width: 50, targets: 0},
            ],
        })
        
    },
    watch: {
        summaries(val) {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt = $("#evaluation-dashbord-table").DataTable({
                     columnDefs: [
                        { width: 50, targets: 0},
                    ],
                })
            });
        }
    }
}
</script>