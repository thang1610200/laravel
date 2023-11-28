<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Forgot password')
</head>

<body class="bg-light">
    @extends('layout')

    @section('content')
        <div class="d-flex flex-column align-items-center justify-content-center px-6 py-8 mx-auto mt-5">
            <div class="bg-white rounded-3 shadow-sm border bg-dark border-dark" style="width: 450px;">
                <div class="p-4 pb-6">
                    <h4 class="fw-bold mb-3">
                        Reset password
                    </h4>
                    <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                        Email doesn't exist
                        <button type="button" class="btn-close" id='close_alert'></button>
                    </div>
                    <div id='alert_forbiden' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                        Check email
                        <button type="button" class="btn-close" id='close_forbiden'></button>
                    </div>
                    <form class="mt-4 d-grid gap-4">
                        @csrf
                        <div>
                            <label for="email" class="d-block mb-2 text-sm-start">Email address</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter email address">
                            <div id="email_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                                Invalid Email
                            </div>
                        </div>
                        <button disabled type="button" id="reset_password"
                            class="form-control btn btn-primary rounded-3">Reset password</button>
                    </form>
                    <p class="text-sm-start text-black-50 mt-3">
                        Not registered yet? <a href="/auth/register" style="text-decoration: none;">Register now</a>
                    </p>
                </div>
            </div>
        </div>
    @stop

    @section('scripts')
        <script>
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

            $("#close_alert").on('click', function() {
                $("#alert_email").removeClass('d-block');
                $("#alert_email").addClass('d-none');
            });

            $("#close_forbiden").on('click', function() {
                $("#alert_forbiden").removeClass('d-block');
                $("#alert_forbiden").addClass('d-none');
            });

            $("form :input").on('keyup', function() {
                if (!$("#email").hasClass('border-danger') && $("#email").val().trim()) {
                    $("#reset_password").attr('disabled', false);
                } else {
                    $("#reset_password").attr('disabled', true);
                }
            })

            $("#reset_password").on('click', function() {
                const email = $("#email").val().trim();

                if (email && !$("#email").hasClass('border-danger')) {
                    $(document).on('ajaxStart', function() {
                        $("#email").attr('disabled', true);
                        $("#reset_password").attr('disabled', true);
                        $("#reset_password").empty();
                        $("#reset_password").append(
                            `<div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>`
                        );
                    });

                    $(document).on('ajaxComplete', function() {
                        $("#email").attr('disabled', false);
                        $("#reset_password").attr('disabled', false);
                        $("#reset_password").empty();
                        $("#reset_password").append(
                            `Reset password`
                        );
                    })

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'POST',
                        url: '/auth/forgot-password',
                        dataType: 'json',
                        data: {
                            email,
                        },
                        success: function(res) {
                            window.location.href = "/auth/login";
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            if (jqXHR.status === 401) {
                                $("#alert_email").removeClass('d-none');
                                $("#alert_email").addClass('d-block');
                                setTimeout(function() {
                                    $("#alert_email").removeClass('d-block');
                                    $("#alert_email").addClass('d-none');
                                }, 3000);
                            } else if (jqXHR.status === 403) {
                                $("#alert_forbiden").removeClass('d-none');
                                $("#alert_forbiden").addClass('d-block');
                                setTimeout(function() {
                                    $("#alert_forbiden").removeClass('d-block');
                                    $("#alert_forbiden").addClass('d-none');
                                }, 3000);
                            }
                        }
                    });
                }
            });
        </script>
    @stop
</body>

</html>
