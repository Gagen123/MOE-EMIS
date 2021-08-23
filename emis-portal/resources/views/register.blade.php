<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/new_logo.png" type="image/x-icon" />
        <title>Emis Portal</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="js/app.js"></script>
    </head>
    <body class="hold-transition login-page" style="background-image: url('{{ asset('images/school.jpg')}}');background-size: cover; background-repeat: no-repeat;">
    <div class="login-box" id="app">
        <div class="card">
            <div class="card-body login-card-body">
                <div id="loginsection">
                    <div class="login-logo">
                        <a href="#"><b>Ministry of Education</b></a>
                        <hr>
                    </div>
                    <p class="login-box-msg">New Registration</p>
                    <form action="{{ url('save_new_registration') }}" method="POST">
                        @csrf
                        @if($Invalid!=null)
                            <div class="alert alert-danger col-12"> {{ $Invalid }}</div>
                        @endif
                        @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span> <br>
                        @endforeach
                        <label> Registration Type:<span class="text-danger">*</span></label><br>
                        <div class="form-group">
                            <input type="radio" name="registrationType" onclick="showsection('newadmission')" value="1" id="new"> New Admission <br>
                            <input type="radio" name="registrationType" onclick="showsection('leadership')" value="3" id="new"> Apply for Leadership <br>
                            <input type="radio" name="registrationType" onclick="showsection('existinglogin')" value="2" id="existing"> User for Student
                        </div>
                        <span id="newadmission" style="display:none">
                            <div class="form-group">
                                <input type="name" id="name" :class="{ 'is-invalid': form.errors.has('name') }" name="name"
                                placeholder="Student Name" class="form-control">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="input-group mb-3">
                                <input type="contact" id="contact" :class="{ 'is-invalid': form.errors.has('contact') }" name="contact"
                                placeholder="Mobile Number" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-phone"></span>
                                    </div>
                                </div>
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" id="emails" :class="{ 'is-invalid': form.errors.has('email') }" name="email"
                                placeholder="email" class="form-control">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                            </div>
                        </span>
                        <span id="leadership" style="display:none">
                            <div class="row">
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    <input type="text" id="emp_id" :class="{ 'is-invalid': form.errors.has('emp_id') }" name="emp_id"
                                    placeholder="Employee Id" class="form-control">
                                    <has-error :form="form" field="emp_id"></has-error>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <button type="button" onclick="loadDetails('emp_id')" class="btn btn-primary">Fetch</button>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <input type="hidden" name="emp_cid" id="emp_cid">
                                <input type="hidden" name="emp_name" id="emp_name">
                                <input type="hidden" name="zest_emp_id" id="zest_emp_id">
                                <input type="hidden" name="emp_dob" id="emp_dob">
                                <input type="hidden" name="emp_Email" id="emp_Email">
                                <input type="hidden" name="emp_MobileNo" id="emp_MobileNo">
                                <input type="hidden" name="emp_positionTitle" id="emp_positionTitle">
                                <input type="hidden" name="emp_positionLevel" id="emp_positionLevel">
                                <input type="hidden" name="emp_dzongkhag" id="emp_dzongkhag">
                                <input type="hidden" name="working_address" id="working_address">
                                <label>CID: </label> <span id="emp_cid_display"></span><br>
                                <label>Name: </label> <span id="emp_name_display"></span><br>
                                <label>Position: </label> <span id="emp_positionTitle_display"></span><br>
                                <label>Email: </label> <span id="emp_Email_display"></span><br>
                                <label>Contact: </label> <span id="emp_MobileNo_display"></span><br>
                            </div>
                            <div class="input-group mb-3" style="display:none" id="emp_password">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <span id="multiplePosition"><br></span>
                                    <div class="alert alert-danger alert-dismissible" id="no_message" style="display: none">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        Sorry! There is no Leadership selection process applicable for your position
                                    </div>
                                    <hr>
                                    <button  id="register_btn" style="display: none" type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                            </div>
                        </span>
                        <span id="existinglogin" style="display:none">
                            <div class="form-group">
                                Your student code will be the user name and password will send to your associated email and mobile
                            </div>
                            <div class="form-group">
                                <input type="text" id="student_code" :class="{ 'is-invalid': form.errors.has('name') }" name="student_code"
                                placeholder="Student Code" class="form-control">
                                <has-error :form="form" field="student_code"></has-error>
                            </div>
                            <div class="input-group mb-3">
                                <input type="date" id="dob" :class="{ 'is-invalid': form.errors.has('dob') }" name="dob"
                                placeholder="Date of Birthr" class="form-control">
                                <has-error :form="form" field="dob"></has-error>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Get Password</button>
                            </div>
                        </span>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <script>
            function showgorget(){
                $('#forgotpassword').show();
                $('#loginsection').hide();
            }
            function showsection(type){
                $('#newadmission').hide();
                $('#existinglogin').hide();
                $('#leadership').hide();
                $('#'+type).show();
            }
            function passwordsend(){
                if($('#emailforget').val()==""){
                    $('#emailerr').html('Please provide email');
                }
                else{
                    Swal.fire({
                        title: 'Password Reset link has been send to your email. Please visit your email',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#forgotpassword').hide();
                            $('#loginsection').show();
                        }
                    });
                }
            }
            function loadDetails(id){
                axios.get('recruitmentFeedbackController/getEmployeeDetials/1/'+$('#'+id).val()) //1 -regualr
                .then(response =>{
                    this.ciderror = '';
                    let detail = response.data;
                    if (detail!=""){
                        let fullname=detail.firstName;
                        if(detail.middleName!=""){
                            fullname=fullname+' '+detail.middleName;
                        }
                        if(detail.lastName!=""){
                            fullname=fullname+' '+detail.lastName;
                        }
                        $('#emp_name_display').html(fullname);
                        $('#emp_cid').val(detail.cidNumber);
                        $('#emp_cid_display').html(detail.cidNumber);
                        $('#zest_emp_id').val(detail.employeeNumber);
                        $('#emp_name').val(fullname);
                        let dob=detail.dateOfBirth;
                        if(dob.includes('-')){
                            dob=dob.split('-')[2]+'-'+dob.split('-')[1]+'-'+dob.split('-')[0];
                        }
                        if(dob.includes('/')){
                            dob=dob.split('/')[2]+'-'+dob.split('/')[1]+'-'+dob.split('/')[0];
                        }
                        $('#emp_dob').val(dob);
                        $('#emp_Email').val(detail.Email);
                        $('#emp_Email_display').html(detail.Email);
                        $('#emp_dateOfAppointment').val(detail.dateOfAppointment);
                        $('#emp_MobileNo').val(detail.MobileNo);
                        $('#emp_MobileNo_display').html(detail.MobileNo);
                        $('#emp_positionLevel').val(detail.positionLevel);
                        $('#emp_positionTitle').val(detail.positionTitle);
                        $('#emp_positionTitle_display').html(detail.positionTitle+' ('+detail.positionLevel+')');
                        $('#emp_dzongkhag').val(detail.OrganogramLevel1);
                        $('#working_address').val(detail.OrganogramLevel3);

                        axios.get('recruitmentFeedbackController/getleadershipDetailsByPosition/'+ detail.positionTitle)
                        .then(response => {
                            let personal_detail = response.data;
                            $('#no_message').hide();
                            $('#register_btn').hide();
                            if(personal_detail.length==0){
                                $('#no_message').show();
                            }
                            else{
                                let rdio="  Registering for: <br>";
                                personal_detail.forEach(element => {
                                    rdio+='<input type="radio" name="vacancyId" value="'+element.id+'"> '+element.selection_for+'<br>';
                                });
                                $('#multiplePosition').html(rdio);
                                $('#register_btn').show();
                                $('#emp_password').show();
                            }
                            $('#emp_dob').val(personal_detail.gender);
                        })

                        // axios.get('getpersonbycid/'+ detail.cidNumber)
                        // .then(response => {
                        //     this.ciderror = '';
                        //     let personal_detail = response.data;
                        //     $('#emp_dob').val(personal_detail.gender);
                        // })
                    }else{
                        this.ciderror = 'Invalid CID.';
                        Swal.fire({
                            html: "No data found for matching CID",
                            icon: 'info'
                        });
                    }
                })
                .catch((e) => {
                    this.ciderror = 'Invalid CID / service down.';
                    Swal.fire({
                        html: "No data found for this eid "+e,
                        icon: 'error'
                    });
                });
            }
        </script>
    </body>
</html>
