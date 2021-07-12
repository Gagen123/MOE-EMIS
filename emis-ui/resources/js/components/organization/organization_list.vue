<template>
<div>
    <ol class="mb-1 ml-xl-n4 mr-xl-n2" style="background-color:#E5E5E5">
        <li class="form-inline "><h6 class="pt-1">List of Organization</h6></li>
    </ol>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header pt-0 mt-0 pb-0">
                    <div>
                        <table id="register-table" class="table table-bordered text-sm table-striped">
                            <thead>
                                <tr>
                                    <th>SL#</th>
                                    <th>Name</th>
                                    <th>Level</th>
                                    <th>Category</th>
                                    <th>Code</th>
                                    <th>Dzongkhag</th>
                                    <th>Status</th>
                                    <th class="pl-5 ml-5 pr-5 ml-5 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in data_list" :key="index">
                                    <td>{{ index+1}}</td>
                                    <td>{{ item.org_name }}</td>
                                    <td>{{ levelArray[item.levelId] }}</td>
                                    <td>{{ item.category }}</td>
                                    <td>{{ item.code }}</td>
                                    <td>{{ dzoArray[item.dzongkhagId] }}</td>
                                    <td>{{ item.status==  1 || item.status==  'Active' ? "Active" : "Inactive"}}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm btn-flat text-white" @click="loadeditpage(item)"> <span class="fa fa-eye"></span> View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</template>
<script>
export default {
    data(){
        return{
            dt:'',
            levelArray:{},
            dzoArray:{},
            data_list:[],
        }
    },
    methods: {
        getLevel(uri = '/organization/getLevelInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.levelArray[data[i].id] = data[i].name;
                }
            });
        },
        loaddzongkhagList(uri = 'masters/loadGlobalMasters/all_dzongkhag'){
            axios.get(uri)
            .then(response => {
                let data = response.data.data;
                for(let i=0;i<data.length;i++){
                    this.dzoArray[data[i].id] = data[i].name;
                }
            })
            .catch(function (error) {
                console.log('err: '+error);
            });
        },
        loadeditpage(item){
            this.$router.push({name:"view_organization_profile",query:{org_id:item.id}});
        },
        loadOrganizationList(type){
             axios.get('loadCommons/loadOrgList/'+type)
            .then((response) => {
                this.data_list=response.data.data;
            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
        }

    },
    mounted(){
        this.getLevel();
        this.loaddzongkhagList();
        this.dt =  $("#register-table").DataTable();
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            if(data['acess_level']=="Org"){
                this.loadOrganizationList('userworkingagency/allData');
            }
            if(data['acess_level']=="Dzongkhag"){
                this.loadOrganizationList('userdzongkhagwise/allData');
            }
            if(data['acess_level']=="Ministry"){
                this.loadOrganizationList('allorganizationList/allData');
            }
        })
        .catch(errors => {
            console.log(errors)
        });
        workingAgency

    },
    watch: {
        data_list() {
            this.dt.destroy();
            this.$nextTick(() => {
                this.dt =  $("#register-table").DataTable()
            });
        }
    },
}
</script>
