<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/new_logo.png" type="image/x-icon" />
        <title>Emis Portal</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Ministry of Education</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <div id="loginsection">
                    <p class="login-box-msg">New Registration</p>
                    <form action="/new_register" method="POST">
                        @if($Invalid!=null)
                            <div class="alert alert-danger col-12"> {{ $Invalid }}</div>
                        @endif
                        @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span> <br>
                        @endforeach
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
