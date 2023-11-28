<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Create Ticket')
</head>

<body>
    @extends('layout')

    @section('content')
        <div class="py-5 mt-3" style="padding-right: 200px; padding-left: 200px;">
            <h4 class="mb-2">Create Ticket</h4>
            <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                Error
                <button type="button" class="btn-close" id="close_alert"></button>
            </div>
            <div id='alert_success' class="d-none alert alert-warning alert-dismissible fade show" role="alert">
                Create Ticket Success!
                <button type="button" class="btn-close" id="close_success"></button>
            </div>
            <form id='form_create'>
                @csrf
                <div class="row">
                    <div class="col-sm-7">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label" for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Price">
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label" for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="form-label" for="description">Description</label>
                    <textarea rows="5" id="description" name="description" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="mt-4">
                    <label class="form-label" for="image">Image</label>
                    <input name="image" id="image" type="file" class="form-control" accept=".jpg,.jpeg,.png" />
                    <div class="border rounded-lg text-center p-3 mt-3">
                        <img src="//placehold.it/140?text=IMAGE" class="img-fluid" id="preview" />
                    </div>
                </div>
                <button disabled id='create' type="button" class="btn btn-primary mt-4">Create</button>
                <a href="/" class="btn btn-danger mt-4">Exit</a>
            </form>
        </div>
    @stop

    @section('scripts')
        <script>
            $("#image").on('change', function() {
                var input = $(this)[0];
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })

            $("#close_alert").on('click', function() {
                $("#alert_email").removeClass('d-block');
                $("#alert_email").addClass('d-none');
            });

            $("#close_success").on('click', function() {
                $("#alert_success").removeClass('d-block');
                $("#alert_success").addClass('d-none');
            });

            $("form :input").on('keyup', function() {
                if ($("#name").val().trim() && $("#quantity").val().trim() && $("#price").val().trim() && $(
                        "#description").val().trim()) {
                    $("#create").attr('disabled', false);
                } else {
                    $("#create").attr('disabled', true);
                }
            })

            $('#create').on('click', function() {
                // const name = $("#name").val().trim();
                // const quantity = $("#quantity").val().trim();
                // const price = $("#price").val().trim();
                // const description = $("#description").val().trim();
                // const image = $("#image")[0].files[0];

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
                        `Create Ticket`
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
                    url: '/user/create-ticket',
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
                        $('#preview').attr('src', '//placehold.it/140?text=IMAGE').fadeIn('slow');
                        // window.location.href = "/";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $("#alert_email").removeClass('d-none');
                        $("#alert_email").addClass('d-block');
                        setTimeout(function() {
                            $("#alert_email").removeClass('d-block');
                            $("#alert_email").addClass('d-none');
                        }, 3000);
                    }
                });
            });
        </script>
    @stop
</body>

</html>
