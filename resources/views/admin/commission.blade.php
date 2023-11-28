<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Commission')
</head>

<body>
    @extends('admin.layout')

    @section('content')
        <div class="py-5 mt-3" style="padding-right: 200px; padding-left: 200px;">
            <h4 class="mb-2">Create Commission</h4>
            <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                Name is exist!
                <button type="button" class="btn-close" id="close_alert"></button>
            </div>
            <div id='alert_success' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                Create Commission Success!
                <button type="button" class="btn-close" id="close_success"></button>
            </div>
            <form id='form_create'>
                @csrf
                <div class="row">
                    <div class="col-sm-8">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="col-sm-4">
                        <label class="form-label" for="price">Cost</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Price">
                    </div>
                </div>
                <button disabled id='create' type="button" class="btn btn-primary mt-4">Create</button>
                <a href="/admin" class="btn btn-danger mt-4">Exit</a>
            </form>
        </div>
    @stop

    @section('scripts')
        <script>
            $("#close_alert").on('click', function() {
                $("#alert_email").removeClass('d-block');
                $("#alert_email").addClass('d-none');
            });

            $("#close_success").on('click', function() {
                $("#alert_success").removeClass('d-block');
                $("#alert_success").addClass('d-none');
            });

            $("form :input").on('keyup', function() {
                if ($("#name").val().trim() && $("#price").val().trim()) {
                    $("#create").attr('disabled', false);
                } else {
                    $("#create").attr('disabled', true);
                }
            })

            $('#create').on('click', function() {
                $(document).on('ajaxStart', function() {
                    $("form :input").prop("disabled", true);
                    $("#create").attr('disabled', true);
                    $("#create").empty();
                    $("#create").append(
                        `<div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                </div>`
                    );
                });

                $(document).on('ajaxComplete', function() {
                    $("form :input").prop("disabled", false);
                    $("#create").attr('disabled', false);
                    $("#create").empty();
                    $("#create").append(
                        `Create Commission`
                    );
                })

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData($('#form_create')[0]);
                //console.log([...formData])

                $.ajax({
                    type: 'POST',
                    url: '/admin/commission',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(res) {
                        $("#alert_success").removeClass('d-none');
                        $("#alert_success").addClass('d-block');
                        setTimeout(function() {
                            $("#alert_success").removeClass('d-block');
                            $("#alert_success").addClass('d-none');
                        }, 3000);
                        $('#form_create')[0].reset();
                        // window.location.href = "/";
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
            });
        </script>
    @stop
</body>

</html>
