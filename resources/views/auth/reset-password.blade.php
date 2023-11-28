<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Reset password')
</head>

<body class="bg-light">
    @extends('layout')
    <div class="d-flex flex-column align-items-center justify-content-center px-6 py-8 mx-auto mt-3">
        <div class="bg-white rounded-3 shadow-sm border bg-dark border-dark" style="width: 450px;">
            <div class="p-4 pb-6">
                <h4 class="fw-bold mb-3">
                    Change Password
                </h4>
                <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                    Please enter another password
                    <button type="button" class="btn-close" id='close_alert'></button>
                </div>
                <form class="mt-4 d-grid gap-4">
                    <div>
                        <label for="email" class="d-block mb-2 text-sm-start">Your email</label>
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="name@company.com" value="{{ $email }}" disabled>
                    </div>
                    <div>
                        <label for="password" class="d-block mb-2 text-sm-start">New password</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="••••••••">
                        <div id="password_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                            A lowercase letter <br />
                            A capital (uppercase) letter <br />
                            A number <br />
                            Minimum 10 characters <br />
                        </div>
                    </div>
                    <div>
                        <label for="confirm" class="d-block mb-2 text-sm-start">Confirm password</label>
                        <input type="password" id="confirm" name="confirm" class="form-control"
                            placeholder="••••••••">
                        <div id="confirm_error" class="d-none mt-2 text-danger" style="font-size: 12px">
                            Password does not match
                        </div>
                    </div>
                    <button disabled id="reset" type="button" class="form-control btn btn-primary rounded-3">Reset
                        password</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $("#password").on('keyup', function() {
            if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*]).{8,}$/.test($("#password").val().trim())) {
                $("#password").removeClass("border-danger");
                $("#password_error").addClass("d-none");
                $("#password_error").removeClass("d-block");
                return true;
            } else {
                $("#password").addClass("border-danger");
                $("#password_error").removeClass("d-none");
                $("#password_error").addClass('d-block');
                return false;
            }
        })

        $("#close_alert").on('click', function() {
            $("#alert_email").removeClass('d-block');
            $("#alert_email").addClass('d-none');
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

        $("form :input").on('keyup', function() {
            if (!$("#password").hasClass('border-danger') && !$("#confirm").hasClass('border-danger') &&
                $("#password").val().trim() && $("#confirm").val().trim()
            ) {
                $("#reset").attr('disabled', false);
            } else {
                $("#reset").attr('disabled', true);
            }
        })

        $("#reset").on('click', function() {
            const email = $("#email").val().trim();
            const password = $("#password").val().trim();
            const confirm = $("#confirm").val().trim();

            if (!$("#password").hasClass('border-danger') && !$("#confirm").hasClass('border-danger') && password &&
                confirm) {
                $(document).on('ajaxStart', function() {
                    $("#confirm").attr('disabled', true);
                    $("#password").attr('disabled', true);
                    $("#reset").attr('disabled', true);
                    $("#reset").empty();
                    $("#reset").append(
                        `<div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>`
                    );
                });

                $(document).on('ajaxComplete', function() {
                    $("#confirm").attr('disabled', false);
                    $("#password").attr('disabled', false);
                    $("#reset").attr('disabled', false);
                    $("#reset").empty();
                    $("#reset").append(
                        `Reset passwod`
                    );
                })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: `/auth/reset${window.location.search}`,
                    dataType: 'json',
                    data: {
                        email,
                        password,
                        confirm
                    },
                    success: function(res) {
                        window.location.href = "/auth/login";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 403) {
                            window.location.href = "/auth/login";
                        } else if (jqXHR.status === 400) {
                            $("#alert_email").removeClass('d-none');
                            $("#alert_email").addClass('d-block');
                            setTimeout(function() {
                                $("#alert_email").removeClass('d-block');
                                $("#alert_email").addClass('d-none');
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
