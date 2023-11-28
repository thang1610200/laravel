@extends('admin-lte.layout');

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Commission</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Commission</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create commission</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div id='alert_email' class="d-none alert alert-warning alert-dismissible fade show"
                                role="alert">
                                Name is exist!
                                <button type="button" class="close" id="close_alert"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div id='alert_success' class="d-none alert alert-warning alert-dismissible fade show"
                                role="alert">
                                Create Commission Success!
                                <button type="button" class="close" id="close_success"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <form id="quickForm">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Commission name">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="price">Cost</label>
                                        <input type="number" class="form-control" id="price" name="price"
                                            placeholder="Price">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button disabled id='create' type="button" class="btn btn-primary">Create</button>
                                    <a href="/admin" class="btn btn-danger">Exit</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
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
