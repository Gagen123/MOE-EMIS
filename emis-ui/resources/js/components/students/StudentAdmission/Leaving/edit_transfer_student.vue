<template>
    <div>
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
                    <label> Transfer Certificate </label>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <p>
                        (Child Current School Letterhead)
                        Parents while seeking admission must submit the Transfer Certificate from the last school attended in the format
                        below and should be on the original letterhead of the leaving school.<br>
                            - Complete the form as of the student’s last day in attendance on his/her school letterhead
                            - This form must be signed and stamped by a school official (blue ink preferred)
                            - The Original Transfer Certificate must be presented at the time of admission testing.<br>
                        1- Name of Student: __________{{student_details.Name}}____________________________________________________<br>
                        2- Nationality: ______________Bhutanese________________________________________________<br>
                        3- Date of Birth:(dd/mm/YY):______________________________________________________________<br>
                        4- Class to which he/she was admitted: __________X_________ Academic Year: _____2021__________<br>
                        5- The Present Class: ______________________XII_____________ Academic Year: ____2022___________<br>
                        6- Last date of attendance in the school: ____________{{student_details.organization}}__________<br>
                        Headmaster/ Principal/ Director of school:<br>
                        Name:______Gomchen Tenzin______________________<br>

                        Ministry of Education (Bhutan)
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
</template>
<script>
export default {
    data(){
        return{
            student_details:[],
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
    mounted() {
       axios.get('students/loadStudentTransfersDetail/'+this.$route.query.data.id)
        .then(response =>{
            let data = response.data.data[0];
            this.student_details=data;
        })
        .catch(errors => {
            console.log(errors);
        });
    },

}
</script>


