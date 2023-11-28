<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('almasaeed2010/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('almasaeed2010/adminlte/dist/css/adminlte.min.css') }}">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/admin" class="h1"><b>Admin</b></a>
            </div>
            <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                Login information is incorrect
                <button type="button" class="close" id="close_alert"><span aria-hidden="true">&times;</span></button>
            </div>
            <div id='alert_verify' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                Please check your email for confirmation
                <button type="button" class="close" id="close_verify"><span aria-hidden="true">&times;</span></button>
            </div>
            <div id='alert_captcha' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                Please click Captcha
                <button type="button" class="close" id="close_captcha"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button disabled id="login" type="button"  type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="g-recaptcha d-flex justify-content-center mt-3 mb-3" id="feedback-recaptcha"
                data-sitekey="6LdOUYEoAAAAAAsQAZvp4cUx5mBmiZLylZy_DoCQ"></div>

                <p class="mb-0">
                    <a href="/admin/auth/register" class="text-center">Register a new account</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('almasaeed2010/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('almasaeed2010/adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        $("#close_alert").on('click', function() {
            $("#alert_email").removeClass('d-block');
            $("#alert_email").addClass('d-none');
        });

        $("#close_verify").on('click', function() {
            $("#alert_verify").removeClass('d-block');
            $("#alert_verify").addClass('d-none');
        });

        $("#close_captcha").on('click', function() {
            $("#alert_captcha").removeClass('d-block');
            $("#alert_captcha").addClass('d-none');
        });

        $("form :input").on('keyup', function() {
            if ($("#email").val().trim() && $("#password").val().trim()) {
                $("#login").attr('disabled', false);
            } else {
                $("#login").attr('disabled', true);
            }
        })

        $("#login").on('click', function() {
            const email = $("#email").val().trim();
            const password = $("#password").val().trim();
            const remember = $("#remember").is(':checked');

            if (!grecaptcha.getResponse()) {
                $("#alert_captcha").removeClass('d-none');
                $("#alert_captcha").addClass('d-block');
                setTimeout(function() {
                    $("#alert_captcha").removeClass('d-block');
                    $("#alert_captcha").addClass('d-none');
                }, 3000);
            }

            if (email && password && grecaptcha.getResponse()) {
                $(document).on('ajaxStart', function() {
                    $("#email").attr('disabled', true);
                    $("#password").attr('disabled', true);
                    $("#login").attr('disabled', true);
                    $("#login").empty();
                    $("#login").append(
                        `<div class="spinner-border text-info" role="status">
                        </div>`
                    );
                });

                $(document).on('ajaxComplete', function() {
                    $("#email").attr('disabled', false);
                    $("#password").attr('disabled', false);
                    $("#login").attr('disabled', false);
                    $("#login").empty();
                    $("#login").append(
                        `Sign In`
                    );
                })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/admin/auth/login',
                    dataType: 'json',
                    data: {
                        email,
                        password,
                        remember,
                        "recaptcha-response": grecaptcha.getResponse()
                    },
                    success: function(res) {
                        if (res.verify) {
                            $("#alert_verify").removeClass('d-none');
                            $("#alert_verify").addClass('d-block');
                            setTimeout(function() {
                                $("#alert_verify").removeClass('d-block');
                                $("#alert_verify").addClass('d-none');
                            }, 3000);
                        } else {
                            window.location.href = "/admin";
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        grecaptcha.reset();
                        if (jqXHR.status === 401) {
                            $("#alert_email").removeClass('d-none');
                            $("#alert_email").addClass('d-block');
                            setTimeout(function() {
                                $("#alert_email").removeClass('d-block');
                                $("#alert_email").addClass('d-none');
                            }, 3000);
                        } else {
                            alert(textStatus);
                        }
                    }
                });
            }
        })
    </script>
</body>

</html>
