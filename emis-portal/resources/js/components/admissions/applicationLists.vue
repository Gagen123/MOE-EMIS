<template>
<div>
    <h5 class="card-header"><strong>Your Application</strong></h5>
    <div class="card-body table-responsive pb-0">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                        <td>{{ item.dzongkhag}}</td>
                        <td>{{ item.school  }}</td>
                        <td>{{ item.dateOfapply }}</td>
                        <td><span class="badge badge-success">{{ item.Status}}</span></td>
                        <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="StudentDecission(item.id,'Accept')"> <b-button variant="success">Accept</b-button></a>
                        </div>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="StudentDecission(item.id,'Cancel')"> <b-button variant="danger">Cancel</b-button></a>
                        </div>
                            
                        </td>
                        <td>
                             <div class="btn-group btn-group-lg">
                                <td>{{item.remarks }}</td>
                            </div>
                        </td>
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
            return{
                applicationList:[],
                std_decission:new form({
                    id:'',
                    type:'',
                }),
              
            }
        },
        methods:{
            loadApplication(cid){
                 axios.get('TrackApplicationController/applicationListsbyCid/' +cid)
                    .then(response => {
                    let data = response;
                    this.applicationList = data.data.data;
                    alert(data.data.data.school)
                    // let orgId = response.data.data.OrgOrganizationId
                    // this.getDetailsByOrgId(orgId)
                });
            },
            // getDetailsByOrgId(orgId){
            //     axios.get('loadOrganizationDetailsbyOrgId/' +orgId)
            //         .then(response =>{
            //             let data = response.data.data;
            //             this.OrgDetails=data;
            //             this.getdzongkhagName(this.OrgDetails.dzongkhagId);
            //             this.getgewogName(this.OrgDetails.gewogId);
            //         })

            // },

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
        created(){
            this.loadApplication(this.$route.query.cid);
           
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
