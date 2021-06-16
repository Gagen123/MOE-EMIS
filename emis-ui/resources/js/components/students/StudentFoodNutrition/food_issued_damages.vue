<template>
    <div>
        <div class="row">

            to be Done
        </div>
    </div>
</template>
<script>
export default {
    components: {
    },
    data() {
        return {
            firstname:"", middlename:"", lastname:"",
            organizationtype:"", fathername:"", mothername:"", fathercontact:"", mothercontact:"",
            schoollevel:"", guardaincontact:"",
            schoolname:"", studentclass:"", studentsection:"", studentstream:"",
            nationality:"", dzongkhag:"", gewog:"",
            schoolLocation:"",schoolstatus:"",
            agencycode:"",rcsccode:"",mofcode:"",
            establishmentyear:"", locationroadtype:"",
            locationdzongkhag:"", locationgewog:"", locationvillage:"",thrmno:"",altitute:"",latitute:"",longitute:"", locationschool:"",
            climatetype:"",locationvillage:"",distancefromroaddays:"",distancefromroadkm:"",distancefromroadhrs:"",compoundarea:"",playgroundmeasure:"",playgrounddescription:"",
            agrriculturearea:"",usedagriculture:"",tabstandNo:"",waterproblem:"",electricremarks:"",wayofdatacollection:"",
            count:5,
        }
    },
    methods: {
        previoustab(preclass,presentclass){
            $('.basic-tabs>a').removeClass('active');
            $('#basic-tabs').removeClass('active show');
            $('.location-tab >a').removeClass('active');
            $('#location-tab').removeClass('active show');
            $('.schooldetails-tab >a').removeClass('active');
            $('#schooldetails-tab').removeClass('active show');
            $('.contactdetails-tab >a').removeClass('active');
            $('#contactdetails-tab').removeClass('active show');
            $('.'+preclass+'> a').addClass('active');
            $('#'+preclass).addClass('active show');
        },
        shownexttab(presentclass,nextclass){
            $('.basic-tabs>a').removeClass('active');
            $('#basic-tabs').removeClass('active show');
            $('.location-tab >a').removeClass('active');
            $('#location-tab').removeClass('active show');
            $('.schooldetails-tab >a').removeClass('active');
            $('#schooldetails-tab').removeClass('active show');
            $('.contactdetails-tab >a').removeClass('active');
            $('#contactdetails-tab').removeClass('active show');
            if(this.validatedforms(presentclass)){
                $('.'+nextclass+'> a').addClass('active');
                $('#'+nextclass).addClass('active show');
                $('.'+nextclass+'> a').removeClass('disabled');
            }
            else{
                $('.'+presentclass+'> a').addClass('active');
                $('#'+presentclass).addClass('active show');
                $('.'+nextclass+'-head').removeClass('active');
                $('.basic-tabs> a').addClass('active');
            }
        },
        submitfinalform(){
            Swal.fire({
                title: 'Are you sure you wish to submit the entire information mention in the form?',
                text: "You won't be able to revert this back once you submit!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Submitted!',
                        'Your applicaiton details has been submitted. System generated application number for this transaction is: #02234. You may use this application nunber to track application status.',
                        'success',
                        this.$router.push('/regstdmanagement')
                    )
                }
            })
        },
        validatedforms(presentclass){
            let returntype=true;
            if(presentclass=="basic-tabs"){
                if($('#organizationtype').val()==""){
                    $('#organizationtype').addClass('is-invalid');
                    $('#organizatioid_err').html('Please select organization type');
                    returntype=false;
                }

                if($('#schoolname').val()==""){
                    $('#schoolname').addClass('is-invalid');
                    $('#schoolname_err').html('Please mention the name of the school');
                    returntype=false;
                }

                if($('#agencycode').val()==""){
                    $('#agencycode').addClass('is-invalid');
                    $('#agencycode_err').html('Please mention agency code');
                    returntype=false;
                }
            }
            return returntype;
        },
        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html('');
            }
        },
        showidentity:function(type){
                if(type=="Non-Bhutanese"){
                    $('#non-national').show();
                    $('#national').hide();
                }
                else if(type=="Bhutanese"){
                    $('#national').show();
                    $('#non-national').hide();
                }
                else if(type=="no-guardian"){
                    $('#guardian').hide();
                }
                else if(type=="guardian"){
                    $('#guardian').show();
                }
        }

    },

    mounted() {
        $('#cardheader').html('New Student Form');
        $('#addnewstd').hide();
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $('.select2-selection__rendered').addClass('font-weight-bolder');
        $('#organizationtype').change(function(){
            //this.removeerror('organizationtype','organizatioid_err');
            if($('#organizationtype').val()=="School"){
                $('#schoolcat').show();
            }
            else{
                $('#schoolcat').hide();
            }
        });
    },

}
</script>
