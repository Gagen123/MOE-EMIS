<template>
    <div>
        <div class="callout callout-success" v-if="viewtype=='view'">
            <span><label><u>Applicant Detials</u></label></span>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Full Name: </label>
                    <span class="text-blue text-bold">{{staff_details.staff_name}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">EID: </label>
                    <span class="text-blue text-bold">{{staff_details.emp_id}}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Position Title: </label>
                    <span class="text-blue text-bold">{{staff_details.position_title_name}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Position Level: </label>
                    <span class="text-blue text-bold">{{staff_details.positionlevel}}</span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Dzongkhag: </label>
                    <span class="text-blue text-bold">{{staff_details.dzongkhag}}</span>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <label for="inputName" class="col-form-label">Working Address: </label>
                    <span class="text-blue text-bold">{{staff_details.working_agency}}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label for="inputName" class="col-form-label">Reason: </label>
                    <span class="text-blue text-bold">{{form.reason}}</span>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <label class="mb-0">Remarks</label>
                    <span class="text-blue text-bold">{{staff_details.remarks}}</span>
                </div>
            </div>
        </div>
        <div v-if="viewtype=='print'">
            <span id="printdiv">
                <div class="row form-group">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <img src="img/design1.png" onerror="this.src='img/design1.png'" class="brand-image" style="opacity: .8">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <img src="img/MoE_Logo.png" onerror="this.src='img/design1.png'" class="brand-image" style="opacity: .8">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <label> Transfer Order</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <p>
                            <span class="fa-pull-right">
                                <b>Date:</b> <span id="currentdate">{{reverseDate(staff_details.reject_approve_Date.substring(0,10)) }}</span>
                            </span>
                            <b>Name:</b> <span id="currentdate">{{staff_details.staff_name }}</span><br>
                            <b>Position Title:</b> <span id="currentdate">{{staff_details.position_title_name}}</span><br>
                            <b>Subject: Transfer Order</b>
                        </p>
                        <p>To execute goods movements in the warehouse, you create transfer orders in the Warehouse Management System (WMS).</p>
                        <p>You create a transfer order for an inbound delivery as soon as the supplier informs you of the scheduled delivery. The advantage of depicting the goods receipt process through the inbound delivery function is that you can execute many processes in advance even before the actual goods receipt posting takes place.</p>
                        <p>You create a transfer order for an outbound delivery if you want to supply a delivery to a sales order for which you have previously created an outbound delivery in the system (see Goods Issue Processing with Reference to Outbound Delivery ).</p>
                        <p>You create a transfer order for the transfer requirement whenever the transfer requirement has been created as a source document. This is the case, for example, if you post a goods receipt in Inventory Management (IM) or if a transfer requirement is created through the PP interface for production supply.</p>
                        <br><br><br>
                        <p>
                            <img src="img/sig1.jpg" onerror="this.src='img/design1.png'" class="brand-image" style="opacity: .8">
                        </p>
                    </div>
                </div>
            </span>
            <button type="button" class="btn btn-outline-primary btn-sm" v-on:click="printcertificate">
                <i class="fas fa-print"></i>
            </button>
        </div>
    </div>
</template>
<script>
export default {
     data(){
        return {
            viewtype:'',
            staff_details:[],
            form: new form({
                id:'',
                staff_id:'',
                reason:'',
                remarks:'',
                model:'TransferOrder',
                action_type:'edit'
            }),
        }
    },
    methods:{
        printcertificate(){
            var divContents = document.getElementById("printdiv").innerHTML;
            var a = window.open('', '', 'height=500, width=5000');
            a.document.write('<html>');
            a.document.write('<body>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        },
    },
    mounted(){
        this.form.reason=this.$route.query.data.reason;
        this.viewtype=this.$route.query.type;
        axios.get('common/getSessionDetail')
        .then(response => {
            let data = response.data.data;
            this.form.staff_id=data['staff_id'];
            axios.get('/staff/staffOfficeorderController/loadDetForVerification/'+this.$route.query.data.id)
            .then(response =>{
                let data = response.data;
                this.staff_details=data;
            })
        })
        .catch(errors => {
            console.log(errors);
        });

        $('#currentdate').html();
    },
}
</script>
