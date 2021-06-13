<template>
<div>
   <div class="card-body">
        <table id="instructor-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Dzongkhag/Thromde</th>
                    <th>School Name</th>
                    <th>Application Date</th>
                    <th>Status</th>
                    <th>Student Decission</th>
                    <th>School decission</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item, index) in applicationList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ dzongkhag.name }}</td>
                    <td>{{ school.name }}</td>
                    <td>{{ item.dateOfapply }}</td>
                    <td><span class="badge badge-success">{{ item.Status}}</span></td>
                    <td v-if="item.Student_Decision==null">
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="StudentDecission(item.id,'Accepted')"> Accept</a>
                        </div>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-danger" @click="StudentDecission(item.id,'Cancelled')">Cancel</a>
                        </div>
                    </td>
                    <td v-else>
                        {{ item.Student_Decision}}
                    </td>
                    <td>
                        <div class="btn-group btn-group-lg">
                            <td>{{ item.School_Decision=='Accepted'? "Accepted":'Under Process'}}</td>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                applicationList:[],
                std_decission:new form({
                    id:'',
                    type:'',
                }),
                dzongkhag:new form({
                    name:'',
                }),
                school:new form({
                    name:'',
                }),
            }
        },
        methods:{
            loadApplication(cid){
                 axios.get('TrackApplicationController/applicationListsbyCid/' +cid)
                    .then(response => {
                    let data = response;
                    this.applicationList = data.data.data;
                    this.getdzoName(data.data.data[0].dzongkhag)
                    this.geschoolName(data.data.data[0].OrgOrganizationId)
                });

            },
            getdzoName(dzo_id){
                 axios.get('load_dzongkhag_details_by_id/' +dzo_id)
                 .then(response => {
                    let data = response;
                    this.dzongkhag=data.data.data;
                 });
            },
           geschoolName(org_id){
                 axios.get('loadOrganizationDetailsbyOrgId/' +org_id)
                 .then(response => {
                    let data = response;
                    this.school=data.data.data;
                 });
            },
            StudentDecission(id, actionType){
              Swal.fire({
                  text: 'Are you sure, you want to ' +actionType+ '?',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Yes!'
                  }).then((result) => {
                    if (result.value) {
                        this.std_decission.id=id;
                        this.std_decission.type=actionType;

                        this.std_decission.post('TrackApplicationController/acceptApplication').then(()=>{
                            if( this.std_decission.type == 'Accept'){
                                Swal.fire(
                                'Accepted!',
                                'Your application has been forwarded successfully.',
                                'success'
                                );
                                }
                            else if( this.std_decission.type == 'Cancel'){
                                Swal.fire(
                                'Accepted!',
                                'Your application has been cancelled successfully.',
                                'success'
                                );
                            }

                        })
                    }
                })
            },

        },
        mounted() {
            this.loadApplication(this.$route.query.cid);
            console.log('Component mounted.')
        }
    }
</script>
