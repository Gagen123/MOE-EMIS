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
    </head>
    <body class="hold-transition login-page" style="background-image: url('{{ asset('images/school.jpg')}}');background-size: cover; background-repeat: no-repeat;">
    <div class="login-box">
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
                            <input type="radio" name="registrationType" onclick="showsection('newadmission')" value="1" id="new"> New Admission
                            <input type="radio" name="registrationType" onclick="showsection('existinglogin')" value="2" id="existing" class="ml-4"> User for Student
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
        </script>
    </body>
</html>
