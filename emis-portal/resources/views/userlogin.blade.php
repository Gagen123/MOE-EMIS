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
                    <p class="login-box-msg">Sign in to start your session </p>
                    <form action="/userlogin" method="get">
                        @if($Invalid!=null)
                            <div class="alert alert-danger col-12"> {{ $Invalid }}</div>
                        @endif
                        @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span> <br>
                        @endforeach
                        <div class="input-group mb-3">
                            <input type="email" id="emails" :class="{ 'is-invalid': form.errors.has('email') }" name="email"
                            placeholder="user name" class="form-control">
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
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>
                    <p class="mb-1">
                        <a href="#" onclick="showgorget()">I forgot my password</a>
                    </p>
                </div>
                <div id="forgotpassword" style="display:none">
                <p class="login-box-msg">Forget Password</p>
                    <form action="userlogin">
                        <div class="input-group mb-3">
                            <input type="text" id="emailforget" class="form-control" placeholder="Provide your email or user name to send reset link">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            <span id="emailerr" class="text-danger"></span>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" onclick="passwordsend()" class="btn btn-primary btn-block">Get password </button>
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
                    })
                }
            }
        </script>
    </body>
</html>
