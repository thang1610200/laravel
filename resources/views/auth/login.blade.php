<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title', 'Login')

    @section('style-libraries')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @stop

</head>

<body class="bg-light">
    @extends('layout')

    @section('content')
        <div class="d-flex flex-column align-items-center justify-content-center px-6 py-8 mx-auto mt-3">
            <div class="bg-white rounded-3 shadow-sm border bg-dark border-dark" style="width: 450px;">
                <div class="p-4 pb-6">
                    <h4 class="fw-bold mb-3">
                        Sign in to your account
                    </h4>
                    <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                        Login information is incorrect
                        <button type="button" class="btn-close" id="close_alert"></button>
                    </div>
                    <div id='alert_verify' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                        Please check your email for confirmation
                        <button type="button" class="btn-close" id="close_verify"></button>
                    </div>
                    <div id='alert_captcha' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                        Please click Captcha
                        <button type="button" class="btn-close" id="close_captcha"></button>
                    </div>
                    <form class="mt-4 d-grid gap-4">
                        @csrf
                        <div>
                            <label for="email" class="d-block mb-2 text-sm-start">Your email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="name@company.com">
                        </div>
                        <div>
                            <label for="password" class="d-block mb-2 text-sm-start">Your password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="••••••••">
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-start">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <a href="/auth/forgot-password">Forgot password?</a>
                            </div>
                        </div>
                        <div class="g-recaptcha d-flex justify-content-center" id="feedback-recaptcha"
                            data-sitekey="6LdOUYEoAAAAAAsQAZvp4cUx5mBmiZLylZy_DoCQ"></div>
                        <button disabled id="login" type="button" class="form-control btn btn-primary rounded-3">Sign
                            in</button>
                    </form>
                    <p class="text-sm-start text-black-50 mt-3">
                        Don’t have an account yet? <a href="/auth/register" style="text-decoration: none;">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
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
                        <span class="visually-hidden">Loading...</span>
                    </div>`
                        );
                    });

                    $(document).on('ajaxComplete', function() {
                        $("#email").attr('disabled', false);
                        $("#password").attr('disabled', false);
                        $("#login").attr('disabled', false);
                        $("#login").empty();
                        $("#login").append(
                            `Sign in`
                        );
                    })

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '/auth/login',
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
                                grecaptcha.reset();
                            } else {
                                window.location.href = "/";
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status === 401) {
                                $("#alert_email").removeClass('d-none');
                                $("#alert_email").addClass('d-block');
                                setTimeout(function() {
                                    $("#alert_email").removeClass('d-block');
                                    $("#alert_email").addClass('d-none');
                                }, 3000);
                            } else {
                                console.log(jqXHR);
                                alert(textStatus);
                            }
                            grecaptcha.reset();
                        }
                    });
                }
            })
        </script>
    @stop
</body>

</html>
