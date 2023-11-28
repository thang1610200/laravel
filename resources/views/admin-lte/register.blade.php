<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Register</title>

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

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/admin" class="h1"><b>Admin</b></a>
            </div>
            <div class="card-body">
                <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                    Email already exists
                    <button type="button" class="btn-close" id="close_alert"><span aria-hidden="true">&times;</span></button>
                </div>
                <div id='alert_captcha' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                    Please click Captcha
                    <button type="button" class="btn-close" id="close_captcha"><span aria-hidden="true">&times;</span></button>
                </div>
                <p class="login-box-msg">Register a new account</p>
                <form>
                    <div class="input-group mb-3">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div id="name_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                            Your name should be more than 5 characters
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <div id="email_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                            Invalid Email
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div id="confirm_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                            Password does not match
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button id="register" type="button" disabled class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="g-recaptcha d-flex justify-content-center mt-3 mb-3" id="feedback-recaptcha"
                    data-sitekey="6LdOUYEoAAAAAAsQAZvp4cUx5mBmiZLylZy_DoCQ"></div>

                <a href="/admin/auth/login" class="text-center">I already have a account</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>

    <!-- jQuery -->
    <script src="{{ asset('almasaeed2010/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('almasaeed2010/adminlte/dist/js/adminlte.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $("#name").on('keyup', function() {
                if ($("#name").val().trim().length <= 5) {
                    $("#name").addClass("border-danger");
                    $("#name_error").removeClass("d-none");
                    $("#name_error").addClass('d-block');
                } else {
                    $("#name").removeClass("border-danger");
                    $("#name_error").addClass("d-none");
                    $("#name_error").removeClass("d-block");
                }
            });

            $("#email").on('keyup', function() {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val().trim())) {
                    $("#email").removeClass("border-danger");
                    $("#email_error").addClass("d-none");
                    $("#email_error").removeClass("d-block");
                    return true;
                } else {
                    $("#email").addClass("border-danger");
                    $("#email_error").removeClass("d-none");
                    $("#email_error").addClass('d-block');
                    return false;
                }
            });

            $("#confirm").on('keyup', function() {
                if ($("#confirm").val().trim() === $("#password").val().trim()) {
                    $("#confirm").removeClass("border-danger");
                    $("#confirm_error").addClass("d-none");
                    $("#confirm_error").removeClass("d-block");
                } else {
                    $("#confirm").addClass("border-danger");
                    $("#confirm_error").removeClass("d-none");
                    $("#confirm_error").addClass('d-block');
                }
            })

            $("#close_alert").on('click', function() {
                $("#alert_email").removeClass('d-block');
                $("#alert_email").addClass('d-none');
            });

            $("#close_captcha").on('click', function() {
                $("#alert_captcha").removeClass('d-block');
                $("#alert_captcha").addClass('d-none');
            });

            $("form :input").on('keyup', function() {
                if (!$("#name").hasClass('border-danger') && !$("#email").hasClass('border-danger') && !$(
                        "#confirm").hasClass('border-danger') && $("#name").val().trim() && $("#email")
                    .val().trim() &&
                    $("#password").val().trim() && $("#confirm").val().trim()
                ) {
                    $("#register").attr('disabled', false);
                } else {
                    $("#register").attr('disabled', true);
                }
            })

            $("#register").on('click', function() {
                const name = $("#name").val().trim();
                const email = $("#email").val().trim();
                const password = $("#password").val().trim();
                const confirm = $("#confirm").val().trim();

                if (!grecaptcha.getResponse()) {
                    $("#alert_captcha").removeClass('d-none');
                    $("#alert_captcha").addClass('d-block');
                    setTimeout(function() {
                        $("#alert_captcha").removeClass('d-block');
                        $("#alert_captcha").addClass('d-none');
                    }, 3000);
                }

                if (!$("#name").hasClass('border-danger') && !$("#email").hasClass('border-danger') && !$(
                        "#password").hasClass('border-danger') && !$("#confirm").hasClass(
                        'border-danger') && name && email && password && confirm && grecaptcha
                .getResponse()) {
                    $(document).on('ajaxStart', function() {
                        $("#name").attr('disabled', true);
                        $("#confirm").attr('disabled', true);
                        $("#email").attr('disabled', true);
                        $("#password").attr('disabled', true);
                        $("#register").attr('disabled', true);
                        $("#register").empty();
                        $("#register").append(
                            `<div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>`
                        );
                    });

                    $(document).on('ajaxComplete', function() {
                        $("#name").attr('disabled', false);
                        $("#confirm").attr('disabled', false);
                        $("#email").attr('disabled', false);
                        $("#password").attr('disabled', false);
                        $("#register").attr('disabled', false);
                        $("#register").empty();
                        $("#register").append(
                            `Create an account`
                        );
                    })

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '/admin/auth/register',
                        dataType: 'json',
                        data: {
                            name,
                            email,
                            password,
                            confirm,
                            "recaptcha-response": grecaptcha.getResponse()
                        },
                        success: function(res) {
                            window.location.href = "/admin/auth/login";
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status === 422) {
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
            });
        });
    </script>
</body>

</html>
