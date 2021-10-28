<template>
    <div>
        <div class="card card-danger card-outline" id="error_section" style="display:none">
            <div class="card-body pb-0 mb-0">
                <div class="callout callout-danger">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="mb-0" id="err_message"></label><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="maindiv">
            <div class="card card-success card-outline collapsed-card" id="adv_serach_ection">
                <div class="card-body pb-0 mb-0" style="display:none">
                    <div class="callout callout-success">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Trainig Type:</label><br>
                                <span class="text-blue text-bold">{{ trainingDetails.trainingtype }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Course Title:</label><br>
                                <span class="text-blue text-bold">{{trainingDetails.course_title}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Vanue:</label><br>
                                <span class="text-blue text-bold">{{trainingDetails.vanue}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Related Programme:</label><br>
                                <span class="text-blue text-bold">{{ trainingDetails.related}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Start Date:</label><br>
                                <span class="text-blue text-bold">{{reverseDate1(trainingDetails.start_date)}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">End Date:</label><br>
                                <span class="text-blue text-bold">{{reverseDate1(trainingDetails.end_date)}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Programme Type:</label><br>
                                <span class="text-blue text-bold">{{ trainingDetails.programme_type }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Programme Level:</label><br>
                                <span class="text-blue text-bold">{{trainingDetails.programme_level}}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label class="mb-0">Total Hrs:</label><br>
                                <span class="text-blue text-bold">{{trainingDetails.total_hrs}}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table id="dynamic-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Attachment Name</th>
                                            <th>File(Image,Doc,Excel,Pdf)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='(attach,count) in trainingDetails.attachments' :key="count+1">
                                            <td>
                                                {{attach.user_defined_name}}
                                            </td>
                                            <td>
                                                <a href="#" @click="openfile(attach)" class="fa fa-eye"> View</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header pb-0 pt-2">
                    <h3 class="card-title">Program Details</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus" ></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card card-success card-outline">
                <div class="card-header pb-0 pt-2">
                    <h3 class="card-title">Participant Details</h3>
                </div>
                <div class="card-body pb-0 mb-0">
                    <table id="dynamic-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Dzongkhag</th>
                                <th>Working Agency</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>participation</th>
                                <th>Attachments</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in participant_list" :key="index">
                                <td>{{ item.dzongkhag}}</td>
                                <td>{{ item.working_agency_name}}</td>
                                <td>{{ item.staff_name}}</td>
                                <td>{{ item.contact}}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ item.participacingas}}</td>
                                <td>
                                    <span v-for="(doc, index) in item.document" :key="index">
                                        <a href="#" @click="openfile(doc)"> {{ doc.original_name.split('_')[1]}}</a>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            trainingDetails:[],
            participant_list:[],
        }
    },
    methods: {
        openfile(file){
            let file_path=file.path+'/'+file.original_name;
            file_path=file_path.replaceAll('/', 'SSS');
            let uri = 'common/viewFiles/'+file_path;
            window.location=uri;
        },

        getParticipantDetails(program_id){
            axios.get('staff/hrdevelopment/getParticipantDetails/nomination/'+program_id)
            .then((response) => {
                let data=response.data.data;
                this.participant_list=data;
            })
            .catch((error) =>{
                console.log("Error:"+error);
            });
        },

    },


    mounted() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.select2').select2();
        $('.select2').select2({
            theme: 'bootstrap4'
        });
        $('.select2').on('select2:select', function (el){
            Fire.$emit('changefunction',$(this).attr('id'));
        });

        Fire.$on('changefunction',(id)=> {
            this.changefunction(id);
        });
        axios.get('staff/hrdevelopment/loadDetails/'+this.$route.params.data)
        .then((response) => {
            let data=response.data.data;
            this.trainingDetails=data
            this.getParticipantDetails(data.id);
        })
        .catch((error) =>{
            console.log("Error:"+error);
        });
    },
}
</script>
