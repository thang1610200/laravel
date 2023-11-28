<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('title', 'Register')

    @section('style-libraries')
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @stop

</head>

<body class="bg-light">
    @extends('admin.layout')

    @section('content')
        <div class="d-flex flex-column align-items-center justify-content-center px-6 py-8 mx-auto mt-3">
            <div class="bg-white rounded-3 shadow-sm border bg-dark border-dark" style="width: 450px;">
                <div class="p-4 pb-6">
                    <h4 class="fw-bold mb-3">
                        Create an account
                    </h4>
                    <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                        Email already exists
                        <button type="button" class="btn-close" id="close_alert"></button>
                    </div>
                    <div id='alert_captcha' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                        Please click Captcha
                        <button type="button" class="btn-close" id="close_captcha"></button>
                    </div>
                    <form class="mt-4 d-grid gap-4">
                        @csrf
                        <div>
                            <label for="name" class="d-block mb-2 text-sm-start font-monospace">Your name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Nguyen Van A">
                            <div id="name_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                                Your name should be more than 5 characters
                            </div>
                        </div>
                        <div>
                            <label for="email" class="d-block mb-2 text-sm-start font-monospace">Your email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="name@company.com">
                            <div id="email_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                                Invalid Email
                            </div>
                        </div>
                        <div>
                            <label for="password" class="d-block mb-2 text-sm-start font-monospace">Your password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="••••••••">
                        </div>
                        <div>
                            <label for="confirm" class="d-block mb-2 text-sm-start font-monospace">Confirm password</label>
                            <input type="password" id="confirm" name="confirm" class="form-control"
                                placeholder="••••••••">
                            <div id="confirm_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                                Password does not match
                            </div>
                        </div>
                        <div class="g-recaptcha d-flex justify-content-center" id="feedback-recaptcha"
                            data-sitekey="6LdOUYEoAAAAAAsQAZvp4cUx5mBmiZLylZy_DoCQ"></div>
                        <button id="register" type="button" disabled class="form-control btn btn-primary rounded-3">Create
                            an account</button>
                    </form>
                    <p class="text-sm-start text-black-50 mt-3">
                        Already have an account? <a href="/admin/auth/login" style="text-decoration: none;">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
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
                        'border-danger') && name && email && password && confirm && grecaptcha.getResponse()) {
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
    @stop
</body>

</html>
