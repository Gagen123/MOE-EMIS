<template>
    <div>
        <ul class="bg-primary mb-2">
            <li class="pl-2 text-white">
                <b><h5>Meeting</h5></b>
            </li>
        </ul>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white">
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-success text-white btn-sm" @click="showadprocess('management_meeting')"><i class="fa fa-arrow-left"></i> Back</button>
                    <button type="button" class="btn btn-primary  text-white btn-sm" @click="showadprocess('open_meeting')"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" @click="create()"><i class="fa fa-plus"></i> Add New</button>
                </span>
            </div>
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <table id="m-table" class="table table-bordered text-sm table-striped">
                     <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Meeting Date</th>
                            <th>Venue</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <router-view></router-view>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        data(){
            return {
                managementbodylist:[]
            }
        },
        methods: {
            showadprocess(type){
                this.$router.push("/"+type);
            },
            create(){
                this.$router.push({name:"create_management_meeting",params:{data:this.$route.params.data}});
            }
        },
        mounted(){
            this.dt = $("#m-table").DataTable();
        },
        watch: {
            managementbodylist(val) {
                this.dt.destroy();
                this.$nextTick(() => {
                    this.dt =  $("#m-table").DataTable()
                });
            }
        }
    }
</script>
